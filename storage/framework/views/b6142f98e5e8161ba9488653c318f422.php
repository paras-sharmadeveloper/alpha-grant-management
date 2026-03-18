<form method="post" class="ajax-submit" autocomplete="off" action="<?php echo e(route('savings_accounts.update', $id)); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<input name="_method" type="hidden" value="PATCH">
	<div class="row px-2">
		<div class="col-md-12">
			<div class="form-group">
			<label class="control-label"><?php echo e(_lang('Account Number')); ?></label>						
			<input type="text" class="form-control" name="account_number" value="<?php echo e($savingsaccount->account_number); ?>" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Member')); ?></label>						
				<select class="form-control select2 auto-select" name="member_id" data-selected="<?php echo e($savingsaccount->member_id); ?>" required>
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
				<select class="form-control select2 auto-select" data-selected="<?php echo e($savingsaccount->savings_product_id); ?>" name="savings_product_id" required>
					<option value=""><?php echo e(_lang('Select One')); ?></option>
					<?php $__currentLoopData = App\Models\SavingsProduct::active()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> (<?php echo e($product->currency->name); ?>)</option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Status')); ?></label>						
				<select class="form-control auto-select" data-selected="<?php echo e($savingsaccount->status); ?>" name="status" required>
					<option value="1"><?php echo e(_lang('Active')); ?></option>
					<option value="0"><?php echo e(_lang('Deactivate')); ?></option>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Opening Balance')); ?></label>						
				<input type="text" class="form-control float-field" name="opening_balance" value="<?php echo e($savingsaccount->opening_balance); ?>" readonly>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
			<label class="control-label"><?php echo e(_lang('Description')); ?></label>						
			<textarea class="form-control" name="description"><?php echo e($savingsaccount->description); ?></textarea>
			</div>
		</div>

		<div class="col-md-12 mt-2">
			<div class="form-group">
			    <button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Update')); ?></button>
		    </div>
		</div>
	</div>
</form>

<?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/savings_accounts/modal/edit.blade.php ENDPATH**/ ?>