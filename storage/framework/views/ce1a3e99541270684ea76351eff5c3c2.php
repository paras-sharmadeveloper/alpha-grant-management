

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xl-3 col-md-6">
		<a href="<?php echo e(route('members.index')); ?>">
			<div class="card mb-4 dashboard-card">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5><?php echo e(_lang('Total Members')); ?></h5>
							<h4 class="pt-1 mb-0"><b><?php echo e($total_customer); ?></b></h4>
						</div>
						<div class="ml-2 text-center">
							<i class="fas fa-users bg-success text-white"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xl-3 col-md-6">
		<a href="<?php echo e(route('loans.filter', 'active')); ?>">
			<div class="card mb-4 dashboard-card">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5><?php echo e(_lang('Active Loans')); ?></h5>
							<h4 class="pt-1 mb-0"><b><?php echo e($active_loans); ?></b></h4>
						</div>
						<div class="ml-2 text-center">
							<i class="fas fa-file-invoice-dollar bg-info text-white"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xl-3 col-md-6">
		<a href="<?php echo e(route('loans.filter', 'pending')); ?>">
			<div class="card mb-4 dashboard-card">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5><?php echo e(_lang('Pending Loans')); ?></h5>
							<h4 class="pt-1 mb-0"><b><?php echo e($pending_loans); ?></b></h4>
						</div>
						<div class="ml-2 text-center">
							<i class="fas fa-hourglass-half bg-warning text-white"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xl-3 col-md-6">
		<a href="<?php echo e(route('loans.index')); ?>">
			<div class="card mb-4 dashboard-card">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5><?php echo e(_lang('Total Loan Amount')); ?></h5>
							<h4 class="pt-1 mb-0"><b><?php echo e(decimalPlace($total_loan_amount)); ?></b></h4>
						</div>
						<div class="ml-2 text-center">
							<i class="fas fa-hand-holding-usd bg-danger text-white"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card mb-4">
			<div class="card-header">
				<?php echo e(_lang('Due Loan Payments')); ?>

			</div>
			<div class="card-body px-0 pt-0">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap pl-4"><?php echo e(_lang('Loan ID')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Member No')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Member')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Last Payment Date')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Due Repayments')); ?></th>
								<th class="text-nowrap text-right pr-4"><?php echo e(_lang('Total Due')); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($due_repayments) == 0): ?>
								<tr>
									<td colspan="6"><p class="text-center"><?php echo e(_lang('No Data Available')); ?></p></td>
								</tr>
							<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $due_repayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
							<tr>
								<td class="pl-4"><?php echo e($repayment->loan->loan_id); ?></td>
								<td><?php echo e($repayment->loan->borrower->member_no); ?></td>
								<td><?php echo e($repayment->loan->borrower->name); ?></td>
								<td class="text-nowrap"><?php echo e($repayment->repayment_date); ?></td>
								<td class="text-nowrap"><?php echo e($repayment->total_due_repayment); ?></td>
								<td class="text-nowrap text-right pr-4"><?php echo e(decimalPlace($repayment->total_due, currency($repayment->loan->currency->name))); ?></td>
							</tr>
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>






<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script src="<?php echo e(asset('public/backend/plugins/chartJs/chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend/assets/js/dashboard.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/dashboard-admin.blade.php ENDPATH**/ ?>