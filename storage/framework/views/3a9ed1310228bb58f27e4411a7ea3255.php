<form method="post" class="ajax-submit" autocomplete="off" action="<?php echo e(route('branches.store')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
    <div class="row px-2">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Branch Name')); ?> <span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="name" id="modal_branch_name" value="<?php echo e(old('name')); ?>" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Branch Code')); ?></label>
				<input type="text" class="form-control" name="branch_code" id="modal_branch_code" placeholder="<?php echo e(_lang('Enter branch code')); ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('State')); ?></label>
				<input type="text" class="form-control" name="state" value="<?php echo e(old('state')); ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Branch Manager')); ?></label>
				<select class="form-control" name="branch_manager_id">
					<option value=""><?php echo e(_lang('Select Manager')); ?></option>
					<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
						<option value="<?php echo e($manager->id); ?>"><?php echo e($manager->name); ?></option>
					<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Contact Email')); ?></label>
				<input type="text" class="form-control" name="contact_email" value="<?php echo e(old('contact_email')); ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Contact Phone')); ?></label>
				<input type="text" class="form-control" name="contact_phone" value="<?php echo e(old('contact_phone')); ?>">
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Address')); ?></label>
				<textarea class="form-control" name="address"><?php echo e(old('address')); ?></textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Descriptions')); ?></label>
				<textarea class="form-control" name="descriptions"><?php echo e(old('descriptions')); ?></textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Save')); ?></button>
			</div>
		</div>
	</div>
</form>

<script>
</script>
<?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/branch/modal/create.blade.php ENDPATH**/ ?>