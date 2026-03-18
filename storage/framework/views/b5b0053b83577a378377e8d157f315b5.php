<form method="post" class="ajax-submit" autocomplete="off" action="<?php echo e(route('bank_accounts.store')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<div class="row px-2">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Opening Date')); ?></label>						
				<input type="text" class="form-control datepicker" name="opening_date" value="<?php echo e(old('opening_date', now())); ?>" required>
			</div>
		</div>

	    <div class="col-lg-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Bank Name')); ?></label>						
				<input type="text" class="form-control" name="bank_name" value="<?php echo e(old('bank_name')); ?>" required>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Account Name')); ?></label>						
				<input type="text" class="form-control" name="account_name" value="<?php echo e(old('account_name')); ?>" required>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Account Number')); ?></label>						
				<input type="text" class="form-control" name="account_number" value="<?php echo e(old('account_number')); ?>" required>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Currency')); ?></label>						
				<select class="form-control select2 auto-select" data-selected="<?php echo e(old('currency_id')); ?>" name="currency_id" required>
					<option value=""><?php echo e(_lang('Select One')); ?></option>
					<?php $__currentLoopData = \App\Models\Currency::where('status', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($currency->id); ?>"><?php echo e($currency->full_name); ?> (<?php echo e($currency->name); ?>)</option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Opening Balance')); ?></label>						
				<input type="text" class="form-control float-field" name="opening_balance" value="<?php echo e(old('opening_balance')); ?>" required>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Description')); ?></label>						
				<textarea class="form-control" name="description"><?php echo e(old('description')); ?></textarea>
			</div>
		</div>

		<div class="col-lg-12 mt-2">
		    <div class="form-group">
			    <button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i> <?php echo e(_lang('Save')); ?></button>
		    </div>
		</div>
	</div>
</form>
<?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/bank_account/modal/create.blade.php ENDPATH**/ ?>