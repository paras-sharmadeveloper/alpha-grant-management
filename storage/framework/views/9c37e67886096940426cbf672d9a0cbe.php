

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<span class="panel-title"><?php echo e(_lang('My Loans')); ?></span>
				<a class="btn btn-primary btn-xs float-right" href="<?php echo e(route('loans.apply_loan')); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Apply Loan')); ?></a>
			</div>

			<div class="card-body">
				<table id="loans_table" class="table table-bordered data-table text-center">
					<thead>
						<tr class="text-center">
                            <th class="text-center"><?php echo e(_lang('Loan ID')); ?></th>
                            <th class="text-center"><?php echo e(_lang('Loan Name')); ?></th>
                            <th class="text-center"><?php echo e(_lang('Amount')); ?></th>
                            <th class="text-center"><?php echo e(_lang('Term')); ?></th>
                            <th class="text-center"><?php echo e(_lang('Interest Rate')); ?></th>
                            <th class="text-center"><?php echo e(_lang('Pending Amount')); ?></th>
                            <th class="text-center"><?php echo e(_lang('Status')); ?></th>
						</tr>
					</thead>
					<tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php
                            $loanTerm = $loan->term ?? $loan->loan_product->term;
                            $loanRate = $loan->interest_rate ?? $loan->loan_product->interest_rate;
                            // Parse term period — e.g. "+1 month" or "+12 months" → "month"
                            $rawPeriod = preg_replace('/^\+\d+\s*/', '', $loan->loan_product->term_period);
                            $periodUnit = rtrim(strtolower(trim($rawPeriod)), 's'); // "month" or "year"
                            // Singular vs plural, and month vs year
                            if ($loanTerm == 1) {
                                $termLabel = '1 ' . $periodUnit;
                            } elseif ($periodUnit === 'month' && $loanTerm % 12 === 0) {
                                $years = $loanTerm / 12;
                                $termLabel = $years . ' ' . ($years == 1 ? 'year' : 'years');
                            } else {
                                $termLabel = $loanTerm . ' ' . $periodUnit . 's';
                            }
                        ?>
                        <tr>
                            <td><a href="<?php echo e(route('loans.loan_details',$loan->id)); ?>"><?php echo e($loan->loan_id ?? '#' . $loan->id); ?></a></td>
                            <td><?php echo e($loan->loan_product->name); ?></td>
                            <td><?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?></td>
                            <td><?php echo e($termLabel); ?></td>
                            <td><?php echo e($loanRate); ?>%</td>
                            <td><?php echo e(decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name))); ?></td>
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
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/customer/loan/my_loans.blade.php ENDPATH**/ ?>