<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card card-signin my-5 p-3">              
				<div class="card-body">
				    <img class="logo" src="<?php echo e(get_logo()); ?>">
					
					<h5 class="text-center py-4"><?php echo e(_lang('Create Your Account')); ?></h4> 

                    <?php if(Session::has('error')): ?>
                        <div class="alert alert-danger">
                            <span><?php echo e(session('error')); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(Session::has('success')): ?>
                        <div class="alert alert-success mb-4">
                            <span><?php echo e(session('success')); ?></span>
                        </div>
                    <?php endif; ?>	
					
                    <form method="POST" class="form-signup" autocomplete="off" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
							<div class="col-lg-12">
                                <input id="name" type="text" placeholder="<?php echo e(_lang('Name')); ?>" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">				
                            <div class="col-lg-12">
                                <div class="form-control py-0 pr-0 d-flex align-items-center parent-box">
                                    <span class="text-nowrap"><?php echo e(parse_url(url(''), PHP_URL_HOST).'/'); ?></span>
                                    <input type="text" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="workspace" value="<?php echo e(old('workspace', request()->workspace)); ?>" required>
                                    <div id="icon-box" class="mr-2"></div>
                                </div>
                                <?php if($errors->has('workspace')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('workspace')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
				
						<div class="form-group row">
                            <div class="col-lg-12">
                                <input id="email" type="email" placeholder="<?php echo e(_lang('E-Mail Address')); ?>" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 mb-3 mb-lg-0">
                                <select class="form-control<?php echo e($errors->has('country_code') ? ' is-invalid' : ''); ?> select2" name="country_code" required>
                                    <option value=""><?php echo e(_lang('Country Code')); ?></option>
                                    <?php $__currentLoopData = get_country_codes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value['dial_code']); ?>" <?php echo e(old('country_code') == $value['dial_code'] ? 'selected' : ''); ?>><?php echo e($value['country'].' (+'.$value['dial_code'].')'); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('country_code')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('country_code')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-lg-6">
                                <input id="mobile" type="text" placeholder="<?php echo e(_lang('Mobile')); ?>" class="form-control<?php echo e($errors->has('mobile') ? ' is-invalid' : ''); ?>" name="mobile" value="<?php echo e(old('mobile')); ?>" required>

                                <?php if($errors->has('mobile')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('mobile')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 mb-3 mb-lg-0">
                                <input id="password" type="password" placeholder="<?php echo e(_lang('Password')); ?>" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required autocomplete="new-password">
                            </div>

                            <div class="col-lg-6">
                                <input id="password-confirm" type="password" class="form-control" placeholder="<?php echo e(_lang('Confirm Password')); ?>" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <?php if($errors->has('password')): ?>
                            <div class="col-12 mt-2">
                                <span class="text-danger">
                                    <span><?php echo e($errors->first('password')); ?></span>
                                </span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="hidden" class="<?php echo e($errors->has('g-recaptcha-response') ? ' is-invalid' : ''); ?>" name="g-recaptcha-response" id="recaptcha">
                                <?php if($errors->has('g-recaptcha-response')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if(request()->package_id): ?>
                        <input type="hidden" name="package_id" value="<?php echo e(request()->package_id); ?>">
                        <?php endif; ?>
						
						<div class="form-group row">
							<div class="col-lg-12 text-center">
								<button type="submit" class="btn btn-primary btn-block btn-login">
								<?php echo e(_lang('Create My Account')); ?>

                                </button>
							</div>
						</div>

                        <div class="form-group row mt-3">
							<div class="col-lg-12 text-center">
                               <a href="<?php echo e(route('login')); ?>"><?php echo e(_lang('Log In to your account')); ?></a>
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
        grecaptcha.execute('<?php echo e(get_option('recaptcha_site_key')); ?>', {action: 'register'}).then(function(token) {
        if (token) {
            document.getElementById('recaptcha').value = token;
        }
        });
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
(function ($) {
    "use strict";

    let timer = null;

    $('input[name="workspace"]').on('keyup', function(){
        clearTimeout(timer);
        var workspace = $(this).val().trim();
        var $inputField = $(this);

        if (workspace.length > 0) {
            timer = setTimeout(function() {
                $.ajax({
                    url: "<?php echo e(route('check-slug')); ?>",
                    method: "GET",
                    data: { workspace: workspace },
                    success: function(response) {
                        if (response.exists) {
                            $inputField.parent().css("border", "1px solid #dc3545");
                            $inputField.parent().next('.success-msg').remove();

                            $("#icon-box").html(`<i class="fas fa-exclamation-circle text-danger"></i>`);

                            if (!$inputField.parent().next('.error-msg').length) {
                                $inputField.parent().after(`<small class="text-danger error-msg"><i class="fas fa-exclamation-circle mr-1"></i>${response.message}</small>`);
                            }else{
                                $inputField.parent().next('.error-msg').html(`<i class="fas fa-exclamation-circle mr-1"></i>${response.message}`);
                            }
                        } else {
                            $inputField.parent().css("border", "1px solid #4f39f6");
                            $("#icon-box").html(`<i class="fas fa-check-circle text-success"></i>`);
                            $inputField.parent().next('.error-msg').remove();
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = errors ? Object.values(errors).join('<br>') : 'Invalid input!';

                            $inputField.parent().css("border", "1px solid #dc3545");
                            $inputField.parent().next('.success-msg').remove();
                            $inputField.parent().next('.error-msg').remove();
                            
                            $inputField.parent().after(`<small class="text-danger error-msg"><i class="fas fa-exclamation-circle mr-1"></i> ${errorMessage}</small>`);
                        }
                    }
                });
            }, 500);
        } else {
            $inputField.parent().css("border", "");
            $inputField.parent().next('.error-msg').remove();
        }
    });
})(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/auth/register.blade.php ENDPATH**/ ?>