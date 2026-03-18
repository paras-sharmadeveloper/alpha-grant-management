<?php $__env->startSection('content'); ?>
<div class="auth-container d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="card card-signin my-5 p-3">

                            <div class="card-body">
                                
                                <img class="logo" src="<?php echo e(get_logo()); ?>">
                                    
                                <h5 class="pt-4 pb-2 text-center"><b><?php echo e(_lang('Verify Your Email Address')); ?></b></h5> 
                                
                                <?php if(session('resent')): ?>
                                    <div class="alert alert-success text-center" role="alert">
                                        <?php echo e(_lang('A fresh verification link has been sent to your email address.')); ?>

                                    </div>
                                <?php endif; ?>

                                <p class="text-center"><?php echo e(_lang('Before proceeding, please check your email for a verification link.')); ?></p>
                                <form class="d-block mt-5 text-center" method="POST" action="<?php echo e(route('verification.resend')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <p><?php echo e(_lang('If you did not receive the email')); ?></p>
                                    <button type="submit" class="btn btn-primary"><?php echo e(_lang('Click here to request another')); ?></button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/auth/verify.blade.php ENDPATH**/ ?>