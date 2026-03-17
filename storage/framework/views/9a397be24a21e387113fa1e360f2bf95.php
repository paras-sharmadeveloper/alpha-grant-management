<?php $__env->startSection('content'); ?>
<div id="pricing-table">
    <div class="row gx-5 justify-content-center"> 
        <div class="col-lg-12 d-flex justify-content-center">
            <div class="form-check form-switch custom-switch mb-5 me-3">
                <input class="form-check-input plan_type" type="radio" value="monthly" name="plan_type" id="monthy-plans" checked>
                <label class="form-check-label ms-1 text-primary" for="monthy-plans"><b><?php echo e(_lang('Monthly')); ?></b></label>
            </div>

            <div class="form-check form-switch custom-switch mb-5 me-3">
                <input class="form-check-input plan_type" type="radio" value="yearly" name="plan_type" id="yearly-plans">
                <label class="form-check-label ms-1 text-primary" for="yearly-plans"><b><?php echo e(_lang('Yearly')); ?></b></label>
            </div>

            <div class="form-check form-switch custom-switch mb-5">
                <input class="form-check-input plan_type" type="radio" value="lifetime" name="plan_type" id="lifetime-plans">
                <label class="form-check-label ms-1 text-primary" for="lifetime-plans"><b><?php echo e(_lang('Lifetime')); ?></b></label>
            </div>
        </div>       

        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 mb-5 <?php echo e($package->package_type); ?>-plan">
            <div class="pricing-plan popular h-100">
                <div class="pricing-plan-header">
                    <?php if($package->is_popular == 1): ?>
                    <span><?php echo e(_lang('Most popular')); ?></span>
                    <?php endif; ?>
                    <h5><?php echo e($package->name); ?></h5>
                    <?php if($package->discount > 0): ?>
                    <p class="d-inline-block mb-4">
                        <small><del><?php echo e(decimalPlace($package->cost, currency_symbol())); ?></del></small>
                        <span class="bg-info d-inline-block text-white px-3 py-1 rounded-pill ms-1"><?php echo e($package->discount.'% '._lang('Discount')); ?></span>
                    </p>
                    <h4><span><?php echo e(decimalPlace($package->cost - ($package->discount / 100) * $package->cost, currency_symbol())); ?></span> / <?php echo e(ucwords($package->package_type)); ?></h4>
                    <?php else: ?>
                    <h4><span><?php echo e(decimalPlace($package->cost, currency_symbol())); ?></span> / <?php echo e(ucwords($package->package_type)); ?></h4>
                    <?php endif; ?>

                    <?php if($package->trial_days > 0): ?>
                    <h6 class="mt-2 text-danger"><?php echo e($package->trial_days.' '._lang('Days Free Trial')); ?></h6>
                    <?php else: ?>
                    <h6 class="mt-2 text-dark"><?php echo e(_lang('No Trial Available')); ?></h6>
                    <?php endif; ?>
                </div>
                <div class="pricing-plan-body">
                    <ul>
                        <li><i class="fas fa-check-circle text-success mr-2"></i><?php echo e(str_replace('-1',_lang('Unlimited'), $package->user_limit).' '._lang('Role Based User')); ?></li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i><?php echo e(str_replace('-1',_lang('Unlimited'), $package->member_limit).' '._lang('Member')); ?></li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i><?php echo e(str_replace('-1',_lang('Unlimited'), $package->branch_limit).' '._lang('Additional Branch')); ?></li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i><?php echo e(str_replace('-1',_lang('Unlimited'), $package->account_type_limit).' '._lang('Account Type')); ?></li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i><?php echo e(str_replace('-1',_lang('Unlimited'), $package->account_limit).' '._lang('Account')); ?></li>
                        <li><i class="<?php echo e($package->member_portal == 0 ? 'fas fa-times-circle text-danger' : 'fas fa-check-circle text-success'); ?> mr-2"></i><?php echo e(_lang('Member Portal')); ?></li>
                    </ul>
                    <form action="<?php echo e(route('membership.choose_package')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="package_id" value="<?php echo e($package->id); ?>">
                        <button type="submit" class="btn btn-primary btn-block mt-4"><?php echo e(_lang('Select Package')); ?></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/membership/packages.blade.php ENDPATH**/ ?>