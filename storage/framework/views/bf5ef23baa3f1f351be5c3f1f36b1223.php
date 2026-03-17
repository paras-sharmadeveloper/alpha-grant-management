<form method="post" class="ajax-submit" autocomplete="off" action="<?php echo e(route('savings_accounts.store')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<div class="row px-2">
	    <div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Account Number')); ?></label>						
				<input type="text" class="form-control" name="account_number" id="account_number" value="<?php echo e(old('account_number')); ?>" required readonly>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Member')); ?></label>						
				<select class="form-control select2" name="member_id" required>
					<option value=""><?php echo e(_lang('Select Member')); ?></option>
					<?php $__currentLoopData = \App\Models\Member::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($member->id); ?>"><?php echo e($member->first_name.' '.$member->last_name); ?> (<?php echo e($member->member_no); ?>)</option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Account Type')); ?></label>						
				<select class="form-control select2" name="savings_product_id" id="savings_product_id" required>
					<option value=""><?php echo e(_lang('Select One')); ?></option>
					<?php $__currentLoopData = App\Models\SavingsProduct::active()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($product->id); ?>" data-account-number="<?php echo e($product->account_number_prefix.$product->starting_account_number); ?>"><?php echo e($product->name); ?> (<?php echo e($product->currency->name); ?>)</option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Status')); ?></label>						
				<select class="form-control auto-select" data-selected="<?php echo e(old('status',1)); ?>" name="status" required>
					<option value="1"><?php echo e(_lang('Active')); ?></option>
					<option value="0"><?php echo e(_lang('Deactivate')); ?></option>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Opening Balance')); ?></label>						
				<input type="text" class="form-control float-field" name="opening_balance" value="<?php echo e(old('opening_balance')); ?>" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Description')); ?></label>						
				<textarea class="form-control" name="description"><?php echo e(old('description')); ?></textarea>
			</div>
		</div>

		<div class="col-md-12 mt-2">
		    <div class="form-group">
			    <button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Submit')); ?></button>
		    </div>
		</div>
	</div>
</form>

<script>
(function ($) {
	$(document).on('change','#savings_product_id',function(){
		if($(this).val() != ''){
			var accountNumber = $(this).find(':selected').data('account-number');
			accountNumber != '' ? $("#account_number").val(accountNumber) : 

			Swal.fire({
				text: "<?php echo e(_lang('Please set starting account number to your selected account type before creating new account!')); ?>",
				icon: "error",
				confirmButtonColor: "#e74c3c",
				confirmButtonText: "<?php echo e(_lang('Close')); ?>",
			});
		}else{
			$("#account_number").val('');
		}
	});
})(jQuery);
</script>
<?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/savings_accounts/modal/create.blade.php ENDPATH**/ ?>