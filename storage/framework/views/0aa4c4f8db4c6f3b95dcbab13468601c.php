<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xl-4 col-lg-6 offset-xl-4 offset-lg-3">
		<div class="card">
			<div class="card-header panel-title text-center">
				<?php if(isset($qrCodeUrl)): ?>
				<?php echo e(_lang('Enable 2FA Authentication')); ?>

                <?php else: ?>
                <?php echo e(_lang('Disable 2FA Authentication')); ?>

                <?php endif; ?>
			</div>

			<div class="card-body text-center">
                <?php if(isset($qrCodeUrl)): ?>
                    <p class="mb-4"><strong><?php echo e(_lang('Scan the QR code bellow with the google authenticator application')); ?></strong></p>
                    <?php echo QrCode::size(250)->generate($qrCodeUrl); ?>

                <?php else: ?>
                    <p class="mb-4"><strong><?php echo e(_lang('Enter the 2FA code from your authenticator app')); ?></strong></p>
                <?php endif; ?>
                <form method="POST" class="validate mt-4" action="<?php echo e($actionUrl); ?>" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" class="form-control<?php echo e($errors->has('one_time_password') ? ' is-invalid' : ''); ?>" name="one_time_password" value="<?php echo e(old('one_time_password')); ?>" placeholder="<?php echo e(_lang('One Time Password')); ?>" required autofocus>

                            <?php if($errors->has('one_time_password')): ?>
                                <span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('one_time_password')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                <?php echo e(_lang('CONTINUE')); ?>

                            </button>						
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/profile/manage_2fa.blade.php ENDPATH**/ ?>