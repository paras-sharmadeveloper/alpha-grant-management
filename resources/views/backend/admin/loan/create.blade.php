@extends('layouts.app')

@section('content')
<div class="row">
    <div class="{{ $alert_col }}">
        <div class="card">
            <div class="card-header">
                <span class="panel-title">{{ _lang('Add New Loan') }}</span>
            </div>
            <div class="card-body">

                {{-- Step progress bar --}}
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2" style="font-family:Poppins,sans-serif;font-size:12px;color:#666;">
                        @foreach(['Applicant Basics','Loan Snapshot','Risk Indicators','Security','Progress','Consent'] as $i => $label)
                        <div class="text-center" style="flex:1;">
                            <div class="step-circle mx-auto mb-1" id="step-circle-{{ $i+1 }}"
                                style="width:28px;height:28px;border-radius:50%;background:#ddd;color:#fff;line-height:28px;font-size:12px;font-weight:600;transition:background .3s;">
                                {{ $i+1 }}
                            </div>
                            <div class="d-none d-md-block" style="font-size:11px;">{{ $label }}</div>
                        </div>
                        @if($i < 5)
                        <div style="flex:0.5;height:2px;background:#ddd;" class="step-line" id="step-line-{{ $i+1 }}"></div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <form method="post" id="enquiry-form" autocomplete="off" novalidate
                      action="{{ route('loans.store') }}" enctype="multipart/form-data">
                    @csrf

                    @if($errors->any())
                    <div class="alert alert-danger" style="font-family:Poppins,sans-serif;font-size:13px;">
                        <strong>Please fix the following:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- STEP 1: Applicant Basics --}}
                    <div class="enquiry-step" id="step-1">
                        <h6 style="font-family:Poppins,sans-serif;color:#214942;margin-bottom:16px;">
                            <i class="ti-user mr-1"></i> Section 1 — Applicant Basics
                        </h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Borrower') }} <span class="required"> *</span></label>
                                    <select class="form-control auto-select select2" data-selected="{{ old('borrower_id') }}" name="borrower_id" id="borrower_id" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        @foreach(\App\Models\Member::all() as $member)
                                        <option value="{{ $member->id }}"
                                            data-name="{{ $member->first_name.' '.$member->last_name }}"
                                            data-mobile="{{ $member->mobile }}"
                                            data-email="{{ $member->email }}">
                                            {{ $member->first_name.' '.$member->last_name.' ('.$member->member_no.')' }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Full Name <span class="required"> *</span></label>
                                    <input type="text" class="form-control" name="enq_full_name" value="{{ old('enq_full_name') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile <span class="required"> *</span></label>
                                    <input type="text" class="form-control" name="enq_mobile" value="{{ old('enq_mobile') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Email <span class="required"> *</span></label>
                                    <input type="email" class="form-control" name="enq_email" value="{{ old('enq_email') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Are you GST Registered? <span class="required"> *</span></label>
                                    <select class="form-control" name="enq_gst_registered" required>
                                        <option value="">— Select —</option>
                                        <option value="1" {{ old('enq_gst_registered') == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('enq_gst_registered') === '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Years Operating</label>
                                    <input type="text" class="form-control" name="enq_years_operating" value="{{ old('enq_years_operating') }}" placeholder="e.g. 3">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">ABN / ACN</label>
                                    <input type="text" class="form-control" name="enq_abn_acn" value="{{ old('enq_abn_acn') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- STEP 2: Loan Snapshot --}}
                    <div class="enquiry-step" id="step-2" style="display:none;">
                        <h6 style="font-family:Poppins,sans-serif;color:#214942;margin-bottom:16px;">
                            <i class="ti-money mr-1"></i> Section 2 — Loan Snapshot
                        </h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Loan Product') }} <span class="required"> *</span></label>
                                    <select class="form-control auto-select select2" data-selected="{{ old('loan_product_id') }}" name="loan_product_id" id="loan_product_id" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        @foreach(\App\Models\LoanProduct::active()->get() as $loanProduct)
                                        <option value="{{ $loanProduct->id }}" data-penalties="{{ $loanProduct->late_payment_penalties }}" data-loan-id="{{ $loanProduct->loan_id_prefix.$loanProduct->starting_loan_id }}" data-details="{{ $loanProduct }}">{{ $loanProduct->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Currency') }}</label>
                                    @php $audCurrency = \App\Models\Currency::where('name', 'AUD')->where('status', 1)->first(); @endphp
                                    <input type="text" class="form-control" value="Australian Dollar (AUD)" disabled>
                                    <input type="hidden" name="currency_id" value="{{ $audCurrency->id ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Applied Amount') }} <span class="required"> *</span></label>
                                    <input type="text" class="form-control float-field" name="applied_amount" id="applied-amount-input" value="{{ old('applied_amount') }}" required>
                                    <small class="text-muted" id="amount-hint"></small>
                                </div>
                            </div>
                            <div class="col-lg-6" id="term-field" style="display:none;">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Term') }} <span id="term-range-label" class="text-muted" style="font-size:12px;"></span></label>
                                    <input type="number" class="form-control" name="term" id="term-input" value="{{ old('term') }}" min="1" max="999">
                                    <small class="text-muted" id="term-hint"></small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Loan Purpose <span class="required"> *</span></label>
                                    <input type="text" class="form-control" name="enq_loan_purpose" value="{{ old('enq_loan_purpose') }}" placeholder="e.g. Equipment purchase" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Time in Business</label>
                                    <input type="text" class="form-control" name="enq_time_in_business" value="{{ old('enq_time_in_business') }}" placeholder="e.g. 2 years">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Monthly Revenue Range <span class="required"> *</span></label>
                                    <select class="form-control" name="enq_monthly_revenue" required>
                                        <option value="">— Select —</option>
                                        <option value="0-20k" {{ old('enq_monthly_revenue') == '0-20k' ? 'selected' : '' }}>$0 – $20k</option>
                                        <option value="20-50k" {{ old('enq_monthly_revenue') == '20-50k' ? 'selected' : '' }}>$20k – $50k</option>
                                        <option value="50-100k" {{ old('enq_monthly_revenue') == '50-100k' ? 'selected' : '' }}>$50k – $100k</option>
                                        <option value="100k+" {{ old('enq_monthly_revenue') == '100k+' ? 'selected' : '' }}>$100k+</option>
                                    </select>
                                </div>
                            </div>
                            @if(! $customFields->isEmpty())
                                @foreach($customFields as $customField)
                                <div class="{{ $customField->field_width }}">
                                    <div class="form-group">
                                        <label class="control-label">{{ $customField->field_name }}</label>
                                        {!! xss_clean(generate_input_field($customField)) !!}
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- STEP 3: Risk Indicators --}}
                    <div class="enquiry-step" id="step-3" style="display:none;">
                        <h6 style="font-family:Poppins,sans-serif;color:#214942;margin-bottom:16px;">
                            <i class="ti-alert mr-1"></i> Section 3 — Risk Indicators
                        </h6>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Any ATO Debt? <span class="required"> *</span></label>
                                    <select class="form-control" name="enq_ato_debt" required>
                                        <option value="">— Select —</option>
                                        <option value="1" {{ old('enq_ato_debt') == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('enq_ato_debt') === '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Any Defaults? <span class="required"> *</span></label>
                                    <select class="form-control" name="enq_defaults" required>
                                        <option value="">— Select —</option>
                                        <option value="1" {{ old('enq_defaults') == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('enq_defaults') === '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Any Existing Loans? <span class="required"> *</span></label>
                                    <select class="form-control" name="enq_existing_loans" required>
                                        <option value="">— Select —</option>
                                        <option value="1" {{ old('enq_existing_loans') == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('enq_existing_loans') === '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- STEP 4: Security Filter --}}
                    <div class="enquiry-step" id="step-4" style="display:none;">
                        <h6 style="font-family:Poppins,sans-serif;color:#214942;margin-bottom:16px;">
                            <i class="ti-shield mr-1"></i> Section 4 — Security Filter
                        </h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Secured or Unsecured? <span class="required"> *</span></label>
                                    <select class="form-control" name="enq_security_type" id="enq_security_type" required>
                                        <option value="">— Select —</option>
                                        <option value="secured" {{ old('enq_security_type') == 'secured' ? 'selected' : '' }}>Secured</option>
                                        <option value="unsecured" {{ old('enq_security_type') == 'unsecured' ? 'selected' : '' }}>Unsecured</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6" id="asset-type-field" style="{{ old('enq_security_type') == 'secured' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label class="control-label">Asset Type</label>
                                    <input type="text" class="form-control" name="enq_asset_type" value="{{ old('enq_asset_type') }}" placeholder="e.g. Property, Vehicle">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- STEP 5: Progress Qualifier --}}
                    <div class="enquiry-step" id="step-5" style="display:none;">
                        <h6 style="font-family:Poppins,sans-serif;color:#214942;margin-bottom:16px;">
                            <i class="ti-calendar mr-1"></i> Section 5 — Progress Qualifier
                        </h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Funds Needed By <span class="required"> *</span></label>
                                    <input type="text" class="form-control datepicker" name="enq_funds_needed_by" value="{{ old('enq_funds_needed_by') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Best Contact Time</label>
                                    <input type="text" class="form-control" name="enq_best_contact_time" value="{{ old('enq_best_contact_time') }}" placeholder="e.g. Morning, After 3pm">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Attachment') }}</label>
                                    <input type="file" class="file-uploader" name="attachment">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Description') }}</label>
                                    <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- STEP 6: Consent --}}
                    <div class="enquiry-step" id="step-6" style="display:none;">
                        <h6 style="font-family:Poppins,sans-serif;color:#214942;margin-bottom:16px;">
                            <i class="ti-check-box mr-1"></i> Section 6 — Consent
                        </h6>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <div style="background:#f8f9fa;border:1px solid #e0e0e0;border-radius:6px;padding:14px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span style="font-family:Poppins,sans-serif;font-size:13px;color:#214942;font-weight:600;">
                                            <i class="ti-clipboard mr-1"></i> Review Your Application
                                        </span>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-review-app">
                                            <i class="ti-eye mr-1"></i> View Full Application
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="enq_consent" name="enq_consent" value="1" {{ old('enq_consent') ? 'checked' : '' }} required>
                                        <label class="custom-control-label" for="enq_consent" style="font-family:Poppins,sans-serif;font-size:14px;">
                                            I consent to being contacted regarding this loan enquiry.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div id="summary-error" class="alert alert-danger" style="display:none;font-family:Poppins,sans-serif;font-size:13px;"></div>
                                <button type="button" class="btn btn-secondary mr-2" id="btn-loan-summary" style="display:none;">
                                    <i class="ti-eye"></i>&nbsp;{{ _lang('View Loan Summary') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Navigation --}}
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-light" id="btn-prev" style="display:none;">
                            <i class="ti-arrow-left"></i> Previous
                        </button>
                        <div class="ml-auto">
                            <button type="button" class="btn btn-primary" id="btn-next">
                                Next <i class="ti-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn btn-success" id="btn-submit" style="display:none;">
                                <i class="ti-check-box"></i>&nbsp;{{ _lang('Submit') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- Application Detail Modal --}}
<div class="modal fade" id="appDetailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#214942;color:#fff;">
                <h5 class="modal-title" style="font-family:Poppins,sans-serif;font-size:14px;font-weight:400;">
                    <i class="ti-file mr-1"></i> Application Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:1;"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="font-family:Poppins,sans-serif;font-size:13px;" id="app-detail-body"></div>
        </div>
    </div>
</div>

{{-- Loan Summary Modal --}}
<div class="modal fade" id="loanSummaryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#214942;color:#fff;">
                <h5 class="modal-title" style="font-family:Poppins,sans-serif;font-size:14px;font-weight:400;">{{ _lang('Loan Repayment Summary') }}</h5>
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:1;"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="font-family:Poppins,sans-serif;font-size:14px;">
                <div id="summary-info" class="mb-3" style="background:#f8f9fa;padding:12px;border-radius:6px;"></div>
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
@endsection

@section('js-script')
<script>
$(document).ready(function () {

    var totalSteps  = 6;
    var currentStep = 1;
    var currentDetails = null;

    function showStep(n) {
        $('.enquiry-step').hide();
        $('#step-' + n).show();
        currentStep = n;
        for (var i = 1; i <= totalSteps; i++) {
            var $c = $('#step-circle-' + i);
            if (i < n)      $c.css('background', '#44a74a');
            else if (i === n) $c.css('background', '#214942');
            else            $c.css('background', '#ddd');
        }
        for (var i = 1; i < totalSteps; i++) {
            $('#step-line-' + i).css('background', i < n ? '#44a74a' : '#ddd');
        }
        $('#btn-prev').toggle(n > 1);
        $('#btn-next').toggle(n < totalSteps);
        $('#btn-submit').toggle(n === totalSteps);
        if (n === totalSteps && currentDetails) $('#btn-loan-summary').show();
        else $('#btn-loan-summary').hide();
    }

    showStep(1);

    // Auto-fill applicant fields when borrower is selected
    $(document).on('change', '#borrower_id', function () {
        var $opt = $(this).find('option:selected');
        $('input[name="enq_full_name"]').val($opt.data('name') || '');
        $('input[name="enq_mobile"]').val($opt.data('mobile') || '');
        $('input[name="enq_email"]').val($opt.data('email') || '');
    });

    @if($errors->any())
    (function() {
        var fieldStepMap = {
            'borrower_id': 1, 'enq_full_name': 1, 'enq_mobile': 1, 'enq_email': 1, 'enq_gst_registered': 1,
            'loan_product_id': 2, 'applied_amount': 2, 'term': 2, 'enq_loan_purpose': 2, 'enq_monthly_revenue': 2,
            'enq_ato_debt': 3, 'enq_defaults': 3, 'enq_existing_loans': 3,
            'enq_security_type': 4,
            'enq_funds_needed_by': 5,
            'enq_consent': 6
        };
        var errorFields = @json($errors->keys());
        var targetStep = 1;
        for (var i = 0; i < errorFields.length; i++) {
            var step = fieldStepMap[errorFields[i]];
            if (step) { targetStep = step; break; }
        }
        showStep(targetStep);
        errorFields.forEach(function(name) { $('[name="' + name + '"]').addClass('is-invalid'); });
    })();
    @endif

    function validateStep(n) {
        var valid = true;
        $('#step-' + n).find('[required]').each(function () {
            var $el = $(this);
            if ($el.is(':checkbox')) {
                if (!$el.is(':checked')) { valid = false; $el.closest('.form-group').addClass('has-error'); }
                else $el.closest('.form-group').removeClass('has-error');
            } else {
                if (!$el.val() || $el.val().trim() === '') { valid = false; $el.addClass('is-invalid'); }
                else $el.removeClass('is-invalid');
            }
        });
        return valid;
    }

    function showError(msg) {
        $('.step-inline-error').remove();
        var $err = $('<div class="alert alert-danger step-inline-error mt-2" style="font-family:Poppins,sans-serif;font-size:13px;">' + msg + '</div>');
        $('#step-' + currentStep).prepend($err);
        setTimeout(function () { $err.fadeOut(400, function(){ $(this).remove(); }); }, 4000);
    }

    $('#btn-next').on('click', function () {
        if (!validateStep(currentStep)) { showError('Please fill in all required fields before continuing.'); return; }
        if (currentStep === 2 && currentDetails) {
            var amount = parseFloat($('#applied-amount-input').val().replace(/,/g, '')) || 0;
            var minAmt = parseFloat(currentDetails.minimum_amount) || 0;
            var maxAmt = parseFloat(currentDetails.maximum_amount) || Infinity;
            if (amount < minAmt) { $('#applied-amount-input').addClass('is-invalid'); showError('The applied amount must be at least ' + minAmt.toLocaleString('en-AU', {minimumFractionDigits:2}) + '.'); return; }
            if (amount > maxAmt) { $('#applied-amount-input').addClass('is-invalid'); showError('The applied amount must not exceed ' + maxAmt.toLocaleString('en-AU', {minimumFractionDigits:2}) + '.'); return; }
            $('#applied-amount-input').removeClass('is-invalid');
        }
        if (currentStep < totalSteps) showStep(currentStep + 1);
    });

    $('#btn-prev').on('click', function () { if (currentStep > 1) showStep(currentStep - 1); });

    $(document).on('change', '#enq_security_type', function () {
        if ($(this).val() === 'secured') $('#asset-type-field').show();
        else { $('#asset-type-field').hide(); $('input[name="enq_asset_type"]').val(''); }
    });

    // Loan product / term field
    var $productSelect   = $('select[name="loan_product_id"]');
    var $termField       = $('#term-field');
    var $termInput       = $('#term-input');

    function updateTermField() {
        var selected = $productSelect.find('option:selected');
        if (!selected.val()) { $termField.hide(); $termInput.removeAttr('required'); currentDetails = null; return; }
        try {
            var details = JSON.parse(selected.attr('data-details'));
            currentDetails = details;
            var minMonths = parseInt(details.min_term) || 12;
            var maxMonths = parseInt(details.term) || 12;
            var minYears = Math.round(minMonths / 12);
            var maxYears = Math.round(maxMonths / 12);
            $('#term-range-label').text('(' + minYears + '–' + maxYears + ' years)');
            $termInput.attr('min', minYears).attr('max', maxYears);
            var cur = parseInt($termInput.val());
            if (!cur || cur < minYears) $termInput.val(minYears);
            else if (cur > maxYears) $termInput.val(maxYears);
            $('#term-hint').text('Min: ' + minYears + ' year' + (minYears > 1 ? 's' : '') + ' — Max: ' + maxYears + ' year' + (maxYears > 1 ? 's' : ''));
            $termField.show(); $termInput.attr('required', 'required');
            var minAmt = parseFloat(details.minimum_amount) || 0;
            var maxAmt = parseFloat(details.maximum_amount) || 0;
            $('#amount-hint').text('Min: $' + minAmt.toLocaleString() + ' — Max: $' + maxAmt.toLocaleString());
        } catch(e) { $termField.hide(); }
    }
    $productSelect.on('change', updateTermField);
    if ($productSelect.val()) updateTermField();

    // Loan summary calc helpers
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

    function calcSchedule(details, amount, termYears) {
        var term = termYears * 12; // convert years to months for monthly installments
        var rate = parseFloat(details.interest_rate) / 100;
        var termPeriod = details.term_period || '+1 month';
        var itype = details.interest_type;
        var fpd = new Date(); fpd.setMonth(fpd.getMonth() + 1);
        var firstDate = fpd.toISOString().slice(0,10);
        var schedule = [], date = firstDate;
        function durYears() {
            var clean = termPeriod.replace(/^\+/, '').trim();
            var m = clean.match(/(\d+)\s*(day|month|year)s?/i);
            if (!m) return term / 12;
            var n = parseInt(m[1]), unit = m[2].toLowerCase();
            if (unit === 'day') return (n * term) / 365;
            if (unit === 'month') return (n * term) / 12;
            if (unit === 'year') return n * term;
            return term / 12;
        }
        if (itype === 'flat_rate') {
            var totalInt = amount * rate * durYears(), principalPT = amount / term, interestPT = totalInt / term, installment = principalPT + interestPT, balance = amount;
            for (var i = 0; i < term; i++) { balance -= principalPT; schedule.push({ date: date, principal: principalPT, interest: interestPT, amount_to_pay: installment, balance: Math.max(balance, 0) }); date = advanceDate(date, termPeriod); }
        } else if (itype === 'fixed_rate') {
            var principalPT = amount / term, interestPT = rate * amount, installment = principalPT + interestPT, balance = amount;
            for (var i = 0; i < term; i++) { balance -= principalPT; schedule.push({ date: date, principal: principalPT, interest: interestPT, amount_to_pay: installment, balance: Math.max(balance, 0) }); date = advanceDate(date, termPeriod); }
        } else if (itype === 'mortgage') {
            var monthlyRate = rate / 12, payment = monthlyRate === 0 ? amount / term : amount * (monthlyRate / (1 - Math.pow(1 + monthlyRate, -term))), balance = amount;
            for (var i = 0; i < term; i++) { var interest = balance * monthlyRate, principal = payment - interest; balance -= principal; schedule.push({ date: date, principal: principal, interest: interest, amount_to_pay: payment, balance: Math.max(balance, 0) }); date = advanceDate(date, termPeriod); }
        } else if (itype === 'one_time') {
            var interest = rate * amount; schedule.push({ date: date, principal: amount, interest: interest, amount_to_pay: amount + interest, balance: 0 });
        } else if (itype === 'reducing_amount') {
            var monthlyRate = rate / 12, principalPT = amount / term, balance = amount;
            for (var i = 0; i < term; i++) { var interest = balance * monthlyRate, amtToPay = interest + principalPT; balance -= principalPT; schedule.push({ date: date, principal: principalPT, interest: interest, amount_to_pay: amtToPay, balance: Math.max(balance, 0) }); date = advanceDate(date, termPeriod); }
        }
        return schedule;
    }

    $('#btn-loan-summary').on('click', function () {
        if (!currentDetails) return;
        var amount = parseFloat($('#applied-amount-input').val().replace(/,/g,''));
        var term   = parseInt($termInput.val());
        if (!amount || amount <= 0) { showError('Please enter the applied amount first.'); return; }
        if (!term   || term   <= 0) { showError('Please enter the term first.'); return; }
        var schedule = calcSchedule(currentDetails, amount, term);
        var totalPayable = 0, totalInterest = 0, totalPrincipal = 0, rows = '';
        $.each(schedule, function (i, row) {
            totalPrincipal += row.principal; totalInterest += row.interest; totalPayable += row.amount_to_pay;
            rows += '<tr><td>' + (i+1) + '</td><td>' + row.date + '</td><td>' + fmt(row.principal) + '</td><td>' + fmt(row.interest) + '</td><td>' + fmt(row.amount_to_pay) + '</td><td>' + fmt(row.balance) + '</td></tr>';
        });
        var tp = (currentDetails.term_period || '').replace(/^\+/, '').replace(/\d+\s*/, '').trim();
        var termMonths = term * 12;
        $('#summary-info').html('<strong>Product:</strong> ' + currentDetails.name + ' &nbsp;|&nbsp; <strong>Amount:</strong> AUD ' + fmt(amount) + ' &nbsp;|&nbsp; <strong>Term:</strong> ' + term + ' Year' + (term > 1 ? 's' : '') + ' (' + termMonths + ' monthly installments) &nbsp;|&nbsp; <strong>Rate:</strong> ' + currentDetails.interest_rate + '% p.a.');
        $('#summary-table-body').html(rows);
        $('#summary-table-foot').html('<tr><td colspan="2"><strong>Total</strong></td><td><strong>' + fmt(totalPrincipal) + '</strong></td><td><strong>' + fmt(totalInterest) + '</strong></td><td><strong>' + fmt(totalPayable) + '</strong></td><td></td></tr>');
        $('#loanSummaryModal').modal('show');
    });

    // Review application button
    $('#btn-review-app').on('click', function () {
        function fv(name) {
            var $el = $('[name="' + name + '"]');
            if ($el.is('select')) return $el.find('option:selected').text().replace('— Select —','').trim() || '—';
            return $el.val() || '—';
        }
        function yesno(name) { var v = $('[name="' + name + '"]').val(); return v === '1' ? 'Yes' : v === '0' ? 'No' : '—'; }
        var html =
            '<div class="row">' +
            '<div class="col-12 mb-2"><strong style="color:#214942;"><i class="ti-user mr-1"></i> Section 1 — Applicant Basics</strong><hr class="mt-1 mb-2"></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Borrower</span><br><strong>' + fv('borrower_id') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Full Name</span><br><strong>' + fv('enq_full_name') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Mobile</span><br><strong>' + fv('enq_mobile') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Email</span><br><strong>' + fv('enq_email') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">GST Registered</span><br><strong>' + yesno('enq_gst_registered') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Years Operating</span><br><strong>' + fv('enq_years_operating') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">ABN / ACN</span><br><strong>' + fv('enq_abn_acn') + '</strong></div>' +
            '<div class="col-12 mb-2 mt-2"><strong style="color:#214942;"><i class="ti-money mr-1"></i> Section 2 — Loan Snapshot</strong><hr class="mt-1 mb-2"></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Loan Product</span><br><strong>' + fv('loan_product_id') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Applied Amount</span><br><strong>AUD ' + fv('applied_amount') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Term</span><br><strong>' + fv('term') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Loan Purpose</span><br><strong>' + fv('enq_loan_purpose') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Monthly Revenue</span><br><strong>' + fv('enq_monthly_revenue') + '</strong></div>' +
            '<div class="col-12 mb-2 mt-2"><strong style="color:#214942;"><i class="ti-alert mr-1"></i> Section 3 — Risk Indicators</strong><hr class="mt-1 mb-2"></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">ATO Debt</span><br><strong>' + yesno('enq_ato_debt') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Defaults</span><br><strong>' + yesno('enq_defaults') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Existing Loans</span><br><strong>' + yesno('enq_existing_loans') + '</strong></div>' +
            '<div class="col-12 mb-2 mt-2"><strong style="color:#214942;"><i class="ti-shield mr-1"></i> Section 4 — Security</strong><hr class="mt-1 mb-2"></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Security Type</span><br><strong>' + fv('enq_security_type') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Asset Type</span><br><strong>' + fv('enq_asset_type') + '</strong></div>' +
            '<div class="col-12 mb-2 mt-2"><strong style="color:#214942;"><i class="ti-calendar mr-1"></i> Section 5 — Progress</strong><hr class="mt-1 mb-2"></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Funds Needed By</span><br><strong>' + fv('enq_funds_needed_by') + '</strong></div>' +
            '<div class="col-md-4 mb-2"><span class="text-muted" style="font-size:11px;">Best Contact Time</span><br><strong>' + fv('enq_best_contact_time') + '</strong></div>' +
            '</div>';
        $('#app-detail-body').html(html);
        $('#appDetailModal').modal('show');
    });

    // Final submit validation
    $('#enquiry-form').on('submit', function (e) {
        if (!$('#enq_consent').is(':checked')) {
            e.preventDefault();
            showError('You must consent before submitting.');
            return false;
        }
    });

});
</script>
@endsection
