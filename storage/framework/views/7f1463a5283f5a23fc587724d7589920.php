<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex align-items-center justify-content-between">
				<div class="panel-title"><?php echo e(_lang('Upcoming Loan Payments')); ?></div>
                <div>
                    <?php echo e(date(get_date_format(), strtotime($startDate))); ?> - <?php echo e(date(get_date_format(), strtotime($endDate))); ?>

                </div>
			</div>
			<div class="card-body">
				<table class="table table-bordered data-table">
                    <thead>
                        <th><?php echo e(_lang("Loan ID")); ?></th>
                        <th><?php echo e(_lang("Date")); ?></th>
                        <th><?php echo e(_lang("Member")); ?></th>
                        <th class="text-right"><?php echo e(_lang("Amount to Pay")); ?></th>
                        <th class="text-right"><?php echo e(_lang("Principal Amount")); ?></th>
                        <th class="text-right"><?php echo e(_lang("Interest")); ?></th>
                        <th class="text-right"><?php echo e(_lang("Late Penalty")); ?></th>
                        <th class="text-right"><?php echo e(_lang("Balance")); ?></th>
                        <th class="text-center"><?php echo e(_lang("Status")); ?></th>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $loanRepayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($repayment->loan->loan_id); ?></td>
                        <td><?php echo e($repayment->repayment_date); ?></td>
                        <td><?php echo e($repayment->loan->borrower->name); ?></td>
                        <td class="text-right">
                            <?php echo e(decimalPlace($repayment['amount_to_pay'], currency($repayment->loan->currency->name))); ?>

                        </td>
                        <td class="text-right">
                            <?php echo e(decimalPlace($repayment['principal_amount'], currency($repayment->loan->currency->name))); ?>

                        </td>
                        <td class="text-right">
                            <?php echo e(decimalPlace($repayment['interest'], currency($repayment->loan->currency->name))); ?>

                        </td>
                        <td class="text-right">
                            <?php echo e(decimalPlace($repayment['penalty'], currency($repayment->loan->currency->name))); ?>

                        </td>
                        <td class="text-right">
                            <?php echo e(decimalPlace($repayment['balance'], currency($repayment->loan->currency->name))); ?>

                        </td>
                        <td class="text-center">
                            <?php if($repayment['status'] == 0 && date('Y-m-d') > $repayment->getRawOriginal('repayment_date')): ?>
                            <?php echo xss_clean(show_status(_lang('Due'),'danger')); ?>

                            <?php elseif($repayment['status'] == 0 && date('Y-m-d') <= $repayment->getRawOriginal('repayment_date')): ?>
                            <?php echo xss_clean(show_status(_lang('Unpaid'),'warning')); ?>

                            <?php else: ?>
                            <?php echo xss_clean(show_status(_lang('Paid'),'success')); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/loan/upcoming_loan_repayments.blade.php ENDPATH**/ ?>