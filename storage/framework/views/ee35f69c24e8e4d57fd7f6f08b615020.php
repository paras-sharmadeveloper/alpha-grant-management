<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-signin p-2 my-5">
                <div class="card-body">
					<img class="logo" src="<?php echo e(get_logo()); ?>">
					
					<h5 class="text-center py-4"><?php echo e(_lang('Select Tenant Account')); ?></h4> 
					
                    

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

					<ul class="list-group mb-4">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
                         <?php if($user->user_type == 'customer'): ?>
                             
                                <script>
                                    window.location.href = "<?php echo e(route('tenant.login', ['tenant' => $user->tenant->slug, 'email' => $user->email])); ?>";
                                </script>
                            <?php endif; ?>
                             <li class="list-group-item">
                                <a class="tenant-link d-block d-flex justify-content-between align-items-center" href="<?php echo e(route('tenant.login', ['tenant' => $user->tenant->slug, 'email' => $user->email])); ?>">     
                                    <span>
                                        <i class="fas fa-globe mr-2"></i>
                                        <?php echo e($user->tenant->name); ?>

                                    </span>
                                    <i class="fas fa-arrow-alt-circle-right"></i>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/auth/tenants.blade.php ENDPATH**/ ?>