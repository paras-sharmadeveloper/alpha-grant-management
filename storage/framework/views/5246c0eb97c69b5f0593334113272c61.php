<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title text-center"><?php echo e(_lang('Manual Deposit Methods')); ?></h4>
			</div>
			<div class="card-body">
                <div class="row justify-content-md-center">
                    <?php $__currentLoopData = $deposit_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="<?php echo e(asset('public/uploads/media/'.$deposit_method->image)); ?>" class="thumb-xl m-auto rounded-circle img-thumbnail"/>
                                <h5 class="mt-3"><b><?php echo e($deposit_method->name); ?></b></h5>
                                <a href="<?php echo e(route('deposit.manual_deposit',$deposit_method->id)); ?>" class="btn btn-light mt-3 stretched-link"><?php echo e(_lang('Deposit Now')); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
			</div>
		</div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/customer/deposit/manual_methods.blade.php ENDPATH**/ ?>