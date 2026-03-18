<form method="post" class="ajax-submit" autocomplete="off" action="<?php echo e(route('custom_fields.store')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>

    <div class="row px-2">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Field Name')); ?></label>
				<input type="text" class="form-control" name="field_name" value="<?php echo e(old('field_name')); ?>" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Field Type')); ?></label>
				<select class="form-control" name="field_type" required>
					<option value="text"><?php echo e(_lang('Text Box')); ?></option>
					<option value="number"><?php echo e(_lang('Number')); ?></option>
					<option value="select"><?php echo e(_lang('Select Box')); ?></option>
					<option value="textarea"><?php echo e(_lang('Textarea')); ?></option>
					<option value="file"><?php echo e(_lang('File (PNG,JPG,PDF)')); ?></option>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Select Options')); ?></label>
				<input type="text" class="form-control" name="default_value" value="<?php echo e(old('default_value')); ?>">
				<small class="text-info"><i class="fas fa-info-circle"></i> <?php echo e(_lang("Add select box options by comma seperator")); ?></small>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Field Size')); ?></label>
				<select class="form-control" name="field_width" required>
					<option value="col-lg-6">50%</option>
					<option value="col-lg-12">100%</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Max File Size')); ?> (<?php echo e(_lang('MB')); ?>)</label>
				<input type="number" class="form-control" name="max_size" value="<?php echo e(old('max_size', 2)); ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Is Required')); ?></label>						
				<select class="form-control" name="is_required" required>
					<option value="required"><?php echo e(_lang('Yes')); ?></option>
					<option value="nullable"><?php echo e(_lang('No')); ?></option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Status')); ?></label>						
				<select class="form-control" name="status" required>
					<option value="1"><?php echo e(_lang('Active')); ?></option>
					<option value="0"><?php echo e(_lang('Deactivate')); ?></option>
				</select>
			</div>
		</div>
		<input type="hidden" name="table" value="<?php echo e($_GET['table']); ?>">

		<div class="col-md-12">
			<div class="form-group">
				<button type="submit" class="btn btn-primary "><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Save')); ?></button>
			</div>
		</div>
	</div>
</form><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/custom_field/modal/create.blade.php ENDPATH**/ ?>