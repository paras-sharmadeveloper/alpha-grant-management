<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomField;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\LoanProduct;
use App\Models\LoanRepayment;
use App\Models\SavingsAccount;
use App\Models\Transaction;
use App\Notifications\LoanPaymentReceived;
use App\Utilities\LoanCalculator as Calculator;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe as StripeClient;
use Stripe\Charge;

class LoanController extends Controller {


    
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
        // Exclude pending loans (status=0) — they are shown on the pending_loans page instead
        $loans  = Loan::where('borrower_id', auth()->user()->member->id)
            ->whereIn('status', [1, 2, 3])
            ->orderBy("loans.id", "desc")
            ->get();
        return view('backend.customer.loan.my_loans', compact('loans', 'assets'));
    }

    public function pending_loans() {
        $assets = ['datatable'];
        $loans  = Loan::where('borrower_id', auth()->user()->member->id)
            ->where('status', 0)
            ->orderBy("loans.id", "desc")
            ->get();
        return view('backend.customer.loan.pending_loans', compact('loans', 'assets'));
    }

    public function loan_details($teant, $loan_id) {
        $assets = ['datatable'];
        $loan   = Loan::where('id', $loan_id)
            ->where('borrower_id', auth()->user()->member->id)
            ->first();

        if (! $loan) {
            abort(403, _lang('Unauthorized Action'));
        }

        // If role is customer (member) and loan is pending, show unauthorized action
        if (auth()->user()->user_type == 'customer' && $loan->status == 0) {
            abort(403, _lang('Unauthorized Action'));
        }

        $customFields = CustomField::where('table', 'loans')
            ->where('status', 1)
            ->orderBy("id", "asc")
            ->get();
        $loancollaterals = \App\Models\LoanCollateral::where('loan_id', $loan_id)->orderBy('id', 'desc')->get();
        $repayments = \App\Models\LoanRepayment::withoutGlobalScopes()
            ->where('loan_id', $loan_id)
            ->orderBy('repayment_date', 'asc')
            ->get();
        $memberDocuments = \App\Models\MemberDocument::withoutGlobalScopes()->where('loan_id', $loan_id)->get();
        return view('backend.customer.loan.loan_details', compact('loan', 'customFields', 'assets', 'loancollaterals', 'repayments', 'memberDocuments'));
    }

    public function print_schedule($tenant, $loan_id) {
        $loan = Loan::where('id', $loan_id)
            ->where('borrower_id', auth()->user()->member->id)
            ->firstOrFail();

        $query = \App\Models\LoanRepayment::withoutGlobalScopes()
            ->where('loan_id', $loan->id)
            ->orderBy('repayment_date', 'asc');

        if (request('from')) {
            $query->where('repayment_date', '>=', request('from'));
        }
        if (request('to')) {
            $query->where('repayment_date', '<=', request('to'));
        }

        $repayments = $query->get();
        return view('backend.admin.loan.print_schedule', compact('loan', 'repayments'));
    }

    public function calculator(Request $request) {
        if ($request->isMethod('get')) {
            $data                           = [];
            $data['first_payment_date']     = '';
            $data['apply_amount']           = '';
            $data['interest_rate']          = '';
            $data['interest_type']          = '';
            $data['term']                   = '';
            $data['term_period']            = '';
            $data['late_payment_penalties'] = 0;
            return view('backend.customer.loan.calculator', $data);
        } else if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'apply_amount'           => 'required|numeric',
                'interest_rate'          => 'required',
                'interest_type'          => 'required',
                'term'                   => 'required|integer|max:100',
                'term_period'            => $request->interest_type == 'one_time' ? '' : 'required',
                'late_payment_penalties' => 'required',
                'first_payment_date'     => 'required',
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
                } else {
                    return redirect()->route('loans.calculator')->withErrors($validator)->withInput();
                }
            }

            $first_payment_date     = $request->first_payment_date;
            $apply_amount           = $request->apply_amount;
            $interest_rate          = $request->interest_rate;
            $interest_type          = $request->interest_type;
            $term                   = $request->term;
            $term_period            = $request->term_period;
            $late_payment_penalties = $request->late_payment_penalties;

            $data       = [];
            $table_data = [];

            if ($interest_type == 'flat_rate') {

                $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
                $table_data             = $calculator->get_flat_rate();
                $data['payable_amount'] = $calculator->payable_amount;

            } else if ($interest_type == 'fixed_rate') {

                $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
                $table_data             = $calculator->get_fixed_rate();
                $data['payable_amount'] = $calculator->payable_amount;

            } else if ($interest_type == 'mortgage') {

                $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
                $table_data             = $calculator->get_mortgage();
                $data['payable_amount'] = $calculator->payable_amount;

            } else if ($interest_type == 'one_time') {

                $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, 1, $term_period, $late_payment_penalties);
                $table_data             = $calculator->get_one_time();
                $data['payable_amount'] = $calculator->payable_amount;

            } else if ($interest_type == 'reducing_amount') {

                $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
                $table_data             = $calculator->get_reducing_amount();
                $data['payable_amount'] = $calculator->payable_amount;

            }

            $data['table_data']             = $table_data;
            $data['first_payment_date']     = $request->first_payment_date;
            $data['apply_amount']           = $request->apply_amount;
            $data['interest_rate']          = $request->interest_rate;
            $data['interest_type']          = $request->interest_type;
            $data['term']                   = $request->term;
            $data['term_period']            = $request->term_period;
            $data['late_payment_penalties'] = $request->late_payment_penalties;

            return view('backend.customer.loan.calculator', $data);
        }
    }

    public function loan_products(Request $request) {
        $alert_col    = "col-lg-8 offset-lg-2";
        $loanProducts = LoanProduct::active()->get();
        return view('backend.customer.loan.loan_products', compact('alert_col', 'loanProducts'));
    }

    public function apply_loan(Request $request) {
        if ($request->isMethod('get')) {
            $alert_col    = "col-lg-8 offset-lg-2";
            $customFields = CustomField::where('table', 'loans')
                ->where('status', 1)
                ->orderBy("id", "asc")
                ->get();
            $accounts = SavingsAccount::with('savings_type')
                ->where('member_id', auth()->user()->member->id)
                ->get();
            $myLoans = Loan::where('borrower_id', auth()->user()->member->id)
                ->with('loan_product')
                ->orderBy('id', 'desc')
                ->get();
            return view('backend.customer.loan.apply_loan', compact('alert_col', 'customFields', 'accounts', 'myLoans'));
        } else if ($request->isMethod('post')) {
            @ini_set('max_execution_time', 0);
            @set_time_limit(0);

            //Initial Validation
            $request->validate([
                'loan_product_id' => 'required',
            ], [
                'loan_product_id.required' => 'Loan product field is required',
            ]);

            $loanProduct = LoanProduct::find($request->loan_product_id);

            $min_amount = $loanProduct->minimum_amount;
            $max_amount = $loanProduct->maximum_amount;

            $validationRules = [
                'loan_product_id'      => 'required',
                'currency_id'          => 'required',
                'applied_amount'       => "required|numeric|min:$min_amount|max:$max_amount",
                'term'                 => 'required|integer|min:' . ($loanProduct->min_term ?? 1) . '|max:' . $loanProduct->term,
                'attachment'           => 'nullable|mimes:jpeg,png,jpg,doc,pdf,docx,zip|max:8192',
                // Enquiry fields
                'enq_full_name'        => 'required|string|max:191',
                'enq_mobile'           => 'required|string|max:50',
                'enq_email'            => 'required|email|max:191',
                'enq_gst_registered'   => 'required|boolean',
                'enq_loan_purpose'     => 'required|string|max:191',
                'enq_monthly_revenue'  => 'required|string',
                'enq_ato_debt'         => 'required|boolean',
                'enq_defaults'         => 'required|boolean',
                'enq_existing_loans'   => 'required|boolean',
                'enq_security_type'    => 'required|string',
                'enq_funds_needed_by'  => 'required|date',
                'enq_consent'          => 'required|accepted',
            ];

            $validationMessages = [];

            // Custom field validation
            $customFields = CustomField::where('table', 'loans')
                ->orderBy("id", "desc")
                ->get();
            $customValidation = generate_custom_field_validation($customFields);

            array_merge($validationRules, $customValidation['rules']);
            array_merge($validationMessages, $customValidation['messages']);

            $validator = Validator::make($request->all(), $validationRules, $validationMessages);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
                } else {
                    return redirect()->route('loans.apply_loan')
                        ->withErrors($validator)
                        ->withInput();
                }
            }

            //Check Debit account is valid account
            // $account = SavingsAccount::where('id', $request->debit_account_id)
            //     ->where('member_id', auth()->user()->member->id)
            //     ->first();

            // if (! $account) {
            //     return back()->with('error', _lang('Invalid account'));
            // }

            $attachment = "";
            if ($request->hasfile('attachment')) {
                $file       = $request->file('attachment');
                $attachment = time() . $file->getClientOriginalName();
                $file->move(public_path() . "/uploads/media/", $attachment);
            }

            DB::beginTransaction();

            // Store custom field data
            $customFieldsData = store_custom_field_data($customFields);

            $loan = new Loan();
            if ($loanProduct->starting_loan_id != null) {
                $loan->loan_id = $loanProduct->loan_id_prefix . $loanProduct->starting_loan_id;
            }
            $loan->loan_product_id        = $request->input('loan_product_id');
            $loan->borrower_id            = auth()->user()->member->id;
            $loan->currency_id            = $request->input('currency_id');
            $loan->first_payment_date     = $request->input('first_payment_date') ?? now()->addMonth()->format('Y-m-d');
            $loan->release_date           = date('Y-m-d'); // Start date = today (application date)
            $loan->applied_amount         = $request->input('applied_amount');
            $loan->late_payment_penalties = 0;
            $loan->attachment             = $attachment;
            $loan->description            = $request->input('description');
            $loan->remarks                = $request->input('remarks');
            $loan->created_user_id        = auth()->id();
            $loan->custom_fields          = json_encode($customFieldsData);
            $loan->debit_account_id       = $request->debit_account_id;
            $loan->term                   = $request->input('term');

            // Use selected term (or fall back to product's max term)
            $selectedTerm = $request->input('term') ?? $loan->loan_product->term;

            // Create Loan Repayments
            $calculator = new Calculator(
                $loan->applied_amount,
                $loan->first_payment_date,
                $loan->loan_product->interest_rate,
                $selectedTerm,
                $loan->loan_product->term_period,
                $loan->late_payment_penalties
            );

            if ($loan->loan_product->interest_type == 'flat_rate') {
                $repayments = $calculator->get_flat_rate();
            } else if ($loan->loan_product->interest_type == 'fixed_rate') {
                $repayments = $calculator->get_fixed_rate();
            } else if ($loan->loan_product->interest_type == 'mortgage') {
                $repayments = $calculator->get_mortgage();
            } else if ($loan->loan_product->interest_type == 'one_time') {
                $repayments = $calculator->get_one_time();
            } else if ($loan->loan_product->interest_type == 'reducing_amount') {
                $repayments = $calculator->get_reducing_amount();
            }

            $loan->total_payable = $calculator->payable_amount;
            $loan->enq_full_name        = $request->input('enq_full_name');
            $loan->enq_mobile           = $request->input('enq_mobile');
            $loan->enq_email            = $request->input('enq_email');
            $loan->enq_business_name    = $request->input('enq_business_name');
            $loan->enq_gst_registered   = $request->input('enq_gst_registered');
            $loan->enq_years_operating  = $request->input('enq_years_operating');
            $loan->enq_abn_acn          = $request->input('enq_abn_acn');
            $loan->enq_loan_purpose     = $request->input('enq_loan_purpose');
            $loan->enq_time_in_business = $request->input('enq_time_in_business');
            $loan->enq_monthly_revenue  = $request->input('enq_monthly_revenue');
            $loan->enq_ato_debt         = $request->input('enq_ato_debt');
            $loan->enq_defaults         = $request->input('enq_defaults');
            $loan->enq_existing_loans   = $request->input('enq_existing_loans');
            $loan->enq_security_type    = $request->input('enq_security_type');
            $loan->enq_asset_type       = $request->input('enq_asset_type');
            $loan->enq_funds_needed_by  = $request->input('enq_funds_needed_by');
            $loan->enq_best_contact_time = $request->input('enq_best_contact_time');
            $loan->enq_consent          = $request->has('enq_consent') ? 1 : 0;
            $loan->save();

            //Check Account has enough balance for deducting fee
            // $convertedAmount = convert_currency($loan->currency->name, $account->savings_type->currency->name, $loan->applied_amount);

            // $charge = 0;
            // $charge += $loanProduct->loan_application_fee_type == 1 ? ($loanProduct->loan_application_fee / 100) * $convertedAmount : $loanProduct->loan_application_fee;
            // $charge += $loanProduct->loan_insurance_fee_type == 1 ? ($loanProduct->loan_insurance_fee / 100) * $convertedAmount : $loanProduct->loan_insurance_fee;

            // if (get_account_balance($account->id, $loan->borrower_id) < $charge) {
            //     return back()->with('error', _lang('Insufficient balance for deducting loan application and insurance fee !'));
            // }

            //Deduct Loan Processing Fee
            // process_loan_fee('loan_application_fee', $loan->borrower_id, $request->debit_account_id, $convertedAmount, $loanProduct->loan_application_fee, $loanProduct->loan_application_fee_type, $loan->id);

            //Increment Loan ID
            if ($loanProduct->starting_loan_id != null) {
                $loanProduct->increment('starting_loan_id');
            }

            DB::commit();

            if ($loan->id > 0) {
                return redirect()->route('loans.my_loans')->with('success', _lang('Your Loan application submitted sucessfully and your application is now under review'));
            }
        }

    }

    public function loan_payment(Request $request, $tenant, $loan_id) {
        if (request()->isMethod('get')) {
            $alert_col = 'col-lg-6 offset-lg-3';
            $loan      = Loan::where('id', $loan_id)->where('borrower_id', auth()->user()->member->id)->first();
            $accounts  = SavingsAccount::whereHas('savings_type', function (Builder $query) use ($loan) {
                $query->where('currency_id', $loan->currency_id);
            })
                ->with('savings_type')
                ->where('member_id', $loan->borrower_id)
                ->get();

            // Calculate overdue days Testing
            $today          = \Carbon\Carbon::today();
            $repayment_date = \Carbon\Carbon::parse($loan->next_payment->getRawOriginal('repayment_date'));
            $overdue_days   = $today->gt($repayment_date) ? $repayment_date->diffInDays($today) : 0;

            $penalty_per_day = $loan->next_payment->penalty;
            $late_penalties  = $overdue_days * $penalty_per_day;
            // Ensure minimum penalty is 0 (in case of no overdue days)
            $late_penalties = max($late_penalties, 0);

            //$late_penalties = date('Y-m-d') > $loan->next_payment->getRawOriginal('repayment_date') ? $loan->next_payment->penalty : 0;
            $totalAmount = $loan->next_payment->principal_amount + $loan->next_payment->interest + $late_penalties;

            return view('backend.customer.loan.payment', compact('loan', 'accounts', 'alert_col', 'late_penalties', 'totalAmount'));
        } else if (request()->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'principal_amount' => 'required|numeric',
                'account_id'       => 'required',
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
                } else {
                    return back()->withErrors($validator)->withInput();
                }
            }

            DB::beginTransaction();

            $loan            = Loan::where('id', $loan_id)->where('borrower_id', auth()->user()->member->id)->first();
            $repayment       = $loan->next_payment;
            $existing_amount = $repayment->principal_amount;

            if ($request->principal_amount < $repayment->principal_amount) {
                return back()->with('error', _lang('You need to pay minimum') . ' ' . $repayment->principal_amount . ' ' . $loan->currency->name)->withInput();
            }

            //Create Transaction
            $today          = \Carbon\Carbon::today();
            $repayment_date = \Carbon\Carbon::parse($loan->next_payment->getRawOriginal('repayment_date'));
            $overdue_days   = $today->gt($repayment_date) ? $repayment_date->diffInDays($today) : 0;

            $penalty_per_day = $loan->next_payment->penalty;
            $penalty         = $overdue_days * $penalty_per_day;
            $penalty         = max($penalty, 0);

            //$penalty = date('Y-m-d') > $repayment->getRawOriginal('repayment_date') ? $repayment->penalty : 0;
            $amount = $request->principal_amount + $penalty + $repayment->interest;

            //Check Available Balance
            if (get_account_balance($request->account_id, $loan->borrower_id) < $amount) {
                return back()->with('error', _lang('Insufficient balance !'));
            }

            //Create Debit Transactions
            $debit                     = new Transaction();
            $debit->trans_date         = now();
            $debit->member_id          = $loan->borrower_id;
            $debit->savings_account_id = $request->account_id;
            $debit->amount             = $amount;
            $debit->dr_cr              = 'dr';
            $debit->type               = 'Loan_Repayment';
            $debit->method             = 'Online';
            $debit->status             = 2;
            $debit->note               = _lang('Loan Repayment');
            $debit->description        = _lang('Loan Repayment');
            $debit->created_user_id    = auth()->id();
            $debit->branch_id          = $loan->borrower->branch_id;
            $debit->loan_id            = $loan->id;

            $debit->save();

            $loanpayment                   = new LoanPayment();
            $loanpayment->loan_id          = $loan->id;
            $loanpayment->paid_at          = date('Y-m-d');
            $loanpayment->late_penalties   = $penalty;
            $loanpayment->interest         = $repayment->interest;
            $loanpayment->repayment_amount = $request->principal_amount + $repayment->interest;
            $loanpayment->total_amount     = $loanpayment->repayment_amount + $repayment->penalty;
            $loanpayment->remarks          = $request->remarks;
            $loanpayment->transaction_id   = $debit->id;
            $loanpayment->repayment_id     = $repayment->id;
            $loanpayment->member_id        = $loan->borrower_id;

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
                LoanRepayment::where('loan_id', $loan_id)->where('status', 0)->delete();
            } else {
                //Update Upcomming Repayment Schedule
                if ($repayment->principal_amount != $existing_amount) {
                    $upCommingRepayments = LoanRepayment::where('loan_id', $loan_id)->where('status', 0)->get();

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

            if (! $request->ajax()) {
                return redirect()->route('loans.my_loans')->with('success', _lang('Payment Made Sucessfully'));
            } else {
                return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Payment Made Sucessfully'), 'data' => $loanpayment, 'table' => '#loan_payments_table']);
            }
        }
    }

    public function stripe_payment(Request $request, $tenant, $loan_id) {
        $loan = Loan::where('id', $loan_id)->where('borrower_id', auth()->user()->member->id)->firstOrFail();

        $today          = \Carbon\Carbon::today();
        $repayment_date = \Carbon\Carbon::parse($loan->next_payment->getRawOriginal('repayment_date'));
        $overdue_days   = $today->gt($repayment_date) ? $repayment_date->diffInDays($today) : 0;
        $late_penalties = max($overdue_days * $loan->next_payment->penalty, 0);
        $totalAmount    = $loan->next_payment->principal_amount + $loan->next_payment->interest + $late_penalties;

        $publishable_key = config('services.stripe.key');

        return view('backend.customer.loan.stripe_payment', compact('loan', 'totalAmount', 'late_penalties', 'publishable_key'));
    }

    public function stripe_callback(Request $request, $tenant, $loan_id) {
        $loan = Loan::where('id', $loan_id)->where('borrower_id', auth()->user()->member->id)->firstOrFail();

        $today          = \Carbon\Carbon::today();
        $repayment_date = \Carbon\Carbon::parse($loan->next_payment->getRawOriginal('repayment_date'));
        $overdue_days   = $today->gt($repayment_date) ? $repayment_date->diffInDays($today) : 0;
        $penalty        = max($overdue_days * $loan->next_payment->penalty, 0);
        $repayment      = $loan->next_payment;
        $amount         = $repayment->principal_amount + $repayment->interest + $penalty;

        $secret_key = config('services.stripe.secret');
        StripeClient::setApiKey($secret_key);

        try {
            $charge = Charge::create([
                'amount'      => round($amount * 100),
                'currency'    => strtolower($loan->currency->name),
                'source'      => $request->stripeToken,
                'description' => _lang('Loan Repayment') . ' - ' . $loan->loan_id,
            ]);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        if ($charge->paid && $charge->captured && $charge->failure_code == null) {
            DB::beginTransaction();

            $existing_amount = $repayment->principal_amount;

            // Record transaction
            $debit                     = new Transaction();
            $debit->trans_date         = now();
            $debit->member_id          = $loan->borrower_id;
            $debit->savings_account_id = $loan->debit_account_id;
            $debit->amount             = $amount;
            $debit->dr_cr              = 'dr';
            $debit->type               = 'Loan_Repayment';
            $debit->method             = 'Stripe';
            $debit->status             = 2;
            $debit->note               = _lang('Loan Repayment via Stripe');
            $debit->description        = _lang('Loan Repayment via Stripe');
            $debit->created_user_id    = auth()->id();
            $debit->branch_id          = $loan->borrower->branch_id;
            $debit->loan_id            = $loan->id;
            $debit->save();

            $loanpayment                   = new LoanPayment();
            $loanpayment->loan_id          = $loan->id;
            $loanpayment->paid_at          = date('Y-m-d');
            $loanpayment->late_penalties   = $penalty;
            $loanpayment->interest         = $repayment->interest;
            $loanpayment->repayment_amount = $repayment->principal_amount + $repayment->interest;
            $loanpayment->total_amount     = $loanpayment->repayment_amount + $penalty;
            $loanpayment->remarks          = 'Stripe Payment - ' . $charge->id;
            $loanpayment->transaction_id   = $debit->id;
            $loanpayment->repayment_id     = $repayment->id;
            $loanpayment->member_id        = $loan->borrower_id;
            $loanpayment->save();

            // Update loan balance
            $loan->total_paid = $loan->total_paid + $repayment->principal_amount;
            if ($loan->total_paid >= $loan->applied_amount) {
                $loan->status = 2;
            }
            $loan->save();

            // Update repayment status
            $repayment->amount_to_pay = $repayment->principal_amount + $repayment->interest;
            $repayment->balance       = $loan->applied_amount - $loan->total_paid;
            $repayment->status        = 1;
            $repayment->save();

            if ($loan->total_paid >= $loan->applied_amount) {
                LoanRepayment::where('loan_id', $loan_id)->where('status', 0)->delete();
            } else {
                if ($repayment->principal_amount != $existing_amount) {
                    $upCommingRepayments = LoanRepayment::where('loan_id', $loan_id)->where('status', 0)->get();
                    if (! $upCommingRepayments->isEmpty()) {
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
                        $repayments = $interest_type == 'flat_rate' ? $calculator->get_flat_rate()
                            : ($interest_type == 'fixed_rate' ? $calculator->get_fixed_rate()
                                : ($interest_type == 'mortgage' ? $calculator->get_mortgage()
                                    : ($interest_type == 'one_time' ? $calculator->get_one_time()
                                        : $calculator->get_reducing_amount())));
                        foreach ($repayments as $i => $newRepayment) {
                            $upCommingRepayments[$i]->fill([
                                'amount_to_pay'    => $newRepayment['amount_to_pay'],
                                'penalty'          => $newRepayment['penalty'],
                                'principal_amount' => $newRepayment['principal_amount'],
                                'interest'         => $newRepayment['interest'],
                                'balance'          => $newRepayment['balance'],
                            ])->save();
                        }
                    }
                }
            }

            DB::commit();

            try {
                $loanpayment->member->notify(new LoanPaymentReceived($loanpayment));
            } catch (Exception $e) {}

            return redirect()->route('loans.my_loans')->with('success', _lang('Payment Made Successfully via Stripe'));
        }

        return back()->with('error', _lang('Payment failed. Please try again.'));
    }


    public function pay_index() {
        $loans = Loan::where('borrower_id', auth()->user()->member->id)
            ->where('status', 1)
            ->with(['currency', 'next_payment', 'loan_product'])
            ->orderBy('id', 'desc')
            ->get();
        return view('backend.customer.loan.pay', compact('loans'));
    }

    public function pay_search(Request $request) {
        $q     = $request->input('q', '');
        $loans = Loan::where('borrower_id', auth()->user()->member->id)
            ->where('status', 1)
            ->where('loan_id', 'like', "%$q%")
            ->with(['currency', 'next_payment'])
            ->get()
            ->map(function ($loan) {
                $next = $loan->next_payment;
                return [
                    'id'             => $loan->id,
                    'loan_id'        => $loan->loan_id,
                    'outstanding'    => ($loan->applied_amount ?? 0) - ($loan->total_paid ?? 0),
                    'currency'       => $loan->currency->name ?? '',
                    'next_due_date'  => $next ? $next->repayment_date : null,
                    'next_amount'    => $next ? ($next->principal_amount + $next->interest) : 0,
                    'stripe_url'     => route('loans.stripe_payment', $loan->id),
                ];
            });
        return response()->json($loans);
    }

    // Function to calculate the release date
    private function calculateReleaseDate($loanData, $currentDate = null) {
        if (! $currentDate) {
            $currentDate = new DateTime();
        } else {
            // Handle d/m/Y format from model accessor
            if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $currentDate)) {
                $currentDate = DateTime::createFromFormat('d/m/Y', $currentDate);
            } else {
                $currentDate = new DateTime($currentDate);
            }
        }

        $releaseDate = clone $currentDate; // Clone to avoid modifying original

        if (isset($loanData['term'], $loanData['term_period'])) {
            $term       = intval($loanData['term']);
            $termPeriod = $loanData['term_period'];

            if (preg_match('/(\+?\d+)\s(day|month|year)/', $termPeriod, $matches)) {
                $multiplier = intval($matches[1]); // Extract the numeric value
                $unit       = $matches[2];         // Extract unit (day, month, year)

                $totalTerm = $term * $multiplier; // Compute total term duration

                // Modify date accordingly
                if ($unit === "day") {
                    $releaseDate->modify("+$totalTerm days");
                } elseif ($unit === "month") {
                    $releaseDate->modify("+$totalTerm months");
                } elseif ($unit === "year") {
                    $releaseDate->modify("+$totalTerm years");
                }

                // Return formatted dates
                return [
                    'first_payment_date' => $currentDate->format('Y-m-d'),
                    'release_date'       => $releaseDate->format('Y-m-d'),
                ];
            }
        }

        return null;
    }

}
