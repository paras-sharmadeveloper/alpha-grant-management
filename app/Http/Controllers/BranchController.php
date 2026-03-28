<?php
namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller {

    public function __construct() {
        date_default_timezone_set(get_timezone());

        $this->middleware(function ($request, $next) {
            $route_name = request()->route()->getName();
            if ($route_name == 'branches.store') {
                if (has_limit('branches', 'branch_limit') <= 0) {
                    if ($request->ajax()) {
                        return response()->json(['result' => 'error', 'message' => _lang('Sorry, Your have reached your limit ! You can update your subscription plan to increase your limit.')]);
                    }
                    return back()->with('error', _lang('Sorry, Your have reached your limit ! You can update your subscription plan to increase your limit.'));
                }
            }
            return $next($request);
        });
    }

    private function generateBranchCode(string $name, $excludeId = null): string {
        $words = preg_split('/\s+/', trim($name));
        if (count($words) >= 2) {
            $code = strtoupper(substr($words[0], 0, 2) . substr($words[1], 0, 2));
        } else {
            $code = strtoupper(substr($name, 0, 4));
        }
        $base = $code;
        $i = 1;
        while (Branch::where('branch_code', $code)->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $code = $base . $i;
            $i++;
        }
        return $code;
    }

    public function index() {
        $assets  = ['datatable'];
        $branchs = Branch::with('manager')->get()->sortByDesc("id");

        // Attach loan stats per branch
        foreach ($branchs as $branch) {
            $loans = Loan::withoutGlobalScopes()
                ->whereHas('borrower', fn($q) => $q->where('branch_id', $branch->id))
                ->where('status', 1) // 1 = Active/Approved
                ->get();

            $branch->active_loans_count    = $loans->count();
            $branch->total_portfolio_value = $loans->sum('applied_amount');
            // Outstanding = total_payable - total_paid
            $branch->outstanding_balance   = $loans->sum(fn($l) => ($l->applied_amount ?? 0) - ($l->total_paid ?? 0));
            // Arrears = late payment penalties accumulated
            $branch->arrears               = $loans->sum('late_payment_penalties');
        }

        return view('backend.admin.branch.list', compact('branchs', 'assets'));
    }

    public function create(Request $request) {
        $managers = User::where('user_type', 'user')->orWhere('user_type', 'admin')->get();
        if (! $request->ajax()) {
            $alert_col = 'col-lg-8 offset-lg-2';
            return view('backend.admin.branch.create', compact('alert_col', 'managers'));
        } else {
            return view('backend.admin.branch.modal.create', compact('managers'));
        }
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'state'         => 'nullable|string',
            'contact_email' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('branches.create')->withErrors($validator)->withInput();
            }
        }

        $branch                    = new Branch();
        $branch->name              = $request->input('name');
        $branch->branch_code       = $request->input('branch_code') ?: $this->generateBranchCode($request->input('name'));
        $branch->state             = $request->input('state');
        $branch->branch_manager_id = $request->input('branch_manager_id');
        $branch->contact_email     = $request->input('contact_email');
        $branch->contact_phone     = $request->input('contact_phone');
        $branch->address           = $request->input('address');
        $branch->descriptions      = $request->input('descriptions');
        $branch->save();

        if (! $request->ajax()) {
            return redirect()->route('branches.create')->with('success', _lang('Saved Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Successfully'), 'data' => $branch, 'table' => '#branches_table']);
        }
    }

    public function show(Request $request, $tenant, $id) {
        $branch  = Branch::with('manager')->find($id);
        $members = \App\Models\Member::withoutGlobalScopes()->where('branch_id', $id)->get();
        $users   = \App\Models\User::where('branch_id', $id)->get();

        $loans = Loan::withoutGlobalScopes()
            ->whereHas('borrower', fn($q) => $q->withoutGlobalScopes()->where('branch_id', $id))
            ->with(['borrower', 'currency', 'loan_product'])
            ->get();

        $active_loans      = $loans->where('status', 1);
        $total_portfolio   = $active_loans->sum('applied_amount');
        $outstanding       = $active_loans->sum(fn($l) => ($l->applied_amount ?? 0) - ($l->total_paid ?? 0));
        $arrears           = $active_loans->sum('late_payment_penalties');

        if (! $request->ajax()) {
            return view('backend.admin.branch.view', compact('branch', 'id', 'members', 'users', 'loans', 'active_loans', 'total_portfolio', 'outstanding', 'arrears'));
        } else {
            return view('backend.admin.branch.modal.view', compact('branch', 'id'));
        }
    }

    public function edit(Request $request, $tenant, $id) {
        $branch   = Branch::find($id);
        $managers = User::where('user_type', 'user')->orWhere('user_type', 'admin')->get();
        if (! $request->ajax()) {
            $alert_col = 'col-lg-8 offset-lg-2';
            return view('backend.admin.branch.edit', compact('branch', 'id', 'alert_col', 'managers'));
        } else {
            return view('backend.admin.branch.modal.edit', compact('branch', 'id', 'managers'));
        }
    }

    public function update(Request $request, $tenant, $id) {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'state'         => 'nullable|string',
            'contact_email' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('branches.edit', $id)->withErrors($validator)->withInput();
            }
        }

        $branch = Branch::find($id);

        $branch->name              = $request->input('name');
        $branch->branch_code       = $request->input('branch_code') ?: $branch->branch_code;
        $branch->state             = $request->input('state');
        $branch->branch_manager_id = $request->input('branch_manager_id');
        $branch->contact_email     = $request->input('contact_email');
        $branch->contact_phone     = $request->input('contact_phone');
        $branch->address           = $request->input('address');
        $branch->descriptions      = $request->input('descriptions');
        $branch->save();

        if (! $request->ajax()) {
            return redirect()->route('branches.index')->with('success', _lang('Updated Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $branch, 'table' => '#branches_table']);
        }
    }

    public function destroy($tenant, $id) {
        $branch = Branch::find($id);
        $branch->delete();
        return redirect()->route('branches.index')->with('success', _lang('Deleted Successfully'));
    }

    // AJAX endpoint to generate branch code preview
    public function generateCode(Request $request) {
        $name = $request->input('name', '');
        if (empty($name)) {
            return response()->json(['code' => '']);
        }
        $words = preg_split('/\s+/', trim($name));
        if (count($words) >= 2) {
            $code = strtoupper(substr($words[0], 0, 2) . substr($words[1], 0, 2));
        } else {
            $code = strtoupper(substr($name, 0, 4));
        }
        return response()->json(['code' => $code]);
    }
}
