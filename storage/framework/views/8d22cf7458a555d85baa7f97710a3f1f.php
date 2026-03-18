<form method="post" class="ajax-screen-submit" autocomplete="off" action="<?php echo e(route('currency.update', $id)); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<input name="_method" type="hidden" value="PATCH">
	<div class="row px-2">
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Full Name')); ?></label>						
				<input type="text" class="form-control" name="full_name" value="<?php echo e($currency->full_name); ?>" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Code')); ?></label>						
				<input type="text" class="form-control" name="name" value="<?php echo e($currency->full_name); ?> (<?php echo e($currency->name); ?>)" placeholder="USD" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Exchange Rate')); ?></label>						
				<input type="text" class="form-control float-field" name="exchange_rate" value="<?php echo e($currency->exchange_rate); ?>" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Base Currency')); ?></label>						
				<select class="form-control auto-select" data-selected="<?php echo e($currency->base_currency); ?>" name="base_currency"  required>
					<option value=""><?php echo e(_lang('Select One')); ?></option>
					<option value="0"><?php echo e(_lang('No')); ?></option>
					<option value="1"><?php echo e(_lang('Yes')); ?></option>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Status')); ?></label>						
				<select class="form-control auto-select" data-selected="<?php echo e($currency->status); ?>" name="status"  required>
					<option value=""><?php echo e(_lang('Select One')); ?></option>
					<option value="1"><?php echo e(_lang('Active')); ?></option>
					<option value="0"><?php echo e(_lang('Deactivate')); ?></option>
				</select>
			</div>
		</div>

		<div class="col-md-12 mt-2">
			<div class="form-group">
			    <button type="submit" class="btn btn-primary "><i class="ti-check-box mr-2"></i><?php echo e(_lang('Update')); ?></button>
		    </div>
		</div>
	</div>
</form>

<?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/currency/modal/edit.blade.php ENDPATH**/ ?>