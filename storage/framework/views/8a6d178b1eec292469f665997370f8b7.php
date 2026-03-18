

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="<?php echo e($alert_col); ?>">
		<div class="card">
			<div class="card-header text-center">
				<span class="panel-title"><?php echo e(_lang('Confirm Loan Approval')); ?></span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="<?php echo e(route('loans.approve', $loan->id)); ?>">
					<?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered">
								<tr>
									<td><?php echo e(_lang("Loan ID")); ?></td>
									<td><?php echo e($loan->loan_id); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang("Loan Type")); ?></td>
									<td><?php echo e($loan->loan_product->name); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang("Borrower")); ?></td>
									<td><?php echo e($loan->borrower->first_name.' '.$loan->borrower->last_name); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang("Member No")); ?></td>
									<td><?php echo e($loan->borrower->member_no); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang("Status")); ?></td>
									<td>
									<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->status == 0): ?>
									<?php echo xss_clean(show_status(_lang('Pending'), 'warning')); ?>

									<?php elseif($loan->status == 1): ?>
									<?php echo xss_clean(show_status(_lang('Approved'), 'success')); ?>

									<?php elseif($loan->status == 2): ?>
									<?php echo xss_clean(show_status(_lang('Completed'), 'info')); ?>

									<?php elseif($loan->status == 3): ?>
									<?php echo xss_clean(show_status(_lang('Cancelled'), 'danger')); ?>

									<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
									</td>
								</tr>
								<tr>
									<td><?php echo e(_lang("First Payment Date")); ?></td>
									<td><?php echo e($loan->first_payment_date); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang("Release Date")); ?></td>
									<td>
									<?php echo e($loan->release_date != '' ? $loan->release_date : ''); ?>

									</td>
								</tr>
								<tr>
									<td><?php echo e(_lang("Applied Amount")); ?></td>
									<td>
									<?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?>

									</td>
								</tr>
								<tr>
									<td><?php echo e(_lang("Late Payment Penalties")); ?></td>
									<td><?php echo e($loan->late_payment_penalties); ?> %</td>
								</tr>
							</table>
						</div>

						
						<input type="hidden" name="account_id" value="cash">

						<div class="col-lg-12 mt-2">
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fas fa-check-circle mr-1"></i><?php echo e(_lang('Confirm')); ?></button>
								<a href="" class="btn btn-danger"><i class="fas fa-undo mr-1"></i><?php echo e(_lang('Back')); ?></a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/loan/approve.blade.php ENDPATH**/ ?>