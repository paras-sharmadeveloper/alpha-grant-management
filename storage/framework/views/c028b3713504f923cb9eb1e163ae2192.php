

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="panel-title"><?php echo e(_lang('Pending Loans')); ?></span>
                <a class="btn btn-primary btn-xs float-right" href="<?php echo e(route('loans.apply_loan')); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Apply Loan')); ?></a>
            </div>

            <div class="card-body">
                <table id="pending_loans_table" class="table table-bordered data-table text-center">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center"><?php echo e(_lang('Loan ID')); ?></th>
                            <th class="text-center"><?php echo e(_lang('Name')); ?></th>
                            <th class="text-center"><?php echo e(_lang('Request Amount')); ?></th>
                            <th class="text-center"><?php echo e(_lang('Status')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr>
                            <td>
                                    <?php echo e($loan->loan_id ?? '#' . $loan->id); ?>

                              
                            </td>
                            <td><?php echo e($loan->loan_product->name); ?></td>
                            <td><?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?></td>
                            <td><?php echo xss_clean(show_status(_lang('Pending'), 'warning')); ?></td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loans->isEmpty()): ?>
                        <tr>
                            <td colspan="4"><p class="text-center"><?php echo e(_lang('No Pending Loans')); ?></p></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/customer/loan/pending_loans.blade.php ENDPATH**/ ?>