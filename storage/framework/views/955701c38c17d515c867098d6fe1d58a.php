<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-4 col-lg-3">
		<ul class="nav flex-column nav-tabs settings-tab" role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#member_details"><i class="ti-user"></i>&nbsp;<?php echo e(_lang('Member Details')); ?></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#account_overview"><i class="ti-credit-card"></i>&nbsp;<?php echo e(_lang('Account Overview')); ?></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#transaction-history"><i class="ti-view-list-alt"></i><?php echo e(_lang('Transactions')); ?></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#member_loans"><i class="ti-agenda"></i>&nbsp;<?php echo e(_lang('Loans')); ?></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kyc_documents"><i class="ti-files"></i>&nbsp;<?php echo e(_lang('KYC Documents')); ?></a></li>
             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#email"><i class="ti-email"></i>&nbsp;<?php echo e(_lang('Send Email')); ?></a></li>
             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sms"><i class="ti-comment-alt"></i>&nbsp;<?php echo e(_lang('Send SMS')); ?></a></li>
             <li class="nav-item"><a class="nav-link" href="<?php echo e(route('members.edit', $member->id)); ?>"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit Member Details')); ?></a></li>
		</ul>
	</div>

	<div class="col-md-8 col-lg-9">
		<div class="tab-content">
			<div id="member_details" class="tab-pane active">
				<div class="card">
					<div class="card-header">
						<span class="header-title"><?php echo e(_lang('Member Details')); ?></span>
					</div>

					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<td colspan="2" class="profile_picture text-center">
									<img src="<?php echo e(profile_picture($member->photo)); ?>" class="thumb-image-md">
								</td>
							</tr>
							<tr><td><?php echo e(_lang('First Name')); ?></td><td><?php echo e($member->first_name); ?></td></tr>
							<tr><td><?php echo e(_lang('Last Name')); ?></td><td><?php echo e($member->last_name); ?></td></tr>
							<tr><td><?php echo e(_lang('Business Name')); ?></td><td><?php echo e($member->business_name); ?></td></tr>
							<tr><td><?php echo e(_lang('Member No')); ?></td><td><?php echo e($member->member_no); ?></td></tr>
							<tr><td><?php echo e(_lang('Branch')); ?></td><td><?php echo e($member->branch->name); ?></td></tr>
							<tr><td><?php echo e(_lang('Email')); ?></td><td><?php echo e($member->email); ?></td></tr>
							<tr><td><?php echo e(_lang('Mobile')); ?></td><td><?php echo e($member->country_code.$member->mobile); ?></td></tr>
							<tr><td><?php echo e(_lang('Gender')); ?></td><td><?php echo e(ucwords($member->gender)); ?></td></tr>
							<tr><td><?php echo e(_lang('City')); ?></td><td><?php echo e($member->city); ?></td></tr>
							<tr><td><?php echo e(_lang('State')); ?></td><td><?php echo e($member->state); ?></td></tr>
							<tr><td><?php echo e(_lang('Zip')); ?></td><td><?php echo e($member->zip); ?></td></tr>
                            <!--Custom Fields-->
                            <?php if(! $customFields->isEmpty()): ?>
                                <?php $customFieldsData = json_decode($member->custom_fields, true); ?>
                                <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($customField->field_name); ?></td>
                                    <td>
                                        <?php if($customField->field_type == 'file'): ?>
                                        <?php $file = $customFieldsData[str_replace(' ', '_', $customField->field_name)]['field_value'] ?? null; ?>
                                        <?php echo $file != null ? '<a href="'. asset('public/uploads/media/'.$file) .'" target="_blank" class="btn btn-xs btn-primary"><i class="fas fa-download mr-2"></i>'._lang('Download').'</a>' : ''; ?>

                                        <?php else: ?>
                                        <?php echo e($customFieldsData[str_replace(' ', '_', $customField->field_name)]['field_value'] ?? null); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
							<tr><td><?php echo e(_lang('Address')); ?></td><td><?php echo e($member->address); ?></td></tr>
							<tr><td><?php echo e(_lang('Credit Source')); ?></td><td><?php echo e($member->credit_source); ?></td></tr>
						</table>
					</div>
				</div>
			</div>

			<div id="account_overview" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Account Overview')); ?></span>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap pl-4"><?php echo e(_lang('Account Number')); ?></th>
                                        <th class="text-nowrap"><?php echo e(_lang('Account Type')); ?></th>
                                        <th><?php echo e(_lang('Currency')); ?></th>
                                        <th class="text-right"><?php echo e(_lang('Balance')); ?></th>
                                        <th class="text-nowrap text-right"><?php echo e(_lang('Loan Guarantee')); ?></th>
                                        <th class="text-nowrap text-right pr-4"><?php echo e(_lang('Current Balance')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = get_account_details($member->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="pl-4"><?php echo e($account->account_number); ?></td>
                                        <td class="text-nowrap"><?php echo e($account->savings_type->name); ?></td>
                                        <td><?php echo e($account->savings_type->currency->name); ?></td>
                                        <td class="text-nowrap text-right"><?php echo e(decimalPlace($account->balance, currency($account->savings_type->currency->name))); ?></td>
                                        <td class="text-nowrap text-right"><?php echo e(decimalPlace($account->blocked_amount, currency($account->savings_type->currency->name))); ?></td>
                                        <td class="text-nowrap text-right pr-4"><?php echo e(decimalPlace($account->balance - $account->blocked_amount, currency($account->savings_type->currency->name))); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
					    </div>
					</div>
				</div>
			</div>

			<div id="transaction-history" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Transactions')); ?></span>
                    </div>

                    <div class="card-body">
						<table id="transactions_table" class="table table-bordered">
							<thead>
								<tr>
									<th><?php echo e(_lang('Date')); ?></th>
									<th><?php echo e(_lang('Member')); ?></th>
									<th><?php echo e(_lang('Account Number')); ?></th>
									<th><?php echo e(_lang('Amount')); ?></th>
									<th><?php echo e(_lang('Debit/Credit')); ?></th>
									<th><?php echo e(_lang('Type')); ?></th>
									<th><?php echo e(_lang('Status')); ?></th>
									<th class="text-center"><?php echo e(_lang('Action')); ?></th>
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
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Loans')); ?></span>
                    </div>

                    <div class="card-body">
						<table id="loans_table" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(_lang('Loan ID')); ?></th>
                                    <th><?php echo e(_lang('Loan Product')); ?></th>
                                    <th class="text-right"><?php echo e(_lang('Applied Amount')); ?></th>
                                    <th class="text-right"><?php echo e(_lang('Amount Paid')); ?></th>
                                    <th class="text-right"><?php echo e(_lang('Due Amount')); ?></th>
                                    <th><?php echo e(_lang('Release Date')); ?></th>
                                    <th><?php echo e(_lang('Status')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $member->loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(route('loans.show',$loan->id)); ?>"><?php echo e($loan->loan_id); ?></a></td>
                                    <td><?php echo e($loan->loan_product->name); ?></td>
                                    <td class="text-right"><?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?></td>
                                    <td class="text-right"><?php echo e(decimalPlace($loan->total_paid, currency($loan->currency->name))); ?></td>
                                    <td class="text-right"><?php echo e(decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name))); ?></td>
                                    <td><?php echo e($loan->release_date); ?></td>
                                    <td>
                                        <?php if($loan->status == 0): ?>
                                            <?php echo xss_clean(show_status(_lang('Pending'), 'warning')); ?>

                                        <?php elseif($loan->status == 1): ?>
                                            <?php echo xss_clean(show_status(_lang('Approved'), 'success')); ?>

                                        <?php elseif($loan->status == 2): ?>
                                            <?php echo xss_clean(show_status(_lang('Completed'), 'info')); ?>

                                        <?php elseif($loan->status == 3): ?>
                                            <?php echo xss_clean(show_status(_lang('Cancelled'), 'danger')); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
					</div>
				</div>
			</div>

			<div id="kyc_documents" class="tab-pane">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <span class="header-title"><?php echo e(_lang('Documents of').' '.$member->first_name.' '.$member->last_name); ?></span>
                        <a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="<?php echo e(_lang('Add New Document')); ?>" href="<?php echo e(route('member_documents.create', $member->id)); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add New')); ?></a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(_lang('Document Name')); ?></th>
                                    <th><?php echo e(_lang('Document File')); ?></th>
                                    <th><?php echo e(_lang('Submitted At')); ?></th>
                                    <th><?php echo e(_lang('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $member->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($document->name); ?></td>
                                    <td><a target="_blank" href="<?php echo e(asset('public/uploads/documents/'.$document->document )); ?>"><?php echo e($document->document); ?></a></td>
                                    <td><?php echo e(date('d M, Y H:i:s',strtotime($document->created_at))); ?></td>
                                    <td class="text-center">
                                        <span class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e(_lang('Action')); ?>

                                        </button>
                                        <form action="<?php echo e(route('member_documents.destroy', $document->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <input name="_method" type="hidden" value="DELETE">

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="<?php echo e(route('member_documents.edit', $document->id)); ?>" data-title="<?php echo e(_lang('Update Document')); ?>" class="dropdown-item dropdown-edit ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
                                                <button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;<?php echo e(_lang('Delete')); ?></button>
                                            </div>
                                        </form>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--End KYC Documents Tab-->

			<div id="email" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Send Email')); ?></span>
                    </div>

                    <div class="card-body">
                        <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('members.send_email')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo e(_lang('User Email')); ?></label>
                                        <input type="email" class="form-control" name="user_email" value="<?php echo e($member->email); ?>" required="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo e(_lang('Subject')); ?></label>
                                        <input type="text" class="form-control" name="subject" value="<?php echo e(old('subject')); ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo e(_lang('Message')); ?></label>
                                        <textarea class="form-control" rows="8" name="message" required><?php echo e(old('message')); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Send')); ?></button>
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
                        <span class="header-title"><?php echo e(_lang('Send SMS')); ?></span>
                    </div>

                    <div class="card-body">
                        <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('members.send_sms')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo e(_lang('User Mobile')); ?></label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo e($member->country_code.$member->mobile); ?>" required="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo e(_lang('Message')); ?></label>
                                        <textarea class="form-control" name="message" required><?php echo e(old('message')); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Send')); ?></button>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
(function ($) {
	"use strict";

	$('#transactions_table').DataTable({
		processing: true,
		serverSide: true,
		ajax: _tenant_url + '/members/get_member_transaction_data/<?php echo e($member->id); ?>',
		"columns" : [
			{ data : 'trans_date', name : 'trans_date' },
			{ data : 'member.first_name', name : 'member.first_name' },
			{ data : 'account.account_number', name : 'account.account_number' },
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
		   "emptyTable":     "<?php echo e(_lang('No Data Found')); ?>",
		   "info":           "<?php echo e(_lang('Showing')); ?> _START_ <?php echo e(_lang('to')); ?> _END_ <?php echo e(_lang('of')); ?> _TOTAL_ <?php echo e(_lang('Entries')); ?>",
		   "infoEmpty":      "<?php echo e(_lang('Showing 0 To 0 Of 0 Entries')); ?>",
		   "infoFiltered":   "(filtered from _MAX_ total entries)",
		   "infoPostFix":    "",
		   "thousands":      ",",
		   "lengthMenu":     "<?php echo e(_lang('Show')); ?> _MENU_ <?php echo e(_lang('Entries')); ?>",
		   "loadingRecords": "<?php echo e(_lang('Loading...')); ?>",
		   "processing":     "<?php echo e(_lang('Processing...')); ?>",
		   "search":         "<?php echo e(_lang('Search')); ?>",
		   "zeroRecords":    "<?php echo e(_lang('No matching records found')); ?>",
		   "paginate": {
			  "first":      "<?php echo e(_lang('First')); ?>",
			  "last":       "<?php echo e(_lang('Last')); ?>",
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
   		var url = "<?php echo e(route('members.show',$member->id)); ?>";
   	    history.pushState({}, null, url + "?tab=" + tab.substring(1));
   	});

   	<?php if(isset($_GET['tab'])): ?>
   	   $('.nav-tabs a[href="#<?php echo e($_GET['tab']); ?>"]').tab('show');
   	<?php endif; ?>

    $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });

})(jQuery);
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/member/view.blade.php ENDPATH**/ ?>