<?php $__env->startSection('content'); ?>
<?php $type = isset($_GET['type']) ? $_GET['type'] : ''; ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<?php if($type != ''): ?>
				<span class="header-title"><?php echo e($type == 'deposit' ? _lang('Deposit Money') : _lang('Withdraw Money')); ?></span>
				<?php else: ?>
				<span class="header-title"><?php echo e(_lang('New Transaction')); ?></span>
				<?php endif; ?>
			</div>
			<div class="card-body">
			    <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('transactions.store')); ?>" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Date')); ?></label>
								<div class="col-xl-9">
									<input type="text" class="form-control datetimepicker" name="trans_date" value="<?php echo e(old('trans_date', now())); ?>"
										required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Member')); ?></label>
								<div class="col-xl-9">
									<select class="form-control auto-select select2" data-selected="<?php echo e(old('member_id')); ?>" name="member_id" id="member_id" required>
										<option value=""><?php echo e(_lang('Select One')); ?></option>
										<?php $__currentLoopData = \App\Models\Member::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($member->id); ?>"><?php echo e($member->first_name.' '.$member->last_name); ?> (<?php echo e($member->member_no); ?>)</option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Account Number')); ?></label>
								<div class="col-xl-9">
									<select class="form-control select2 auto-select" data-selected="<?php echo e(old('savings_account_id')); ?>" name="savings_account_id" id="savings_account_id" required>
						               <?php if(old('member_id') != ''): ?>
									   		<?php $__currentLoopData = \App\Models\SavingsAccount::where('member_id', old('member_id'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($account->id); ?>"><?php echo e($account->account_number); ?> (<?php echo e($account->savings_type->name.' - '.$account->savings_type->currency->name); ?>)</option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									   <?php endif; ?>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Current Balance')); ?></label>
								<div class="col-xl-9">
									<input type="text" class="form-control" id="current_balance" readonly>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Amount')); ?></label>
								<div class="col-xl-9">
									<input type="text" class="form-control float-field" name="amount" value="<?php echo e(old('amount')); ?>" required>
								</div>
							</div>

							<?php if($type == ''): ?>
							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Debit/Credit')); ?></label>
								<div class="col-xl-9">
									<select class="form-control" name="dr_cr" id="dr_cr" required>
										<option value=""><?php echo e(_lang('Select One')); ?></option>
										<option value="dr"><?php echo e(_lang('Debit')); ?></option>
										<option value="cr"><?php echo e(_lang('Credit')); ?></option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Transaction Types')); ?></label>
								<div class="col-xl-9">
									<select class="form-control select2" name="type" id="transaction_type" required>
										<option value=""><?php echo e(_lang('Select One')); ?></option>
									</select>
								</div>
							</div>
							<?php else: ?>
							<input type="hidden" name="dr_cr" value="<?php echo e($type == 'deposit' ? 'cr' : 'dr'); ?>">
							<input type="hidden" name="type" value="<?php echo e($type); ?>">
							<?php endif; ?>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Status')); ?></label>
								<div class="col-xl-9">
									<select class="form-control auto-select" data-selected="<?php echo e(old('status', 2)); ?>" name="status" required>
										<option value=""><?php echo e(_lang('Select One')); ?></option>
										<option value="0"><?php echo e(_lang('Pending')); ?></option>
										<option value="1"><?php echo e(_lang('Cancelled')); ?></option>
										<option value="2"><?php echo e(_lang('Completed')); ?></option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Description')); ?></label>
								<div class="col-xl-9">
									<textarea class="form-control" name="description" required><?php echo e(old('description')); ?></textarea>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-xl-9 offset-xl-3">
									<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Submit')); ?></button>
								</div>
							</div>
						</div>

						<div class="col-lg-4 d-none d-lg-block">
							<div class="border">
								<h5 class="text-center py-3"><?php echo e(_lang('Account Owner Details')); ?></h5>
								<table class="table">
									<tr>
										<td colspan="2" class="text-center">
											<img id="account_avatar" class="thumb-contact" src="<?php echo e(asset('public/uploads/profile/default.png')); ?>">
										</td>
									</tr>
									<tr>
										<td class="pl-3"><?php echo e(_lang('Name')); ?></td>
										<td class="pr-3"><span id="account_owner"></span></td>
									</tr>
									<tr>
										<td class="pl-3"><?php echo e(_lang('Email')); ?></td>
										<td class="pr-3"><span id="account_email"></span></td>
									</tr>
									<tr>
										<td class="pl-3"><?php echo e(_lang('Mobile')); ?></td>
										<td class="pr-3"><span id="account_mobile"></span></td>
									</tr>
									<tr>
										<td class="pl-3"><?php echo e(_lang('Address')); ?></td>
										<td class="pr-3"><span id="account_address"></span></td>
									</tr>
								</table>				
							</div>					
						</div>
					</div>
			    </form>
			</div>
		</div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
(function ($) {
	'use strict';

	$(document).on('change','#member_id',function(){
		var member_id = $(this).val();
		if(member_id != ''){
			$.ajax({
				url: _tenant_url + '/savings_accounts/get_account_by_member_id/' + member_id,
				success: function(data){
					var json = JSON.parse(JSON.stringify(data));
					$("#savings_account_id").html('');
					$.each(json['accounts'], function(i, account) {
						$("#savings_account_id").append(`<option data-balance="${account.balance - account.blocked_amount}" value="${account.id}">${account.account_number} (${account.savings_type.name} - ${account.savings_type.currency.name})</option>`);
					});

					$("#current_balance").val(json['accounts'][0].savings_type.currency.name + ' ' + (json['accounts'][0].balance - json['accounts'][0].blocked_amount));
					
					if(json['accounts'][0].member['photo'] != null){
						$("#account_avatar").attr('src', '/public/uploads/profile/' + json['accounts'][0].member['photo']);
					}else{
						$("#account_avatar").attr('src', '/public/uploads/profile/default.png');
					}

					$("#account_owner").html(json['accounts'][0].member['first_name'] + ' ' + json['accounts'][0].member['last_name']);
					$("#account_email").html(json['accounts'][0].member['email']);
					$("#account_mobile").html(json['accounts'][0].member['mobile']);
					$("#account_address").html(json['accounts'][0].member['address']);

				}
			});
		}
	});

	$(document).on('change','#savings_account_id',function(){
		var balance = $(this).find(':selected').data('balance');
		$("#current_balance").val(balance);
	});

	$(document).on('change','#dr_cr',function(){
		var dr_cr = $(this).val();
		if(dr_cr != ''){
			$.ajax({
				url: _tenant_url + '/transaction_categories/get_category_by_type/' + dr_cr,
				success: function(data){
					var json = JSON.parse(JSON.stringify(data));
					$("#transaction_type").html('');
					$.each(json, function(i, category) {
						$("#transaction_type").append(`<option value="${category.value}">${category.name}</option>`);
					});

				}
			});
		}
	});

})(jQuery);
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/transaction/create.blade.php ENDPATH**/ ?>