<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="<?php echo e($alert_col); ?>">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Available Loan Products')); ?></span>
			</div>
			<div class="card-body">
                <div class="row justify-content-center">
				    <?php $__currentLoopData = $loanProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-2">
                        <div class="card primary-border-top-4">
                            <div class="card-body py-4">
                                <h5 class="card-title text-center mb-4 text-primary"><b><?php echo e($loanProduct->name); ?></b></h5>

                                <ul class="list-inline">
                                    <li class="mb-2"><?php echo e(_lang('Minimum Amount')); ?>: <strong><?php echo e($loanProduct->minimum_amount); ?></strong></li>
                                    <li class="mb-2"><?php echo e(_lang('Maximum Amount')); ?>: <strong><?php echo e($loanProduct->maximum_amount); ?></strong></li>
                                    <li class="mb-2"><?php echo e(_lang('Interest Rate')); ?>: <strong><?php echo e($loanProduct->interest_rate); ?>%</strong></li>
                                    <li class="mb-2"><?php echo e(_lang('Interest Type')); ?>: <strong><?php echo e(ucwords(str_replace('_',' ',$loanProduct->interest_type))); ?></strong></li>
                                    <li class="mb-2"><?php echo e(_lang('Max Amount')); ?>: <strong><?php echo e($loanProduct->term); ?></strong></li>
                                    <li class="mb-2">
                                        <span><?php echo e(_lang('Term Period')); ?>:</span> 
                                        <?php if($loanProduct->term_period === '+1 day'): ?>
                                            <strong><?php echo e(_lang('Day')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+3 day'): ?>
                                            <strong><?php echo e(_lang('Every 3 days')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+5 day'): ?>
                                            <strong><?php echo e(_lang('Every 5 days')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+7 day'): ?>
                                            <strong><?php echo e(_lang('Week')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+10 day'): ?>
                                            <strong><?php echo e(_lang('Every 10 days')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+15 day'): ?>
                                            <strong><?php echo e(_lang('Every 15 days')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+21 day'): ?>
                                            <strong><?php echo e(_lang('Every 21 days')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+1 month'): ?>
                                            <strong><?php echo e(_lang('Month')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+2 month'): ?>
                                            <strong><?php echo e(_lang('Every 2 months')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+3 month'): ?>
                                            <strong><?php echo e(_lang('Quarterly (Every 3 months)')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+4 month'): ?>
                                            <strong><?php echo e(_lang('Every 4 months')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+6 month'): ?>
                                            <strong><?php echo e(_lang('Biannually (Every 6 months)')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+9 month'): ?>
                                            <strong><?php echo e(_lang('Every 9 months')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+1 year'): ?>
                                            <strong><?php echo e(_lang('Year')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+2 year'): ?>
                                            <strong><?php echo e(_lang('Every 2 years')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+3 year'): ?>
                                            <strong><?php echo e(_lang('Every 3 years')); ?></strong>
                                        <?php elseif($loanProduct->term_period === '+5 year'): ?>
                                            <strong><?php echo e(_lang('Every 5 years')); ?></strong>
                                        <?php endif; ?>
                                    </li>
                                    <li class="mb-2"><?php echo e(_lang('Late Penalties')); ?>: <strong><?php echo e($loanProduct->late_payment_penalties); ?>%</strong></li>
                                    <li class="mb-2"><?php echo e(_lang('Application Fee')); ?>: <strong><?php echo e($loanProduct->loan_application_fee); ?> <?php echo e($loanProduct->loan_application_fee_type == 1 ? '%' : ''); ?></strong></li>
                                    <li class="mb-2"><?php echo e(_lang('Processing Fee')); ?>: <strong><?php echo e($loanProduct->loan_processing_fee); ?> <?php echo e($loanProduct->loan_application_fee_type == 1 ? '%' : ''); ?></strong></li>
                                    <?php if($loanProduct->description): ?>
                                    <li class="mb-2"><?php echo e(_lang('Description')); ?>: <strong></strong><?php echo e($loanProduct->description); ?></strong></li>
                                    <?php endif; ?>
                                </ul>
                                <a href="<?php echo e(route('loans.apply_loan',['product' => $loanProduct->id])); ?>" class="btn btn-primary btn-block mt-4">Apply Now</a>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/customer/loan/loan_products.blade.php ENDPATH**/ ?>