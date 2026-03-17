<form method="post" class="ajax-submit" autocomplete="off" action="<?php echo e(route('savings_products.store')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<div class="row px-2">
	    <div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Name')); ?></label>						
				<input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Account Number Prefix')); ?></label>						
				<input type="text" class="form-control" name="account_number_prefix" value="<?php echo e(old('account_number_prefix')); ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Starting Account Number')); ?></label>						
				<input type="number" class="form-control" name="starting_account_number" value="<?php echo e(old('starting_account_number')); ?>" required>
			</div>
		</div>

		<div class="col-md-6">
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

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Yearly Interest Rate')); ?> (%)</label>						
				<input type="text" class="form-control float-field" name="interest_rate" value="<?php echo e(old('interest_rate')); ?>" >
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Interest Period')); ?></label>						
				<select class="form-control auto-select" data-selected="<?php echo e(old('interest_period')); ?>" name="interest_period" >
					<option value=""><?php echo e(_lang('Select One')); ?></option>
					<option value="1"><?php echo e(_lang('Every 1 month')); ?></option>
					<option value="3"><?php echo e(_lang('Every 3 months')); ?></option>
					<option value="6"><?php echo e(_lang('Every 6 months')); ?></option>
					<option value="12"><?php echo e(_lang('Every 12 months')); ?></option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Interest Method')); ?></label>						
				<select class="form-control" name="interest_method" >
					<option value="daily_outstanding_balance"><?php echo e(_lang('Daily Outstanding Balance')); ?></option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Minimum Balance for Interest')); ?></label>						
				<input type="number" class="form-control" name="min_bal_interest_rate" value="<?php echo e(old('min_bal_interest_rate')); ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Allow Withdraw')); ?></label>						
				<select class="form-control auto-select" data-selected="<?php echo e(old('allow_withdraw', 1)); ?>" name="allow_withdraw"  required>
					<option value=""><?php echo e(_lang('Select One')); ?></option>
					<option value="1"><?php echo e(_lang('Yes')); ?></option>
					<option value="0"><?php echo e(_lang('No')); ?></option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Minimum Deposit Amount')); ?></label>						
				<input type="number" class="form-control" name="minimum_deposit_amount" value="<?php echo e(old('minimum_deposit_amount', 0)); ?>" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Minimum Account Balance')); ?></label>						
				<input type="number" class="form-control" name="minimum_account_balance" value="<?php echo e(old('minimum_account_balance', 0)); ?>" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Maintenance Fee')); ?></label>						
				<input type="number" class="form-control" name="maintenance_fee" value="<?php echo e(old('maintenance_fee', 0)); ?>" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Maintenance Fee will be deduct')); ?></label>						
				<select class="form-control auto-select" data-selected="<?php echo e(old('maintenance_fee_posting_period')); ?>" name="maintenance_fee_posting_period" >
					<option value=""><?php echo e(_lang('Select One')); ?></option>
					<?php for($f=1; $f< 13; $f++): ?>
						<option value="<?php echo e($f); ?>"><?php echo e(date('F', strtotime('2022-'.$f.'-01'))); ?></option>
					<?php endfor; ?>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Auto Create After Signup')); ?></label>						
				<select class="form-control auto-select" data-selected="<?php echo e(old('auto_create', 0)); ?>" name="auto_create" required>
					<option value="0"><?php echo e(_lang('No')); ?></option>
					<option value="1"><?php echo e(_lang('Yes')); ?></option>
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
	
		<div class="col-md-12 mt-2">
		    <div class="form-group">
			    <button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Submit')); ?></button>
		    </div>
		</div>
	</div>
</form>
<?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/savings_product/modal/create.blade.php ENDPATH**/ ?>