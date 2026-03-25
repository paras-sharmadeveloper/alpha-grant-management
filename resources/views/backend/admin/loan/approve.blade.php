@extends('layouts.app')

@section('content')

{{--
    OLD APPROVE VIEW — preserved as comment, DO NOT DELETE
    Original was a simple confirm card. Replaced with 4-tab review + editable approve page.
--}}

<style>
    .kyc-top-bar {
        background:#214942; padding:12px 20px; color:#fff;
        font-family:"Poppins",sans-serif; font-size:14px; font-weight:400; text-transform:capitalize;
        display:flex; align-items:center; justify-content:space-between;
    }
    .kyc-top-bar .kyc-title { flex:1; text-align:center; }
    .kyc-bottom-bar { background:#214942; height:40px; margin-top:20px; }
    .kyc-tabs { display:flex; justify-content:center; gap:60px; border-bottom:2px solid #ddd; background:#fff; margin-bottom:0; flex-wrap:wrap; }
    .kyc-tab { padding:15px; cursor:pointer; color:#333; font-size:14px; font-family:"Poppins",sans-serif; font-weight:400; text-transform:capitalize; border-bottom:3px solid transparent; margin-bottom:-2px; user-select:none; }
    .kyc-tab.active { color:#214942; border-bottom:3px solid #44a74a; }
    .kyc-tab-content { display:none; width:85%; margin:20px auto; font-family:"Poppins",sans-serif; font-size:14px; }
    .kyc-tab-content.active { display:block; }
    .kyc-row { display:flex; justify-content:space-between; align-items:center; padding:14px 0; border-bottom:1px solid #eee; font-size:14px; font-family:"Poppins",sans-serif; gap:12px; }
    .kyc-label { color:#2c3e50; font-weight:400; text-transform:capitalize; min-width:220px; }
    .kyc-value { color:#214942; font-weight:400; }
    .kyc-section-title { font-size:13px; font-weight:600; color:#214942; text-transform:uppercase; letter-spacing:1px; margin:20px 0 8px; border-left:3px solid #44a74a; padding-left:10px; }
    .kyc-input { border:1px solid #ccc; border-radius:4px; padding:7px 12px; font-family:"Poppins",sans-serif; font-size:14px; color:#214942; width:220px; }
    .doc-row { display:flex; align-items:center; gap:10px; margin-bottom:10px; flex-wrap:wrap; }
    .doc-row input[type=text] { border:1px solid #ccc; border-radius:4px; padding:7px 12px; font-family:"Poppins",sans-serif; font-size:14px; width:200px; }
    .doc-row input[type=file] { font-family:"Poppins",sans-serif; font-size:13px; }
    .btn-add-doc { background:#214942; color:#fff; border:none; padding:7px 16px; border-radius:4px; font-family:"Poppins",sans-serif; font-size:13px; cursor:pointer; display:inline-flex; align-items:center; gap:6px; }
    .btn-remove-doc { background:#e74c3c; color:#fff; border:none; padding:5px 10px; border-radius:4px; font-size:12px; cursor:pointer; }
</style>

{{-- Single form wraps everything so docs + term overrides submit together --}}
<form method="post" action="{{ route('loans.approve', $loan->id) }}" enctype="multipart/form-data" id="approve-form">
@csrf
<input type="hidden" name="account_id" value="cash">

<div class="col-lg-12">
    <div class="card">
        <div class="card-body p-0">

            {{-- Top bar with back button --}}
            <div class="kyc-top-bar">
                <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-sm" style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.4);font-family:Poppins,sans-serif;font-size:13px;">
                    <i class="fas fa-arrow-left mr-1"></i>{{ _lang('Back') }}
                </a>
                <span class="kyc-title">{{ _lang('Approve Loan') }} &mdash; {{ $loan->loan_product->name }} ({{ $loan->loan_id }})</span>
                <span style="width:80px;"></span>{{-- spacer to keep title centered --}}
            </div>

            <div class="kyc-tabs">
                <div class="kyc-tab active" onclick="kycTab('kyc_loan', this)">{{ _lang('Loan Details') }}</div>
                <div class="kyc-tab" onclick="kycTab('kyc_customer', this)">{{ _lang('Customer Details') }}</div>
                <div class="kyc-tab" onclick="kycTab('kyc_term', this)">{{ _lang('Term & Approve') }}</div>
                <div class="kyc-tab" onclick="kycTab('kyc_docs', this)">{{ _lang('Documents') }}</div>
            </div>

            {{-- TAB 1: Loan Details --}}
            <div id="kyc_loan" class="kyc-tab-content active">
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Loan ID') }}</span><span class="kyc-value">{{ $loan->loan_id }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Loan Product') }}</span><span class="kyc-value">{{ $loan->loan_product->name }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Applied Amount') }}</span><span class="kyc-value">{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Interest Rate') }}</span><span class="kyc-value">{{ $loan->interest_rate ?? $loan->loan_product->interest_rate }}%</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Interest Type') }}</span><span class="kyc-value">{{ ucwords(str_replace('_',' ', $loan->loan_product->interest_type)) }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Loan Term') }}</span><span class="kyc-value">{{ $loan->term ?? $loan->loan_product->term }} {{ preg_replace('/^\+\d+\s*/', '', $loan->loan_product->term_period) }}(s)</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('First Payment Date') }}</span><span class="kyc-value">{{ $loan->first_payment_date }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Release Date') }}</span><span class="kyc-value">{{ $loan->release_date ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Late Payment Penalties') }}</span><span class="kyc-value">{{ $loan->late_payment_penalties }}%</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Status') }}</span><span class="kyc-value" style="color:#f39c12;">{{ _lang('Pending') }}</span></div>
                @if($loan->description)
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Description') }}</span><span class="kyc-value">{{ $loan->description }}</span></div>
                @endif
                @if($loan->remarks)
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Remarks') }}</span><span class="kyc-value">{{ $loan->remarks }}</span></div>
                @endif
                @if(! $customFields->isEmpty())
                    @php $cfData = json_decode($loan->custom_fields, true); @endphp
                    @foreach($customFields as $cf)
                    <div class="kyc-row">
                        <span class="kyc-label">{{ $cf->field_name }}</span>
                        <span class="kyc-value">
                            @if($cf->field_type == 'file')
                                @php $fv = $cfData[$cf->field_name]['field_value'] ?? null; @endphp
                                {!! $fv ? '<a href="'.asset('public/uploads/media/'.$fv).'" target="_blank">'._lang('Preview').'</a>' : '—' !!}
                            @else
                                {{ $cfData[$cf->field_name]['field_value'] ?? '—' }}
                            @endif
                        </span>
                    </div>
                    @endforeach
                @endif

                {{-- View Application button --}}
                @if($loan->enq_full_name)
                <div style="margin-top:20px;">
                    <button type="button" class="btn btn-sm" style="background:#214942;color:#fff;" data-toggle="modal" data-target="#enqModal">
                        <i class="ti-clipboard mr-1"></i> {{ _lang('View Application') }}
                    </button>
                </div>
                @endif
            </div>

            {{-- TAB 2: Customer Details --}}
            <div id="kyc_customer" class="kyc-tab-content">
                @php $m = $loan->borrower; @endphp
                <div class="kyc-section-title">{{ _lang('Personal Information') }}</div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Full Name') }}</span><span class="kyc-value">{{ $m->first_name.' '.$m->last_name }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Member No') }}</span><span class="kyc-value">{{ $m->member_no ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Email') }}</span><span class="kyc-value">{{ $m->email ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Mobile') }}</span><span class="kyc-value">{{ ($m->country_code ? '+'.$m->country_code.' ' : '').$m->mobile }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Gender') }}</span><span class="kyc-value">{{ ucfirst($m->gender ?? '—') }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Business Name') }}</span><span class="kyc-value">{{ $m->business_name ?? '—' }}</span></div>
                <div class="kyc-section-title">{{ _lang('Address') }}</div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Address') }}</span><span class="kyc-value">{{ $m->address ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('City') }}</span><span class="kyc-value">{{ $m->city ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('State') }}</span><span class="kyc-value">{{ $m->state ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Zip') }}</span><span class="kyc-value">{{ $m->zip ?? '—' }}</span></div>
                @if($m->credit_source)
                <div class="kyc-section-title">{{ _lang('Credit Information') }}</div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Credit Source') }}</span><span class="kyc-value">{{ $m->credit_source }}</span></div>
                @endif
                @if($m->photo)
                <div class="kyc-section-title">{{ _lang('Photo') }}</div>
                <div style="padding:16px 0;"><img src="{{ asset('public/uploads/media/'.$m->photo) }}" style="max-width:120px;border-radius:8px;border:2px solid #214942;"></div>
                @endif
            </div>

            {{-- TAB 3: Term & Approve --}}
            <div id="kyc_term" class="kyc-tab-content">

                <div class="kyc-section-title">{{ _lang('Override Loan Terms') }}</div>
                <p style="font-size:13px;color:#888;margin-bottom:16px;">{{ _lang('Leave blank to keep original values.') }}</p>

                <div class="kyc-row">
                    <span class="kyc-label">
                        {{ _lang('Applied Amount') }}<br>
                        <small style="color:#aaa;font-size:12px;">{{ _lang('original') }}: {{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</small>
                    </span>
                    <input type="number" step="0.01" name="override_amount" id="inp-amount" class="kyc-input"
                        placeholder="{{ $loan->applied_amount }}" value="{{ old('override_amount') }}">
                </div>
                <div class="kyc-row">
                    <span class="kyc-label">
                        {{ _lang('Term') }}<br>
                        <small style="color:#aaa;font-size:12px;">{{ _lang('original') }}: {{ $loan->loan_product->term }} {{ preg_replace('/^\+\d+\s*/', '', $loan->loan_product->term_period) }}(s) &nbsp;|&nbsp; min: {{ $loan->loan_product->min_term ?? 1 }}</small>
                    </span>
                    <input type="number" name="override_term" id="inp-term" class="kyc-input"
                        placeholder="{{ $loan->loan_product->term }}"
                        min="{{ $loan->loan_product->min_term ?? 1 }}"
                        max="{{ $loan->loan_product->term }}"
                        value="{{ old('override_term') }}">
                </div>
                <div class="kyc-row">
                    <span class="kyc-label">
                        {{ _lang('Interest Rate (%)') }}<br>
                        <small style="color:#aaa;font-size:12px;">{{ _lang('original') }}: {{ $loan->loan_product->interest_rate }}%</small>
                    </span>
                    <input type="number" step="0.01" name="override_interest_rate" id="inp-rate" class="kyc-input"
                        placeholder="{{ $loan->loan_product->interest_rate }}" value="{{ old('override_interest_rate') }}">
                </div>

                <div style="margin-top:16px;display:flex;gap:10px;">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="openSummaryModal()">
                        <i class="ti-eye mr-1"></i>{{ _lang('View Summary') }}
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetOverrides()">
                        <i class="fas fa-undo mr-1"></i>{{ _lang('Reset') }}
                    </button>
                </div>

                <div class="kyc-section-title" style="margin-top:28px;">{{ _lang('Confirm') }}</div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Borrower') }}</span><span class="kyc-value">{{ $loan->borrower->first_name.' '.$loan->borrower->last_name }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('First Payment Date') }}</span><span class="kyc-value">{{ $loan->first_payment_date }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Release Date') }}</span><span class="kyc-value">{{ $loan->release_date ?? '—' }}</span></div>

                <div style="display:flex;gap:12px;margin-top:24px;align-items:center;">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check-circle mr-1"></i>{{ _lang('Approve Loan') }}
                    </button>
                    <button type="button" class="btn btn-info btn-sm" onclick="kycTabByName('kyc_docs')">
                        <i class="fas fa-file mr-1"></i>{{ _lang('Go to Documents') }}
                    </button>
                </div>
            </div>

            {{-- TAB 4: Documents --}}
            <div id="kyc_docs" class="kyc-tab-content">

                @if($memberDocuments->isNotEmpty())
                <div class="kyc-section-title">{{ _lang('Existing Documents') }}</div>
                @foreach($memberDocuments as $doc)
                <div class="kyc-row">
                    <span class="kyc-label">{{ $doc->name }}</span>
                    <span class="kyc-value"><a href="{{ asset('public/uploads/media/'.$doc->document) }}" target="_blank">{{ _lang('View') }}</a></span>
                </div>
                @endforeach
                @endif

                @if($loancollaterals->isNotEmpty())
                <div class="kyc-section-title">{{ _lang('Loan Collaterals') }}</div>
                @foreach($loancollaterals as $col)
                <div class="kyc-row">
                    <span class="kyc-label">{{ $col->name }}</span>
                    <span class="kyc-value">
                        @if($col->attachments)
                            <a href="{{ asset('public/uploads/media/'.$col->attachments) }}" target="_blank">{{ _lang('View') }}</a>
                        @else
                            {{ $col->collateral_type }} — {{ decimalPlace($col->estimated_price) }}
                        @endif
                    </span>
                </div>
                @endforeach
                @endif

                <div class="kyc-section-title" style="margin-top:24px;">{{ _lang('Upload New Documents') }}</div>
                <p style="font-size:13px;color:#888;margin-bottom:12px;">{{ _lang('Check "Show to Customer" to make a document visible in the customer portal.') }}</p>

                <div id="doc-upload-list"></div>

                <button type="button" class="btn-add-doc" onclick="addDocRow()">
                    <i class="fas fa-plus"></i> {{ _lang('Add More') }}
                </button>

                <div style="margin-top:24px;display:flex;gap:12px;align-items:center;">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check-circle mr-1"></i>{{ _lang('Approve Loan') }}
                    </button>
                    <small style="color:#888;font-family:Poppins,sans-serif;font-size:12px;">{{ _lang('Documents will be saved and loan approved.') }}</small>
                </div>
            </div>

            <div class="kyc-bottom-bar"></div>
        </div>
    </div>
