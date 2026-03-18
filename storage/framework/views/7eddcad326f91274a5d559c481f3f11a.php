

<?php $__env->startSection('content'); ?>


<div class="row">
	<div class="col-xl-12">
		<div class="card mb-4">
			<div class="card-header d-flex justify-content-between align-items-center">
				<?php echo e(_lang('Upcoming Loan Payment')); ?>


				<form method="GET" action="" class="form-inline">
					<input type="date" name="from_date" class="form-control form-control-sm mr-2"
						value="<?php echo e(request('from_date')); ?>">

					<input type="date" name="to_date" class="form-control form-control-sm mr-2"
						value="<?php echo e(request('to_date')); ?>">

					<button type="submit" class="btn btn-primary btn-sm mr-1">
						<i class="ti-filter"></i>
					</button>

					<a href="<?php echo e(url()->current()); ?>" class="btn btn-danger btn-sm">
						<i class="ti-close"></i>
					</a>
				</form>
			</div>
			<div class="card-body px-0 pt-0">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<th class="text-nowrap pl-4"><?php echo e(_lang('Loan ID')); ?></th>
							<th class="text-nowrap"><?php echo e(_lang('Next Payment Date')); ?></th>
							<th><?php echo e(_lang('Status')); ?></th>
							<th class="text-nowrap text-right"><?php echo e(_lang('Amount to Pay')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
						</thead>
						<tbody>
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($loans) == 0): ?>
								<tr>
									<td colspan="5"><p class="text-center"><?php echo e(_lang('No Data Available')); ?></p></td>
								</tr>
							<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
							<tr>
								<td class="pl-4"><?php echo e($loan->loan_id); ?></td>
								<td class="text-nowrap"><?php echo e($loan->next_payment->repayment_date); ?></td>
								<td><?php echo $loan->next_payment->getRawOriginal('repayment_date') >= date('Y-m-d') ? xss_clean(show_status(_lang('Upcoming'),'success')) : xss_clean(show_status(_lang('Due'),'danger')); ?></td>
								<td class="text-nowrap text-right"><?php echo e(decimalPlace($loan->next_payment->amount_to_pay, currency($loan->currency->name))); ?></td>
								<td class="text-center"><a href="<?php echo e(route('loans.stripe_payment',$loan->id)); ?>" class="btn btn-primary btn-xs text-nowrap"><?php echo e(_lang('Pay Now')); ?></a></td>
							</tr>
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-12">
		<div class="card mb-4">
			<div class="card-header d-flex justify-content-between align-items-center">
				<?php echo e(_lang('Recent Transactions')); ?>

				
				<form method="GET" action="" class="form-inline">
					<input type="date" name="from_date" class="form-control form-control-sm mr-2"
						value="<?php echo e(request('from_date')); ?>">

					<input type="date" name="to_date" class="form-control form-control-sm mr-2"
						value="<?php echo e(request('to_date')); ?>">

					<button type="submit" class="btn btn-primary btn-sm mr-1">
						<i class="ti-filter"></i>
					</button>

					<a href="<?php echo e(url()->current()); ?>" class="btn btn-danger btn-sm">
						<i class="ti-close"></i>
					</a>
				</form>
			</div>
			<div class="card-body px-0 pt-0">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="pl-4"><?php echo e(_lang('Date')); ?></th>
								<th class="text-right"><?php echo e(_lang('Amount')); ?></th>
								<th><?php echo e(_lang('Type')); ?></th>
								<th><?php echo e(_lang('Status')); ?></th>
								<th class="text-center"><?php echo e(_lang('Details')); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($recent_transactions) == 0): ?>
								<tr>
									<td colspan="7"><p class="text-center"><?php echo e(_lang('No Data Available')); ?></p></td>
								</tr>
							<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recent_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
							<?php
							$symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
							$class  = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
							?>
							<tr>
								<td class="pl-4"><?php echo e($transaction->trans_date); ?></td>
								<td class="text-right"><span class="<?php echo e($class); ?>"><?php echo e($symbol.' '.decimalPlace($transaction->amount, currency($transaction->account->savings_type->currency->name))); ?></span></td>
								<td><?php echo e(ucwords(str_replace('_',' ',$transaction->type))); ?></td>
								<td><?php echo xss_clean(transaction_status($transaction->status)); ?></td>
								<td class="text-center"><a href="<?php echo e(route('trasnactions.details', $transaction->id)); ?>" target="_blank" class="btn btn-outline-primary btn-xs"><?php echo e(_lang('View')); ?></a></td>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/customer/dashboard-customer.blade.php ENDPATH**/ ?>