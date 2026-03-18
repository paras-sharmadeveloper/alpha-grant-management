<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-signin p-3 my-5">
                <div class="card-body">
					<img class="logo" src="<?php echo e(get_logo()); ?>">

                    <?php if(!$adminLogin): ?>
					<h5 class="text-center py-4"><?php echo e(_lang('LOGIN TO YOUR ACCOUNT')); ?></h4>
                    <?php else: ?>
                    <h5 class="text-center py-4"><?php echo e(_lang('ADMIN LOGIN')); ?></h4>
                    <?php endif; ?>

                    <?php if(Session::has('error')): ?>
                        <div class="alert alert-danger text-center">
                            <strong><?php echo e(session('error')); ?></strong>
                        </div>
                    <?php endif; ?>

                    <?php if(Session::has('success')): ?>
                        <div class="alert alert-success text-center">
                            <strong><?php echo e(session('success')); ?></strong>
                        </div>
                    <?php endif; ?>

					<?php if(Session::has('registration_success')): ?>
                        <div class="alert alert-success text-center">
                            <strong><?php echo e(session('registration_success')); ?></strong>
                        </div>
                    <?php endif; ?>

					<form method="POST" class="form-signin" action="<?php echo e($postUrl); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email', request()->email)); ?>" placeholder="<?php echo e(_lang('Email')); ?>" required autofocus autocomplete="username">

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
						    <div class="col-md-12">

								<input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="<?php echo e(_lang('Password')); ?>" required autocomplete="current-password">

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="hidden" name="g-recaptcha-response" id="recaptcha">
                                <?php if($errors->has('g-recaptcha-response')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

						<div class="text-center">
							<div class="custom-control custom-checkbox mb-3">
								<input type="checkbox" name="remember" class="custom-control-input" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
								<label class="custom-control-label" for="remember"><?php echo e(_lang('Remember Me')); ?></label>
							</div>
						</div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <?php echo e(_lang('Login')); ?>

                                </button>

                                <?php if(!$adminLogin && get_tenant_option('members_sign_up', 0, app('tenant')->id) == 1): ?>
                                    <a href="<?php echo e(route('tenant.members_signup')); ?>" class="btn btn-dark btn-block"><?php echo e(_lang('Member Sign Up')); ?></a>
                                <?php else: ?>
                                    <?php if(get_option('member_signup') == 1): ?>
                                        
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

						<div class="form-group row mt-3">
                            <div class="col-md-12">
								
							</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(get_option('enable_recaptcha', 0) == 1): ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_option('recaptcha_site_key')); ?>"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo e(get_option('recaptcha_site_key')); ?>', {action: 'login'}).then(function(token) {
        if (token) {
            document.getElementById('recaptcha').value = token;
        }
        });
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/auth/login.blade.php ENDPATH**/ ?>