</div>

</form>

{{-- Loan Summary Modal --}}
<div class="modal fade" id="loanSummaryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#214942;color:#fff;">
                <h5 class="modal-title" style="font-family:Poppins,sans-serif;font-size:14px;font-weight:400;">{{ _lang('Loan Repayment Summary') }}</h5>
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:1;"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="font-family:Poppins,sans-serif;font-size:14px;">
                <div id="summary-info" class="mb-3" style="background:#f8f9fa;padding:12px;border-radius:6px;font-size:13px;"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" style="font-size:13px;">
                        <thead style="background:#214942;color:#fff;">
                            <tr>
                                <th>#</th><th>{{ _lang('Date') }}</th><th>{{ _lang('Principal') }}</th>
                                <th>{{ _lang('Interest') }}</th><th>{{ _lang('Amount to Pay') }}</th><th>{{ _lang('Balance') }}</th>
                            </tr>
                        </thead>
                        <tbody id="summary-table-body"></tbody>
                        <tfoot id="summary-table-foot" style="font-weight:600;background:#f0f0f0;"></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Enquiry / Application Modal --}}
<div class="modal fade" id="enqModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="font-family:Poppins,sans-serif;font-size:13px;">
            <div class="modal-header" style="background:#214942;color:#fff;">
                <h5 class="modal-title" style="font-size:14px;font-weight:400;">
                    <i class="ti-clipboard mr-1"></i> {{ _lang('Loan Application') }} — {{ $loan->enq_full_name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:1;"><span>&times;</span></button>
            </div>
            <div class="modal-body p-0">
                <table class="table table-sm table-bordered mb-0">
                    <tbody>
                        {{-- Section 1 --}}
                        <tr><td colspan="2" style="background:#214942;color:#fff;font-size:11px;font-weight:600;letter-spacing:.5px;padding:6px 12px;">SECTION 1 — APPLICANT BASICS</td></tr>
                        <tr><td style="width:35%;background:#f8f9fa;" class="text-muted">Full Name</td><td>{{ $loan->enq_full_name ?? '—' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Mobile</td><td>{{ $loan->enq_mobile ?? '—' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Email</td><td>{{ $loan->enq_email ?? '—' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Business Name</td><td>{{ $loan->enq_business_name ?? '—' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">GST Registered</td><td>{{ $loan->enq_gst_registered ? 'Yes' : 'No' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Years Operating</td><td>{{ $loan->enq_years_operating ?? '—' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">ABN / ACN</td><td>{{ $loan->enq_abn_acn ?? '—' }}</td></tr>
                        {{-- Section 2 --}}
                        <tr><td colspan="2" style="background:#214942;color:#fff;font-size:11px;font-weight:600;letter-spacing:.5px;padding:6px 12px;">SECTION 2 — LOAN SNAPSHOT</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Loan Product</td><td>{{ $loan->loan_product->name ?? '—' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Applied Amount</td><td>{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Loan Purpose</td><td>{{ $loan->enq_loan_purpose ?? '—' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Time in Business</td><td>{{ $loan->enq_time_in_business ?? '—' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Monthly Revenue</td><td>{{ $loan->enq_monthly_revenue ?? '—' }}</td></tr>
                        {{-- Section 3 --}}
                        <tr><td colspan="2" style="background:#214942;color:#fff;font-size:11px;font-weight:600;letter-spacing:.5px;padding:6px 12px;">SECTION 3 — RISK INDICATORS</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">ATO Debt</td><td>{{ $loan->enq_ato_debt ? 'Yes' : 'No' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Defaults</td><td>{{ $loan->enq_defaults ? 'Yes' : 'No' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Existing Loans</td><td>{{ $loan->enq_existing_loans ? 'Yes' : 'No' }}</td></tr>
                        {{-- Section 4 --}}
                        <tr><td colspan="2" style="background:#214942;color:#fff;font-size:11px;font-weight:600;letter-spacing:.5px;padding:6px 12px;">SECTION 4 — SECURITY</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Security Type</td><td>{{ ucfirst($loan->enq_security_type ?? '—') }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Asset Type</td><td>{{ $loan->enq_asset_type ?? '—' }}</td></tr>
                        {{-- Section 5 --}}
                        <tr><td colspan="2" style="background:#214942;color:#fff;font-size:11px;font-weight:600;letter-spacing:.5px;padding:6px 12px;">SECTION 5 — PROGRESS</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Funds Needed By</td><td>{{ $loan->enq_funds_needed_by ?? '—' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Best Contact Time</td><td>{{ $loan->enq_best_contact_time ?? '—' }}</td></tr>
                        {{-- Section 6 --}}
                        <tr><td colspan="2" style="background:#214942;color:#fff;font-size:11px;font-weight:600;letter-spacing:.5px;padding:6px 12px;">SECTION 6 — CONSENT</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Consent Given</td><td>{{ $loan->enq_consent ? 'Yes' : 'No' }}</td></tr>
                        <tr><td style="background:#f8f9fa;" class="text-muted">Submitted</td><td>{{ \Carbon\Carbon::parse($loan->getRawOriginal('created_at'))->format('d M Y H:i') }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-script')
<script>
// Tab switching
function kycTab(id, el) {
    document.querySelectorAll('.kyc-tab-content').forEach(c => c.classList.remove('active'));
    document.querySelectorAll('.kyc-tab').forEach(t => t.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    el.classList.add('active');
}
function kycTabByName(id) {
    var tabs = document.querySelectorAll('.kyc-tab');
    var contents = ['kyc_loan','kyc_customer','kyc_term','kyc_docs'];
    var idx = contents.indexOf(id);
    if (idx >= 0) kycTab(id, tabs[idx]);
}

// Document upload rows
var docIndex = 0;
function addDocRow() {
    var i = docIndex++;
    var div = document.createElement('div');
    div.className = 'doc-row';
    div.id = 'doc-row-' + i;
    div.innerHTML =
        '<input type="text" name="document_names[' + i + ']" placeholder="Document Name" style="border:1px solid #ccc;border-radius:4px;padding:7px 12px;font-family:Poppins,sans-serif;font-size:14px;width:180px;">' +
        '<input type="file" name="documents[' + i + ']" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.zip">' +
        '<label style="display:flex;align-items:center;gap:5px;font-family:Poppins,sans-serif;font-size:13px;cursor:pointer;white-space:nowrap;">' +
            '<input type="checkbox" name="show_to_customer[' + i + ']" value="1" style="width:15px;height:15px;"> Show to Customer' +
        '</label>' +
        '<button type="button" class="btn-remove-doc" onclick="removeDocRow(' + i + ')">&#x2715;</button>';
    document.getElementById('doc-upload-list').appendChild(div);
}
function removeDocRow(i) {
    var el = document.getElementById('doc-row-' + i);
    if (el) el.remove();
}
// Show one row by default after DOM ready
document.addEventListener('DOMContentLoaded', function() { addDocRow(); });

// Loan summary calculator
var loanDefaults = {
    amount:       {{ $loan->applied_amount }},
    term:         {{ $loan->loan_product->term }},
    minTerm:      {{ $loan->loan_product->min_term ?? 1 }},
    rate:         {{ $loan->loan_product->interest_rate }},
    itype:        '{{ $loan->loan_product->interest_type }}',
    termPeriod:   '{{ $loan->loan_product->term_period }}',
    firstPayDate: '{{ $loan->getRawOriginal('first_payment_date') }}',
    currency:     'AUD'
};

function advanceDate(dateStr, termPeriod) {
    var d = new Date(dateStr + 'T00:00:00');
    var clean = termPeriod.replace(/^\+/, '').trim();
    var m = clean.match(/(\d+)\s*(day|month|year)s?/i);
    if (!m) return dateStr;
    var n = parseInt(m[1]), unit = m[2].toLowerCase();
    if (unit === 'day')   d.setDate(d.getDate() + n);
    if (unit === 'month') d.setMonth(d.getMonth() + n);
    if (unit === 'year')  d.setFullYear(d.getFullYear() + n);
    return d.toISOString().slice(0,10);
}
function fmt(n) { return parseFloat(n).toFixed(2); }

function calcSchedule(amount, term, rate, itype, termPeriod, firstDate) {
    var r = rate / 100, schedule = [], date = firstDate;
    function durYears() {
        var clean = termPeriod.replace(/^\+/, '').trim();
        var m = clean.match(/(\d+)\s*(day|month|year)s?/i);
        if (!m) return term / 12;
        var n = parseInt(m[1]), unit = m[2].toLowerCase();
        if (unit === 'day')   return (n * term) / 365;
        if (unit === 'month') return (n * term) / 12;
        return n * term;
    }
    if (itype === 'flat_rate') {
        var totalInt = amount * r * durYears(), totalPay = amount + totalInt;
        var inst = totalPay / term, ppt = amount / term, ipt = totalInt / term, bal = amount;
        for (var i = 0; i < term; i++) { bal -= ppt; schedule.push({date:date,principal:ppt,interest:ipt,amount_to_pay:inst,balance:Math.max(bal,0)}); date=advanceDate(date,termPeriod); }
    } else if (itype === 'fixed_rate') {
        var ppt = amount/term, ipt = r*amount, inst = ppt+ipt, bal = amount;
        for (var i = 0; i < term; i++) { bal -= ppt; schedule.push({date:date,principal:ppt,interest:ipt,amount_to_pay:inst,balance:Math.max(bal,0)}); date=advanceDate(date,termPeriod); }
    } else if (itype === 'mortgage') {
        var mr = r/12, pay = mr===0 ? amount/term : amount*(mr/(1-Math.pow(1+mr,-term))), bal = amount;
        for (var i = 0; i < term; i++) { var int=bal*mr, prin=pay-int; bal-=prin; schedule.push({date:date,principal:prin,interest:int,amount_to_pay:pay,balance:Math.max(bal,0)}); date=advanceDate(date,termPeriod); }
    } else if (itype === 'one_time') {
        var int = r*amount; schedule.push({date:date,principal:amount,interest:int,amount_to_pay:amount+int,balance:0});
    } else if (itype === 'reducing_amount') {
        var mr = r/12, ppt = amount/term, bal = amount;
        for (var i = 0; i < term; i++) { var int=bal*mr, atp=int+ppt; bal-=ppt; schedule.push({date:date,principal:ppt,interest:int,amount_to_pay:atp,balance:Math.max(bal,0)}); date=advanceDate(date,termPeriod); }
    }
    return schedule;
}

function resetOverrides() {
    document.getElementById('inp-amount').value = '';
    document.getElementById('inp-term').value   = '';
    document.getElementById('inp-rate').value   = '';
}

function openSummaryModal() {
    var amount = parseFloat(document.getElementById('inp-amount').value) || loanDefaults.amount;
    var term   = parseInt(document.getElementById('inp-term').value)   || loanDefaults.term;
    var rate   = parseFloat(document.getElementById('inp-rate').value) || loanDefaults.rate;

    var schedule = calcSchedule(amount, term, rate, loanDefaults.itype, loanDefaults.termPeriod, loanDefaults.firstPayDate);
    var tp = loanDefaults.termPeriod.replace(/^\+/, '').replace(/\d+\s*/, '').trim();
    var totP=0, totI=0, totA=0, rows='';
    schedule.forEach(function(row, i) {
        totP+=row.principal; totI+=row.interest; totA+=row.amount_to_pay;
        rows += '<tr><td>'+(i+1)+'</td><td>'+row.date+'</td><td>'+fmt(row.principal)+'</td><td>'+fmt(row.interest)+'</td><td>'+fmt(row.amount_to_pay)+'</td><td>'+fmt(row.balance)+'</td></tr>';
    });
    document.getElementById('summary-info').innerHTML =
        '<strong>Amount:</strong> '+fmt(amount)+' | <strong>Term:</strong> '+term+' '+tp+'(s) | <strong>Rate:</strong> '+rate+'% | <strong>Type:</strong> '+loanDefaults.itype.replace(/_/g,' ');
    document.getElementById('summary-table-body').innerHTML = rows;
    document.getElementById('summary-table-foot').innerHTML =
        '<tr><td colspan="2"><strong>Total</strong></td><td><strong>'+fmt(totP)+'</strong></td><td><strong>'+fmt(totI)+'</strong></td><td><strong>'+fmt(totA)+'</strong></td><td></td></tr>';
    $('#loanSummaryModal').modal('show');
}
</script>
@endsection
