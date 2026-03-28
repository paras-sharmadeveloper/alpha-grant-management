

<?php $__env->startSection('content'); ?>
<style>
    .db-stat { background:#fff; border-radius:8px; padding:20px 24px; font-family:"Poppins",sans-serif; margin-bottom:20px; box-shadow:0 1px 4px rgba(0,0,0,0.07); display:flex; align-items:center; justify-content:space-between; }
    .db-stat-left { display:flex; flex-direction:column; }
    .db-stat-label { font-size:13px; font-weight:400; color:#555; margin-bottom:6px; }
    .db-stat-value { font-size:22px; font-weight:600; color:#222; }
    .db-stat-icon { width:48px; height:48px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:20px; color:#fff; flex-shrink:0; }
    .loan-tbl th { background:#214942; color:#fff; font-size:12px; font-weight:500; white-space:nowrap; padding:10px 12px; }
    .loan-tbl td { font-size:12px; vertical-align:middle; white-space:nowrap; padding:9px 12px; }
    .b-overdue { background:#e74c3c; color:#fff; padding:2px 8px; border-radius:10px; font-size:11px; }
    .b-current { background:#27ae60; color:#fff; padding:2px 8px; border-radius:10px; font-size:11px; }
</style>


<div class="row">
    <div class="col-md-4">
        <div class="db-stat">
            <div class="db-stat-left">
                <span class="db-stat-label">Total Loan Book</span>
                <span class="db-stat-value"><?php echo e(currency_symbol()); ?><?php echo e(number_format(round($total_loan_book))); ?></span>
            </div>
            <div class="db-stat-icon" style="background:#214942;">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="db-stat">
            <div class="db-stat-left">
                <span class="db-stat-label">Total Outstanding</span>
                <span class="db-stat-value"><?php echo e(currency_symbol()); ?><?php echo e(number_format(round($total_outstanding))); ?></span>
            </div>
            <div class="db-stat-icon" style="background:#1a6b5a;">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="db-stat">
            <div class="db-stat-left">
                <span class="db-stat-label">Due This Month</span>
                <span class="db-stat-value"><?php echo e(currency_symbol()); ?><?php echo e(number_format(round($due_this_month))); ?></span>
            </div>
            <div class="db-stat-icon" style="background:#44a74a;">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="db-stat">
            <div class="db-stat-left">
                <span class="db-stat-label">Borrowers</span>
                <span class="db-stat-value"><?php echo e($total_borrowers); ?></span>
            </div>
            <div class="db-stat-icon" style="background:#2c7873;">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="db-stat">
            <div class="db-stat-left">
                <span class="db-stat-label">Total Loans</span>
                <span class="db-stat-value"><?php echo e($active_loans + $pending_loans); ?></span>
            </div>
            <div class="db-stat-icon" style="background:#e67e22;">
                <i class="fas fa-list-alt"></i>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header" style="font-family:Poppins,sans-serif;font-size:14px;">
                <?php echo e(_lang('Recent Transactions')); ?>

            </div>
            <div class="card-body px-0 pt-0">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="pl-4"><?php echo e(_lang('Loan No')); ?></th>
                                <th><?php echo e(_lang('Date')); ?></th>
                                <th><?php echo e(_lang('Member')); ?></th>
                                <th><?php echo e(_lang('Type')); ?></th>
                                <th><?php echo e(_lang('Dr/Cr')); ?></th>
                                <th class="text-right pr-4"><?php echo e(_lang('Amount')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recent_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr>
                                <td class="pl-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tx->loan_id && $tx->loan->id): ?>
                                        <a href="<?php echo e(route('loans.show', $tx->loan_id)); ?>" style="color:#214942;font-weight:500;"><?php echo e($tx->loan->loan_id); ?></a>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td><?php echo e($tx->trans_date); ?></td>
                                <td><?php echo e($tx->member->first_name ?? ''); ?> <?php echo e($tx->member->last_name ?? ''); ?></td>
                                <td><?php echo e(str_replace('_', ' ', $tx->type)); ?></td>
                                <td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tx->dr_cr == 'dr'): ?>
                                        <span class="badge badge-danger">DR</span>
                                    <?php else: ?>
                                        <span class="badge badge-success">CR</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td class="text-right pr-4 <?php echo e($tx->dr_cr == 'dr' ? 'text-danger' : 'text-success'); ?>">
                                    <?php echo e($tx->dr_cr == 'dr' ? '-' : '+'); ?><?php echo e(decimalPlace($tx->amount, currency_symbol())); ?>

                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr><td colspan="6" class="text-center text-muted"><?php echo e(_lang('No Data Available')); ?></td></tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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