@extends('layouts.app')

@section('content')
<style>
    .db-stat { background:#fff; border-radius:8px; padding:20px 24px; font-family:"Poppins",sans-serif; margin-bottom:20px; box-shadow:0 1px 4px rgba(0,0,0,0.07); display:flex; align-items:center; justify-content:space-between; }
    .db-stat-left { display:flex; flex-direction:column; }
    .db-stat-label { font-size:13px; font-weight:400; color:#555; margin-bottom:6px; }
    .db-stat-value { font-size:22px; font-weight:600; color:#222; }
    .db-stat-icon { width:48px; height:48px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:20px; color:#fff; flex-shrink:0; }
    .loan-tbl th { background:#214942; color:#fff; font-size:12px; font-weight:500; white-space:nowrap; padding:10px 12px; }
    .loan-tbl td { font-size:12px; vertical-align:middle; white-space:nowrap; padding:9px 12px; }
    .b-overdue { background:#e74c3c; color:#fff; padding:2px 8px; border-radius:10px; font-size:11px; }
    .b-current { background:#27ae60; color:#fff; padding:2px 8px; border-radius:10px; font-size:11px; }
</style>

{{-- ── 4 Stat Cards ── --}}
<div class="row">
    <div class="col-xl col-md-4 col-sm-6">
        <div class="db-stat">
            <div class="db-stat-left">
                <span class="db-stat-label">Total Loan Book</span>
                <span class="db-stat-value">{{ currency_symbol() }}{{ number_format(round($total_loan_book)) }}</span>
            </div>
            <div class="db-stat-icon" style="background:#214942;">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="db-stat">
            <div class="db-stat-left">
                <span class="db-stat-label">Total Outstanding</span>
                <span class="db-stat-value">{{ currency_symbol() }}{{ number_format(round($total_outstanding)) }}</span>
            </div>
            <div class="db-stat-icon" style="background:#1a6b5a;">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="db-stat">
            <div class="db-stat-left">
                <span class="db-stat-label">Due This Month</span>
                <span class="db-stat-value">{{ currency_symbol() }}{{ number_format(round($due_this_month)) }}</span>
            </div>
            <div class="db-stat-icon" style="background:#44a74a;">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="db-stat">
            <div class="db-stat-left">
                <span class="db-stat-label">Borrowers</span>
                <span class="db-stat-value">{{ $total_borrowers }}</span>
            </div>
            <div class="db-stat-icon" style="background:#2c7873;">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-xl col-md-4 col-sm-6">
        <div class="db-stat">
            <div class="db-stat-left">
                <span class="db-stat-label">Total Loans</span>
                <span class="db-stat-value">{{ $active_loans + $pending_loans }}</span>
            </div>
            <div class="db-stat-icon" style="background:#e67e22;">
                <i class="fas fa-list-alt"></i>
            </div>
        </div>
    </div>
</div>

{{-- ── Recent Transactions ── --}}
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header" style="font-family:Poppins,sans-serif;font-size:14px;">
                {{ _lang('Recent Transactions') }}
            </div>
            <div class="card-body px-0 pt-0">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="pl-4">{{ _lang('Loan No') }}</th>
                                <th>{{ _lang('Date') }}</th>
                                <th>{{ _lang('Member') }}</th>
                                <th>{{ _lang('Type') }}</th>
                                <th>{{ _lang('Dr/Cr') }}</th>
                                <th class="text-right pr-4">{{ _lang('Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_transactions as $tx)
                            <tr>
                                <td class="pl-4">
                                    @if($tx->loan_id && $tx->loan->id)
                                        <a href="{{ route('loans.show', $tx->loan_id) }}" style="color:#214942;font-weight:500;">{{ $tx->loan->loan_id }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>{{ $tx->trans_date }}</td>
                                <td>{{ $tx->member->first_name ?? '' }} {{ $tx->member->last_name ?? '' }}</td>
                                <td>{{ str_replace('_', ' ', $tx->type) }}</td>
                                <td>
                                    @if($tx->dr_cr == 'dr')
                                        <span class="badge badge-danger">DR</span>
                                    @else
                                        <span class="badge badge-success">CR</span>
                                    @endif
                                </td>
                                <td class="text-right pr-4 {{ $tx->dr_cr == 'dr' ? 'text-danger' : 'text-success' }}">
                                    {{ $tx->dr_cr == 'dr' ? '-' : '+' }}{{ decimalPlace($tx->amount, currency_symbol()) }}
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted">{{ _lang('No Data Available') }}</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Due Loan Payments ── --}}
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header" style="font-family:Poppins,sans-serif;font-size:14px;">
                {{ _lang('Due Loan Payments') }}
            </div>
            <div class="card-body px-0 pt-0">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="pl-4">{{ _lang('Loan ID') }}</th>
                                <th>{{ _lang('Member No') }}</th>
                                <th>{{ _lang('Member') }}</th>
                                <th>{{ _lang('Last Payment Date') }}</th>
                                <th>{{ _lang('Due Repayments') }}</th>
                                <th class="text-right pr-4">{{ _lang('Total Due') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($due_repayments) == 0)
                                <tr><td colspan="6" class="text-center text-muted">{{ _lang('No Data Available') }}</td></tr>
                            @endif
                            @foreach($due_repayments as $repayment)
                            <tr>
                                <td class="pl-4">{{ $repayment->loan->loan_id }}</td>
                                <td>{{ $repayment->loan->borrower->member_no }}</td>
                                <td>{{ $repayment->loan->borrower->name }}</td>
                                <td>{{ $repayment->repayment_date }}</td>
                                <td>{{ $repayment->total_due_repayment }}</td>
                                <td class="text-right pr-4">{{ decimalPlace($repayment->total_due, currency($repayment->loan->currency->name)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-script')
<script src="{{ asset('public/backend/plugins/chartJs/chart.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/dashboard.js') }}"></script>
@endsection
