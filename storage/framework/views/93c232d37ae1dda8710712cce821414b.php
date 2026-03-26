

<?php $__env->startSection('content'); ?>
<div class="row mb-3">
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-primary"><?php echo e($loans->count()); ?></div>
            <small class="text-muted"><?php echo e(_lang('Active Loans')); ?></small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-success"><?php echo e(decimalPlace($total_portfolio, currency_symbol())); ?></div>
            <small class="text-muted"><?php echo e(_lang('Total Portfolio')); ?></small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-warning"><?php echo e(decimalPlace($total_outstanding, currency_symbol())); ?></div>
            <small class="text-muted"><?php echo e(_lang('Outstanding Balance')); ?></small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-danger"><?php echo e(decimalPlace($total_arrears, currency_symbol())); ?></div>
            <small class="text-muted"><?php echo e(_lang('Total Arrears')); ?></small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="panel-title"><?php echo e(_lang('Loan Book')); ?></span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="loan_book_table" class="table data-table">
                        <thead>
                            <tr>
                                <th><?php echo e(_lang('Loan ID')); ?></th>
                                <th><?php echo e(_lang('Borrower')); ?></th>
                                <th><?php echo e(_lang('Product')); ?></th>
                                <th class="text-right"><?php echo e(_lang('Applied Amount')); ?></th>
                                <th class="text-right"><?php echo e(_lang('Amount Paid')); ?></th>
                                <th class="text-right"><?php echo e(_lang('Outstanding')); ?></th>
                                <th class="text-right"><?php echo e(_lang('Arrears')); ?></th>
                                <th><?php echo e(_lang('Next Due Date')); ?></th>
                                <th><?php echo e(_lang('Release Date')); ?></th>
                                <th class="text-center"><?php echo e(_lang('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr>
                                <td><a href="<?php echo e(route('loans.show', $loan->id)); ?>"><?php echo e($loan->loan_id); ?></a></td>
                                <td><?php echo e($loan->borrower->first_name ?? ''); ?> <?php echo e($loan->borrower->last_name ?? ''); ?></td>
                                <td><?php echo e($loan->loan_product->name ?? '-'); ?></td>
                                <td class="text-right"><?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name ?? ''))); ?></td>
                                <td class="text-right"><?php echo e(decimalPlace($loan->total_paid ?? 0, currency($loan->currency->name ?? ''))); ?></td>
                                <td class="text-right"><?php echo e(decimalPlace(($loan->applied_amount ?? 0) - ($loan->total_paid ?? 0), currency($loan->currency->name ?? ''))); ?></td>
                                <td class="text-right <?php if($loan->late_payment_penalties > 0): ?> text-danger <?php endif; ?>">
                                    <?php echo e(decimalPlace($loan->late_payment_penalties ?? 0, currency($loan->currency->name ?? ''))); ?>

                                </td>
                                <td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->next_payment && $loan->next_payment->repayment_date): ?>
                                        <?php $isOverdue = \Carbon\Carbon::parse($loan->next_payment->getRawOriginal('repayment_date'))->isPast(); ?>
                                        <span class="<?php echo e($isOverdue ? 'text-danger' : ''); ?>"><?php echo e($loan->next_payment->repayment_date); ?></span>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td><?php echo e($loan->release_date ?? '-'); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('loans.show', $loan->id)); ?>" class="btn btn-primary btn-xs"><i class="ti-eye"></i></a>
                                </td>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/loan/loan_book.blade.php ENDPATH**/ ?>