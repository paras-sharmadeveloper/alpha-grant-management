@extends('layouts.app')

@section('content')

{{--
===============================================================
 OLD LAYOUT - COMMENTED OUT (DO NOT DELETE)
===============================================================

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <span class="panel-title">{{ _lang('Loan Details') }}</span>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#loan_details">{{ _lang('Loan Details') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#schedule">{{ _lang('Repayments Schedule') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#repayments">{{ _lang('Repayments') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#documents">{{ _lang('Documents') }}</a>
                </li>
            </ul>
            ... (full old content preserved above in git history)
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

    /* Summary card */
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

    /* Detail rows */
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

    /* Transactions */
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

    /* Statements */
    .ld-info-box {
        background: #DEF6E6;
        color: #203422;
        padding: 14px 25px;
        border-radius: 30px;
        margin-bottom: 20px;
        font-size: 15px;
        font-weight: 500;
    }
    .ld-gen-card {
        background: #E5F6FE;
        padding: 25px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 20px;
    }
    .ld-gen-btn {
        background: #0060ED;
        color: #fff;
        border: none;
        padding: 16px;
        width: 100%;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 10px;
        font-weight: 600;
        font-size: 17px;
    }
    .ld-statement-row {
        display: flex;
        justify-content: space-between;
        padding: 14px 3px;
        border-bottom: 1px solid #ccc;
        font-size: 16px;
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

            {{-- Top info link --}}
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
                        <span class="ld-label">{{ _lang('Release Date') }}</span>
                        <span class="ld-value">{{ $loan->release_date }}</span>
                    </div>

                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('First Payment Date') }}</span>
                        <span class="ld-value">{{ $loan->first_payment_date }}</span>
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
                        <span class="ld-label">{{ _lang('Loan Officer') }}</span>
                        <span class="ld-value">{{ $loan->approved_by->name }}</span>
                    </div>
                    @endif

                    @if($loan->description)
                    <div class="ld-detail-row">
                        <span class="ld-label">{{ _lang('Description') }}</span>
                        <span class="ld-value">{{ $loan->description }}</span>
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

                </div>

                {{-- Extra repayments info card --}}
                <div style="background:#D6F2FF;border-radius:12px;padding:25px 30px;margin-top:25px;text-align:center;">
                    <h5 style="font-weight:700;font-size:17px;margin-bottom:18px;">{{ _lang('How do I make extra repayments') }}</h5>
                    <div style="background:#fff;border-radius:8px;padding:14px 20px;display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;font-size:15px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <span style="background:#1a73e8;color:#fff;border-radius:6px;padding:6px 10px;font-weight:700;font-size:14px;">B</span>
                            <span>{{ _lang('Biller Code') }}</span>
                        </div>
                        <span style="font-weight:600;">{{ $loan->loan_id }}</span>
                        <span style="border-left:1px solid #ccc;padding-left:20px;">{{ _lang('Ref #') }}</span>
                        <span style="font-weight:600;">{{ $loan->borrower->member_no ?? $loan->borrower_id }}</span>
                    </div>
                    <p style="font-size:14px;color:#555;margin-bottom:15px;">{{ _lang('Telephone & Internet Banking - BPAY®') }}</p>
                    <hr style="border-color:#aaa;">
                    <p style="font-weight:700;font-size:15px;margin-bottom:6px;">{{ _lang('Need to change your direct debit details?') }}</p>
                    <p style="font-size:14px;color:#444;">{{ _lang('Contact us Monday to Friday, 8:30am to 6pm.') }}</p>
                </div>

            </div>

            {{-- TAB: Transactions --}}
            <div id="ld_transactions" class="ld-tab-content">

                {{-- Loan disbursement as + (money received by borrower) --}}
                <div class="ld-transaction">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date">{{ \Carbon\Carbon::parse($loan->getRawOriginal('release_date'))->format('D, d M Y') }}</span>
                        <span class="ld-tx-title">{{ _lang('Loan Disbursed') }}</span>
                    </div>
                    <span class="ld-tx-amount" style="color:#27ae60;">
                        +{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}
                    </span>
                </div>

                @forelse($loan->payments as $payment)
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
                @if($loan->status != 1)
                <p class="text-center mt-4 text-muted">{{ _lang('No transactions found.') }}</p>
                @endif
                @endforelse
            </div>

            {{-- TAB: Statements --}}
            <div id="ld_statements" class="ld-tab-content">
                <div class="ld-gen-card">
                    <h3 style="font-weight:700;font-size:18px;">{{ _lang('Repayment Schedule') }}</h3>
                    <p style="font-size:16px;">{{ _lang('Full repayment schedule for your loan.') }}</p>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>{{ _lang('Date') }}</th>
                            <th>{{ _lang('Amount to Pay') }}</th>
                            <th>{{ _lang('Principal') }}</th>
                            <th>{{ _lang('Interest') }}</th>
                            <th>{{ _lang('Balance') }}</th>
                            <th>{{ _lang('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loan->repayments as $repayment)
                        <tr class="text-center">
                            <td>{{ $repayment->repayment_date }}</td>
                            <td>{{ decimalPlace($repayment->amount_to_pay, currency($loan->currency->name)) }}</td>
                            <td>{{ decimalPlace($repayment->principal_amount, currency($loan->currency->name)) }}</td>
                            <td>{{ decimalPlace($repayment->interest, currency($loan->currency->name)) }}</td>
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
