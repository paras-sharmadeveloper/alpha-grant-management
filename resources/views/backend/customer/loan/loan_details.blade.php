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
    /* Theme colors: sidebar = #214942, active nav = #44a74a */
    .ld-top-bar {
        background: #214942;
        text-align: center;
        padding: 15px;
        color: #fff;
        font-weight: 400;
        font-size: 14px;
        font-family: "Poppins", sans-serif;
        letter-spacing: 0;
        text-transform: capitalize;
    }
    .ld-bottom-bar {
        background: #214942;
        height: 40px;
        margin-top: 20px;
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
        font-size: 14px;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        letter-spacing: 0;
        text-transform: capitalize;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
    }
    .ld-tab.active {
        color: #214942;
        border-bottom: 3px solid #44a74a;
        font-weight: 400;
    }
    .ld-tab-content { display: none; width: 85%; margin: 20px auto; font-family: "Poppins", sans-serif; }
    .ld-tab-content.active { display: block; }

    /* Summary card */
    .ld-summary-card {
        background: #214942;
        border-radius: 10px;
        padding: 25px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .ld-summary-item { flex: 1; display: flex; flex-direction: column; gap: 8px; }
    .ld-divider { width: 1px; height: 50px; background: #fff; margin-right: 30px; }
    .ld-label { font-size: 14px; color: rgba(255,255,255,0.75); font-family: "Poppins", sans-serif; font-weight: 400; letter-spacing: 0; text-transform: capitalize; }
    .ld-value { font-size: 14px; font-weight: 400; color: #fff; font-family: "Poppins", sans-serif; letter-spacing: 0; text-transform: capitalize; }

    /* Detail rows */
    .ld-details-section { background: #fff; padding: 10px 0; }
    .ld-detail-row {
        display: flex;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        letter-spacing: 0;
    }
    .ld-detail-row .ld-label { color: #2c3e50; font-size: 14px; font-weight: 400; text-transform: capitalize; }
    .ld-detail-row .ld-value { font-weight: 400; font-size: 14px; color: #214942; text-transform: capitalize; }

    /* Transactions */
    .ld-transaction {
        padding: 15px 0;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        font-weight: 400;
        letter-spacing: 0;
    }
    .ld-tx-left { display: flex; flex-direction: column; }
    .ld-tx-date { font-size: 14px; font-weight: 400; color: #555; text-transform: capitalize; }
    .ld-tx-title { font-size: 14px; font-weight: 400; margin-top: 6px; text-transform: capitalize; }
    .ld-tx-amount { font-weight: 400; font-size: 14px; }

    .ld-gen-btn {
        background: #214942;
        color: #fff;
        border: none;
        padding: 16px;
        width: 100%;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 10px;
        font-weight: 600;
        font-size: 17px;
        font-family: "Poppins", sans-serif;
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

            {{-- Top bar --}}
            <div class="ld-top-bar">
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
                <div class="ld-tab" onclick="ldOpenTab('ld_documents', this)">{{ _lang('Documents') }}</div>
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
                        <span class="ld-label">{{ _lang('Late Payment Penalties') }}</span>
                        <span class="ld-value">{{ $loan->late_payment_penalties }}%</span>
                    </div>

                    @if($loan->status == 1)
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
                <div style="background:#214942;border-radius:12px;padding:25px 30px;margin-top:25px;text-align:center;font-family:'Poppins',sans-serif;font-size:14px;font-weight:400;letter-spacing:0;">
                    <h5 style="font-weight:400;font-size:14px;margin-bottom:18px;color:#fff;text-transform:capitalize;">{{ _lang('How do I make extra repayments') }}</h5>
                    <div style="background:#fff;border-radius:8px;padding:14px 20px;display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;font-size:14px;font-weight:400;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <span style="background:#214942;color:#fff;border-radius:6px;padding:6px 10px;font-weight:400;font-size:14px;">B</span>
                            <span style="text-transform:capitalize;">{{ _lang('Biller Code') }}</span>
                        </div>
                        <span>{{ $loan->loan_id }}</span>
                        <span style="border-left:1px solid #ccc;padding-left:20px;text-transform:capitalize;">{{ _lang('Ref #') }}</span>
                        <span>{{ $loan->borrower->member_no ?? $loan->borrower_id }}</span>
                    </div>
                    <p style="font-size:14px;font-weight:400;color:rgba(255,255,255,0.75);margin-bottom:15px;text-transform:capitalize;">{{ _lang('Telephone & Internet Banking - BPAY®') }}</p>
                    <hr style="border-color:rgba(255,255,255,0.3);">
                    <p style="font-weight:400;font-size:14px;margin-bottom:6px;color:#fff;text-transform:capitalize;">{{ _lang('Need to change your direct debit details?') }}</p>
                    <p style="font-size:14px;font-weight:400;color:rgba(255,255,255,0.75);text-transform:capitalize;">{{ _lang('Contact us Monday to Friday, 8:30am to 6pm.') }}</p>
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
                    <span class="ld-tx-amount">
                        +{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}
                    </span>
                </div>

                @forelse($loan->payments as $payment)
                {{-- EMI paid: + principal (you are paying the loan) --}}
                <div class="ld-transaction">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date">{{ \Carbon\Carbon::parse($payment->getRawOriginal('paid_at'))->format('D, d M Y') }}</span>
                        <span class="ld-tx-title">{{ _lang('EMI Paid') }}</span>
                    </div>
                    <span class="ld-tx-amount">
                        +{{ decimalPlace($payment->repayment_amount - $payment->interest, currency($loan->currency->name)) }}
                    </span>
                </div>
                {{-- Interest charged: - (bank is charging you) --}}
                @if($payment->interest > 0)
                <div class="ld-transaction" style="padding-left:20px;background:#fafafa;">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date">{{ _lang('Interest Charged') }}</span>
                    </div>
                    <span class="ld-tx-amount">
                        -{{ decimalPlace($payment->interest, currency($loan->currency->name)) }}
                    </span>
                </div>
                @endif
                {{-- Late penalty: - --}}
                @if($payment->late_penalties > 0)
                <div class="ld-transaction" style="padding-left:20px;background:#fafafa;">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date">{{ _lang('Late Penalty') }}</span>
                    </div>
                    <span class="ld-tx-amount">
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

            {{-- TAB: Statements (Print button only) --}}
            <div id="ld_statements" class="ld-tab-content">
                <div style="text-align:center;padding:40px 20px;">
                    <p style="font-size:14px;font-weight:400;font-family:'Poppins',sans-serif;color:#555;margin-bottom:20px;text-transform:capitalize;">
                        {{ _lang('Download the full repayment schedule as PDF.') }}
                    </p>
                    <a href="{{ route('loans.customer_print_schedule', $loan->id) }}" target="_blank"
                       style="background:#214942;color:#fff;padding:14px 40px;border-radius:8px;font-size:14px;font-weight:400;text-decoration:none;display:inline-block;font-family:'Poppins',sans-serif;letter-spacing:0;text-transform:capitalize;">
                        🖨 {{ _lang('Print / Download Schedule') }}
                    </a>
                </div>
            </div>

            {{-- TAB: Documents --}}
            <div id="ld_documents" class="ld-tab-content">
                @forelse($loancollaterals as $collateral)
                <div class="ld-detail-row">
                    <span class="ld-label">{{ $collateral->name }}</span>
                    <span class="ld-value">
                        @if($collateral->attachments)
                            <a href="{{ asset('public/uploads/media/'.$collateral->attachments) }}" target="_blank">
                                {{ _lang('View') }}
                            </a>
                        @else
                            {{ $collateral->collateral_type }} &mdash; {{ decimalPlace($collateral->estimated_price) }}
                        @endif
                    </span>
                </div>
                @empty
                <p class="text-center mt-4 text-muted">{{ _lang('No documents found.') }}</p>
                @endforelse
            </div>

            <div class="ld-bottom-bar"></div>

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
