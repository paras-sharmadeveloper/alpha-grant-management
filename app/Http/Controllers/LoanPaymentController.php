<?php
namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\LoanRepayment;
use App\Models\SavingsAccount;
use App\Models\Transaction;
use App\Notifications\LoanPaymentReceived;
use App\Utilities\LoanCalculator as Calculator;
use DataTables;
use DB;
use Exception;
use Illuminate\Http\Request;
use Validator;

class LoanPaymentController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_timezone());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
         $assets = ['datatable'];
        return view('backend.admin.loan_payment.list', compact('assets'));
    }

    public function get_table_data() {
        $loanpayments = LoanPayment::select('loan_payments.*')
            ->with(['loan', 'loan.borrower'])
            ->orderBy("loan_payments.id", "desc");

        return Datatables::eloquent($loanpayments)
            ->addColumn('member_name', function ($loanpayment) {
                return $loanpayment->loan->borrower->first_name . ' ' . $loanpayment->loan->borrower->last_name;
            })
            ->editColumn('repayment_amount', function ($loanpayment) {
                return decimalPlace($loanpayment->repayment_amount - $loanpayment->interest, currency($loanpayment->loan->currency->name));
            })
            ->addColumn('total_amount', function ($loanpayment) {
                return decimalPlace($loanpayment->total_amount, currency($loanpayment->loan->currency->name));
            })
            ->addColumn('action', function ($loanpayment) {
                return '<div class="dropdown text-center">'
                . '<button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">' . _lang('Action')
                . '&nbsp;</button>'
                . '<div class="dropdown-menu">'
                . '<a class="dropdown-item" href="' . route('loan_payments.show', $loanpayment['id']) . '" data-title="' . _lang('Update Account') . '"><i class="ti-eye"></i>  ' . _lang('View') . '</a>'
                . '<a class="dropdown-item" href="' . route('loan_payments.show', $loanpayment['id']) . '?print=general" target="_blank"><i class="fas fa-print"></i>  ' . _lang('Regular Print') . '</a>'
                . '<a class="dropdown-item" href="' . route('loan_payments.show', $loanpayment['id']) . '?print=pos" target="_blank"><i class="fas fa-print"></i>  ' . _lang('POS Receipt') . '</a>'
                . '<a class="dropdown-item" href="' . route('loans.show', $loanpayment['loan_id']) . '" data-title="' . _lang('Account Details') . '"><i class="ti-file"></i> ' . _lang('Loan Details') . '</a>'
                . '<form action="' . route('loan_payments.destroy', $loanpayment['id']) . '" method="post">'
                . csrf_field()
                . '<input name="_method" type="hidden" value="DELETE">'
                . '<button class="dropdown-item btn-remove" type="submit"><i class="ti-trash"></i> ' . _lang('Delete') . '</button>'
                    . '</form>'
                    . '</div>'
                    . '</div>';
            })
            ->setRowId(function ($loanpayment) {
                return "row_" . $loanpayment->id;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

    
        $alert_col = 'col-lg-8 offset-lg-2';
        return view('backend.admin.loan_payment.create', compact('alert_col'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'loan_id'          => 'required',
            'paid_at'          => 'required',
            'late_penalties'   => 'nullable|numeric',
            'principal_amount' => 'required|numeric',
            'interest'         => 'required|numeric',
            'due_amount_of'    => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('loan_payments.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        DB::beginTransaction();
        $repayment = LoanRepayment::where('loan_id', $request->loan_id)
            ->where('status', 0)
            ->orderBy('id', 'asc')
            ->first();

        if ($repayment->id != $request->due_amount_of) {
            return back()->with('error', _lang('Invalid Operation !'));
        }

        $existing_amount = $repayment->principal_amount;

        $loan = Loan::find($request->loan_id);

        $amount = $request->principal_amount + $request->late_penalties + $repayment->interest;
        if ($request->account_id != 'cash') {

            $account = SavingsAccount::where('id', $request->account_id)
                ->where('member_id', $loan->borrower_id)
                ->first();

            if (! $account) {
                return back()->with('error', _lang('Invalid account !'));
            }

            //Check Available Balance
            if (get_account_balance($request->account_id, $loan->borrower_id) < $amount) {
                return back()->with('error', _lang('Insufficient balance !'));
            }
        }

        if ($request->account_id != 'cash') {
            //Create Debit Transactions
            $debit                     = new Transaction();
            $debit->trans_date         = now();
            $debit->member_id          = $loan->borrower_id;
            $debit->savings_account_id = $request->account_id;
            $debit->amount             = $amount;
            $debit->dr_cr              = 'dr';
            $debit->type               = 'Loan_Repayment';
            $debit->method             = 'Manual';
            $debit->status             = 2;
            $debit->note               = _lang('Loan Repayment');
            $debit->description        = _lang('Loan Repayment');
            $debit->created_user_id    = auth()->id();
            $debit->branch_id          = $loan->borrower->branch_id;
            $debit->loan_id            = $loan->id;

            $debit->save();
        }

        $loanpayment                   = new LoanPayment();
        $loanpayment->loan_id          = $request->loan_id;
        $loanpayment->paid_at          = $request->paid_at;
        $loanpayment->late_penalties   = $request->late_penalties ?? 0; //it's optionals
        $loanpayment->interest         = $repayment->interest;
        $loanpayment->repayment_amount = $request->principal_amount + $repayment->interest;
        $loanpayment->total_amount     = $loanpayment->repayment_amount + $request->late_penalties;
        $loanpayment->remarks          = $request->remarks;
        $loanpayment->repayment_id     = $repayment->id;
        $loanpayment->member_id        = $loan->borrower_id;
        $loanpayment->transaction_id   = $request->account_id != 'cash' ? $debit->id : null;

        $loanpayment->save();

        //Update Loan Balance
        $loan->total_paid = $loan->total_paid + $request->principal_amount;
        if ($loan->total_paid >= $loan->applied_amount) {
            $loan->status = 2;
        }
        $loan->save();

        //Update Repayment Status
        $repayment->principal_amount = $request->principal_amount;
        $repayment->amount_to_pay    = $request->principal_amount + $repayment->interest;
        //$repayment->balance          = $loan->total_payable - ($loan->total_paid + $loan->payments->sum('interest'));
        $repayment->balance = $loan->applied_amount - $loan->total_paid;
        $repayment->status  = 1;
        $repayment->save();

        //Delete All Upcomming Repayment schedule if payment is done
        if ($loan->total_paid >= $loan->applied_amount) {
            LoanRepayment::where('loan_id', $request->loan_id)->where('status', 0)->delete();
        } else {
            //Update Upcomming Repayment Schedule
            if ($request->principal_amount != $existing_amount) {
                $upCommingRepayments = LoanRepayment::where('loan_id', $request->loan_id)
                    ->where('status', 0)
                    ->orderBy('id', 'asc')
                    ->get();

                if ($upCommingRepayments->isEmpty()) {
                    return back()->with('error', _lang('You must pay the full repayment amount as this is your final scheduled payment.'));
                }

                // Create Loan Repayments
                $interest_type = $loan->loan_product->interest_type;
                $calculator    = new Calculator(
                    $loan->applied_amount - $loan->total_paid,
                    $upCommingRepayments[0]->repayment_date,
                    $loan->loan_product->interest_rate,
                    $upCommingRepayments->count(),
                    $loan->loan_product->term_period,
                    $loan->late_payment_penalties,
                    $loan->applied_amount
                );

                if ($interest_type == 'flat_rate') {
                    $repayments = $calculator->get_flat_rate();
                } else if ($interest_type == 'fixed_rate') {
                    $repayments = $calculator->get_fixed_rate();
                } else if ($interest_type == 'mortgage') {
                    $repayments = $calculator->get_mortgage();
                } else if ($interest_type == 'one_time') {
                    $repayments = $calculator->get_one_time();
                } else if ($interest_type == 'reducing_amount') {
                    $repayments = $calculator->get_reducing_amount();
                }

                $index = 0;
                foreach ($repayments as $newRepayment) {
                    $upCommingRepayment                   = $upCommingRepayments[$index];
                    $upCommingRepayment->amount_to_pay    = $newRepayment['amount_to_pay'];
                    $upCommingRepayment->penalty          = $newRepayment['penalty'];
                    $upCommingRepayment->principal_amount = $newRepayment['principal_amount'];
                    $upCommingRepayment->interest         = $newRepayment['interest'];
                    $upCommingRepayment->balance          = $newRepayment['balance'];
                    $upCommingRepayment->save();
                    $index++;
                }
            }
        }

        DB::commit();

        try {
            $loanpayment->member->notify(new LoanPaymentReceived($loanpayment));
        } catch (Exception $e) {}

        return redirect()->route('loan_payments.index')->with('success', _lang('Loan Payment Made Sucessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $tenant, $id) {
        $loanpayment = LoanPayment::find($id);
        if (! $request->ajax()) {
            return view('backend.admin.loan_payment.view', compact('loanpayment', 'id'));
        } else {
            return view('backend.admin.loan_payment.modal.view', compact('loanpayment', 'id'));
        }
    }

    public function get_repayment_by_loan_id($tenant, $loan_id) {
        $repayments = LoanRepayment::where('loan_id', $loan_id)
            ->where('status', 0)
            ->orderBy('id', 'asc')
            ->limit(1)
            ->get();

        $accounts = [];
        if ($repayments->count() > 0) {
            $accounts = SavingsAccount::with('savings_type.currency')
                ->where('member_id', $repayments[0]->loan->borrower_id)
                ->get();
        }

        echo json_encode(['repayments' => $repayments, 'accounts' => $accounts]);
    }

    // ── Admin Pay Hub ─────────────────────────────────────────────────────────

    public function pay_index() {
        $assets       = ['datatable'];
        $bankAccounts = \App\Models\BankAccount::all();
        $stripeKey    = config('services.stripe.key');
        return view('backend.admin.pay.index', compact('assets', 'bankAccounts', 'stripeKey'));
    }

    public function pay_search(Request $request) {
        $q = $request->input('q', '');
        if (strlen($q) < 1) {
            return response()->json([]);
        }
        $loans = Loan::with(['borrower', 'currency', 'next_payment'])
            ->where('status', 1)
            ->where(function ($query) use ($q) {
                $query->where('loan_id', 'like', "%$q%")
                    ->orWhereHas('borrower', function ($bq) use ($q) {
                        $bq->where('member_no', 'like', "%$q%")
                            ->orWhere('first_name', 'like', "%$q%")
                            ->orWhere('last_name', 'like', "%$q%");
                    });
            })
            ->limit(20)
            ->get()
            ->map(function ($loan) {
                $next = $loan->next_payment;
                return [
                    'id'               => $loan->id,
                    'loan_id'          => $loan->loan_id,
                    'borrower_name'    => $loan->borrower->first_name . ' ' . $loan->borrower->last_name,
                    'member_no'        => $loan->borrower->member_no,
                    'applied_amount'   => $loan->applied_amount,
                    'outstanding'      => ($loan->applied_amount ?? 0) - ($loan->total_paid ?? 0),
                    'currency'         => $loan->currency->name ?? '',
                    'next_due_date'    => $next ? $next->repayment_date : null,
                    'next_principal'   => $next ? $next->principal_amount : 0,
                    'next_interest'    => $next ? $next->interest : 0,
                    'next_penalty'     => $next ? $next->penalty : 0,
                    'next_repayment_id'=> $next ? $next->id : null,
                ];
            });

        return response()->json($loans);
    }

    public function pay_process(Request $request) {
        $validator = Validator::make($request->all(), [
            'loan_id'          => 'required|exists:loans,id',
            'paid_at'          => 'required',
            'principal_amount' => 'required|numeric|min:0.01',
            'interest'         => 'required|numeric|min:0',
            'late_penalties'   => 'nullable|numeric|min:0',
            'due_amount_of'    => 'required',
            'payment_method'   => 'required|in:cash,bank_transfer',
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
        }

        DB::beginTransaction();

        $loan      = Loan::find($request->loan_id);
        $repayment = LoanRepayment::where('loan_id', $loan->id)->where('status', 0)->orderBy('id', 'asc')->first();

        if (!$repayment || $repayment->id != $request->due_amount_of) {
            return response()->json(['result' => 'error', 'message' => _lang('Invalid repayment schedule.')]);
        }

        $existing_amount = $repayment->principal_amount;
        $late_penalties  = $request->late_penalties ?? 0;
        $total           = $request->principal_amount + $request->interest + $late_penalties;

        $loanpayment                   = new LoanPayment();
        $loanpayment->loan_id          = $loan->id;
        $loanpayment->paid_at          = $request->paid_at;
        $loanpayment->late_penalties   = $late_penalties;
        $loanpayment->interest         = $request->interest;
        $loanpayment->repayment_amount = $request->principal_amount + $request->interest;
        $loanpayment->total_amount     = $total;
        $loanpayment->remarks          = $request->remarks . ' | Method: ' . strtoupper($request->payment_method)
            . ($request->payment_method === 'bank_transfer'
                ? ($request->utr_number ? ' | Ref: ' . $request->utr_number : '')
                : '');
        $loanpayment->repayment_id     = $repayment->id;
        $loanpayment->member_id        = $loan->borrower_id;
        $loanpayment->save();

        // Record who paid
        $paidBy = auth()->id();

        // Update loan balance
        $loan->total_paid = ($loan->total_paid ?? 0) + $request->principal_amount;
        if ($loan->total_paid >= $loan->applied_amount) {
            $loan->status = 2;
        }
        $loan->save();

        // Update repayment status
        $repayment->principal_amount = $request->principal_amount;
        $repayment->amount_to_pay    = $request->principal_amount + $request->interest;
        $repayment->balance          = $loan->applied_amount - $loan->total_paid;
        $repayment->status           = 1;
        $repayment->save();

        if ($loan->total_paid >= $loan->applied_amount) {
            LoanRepayment::where('loan_id', $loan->id)->where('status', 0)->delete();
        } else {
            if ($request->principal_amount != $existing_amount) {
                $upComming = LoanRepayment::where('loan_id', $loan->id)->where('status', 0)->orderBy('id', 'asc')->get();
                if ($upComming->isNotEmpty()) {
                    $calculator = new \App\Utilities\LoanCalculator(
                        $loan->applied_amount - $loan->total_paid,
                        $upComming[0]->getRawOriginal('repayment_date'),
                        $loan->loan_product->interest_rate,
                        $upComming->count(),
                        $loan->loan_product->term_period,
                        $loan->late_payment_penalties,
                        $loan->applied_amount
                    );
                    $interest_type = $loan->loan_product->interest_type;
                    $newRepayments = $interest_type === 'flat_rate' ? $calculator->get_flat_rate()
                        : ($interest_type === 'mortgage' ? $calculator->get_mortgage()
                        : ($interest_type === 'one_time' ? $calculator->get_one_time()
                        : ($interest_type === 'reducing_amount' ? $calculator->get_reducing_amount()
                        : $calculator->get_fixed_rate())));
                    foreach ($newRepayments as $i => $nr) {
                        if (isset($upComming[$i])) {
                            $upComming[$i]->fill(['amount_to_pay' => $nr['amount_to_pay'], 'penalty' => $nr['penalty'], 'principal_amount' => $nr['principal_amount'], 'interest' => $nr['interest'], 'balance' => $nr['balance']])->save();
                        }
                    }
                }
            }
        }

        DB::commit();

        try {
            $loanpayment->member->notify(new \App\Notifications\LoanPaymentReceived($loanpayment));
        } catch (\Exception $e) {}

        return response()->json(['result' => 'success', 'message' => _lang('Payment processed successfully'), 'payment_id' => $loanpayment->id]);
    }

    public function pay_stripe($tenant, $loan_id) {
        $loan            = Loan::findOrFail($loan_id);
        $today           = \Carbon\Carbon::today();
        $repDate         = \Carbon\Carbon::parse($loan->next_payment->getRawOriginal('repayment_date'));
        $overdueDays     = $today->gt($repDate) ? $repDate->diffInDays($today) : 0;
        // Use ?late= from modal if provided, otherwise auto-calculate
        $late_penalties  = request()->has('late')
            ? max((float) request('late'), 0)
            : max($overdueDays * $loan->next_payment->penalty, 0);
        $totalAmount     = $loan->next_payment->principal_amount + $loan->next_payment->interest + $late_penalties;
        $publishable_key = config('services.stripe.key');
        return view('backend.admin.pay.stripe', compact('loan', 'totalAmount', 'late_penalties', 'publishable_key'));
    }

    public function pay_stripe_callback(Request $request, $tenant, $loan_id) {
        $loan      = Loan::findOrFail($loan_id);
        $repayment = $loan->next_payment;

        // Use the late_penalties passed from the form (set on the stripe page)
        $penalty = max((float) $request->input('late_penalties', 0), 0);
        $amount  = $repayment->principal_amount + $repayment->interest + $penalty;

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        try {
            \Stripe\Charge::create([
                'amount'      => round($amount * 100),
                'currency'    => strtolower($loan->currency->name),
                'source'      => $request->stripeToken,
                'description' => 'Loan Repayment - ' . $loan->loan_id,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        // Record payment
        DB::beginTransaction();
        $loanpayment                   = new LoanPayment();
        $loanpayment->loan_id          = $loan->id;
        $loanpayment->paid_at          = date('Y-m-d');
        $loanpayment->late_penalties   = $penalty;
        $loanpayment->interest         = $repayment->interest;
        $loanpayment->repayment_amount = $repayment->principal_amount + $repayment->interest;
        $loanpayment->total_amount     = $amount;
        $loanpayment->remarks          = 'Stripe Payment';
        $loanpayment->repayment_id     = $repayment->id;
        $loanpayment->member_id        = $loan->borrower_id;
        $loanpayment->save();

        $loan->total_paid = ($loan->total_paid ?? 0) + $repayment->principal_amount;
        if ($loan->total_paid >= $loan->applied_amount) { $loan->status = 2; }
        $loan->save();
        $repayment->balance = $loan->applied_amount - $loan->total_paid;
        $repayment->status  = 1;
        $repayment->save();
        if ($loan->total_paid >= $loan->applied_amount) {
            LoanRepayment::where('loan_id', $loan->id)->where('status', 0)->delete();
        }
        DB::commit();

        return redirect()->route('pay.index')->with('success', _lang('Stripe payment processed successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tenant, $id) {
        DB::beginTransaction();

        $loanpayment = LoanPayment::find($id);

        $transaction = Transaction::find($loanpayment->transaction_id);
        if ($transaction) {
            $transaction->delete();
        }

        //Update Balance
        $repayment         = LoanRepayment::find($loanpayment->repayment_id);
        $repayment->status = 0;
        $repayment->save();

        $loan             = Loan::find($loanpayment->loan_id);
        $loan->total_paid = $loan->total_paid - $repayment->principal_amount;
        if ($loan->total_paid < $loan->applied_amount) {
            $loan->status = 1;
        }
        $loan->save();

        $loanpayment->delete();

        DB::commit();

        return back()->with('success', _lang('Deleted Sucessfully'));
    }
}
