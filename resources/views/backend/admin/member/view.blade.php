@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-4 col-lg-3">
		<ul class="nav flex-column nav-tabs settings-tab" role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#member_details"><i class="ti-user"></i>&nbsp;{{ _lang('Member Details') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#transaction-history"><i class="ti-view-list-alt"></i>{{ _lang('Transactions') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#member_loans"><i class="ti-agenda"></i>&nbsp;{{ _lang('Loans') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kyc_documents"><i class="ti-files"></i>&nbsp;{{ _lang('KYC Documents') }}</a></li>
           {{--

             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#account_overview"><i class="ti-credit-card"></i>&nbsp;{{ _lang('Account Overview') }}</a></li>
			
             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#email"><i class="ti-email"></i>&nbsp;{{ _lang('Send Email') }}</a></li>
             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sms"><i class="ti-comment-alt"></i>&nbsp;{{ _lang('Send SMS') }}</a></li>
           --}}
             <li class="nav-item"><a class="nav-link" href="{{ route('members.edit', $member->id) }}"><i class="ti-pencil-alt"></i>&nbsp;{{ _lang('Edit Member Details') }}</a></li>
		</ul>
	</div>

	<div class="col-md-8 col-lg-9">
		<div class="tab-content">
			<div id="member_details" class="tab-pane active">
				<div class="card">
					<div class="card-header">
						<span class="header-title">{{ _lang('Member Details') }}</span>
					</div>

					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<td colspan="2" class="profile_picture text-center">
                                        <img src="{{ ($member->photo && $member->photo !== 'default.png') 
                                            ? profile_picture($member->photo) 
                                            : asset('public/backend/images/avatar.png') }}" 
                                            class="thumb-image-md">
                                    </td>
							</tr>
							<tr><td>{{ _lang('First Name') }}</td><td>{{ $member->first_name }}</td></tr>
							<tr><td>{{ _lang('Last Name') }}</td><td>{{ $member->last_name }}</td></tr>
							<tr><td>{{ _lang('Business Name') }}</td><td>{{ $member->business_name }}</td></tr>
							<tr><td>{{ _lang('Member No') }}</td><td>{{ $member->member_no }}</td></tr>
							<tr><td>{{ _lang('Branch') }}</td><td>{{ $member->branch->name }}</td></tr>
							<tr><td>{{ _lang('Email') }}</td><td>{{ $member->email }}</td></tr>
							<tr><td>{{ _lang('Mobile') }}</td><td>{{ $member->country_code.$member->mobile }}</td></tr>
							<tr><td>{{ _lang('Gender') }}</td><td>{{ ucwords($member->gender) }}</td></tr>
							<tr><td>{{ _lang('City') }}</td><td>{{ $member->city }}</td></tr>
							<tr><td>{{ _lang('State') }}</td><td>{{ $member->state }}</td></tr>
							<tr><td>{{ _lang('Zip') }}</td><td>{{ $member->zip }}</td></tr>
                            <!--Custom Fields-->
                            @if(! $customFields->isEmpty())
                                @php $customFieldsData = json_decode($member->custom_fields, true); @endphp
                                @foreach($customFields as $customField)
                                <tr>
                                    <td>{{ $customField->field_name }}</td>
                                    <td>
                                        @if($customField->field_type == 'file')
                                        @php $file = $customFieldsData[str_replace(' ', '_', $customField->field_name)]['field_value'] ?? null; @endphp
                                        {!! $file != null ? '<a href="'. asset('public/uploads/media/'.$file) .'" target="_blank" class="btn btn-xs btn-primary"><i class="fas fa-download mr-2"></i>'._lang('Download').'</a>' : '' !!}
                                        @else
                                        {{ $customFieldsData[str_replace(' ', '_', $customField->field_name)]['field_value'] ?? null }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif
							<tr><td>{{ _lang('Address') }}</td><td>{{ $member->address }}</td></tr>
							<tr><td>{{ _lang('Credit Source') }}</td><td>{{ $member->credit_source }}</td></tr>
						</table>
					</div>
				</div>
			</div>

			<div id="account_overview" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Account Overview') }}</span>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap pl-4">{{ _lang('Account Number') }}</th>
                                        <th class="text-nowrap">{{ _lang('Account Type') }}</th>
                                        <th>{{ _lang('Currency') }}</th>
                                        <th class="text-right">{{ _lang('Balance') }}</th>
                                        <th class="text-nowrap text-right">{{ _lang('Loan Guarantee') }}</th>
                                        <th class="text-nowrap text-right pr-4">{{ _lang('Current Balance') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(get_account_details($member->id) as $account)
                                    <tr>
                                        <td class="pl-4">{{ $account->account_number }}</td>
                                        <td class="text-nowrap">{{ $account->savings_type->name }}</td>
                                        <td>{{ $account->savings_type->currency->name }}</td>
                                        <td class="text-nowrap text-right">{{ decimalPlace($account->balance, currency($account->savings_type->currency->name)) }}</td>
                                        <td class="text-nowrap text-right">{{ decimalPlace($account->blocked_amount, currency($account->savings_type->currency->name)) }}</td>
                                        <td class="text-nowrap text-right pr-4">{{ decimalPlace($account->balance - $account->blocked_amount, currency($account->savings_type->currency->name)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
					    </div>
					</div>
				</div>
			</div>

			<div id="transaction-history" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Transactions') }}</span>
                    </div>

                    <div class="card-body">
						<table id="transactions_table" class="table table-bordered">
							<thead>
								<tr>
									<th>{{ _lang('Date') }}</th>
									<th>{{ _lang('Member') }}</th>
									<th>{{ _lang('Account Number') }}</th>
									<th>{{ _lang('Amount') }}</th>
									<th>{{ _lang('Debit/Credit') }}</th>
									<th>{{ _lang('Type') }}</th>
									<th>{{ _lang('Status') }}</th>
									<th class="text-center">{{ _lang('Action') }}</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div><!--End Transaction Table-->

			<div id="member_loans" class="tab-pane">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <span class="header-title">{{ _lang('Loans') }}</span>
                        <button class="btn btn-primary btn-xs ml-auto" id="btn_member_pay">
                            <i class="ti-credit-card"></i>&nbsp;{{ _lang('Pay') }}
                        </button>
                    </div>

                    <div class="card-body">
						<table id="loans_table" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>{{ _lang('Loan ID') }}</th>
                                    <th>{{ _lang('Loan Product') }}</th>
                                    <th class="text-right">{{ _lang('Applied Amount') }}</th>
                                    <th class="text-right">{{ _lang('Amount Paid') }}</th>
                                    <th class="text-right">{{ _lang('Due Amount') }}</th>
                                    <th>{{ _lang('Release Date') }}</th>
                                    <th>{{ _lang('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($member->loans as $loan)
                                <tr>
                                    <td><a href="{{ route('loans.show',$loan->id) }}">{{ $loan->loan_id }}</a></td>
                                    <td>{{ $loan->loan_product->name }}</td>
                                    <td class="text-right">{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</td>
                                    <td class="text-right">{{ decimalPlace($loan->total_paid, currency($loan->currency->name)) }}</td>
                                    <td class="text-right">{{ decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name)) }}</td>
                                    <td>{{ $loan->release_date }}</td>
                                    <td>
                                        @if($loan->status == 0)
                                            {!! xss_clean(show_status(_lang('Pending'), 'warning')) !!}
                                        @elseif($loan->status == 1)
                                            {!! xss_clean(show_status(_lang('Approved'), 'success')) !!}
                                        @elseif($loan->status == 2)
                                            {!! xss_clean(show_status(_lang('Completed'), 'info')) !!}
                                        @elseif($loan->status == 3)
                                            {!! xss_clean(show_status(_lang('Cancelled'), 'danger')) !!}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
					</div>
				</div>
			</div>

			<div id="kyc_documents" class="tab-pane">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <span class="header-title">{{ _lang('Documents of').' '.$member->first_name.' '.$member->last_name }}</span>
                        <a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="{{ _lang('Add New Document') }}" href="{{ route('member_documents.create', $member->id) }}"><i class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>{{ _lang('Document Name') }}</th>
                                    <th>{{ _lang('Document File') }}</th>
                                    <th>{{ _lang('Submitted At') }}</th>
                                    <th>{{ _lang('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($member->documents as $document)
                                <tr>
                                    <td>{{ $document->name }}</td>
                                    <td><a target="_blank" href="{{ asset('public/uploads/documents/'.$document->document ) }}">{{ $document->document }}</a></td>
                                    <td>{{ date('d M, Y H:i:s',strtotime($document->created_at)) }}</td>
                                    <td class="text-center">
                                        <span class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ _lang('Action') }}
                                        </button>
                                        <form action="{{ route('member_documents.destroy', $document->id) }}" method="post">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="{{ route('member_documents.edit', $document->id) }}" data-title="{{ _lang('Update Document') }}" class="dropdown-item dropdown-edit ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;{{ _lang('Edit') }}</a>
                                                <button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;{{ _lang('Delete') }}</button>
                                            </div>
                                        </form>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--End KYC Documents Tab-->

			<div id="email" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Send Email') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="post" class="validate" autocomplete="off" action="{{ route('members.send_email') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('User Email') }}</label>
                                        <input type="email" class="form-control" name="user_email" value="{{ $member->email }}" required="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Subject') }}</label>
                                        <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Message') }}</label>
                                        <textarea class="form-control" rows="8" name="message" required>{{ old('message') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="ti-check-box"></i>&nbsp;{{ _lang('Send') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--End Send Email Tab-->

            <div id="sms" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Send SMS') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="post" class="validate" autocomplete="off" action="{{ route('members.send_sms') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('User Mobile') }}</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $member->country_code.$member->mobile }}" required="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Message') }}</label>
                                        <textarea class="form-control" name="message" required>{{ old('message') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="ti-check-box"></i>&nbsp;{{ _lang('Send') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--End Send SMS Tab-->

		</div>
	</div>
</div>

{{-- Member Pay Modal --}}
<div class="modal fade" id="memberPayModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ _lang('Make Payment') }} — {{ $member->first_name }} {{ $member->last_name }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="mp_step_search">
                    <div class="form-group">
                        <label>{{ _lang('Search Loan') }}</label>
                        <input type="text" id="member_pay_search" class="form-control" placeholder="{{ _lang('Loan ID or member name...') }}" autocomplete="off">
                    </div>
                    <div id="member_pay_results" class="mt-2"></div>
                </div>
                <div id="mp_step_form" style="display:none;">
                    <div class="alert alert-info py-2" id="mp_loan_info"></div>
                    <form id="mp_form">
                        @csrf
                        <input type="hidden" name="loan_id" id="mp_loan_id">
                        <input type="hidden" name="due_amount_of" id="mp_due_amount_of">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ _lang('Payment Date') }}</label>
                                    <input type="text" class="form-control datepicker" name="paid_at" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ _lang('Principal') }}</label>
                                    <input type="number" step="0.01" class="form-control" name="principal_amount" id="mp_principal" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ _lang('Interest') }}</label>
                                    <input type="number" step="0.01" class="form-control" name="interest" id="mp_interest" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ _lang('Late Penalties') }}</label>
                                    <input type="number" step="0.01" class="form-control" name="late_penalties" id="mp_penalties" value="0">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ _lang('Total') }}</label>
                                    <input type="number" step="0.01" class="form-control" id="mp_total" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex flex-wrap mb-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm mr-2 mb-1 mp-method-btn active" data-method="cash"><i class="fas fa-money-bill-wave"></i> {{ _lang('Cash') }}</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm mr-2 mb-1 mp-method-btn" data-method="bank_transfer"><i class="fas fa-university"></i> {{ _lang('Bank Transfer') }}</button>
                                    <a href="#" id="stripe_mp_link" class="btn btn-outline-danger btn-sm mr-2 mb-1"><i class="fab fa-stripe-s"></i> {{ _lang('Stripe') }}</a>
                                </div>
                                <input type="hidden" name="payment_method" id="mp_method" value="cash">
                            </div>
                            <div class="col-md-12" id="mp_bank_section" style="display:none;">
                                <div class="form-group">
                                    <label>{{ _lang('Transaction / Reference Number') }}</label>
                                    <input type="text" class="form-control" name="utr_number" placeholder="{{ _lang('Bank reference number') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ _lang('Remarks') }}</label>
                                    <textarea class="form-control" name="remarks" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary btn-sm" id="mp_back"><i class="ti-arrow-left"></i> {{ _lang('Back') }}</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="mp_submit"><i class="ti-check"></i> {{ _lang('Process Payment') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-script')
<script>
(function ($) {
	"use strict";

	$('#transactions_table').DataTable({
		processing: true,
		serverSide: true,
		ajax: _tenant_url + '/members/get_member_transaction_data/{{ $member->id }}',
		"columns" : [
			{ data : 'trans_date', name : 'trans_date' },
			{ data : 'member.first_name', name : 'member.first_name' },
			{ data : 'account_number', name : 'account_number', orderable: false },
			{ data : 'amount', name : 'amount' },
			{ data : 'dr_cr', name : 'dr_cr' },
			{ data : 'type', name : 'type' },
			{ data : 'status', name : 'status' },
			{ data : "action", name : "action" },
		],
		responsive: true,
		"bStateSave": true,
		"bAutoWidth":false,
		"ordering": false,
		"language": {
		   "decimal":        "",
		   "emptyTable":     "{{ _lang('No Data Found') }}",
		   "info":           "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
		   "infoEmpty":      "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
		   "infoFiltered":   "(filtered from _MAX_ total entries)",
		   "infoPostFix":    "",
		   "thousands":      ",",
		   "lengthMenu":     "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
		   "loadingRecords": "{{ _lang('Loading...') }}",
		   "processing":     "{{ _lang('Processing...') }}",
		   "search":         "{{ _lang('Search') }}",
		   "zeroRecords":    "{{ _lang('No matching records found') }}",
		   "paginate": {
			  "first":      "{{ _lang('First') }}",
			  "last":       "{{ _lang('Last') }}",
              "previous":   "<i class='fas fa-angle-left'></i>",
        	  "next" :      "<i class='fas fa-angle-right'></i>",
		  }
		},
        drawCallback: function () {
			$(".dataTables_paginate > .pagination").addClass("pagination-bordered");
		}
	});

    $('.nav-tabs a').on('shown.bs.tab', function(event){
   		var tab = $(event.target).attr("href");
   		var url = "{{ route('members.show',$member->id) }}";
   	    history.pushState({}, null, url + "?tab=" + tab.substring(1));
   	});

   	@if(isset($_GET['tab']))
   	   $('.nav-tabs a[href="#{{ $_GET['tab'] }}"]').tab('show');
   	@endif

    $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });

    // ── Member Pay Button ─────────────────────────────────────────────────────
    var memberNo   = '{{ $member->member_no }}';
    var stripeBase = '{{ url(request()->route("tenant") . "/pay/stripe") }}';

    $('#btn_member_pay').on('click', function () {
        $('#memberPayModal').modal('show');
        // Auto-search by member number
        $('#member_pay_search').val(memberNo).trigger('input');
    });

    var memberPayTimer;
    $('#member_pay_search').on('input', function () {
        clearTimeout(memberPayTimer);
        var q = $(this).val().trim();
        if (!q) { $('#member_pay_results').html(''); return; }
        memberPayTimer = setTimeout(function () {
            $.get('{{ route("pay.search") }}', { q: q }, function (data) {
                if (!data.length) {
                    $('#member_pay_results').html('<p class="text-muted small">{{ _lang("No active loans found") }}</p>');
                    return;
                }
                var html = '<table class="table table-sm table-hover"><thead><tr>'
                    + '<th>{{ _lang("Loan ID") }}</th><th>{{ _lang("Outstanding") }}</th><th>{{ _lang("Next Due") }}</th><th></th>'
                    + '</tr></thead><tbody>';
                $.each(data, function (i, loan) {
                    html += '<tr>'
                        + '<td>' + loan.loan_id + '</td>'
                        + '<td>' + loan.currency + ' ' + parseFloat(loan.outstanding).toFixed(2) + '</td>'
                        + '<td>' + (loan.next_due_date || '-') + '</td>'
                        + '<td><button class="btn btn-primary btn-xs btn-mp-select" data-loan=\'' + JSON.stringify(loan) + '\'>{{ _lang("Pay") }}</button></td>'
                        + '</tr>';
                });
                html += '</tbody></table>';
                $('#member_pay_results').html(html);
            });
        }, 300);
    });

    $(document).on('click', '.btn-mp-select', function () {
        var loan = $(this).data('loan');
        $('#mp_loan_id').val(loan.id);
        $('#mp_due_amount_of').val(loan.next_repayment_id);
        $('#mp_principal').val(parseFloat(loan.next_principal).toFixed(2));
        $('#mp_interest').val(parseFloat(loan.next_interest).toFixed(2));
        $('#mp_penalties').val(0);
        mpRecalc();
        $('#stripe_mp_link').attr('href', stripeBase + '/' + loan.id + '?late=0');
        $('#mp_loan_info').html('<strong>' + loan.loan_id + '</strong> &mdash; {{ _lang("Outstanding") }}: ' + loan.currency + ' ' + parseFloat(loan.outstanding).toFixed(2));
        $('#mp_step_search').hide();
        $('#mp_step_form').show();
    });

    $('#mp_back').on('click', function () { $('#mp_step_form').hide(); $('#mp_step_search').show(); });

    $(document).on('click', '.mp-method-btn', function () {
        $('.mp-method-btn').removeClass('active');
        $(this).addClass('active');
        $('#mp_method').val($(this).data('method'));
        $('#mp_bank_section').toggle($(this).data('method') === 'bank_transfer');
    });

    function mpRecalc() {
        var p = parseFloat($('#mp_principal').val()) || 0;
        var i = parseFloat($('#mp_interest').val()) || 0;
        var pen = parseFloat($('#mp_penalties').val()) || 0;
        $('#mp_total').val((p + i + pen).toFixed(2));
        var loanId = $('#mp_loan_id').val();
        if (loanId) $('#stripe_mp_link').attr('href', stripeBase + '/' + loanId + '?late=' + pen);
    }
    $('#mp_principal, #mp_interest, #mp_penalties').on('input', mpRecalc);

    $('#mp_form').on('submit', function (e) {
        e.preventDefault();
        var btn = $('#mp_submit').prop('disabled', true).text('{{ _lang("Processing...") }}');
        $.ajax({
            url: '{{ route("pay.process") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                if (res.result === 'success') {
                    $('#memberPayModal').modal('hide');
                    toastr.success(res.message);
                    location.reload();
                } else {
                    toastr.error(Array.isArray(res.message) ? res.message.join('<br>') : res.message);
                }
            },
            error: function () { toastr.error('{{ _lang("An error occurred") }}'); },
            complete: function () { btn.prop('disabled', false).text('{{ _lang("Process Payment") }}'); }
        });
    });

    $('#memberPayModal').on('hidden.bs.modal', function () {
        $('#mp_step_form').hide();
        $('#mp_step_search').show();
        $('#member_pay_results').html('');
    });

})(jQuery);
</script>
@endsection


