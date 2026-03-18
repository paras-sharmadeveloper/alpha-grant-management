@extends('layouts.app')

@section('content')

{{--
===============================================================
 OLD LAYOUT - COMMENTED OUT (DO NOT DELETE)
===============================================================
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-sm-flex align-items-center justify-content-between">
                <div class="panel-title">{{ _lang('View Loan Details') }}</div>
                @if($loan->status == 0)
                <div>
                <a class="btn btn-primary btn-xs" href="{{ route('loans.approve', $loan['id']) }}">
                    <i class="fas fa-check-circle mr-1"></i>{{ _lang('Click to Approve') }}</a>
                <a class="btn btn-danger btn-xs confirm-alert" data-message="{{ _lang('Are you sure you want to reject this loan application?') }}" href="#">
                    <i class="fas fa-times-circle mr-1"></i>{{ _lang('Click to Reject') }}
                </a>
                </div>
                @endif
            </div>
            ... (full old content preserved in git history)
        </div>
    </div>
</div>
===============================================================
 END OLD LAYOUT
===============================================================
--}}

<style>
    .ld-top-link {
        text-align: center;
        padding: 15px;
        color: #1a73e8;
        font-weight: 600;
        font-size: 16px;
    }
    .ld-tabs {
        display: flex;
        justify-content: center;
        gap: 80px;
        border-bottom: 2px solid #ddd;
        background: #fff;
        margin-bottom: 0;
    }
    .ld-tab {
        padding: 15px;
        cursor: pointer;
        color: #333;
        font-size: 17px;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
    }
    .ld-tab.active {
        color: #1a73e8;
        border-bottom: 3px solid #1a73e8;
        font-weight: 600;
    }
    .ld-tab-content { display: none; width: 85%; margin: 20px auto; }
    .ld-tab-content.active { display: block; }

    .ld-summary-card {
        background: #D6F2FF;
        border-radius: 10px;
        padding: 25px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .ld-summary-item { flex: 1; display: flex; flex-direction: column; gap: 8px; }
    .ld-divider { width: 1px; height: 50px; background: #111f28; margin-right: 30px; }
    .ld-label { font-size: 14px; color: #1f2d3d; }
    .ld-value { font-size: 20px; font-weight: 700; color: #000; }

    .ld-details-section { background: #fff; padding: 10px 0; }
    .ld-detail-row {
        display: flex;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid #ddd;
        font-size: 17px;
    }
    .ld-detail-row .ld-label { color: #2c3e50; font-size: 17px; }
    .ld-detail-row .ld-value { font-weight: 700; font-size: 17px; color: #0b1f3a; }

    .ld-transaction {
        padding: 15px 0;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .ld-tx-left { display: flex; flex-direction: column; }
    .ld-tx-date { font-size: 13px; font-weight: 600; color: #555; }
    .ld-tx-title { font-size: 17px; margin-top: 6px; }
    .ld-tx-amount { font-weight: 800; font-size: 16px; }

    .ld-action-bar {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }

    @media (max-width: 768px) {
        .ld-tab-content { width: 95%; }
        .ld-tabs { gap: 20px; }
        .ld-summary-card { flex-direction: column; gap: 15px; }
        .ld-divider { display: none; }
    }
</style>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body p-0">

            {{-- Approve / Reject buttons (only when pending) --}}
            @if($loan->status == 0)
            <div class="ld-action-bar">
                <a href="{{ route('loans.approve', $loan->id) }}" class="btn btn-success">
                    <i class="fas fa-check-circle mr-1"></i>{{ _lang('Approve') }}
                </a>
                <a href="{{ route('loans.reject', $loan->id) }}"
                   class="btn btn-danger confirm-alert"
                   data-message="{{ _lang('Are you sure you want to reject this loan application?') }}">
                    <i class="fas fa-times-circle mr-1"></i>{{ _lang('Reject') }}
                </a>
            </div>
            @endif

            {{-- Top title --}}
            <div class="ld-top-link">
                {{ $loan->loan_product->name }} &mdash; {{ $loan->loan_id }}
            </div>

            {{-- Summary card --}}
            <div style="width:85%;margin:0 auto 20px;">
                <div class="ld-summary-card">
                    <div class="ld-summary-item">
                        <span class="ld-label">{{ _lang('Next Payment Date') }}</span>
                        <span class="ld-value">
                            {{ $loan->next_payment ? $loan->next_payment->repayment_date : '—' }}
                        </span>
                    </div>
                    <div class="ld-divider"></div>
                    <div class="ld-summary-item">
                        <span class="ld-label">{{ _lang('Pending Amount') }}</span>
                        <span class="ld-value">
                            {{ decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name)) }}
                        </span>
                    </div>
                    <div class="ld-divider"></div>
                    <div class="ld-summary-item">
                        <span class="ld-label">{{ _lang('Status') }}</span>
                        <span class="ld-value">
                            @if($loan->status == 0) <span style="color:#f39c12;">{{ _lang('Pending') }}</span>
                            @elseif($loan->status == 1) <span style="color:#27ae60;">{{ _lang('Approved') }}</span>
                            @elseif($loan->status == 2) <span style="color:#2980b9;">{{ _lang('Completed') }}</span>
                            @else <span style="color:#e74c3c;">{{ _lang('Cancelled') }}</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            {{-- Tabs --}}
            <div class="ld-tabs">
                <div class="ld-tab active" onclick="ldOpenTab('ld_details', this)">{{ _lang('Loan Details') }}</div>
                <div class="ld-tab" onclick="ldOpenTab('ld_transactions', this)">{{ _lang('Transactions') }}</div>
                <div class="ld-tab" onclick="ldOpenTab('ld_statements', this)">{{ _lang('Statements') }}</div>
            </div>

            {{-- TAB: Loan Details --}}
            <div id="ld_details" class="ld-tab-content active">
                <div class="ld-details-section">

                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Loan ID') }}</span>
                        <span class="ld-value">{{ $loan->loan_id }}</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Borrower') }}</span>
                        <span class="ld-value">{{ $loan->borrower->first_name.' '.$loan->borrower->last_name }}</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Member No') }}</span>
                        <span class="ld-value">{{ $loan->borrower->member_no }}</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Loan Amount') }}</span>
                        <span class="ld-value">{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Interest Rate') }}</span>
                        <span class="ld-value">{{ $loan->loan_product->interest_rate }}%</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Loan Term') }}</span>
                        <span class="ld-value">
                            {{ $loan->loan_product->term }} {{ preg_replace('/^\+\d+\s*/', '', $loan->loan_product->term_period) }}
                        </span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('First Payment Date') }}</span>
                        <span class="ld-value">{{ $loan->first_payment_date }}</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Release Date') }}</span>
                        <span class="ld-value">{{ $loan->release_date }}</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Total Principal Paid') }}</span>
                        <span class="ld-value" style="color:#27ae60;">{{ decimalPlace($loan->total_paid, currency($loan->currency->name)) }}</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Due Amount') }}</span>
                        <span class="ld-value" style="color:#e74c3c;">{{ decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name)) }}</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Late Payment Penalties') }}</span>
                        <span class="ld-value">{{ $loan->late_payment_penalties }}%</span>
                    </div>

                    @if($loan->status == 1)
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Approved Date') }}</span>
                        <span class="ld-value">{{ $loan->approved_date }}</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Approved By') }}</span>
                        <span class="ld-value">{{ $loan->approved_by->name }}</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Disburse Method') }}</span>
                        <span class="ld-value">{{ $loan->disburse_method == 'cash' ? ucwords($loan->disburse_method) : _lang('Transfer to Account') }}</span>
                    </div>
                    @endif

                    {{-- Custom Fields --}}
                    @if(! $customFields->isEmpty())
                        @php $customFieldsData = json_decode($loan->custom_fields, true); @endphp
                        @foreach($customFields as $customField)
                        <div class="ld-detail-row">
                            <span class="ld-label">{{ $customField->field_name }}</span>
                            <span class="ld-value">
                                @if($customField->field_type == 'file')
                                    @php $file = $customFieldsData[$customField->field_name]['field_value'] ?? null; @endphp
                                    {!! $file ? '<a href="'.asset('public/uploads/media/'.$file).'" target="_blank">'._lang('Preview').'</a>' : '' !!}
                                @else
                                    {{ $customFieldsData[$customField->field_name]['field_value'] ?? '' }}
                                @endif
                            </span>
                        </div>
                        @endforeach
                    @endif

                    @if($loan->description)
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Description') }}</span>
                        <span class="ld-value">{{ $loan->description }}</span>
                    </div>
                    @endif
                    @if($loan->remarks)
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Remarks') }}</span>
                        <span class="ld-value">{{ $loan->remarks }}</span>
                    </div>
                    @endif

                </div>

                {{-- Edit link --}}
                <div style="text-align:center;margin-top:20px;">
                    <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-warning">
                        <i class="ti-pencil-alt mr-1"></i>{{ _lang('Edit Loan') }}
                    </a>
                </div>
            </div>

            {{-- TAB: Transactions --}}
            <div id="ld_transactions" class="ld-tab-content">

                {{-- Loan disbursement as + --}}
                <div class="ld-transaction">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date">{{ \Carbon\Carbon::parse($loan->getRawOriginal('release_date'))->format('D, d M Y') }}</span>
                        <span class="ld-tx-title">{{ _lang('Loan Disbursed') }}</span>
                    </div>
                    <span class="ld-tx-amount" style="color:#27ae60;">
                        +{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}
                    </span>
                </div>

                @forelse($payments as $payment)
                <div class="ld-transaction">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date">{{ \Carbon\Carbon::parse($payment->getRawOriginal('paid_at'))->format('D, d M Y') }}</span>
                        <span class="ld-tx-title">{{ _lang('Loan Repayment') }}</span>
                    </div>
                    <span class="ld-tx-amount" style="color:#000;">
                        -{{ decimalPlace($payment->total_amount, currency($loan->currency->name)) }}
                    </span>
                </div>
                @if($payment->interest > 0)
                <div class="ld-transaction" style="padding-left:15px;background:#fafafa;">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date" style="font-size:12px;">{{ _lang('Interest Charged') }}</span>
                    </div>
                    <span class="ld-tx-amount" style="color:#000;font-size:14px;">
                        -{{ decimalPlace($payment->interest, currency($loan->currency->name)) }}
                    </span>
                </div>
                @endif
                @if($payment->late_penalties > 0)
                <div class="ld-transaction" style="padding-left:15px;background:#fafafa;">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date" style="font-size:12px;">{{ _lang('Late Penalty') }}</span>
                    </div>
                    <span class="ld-tx-amount" style="color:#000;font-size:14px;">
                        -{{ decimalPlace($payment->late_penalties, currency($loan->currency->name)) }}
                    </span>
                </div>
                @endif
                @empty
                <p class="text-center mt-4 text-muted">{{ _lang('No transactions found.') }}</p>
                @endforelse
            </div>

            {{-- TAB: Statements (Repayment Schedule) --}}
            <div id="ld_statements" class="ld-tab-content">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>{{ _lang('Date') }}</th>
                            <th>{{ _lang('Amount to Pay') }}</th>
                            <th>{{ _lang('Principal') }}</th>
                            <th>{{ _lang('Interest') }}</th>
                            <th>{{ _lang('Late Penalty') }}</th>
                            <th>{{ _lang('Balance') }}</th>
                            <th>{{ _lang('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($repayments as $repayment)
                        <tr class="text-center">
                            <td>{{ $repayment->repayment_date }}</td>
                            <td>{{ decimalPlace($repayment->amount_to_pay, currency($loan->currency->name)) }}</td>
                            <td>{{ decimalPlace($repayment->principal_amount, currency($loan->currency->name)) }}</td>
                            <td>{{ decimalPlace($repayment->interest, currency($loan->currency->name)) }}</td>
                            <td>{{ decimalPlace($repayment->penalty, currency($loan->currency->name)) }}</td>
                            <td>{{ decimalPlace($repayment->balance, currency($loan->currency->name)) }}</td>
                            <td>
                                @if($repayment->status == 0 && date('Y-m-d') > $repayment->getRawOriginal('repayment_date'))
                                    {!! xss_clean(show_status(_lang('Due'), 'danger')) !!}
                                @elseif($repayment->status == 0)
                                    {!! xss_clean(show_status(_lang('Unpaid'), 'warning')) !!}
                                @else
                                    {!! xss_clean(show_status(_lang('Paid'), 'success')) !!}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="background:#E5F6FE;height:40px;margin-top:20px;"></div>

        </div>
    </div>
</div>

@endsection

@section('js-script')
<script>
function ldOpenTab(tabId, el) {
    document.querySelectorAll('.ld-tab-content').forEach(c => c.classList.remove('active'));
    document.querySelectorAll('.ld-tab').forEach(t => t.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');
    el.classList.add('active');
}
</script>
@endsection
