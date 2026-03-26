<form method="post" class="ajax-submit" autocomplete="off" action="<?php echo e(route('branches.update', $id)); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<input name="_method" type="hidden" value="PATCH">

	<div class="row px-2">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Branch Name')); ?> <span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="name" id="modal_edit_branch_name" value="<?php echo e($branch->name); ?>" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Branch Code')); ?></label>
				<input type="text" class="form-control bg-light" name="branch_code" id="modal_edit_branch_code" value="<?php echo e($branch->branch_code); ?>" readonly>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('State')); ?></label>
				<input type="text" class="form-control" name="state" value="<?php echo e($branch->state); ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Branch Manager')); ?></label>
				<select class="form-control" name="branch_manager_id">
					<option value=""><?php echo e(_lang('Select Manager')); ?></option>
					<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
						<option value="<?php echo e($manager->id); ?>" <?php echo e($branch->branch_manager_id == $manager->id ? 'selected' : ''); ?>><?php echo e($manager->name); ?></option>
					<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Contact Email')); ?></label>
				<input type="text" class="form-control" name="contact_email" value="<?php echo e($branch->contact_email); ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Contact Phone')); ?></label>
				<input type="text" class="form-control" name="contact_phone" value="<?php echo e($branch->contact_phone); ?>">
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Address')); ?></label>
				<textarea class="form-control" name="address"><?php echo e($branch->address); ?></textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Descriptions')); ?></label>
				<textarea class="form-control" name="descriptions"><?php echo e($branch->descriptions); ?></textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Update')); ?></button>
			</div>
		</div>
	</div>
</form>

<script>
var modalOriginalName = '<?php echo e($branch->name); ?>';
$('#modal_edit_branch_name').on('input', function() {
    var name = $(this).val().trim();
    if (name === modalOriginalName || name.length === 0) return;
    $.get('<?php echo e(route('branches.generate_code')); ?>', { name: name }, function(res) {
        $('#modal_edit_branch_code').val(res.code);
    });
});
</script>
<?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/branch/modal/edit.blade.php ENDPATH**/ ?>