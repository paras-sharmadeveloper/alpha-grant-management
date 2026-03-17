<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Create New Language')); ?></span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="<?php echo e(route('admin.languages.store')); ?>" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="row mb-4">
						<label class="col-sm-3 col-form-label form-label"><?php echo e(_lang('Language Name')); ?></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="language_name" value="<?php echo e(old('language_name')); ?>" required>
						</div>
					</div>

					<div class="row mb-4">
						<label class="col-sm-3 col-form-label form-label"><?php echo e(_lang('Country')); ?></label>
						<div class="col-sm-9">
							<?php echo $__env->make('backend.super_admin.administration.language.flag', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-xl-9 offset-xl-3">
							<button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Submit')); ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/administration/language/create.blade.php ENDPATH**/ ?>