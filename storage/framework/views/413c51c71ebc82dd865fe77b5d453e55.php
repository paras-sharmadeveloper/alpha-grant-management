

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-6 offset-lg-3">
		<div class="card">
			<div class="card-header panel-title text-center">
				<?php echo e(_lang('Change Password')); ?>

			</div>

			<div class="card-body">
				<?php $isAadminRoute = auth()->user()->user_type == 'superadmin' ? 'admin.' : ''; ?>
				<form action="<?php echo e(route($isAadminRoute.'profile.update_password')); ?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Old Password')); ?></label>
								<input type="password" class="form-control" name="oldpassword" required>
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('New Password')); ?></label>
								<input type="password" class="form-control" name="password" required>
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Confirm Password')); ?></label>
								<input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Update Password')); ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/profile/change_password.blade.php ENDPATH**/ ?>