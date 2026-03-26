

<?php $__env->startSection('content'); ?>


<div class="row mb-3">
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-primary"><?php echo e($active_loans->count()); ?></div>
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
            <div class="h4 mb-0 text-warning"><?php echo e(decimalPlace($outstanding, currency_symbol())); ?></div>
            <small class="text-muted"><?php echo e(_lang('Outstanding Balance')); ?></small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-danger"><?php echo e(decimalPlace($arrears, currency_symbol())); ?></div>
            <small class="text-muted"><?php echo e(_lang('Arrears')); ?></small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <ul class="nav flex-column nav-tabs settings-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#branch_details"><i class="ti-home"></i>&nbsp;<?php echo e(_lang('Branch Details')); ?></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#branch_users"><i class="ti-id-badge"></i>&nbsp;<?php echo e(_lang('Users')); ?></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#branch_members"><i class="ti-user"></i>&nbsp;<?php echo e(_lang('Members')); ?></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#branch_loans"><i class="ti-agenda"></i>&nbsp;<?php echo e(_lang('Loans')); ?></a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('branches.edit', $id)); ?>"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit Branch')); ?></a></li>
        </ul>
    </div>

    <div class="col-md-9">
        <div class="tab-content">

            
            <div id="branch_details" class="tab-pane active">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Branch Details')); ?></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr><td style="width:35%"><?php echo e(_lang('Branch Name')); ?></td><td><?php echo e($branch->name); ?></td></tr>
                            <tr><td><?php echo e(_lang('Branch Code')); ?></td><td><span class="badge badge-secondary"><?php echo e($branch->branch_code); ?></span></td></tr>
                            <tr><td><?php echo e(_lang('State')); ?></td><td><?php echo e($branch->state ?? '-'); ?></td></tr>
                            <tr><td><?php echo e(_lang('Branch Manager')); ?></td><td><?php echo e($branch->manager->name ?? '-'); ?></td></tr>
                            <tr><td><?php echo e(_lang('Contact Email')); ?></td><td><?php echo e($branch->contact_email ?? '-'); ?></td></tr>
                            <tr><td><?php echo e(_lang('Contact Phone')); ?></td><td><?php echo e($branch->contact_phone ?? '-'); ?></td></tr>
                            <tr><td><?php echo e(_lang('Address')); ?></td><td><?php echo e($branch->address ?? '-'); ?></td></tr>
                            <tr><td><?php echo e(_lang('Descriptions')); ?></td><td><?php echo e($branch->descriptions ?? '-'); ?></td></tr>
                        </table>
                    </div>
                </div>
            </div>

            
            <div id="branch_users" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Users')); ?></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(_lang('Name')); ?></th>
                                        <th><?php echo e(_lang('Email')); ?></th>
                                        <th><?php echo e(_lang('Role')); ?></th>
                                        <th><?php echo e(_lang('Status')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr>
                                        <td><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->role->name ?? '-'); ?></td>
                                        <td><?php echo xss_clean(show_status($user->status == 1 ? _lang('Active') : _lang('Inactive'), $user->status == 1 ? 'success' : 'danger')); ?></td>
                                    </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <tr><td colspan="4" class="text-center"><?php echo e(_lang('No users found')); ?></td></tr>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            
            <div id="branch_members" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Members')); ?></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(_lang('Member No')); ?></th>
                                        <th><?php echo e(_lang('Name')); ?></th>
                                        <th><?php echo e(_lang('Email')); ?></th>
                                        <th><?php echo e(_lang('Mobile')); ?></th>
                                        <th><?php echo e(_lang('Status')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr>
                                        <td><a href="<?php echo e(route('members.show', $member->id)); ?>"><?php echo e($member->member_no); ?></a></td>
                                        <td><?php echo e($member->first_name); ?> <?php echo e($member->last_name); ?></td>
                                        <td><?php echo e($member->email); ?></td>
                                        <td><?php echo e($member->country_code); ?><?php echo e($member->mobile); ?></td>
                                        <td><?php echo xss_clean(show_status($member->status == 1 ? _lang('Active') : _lang('Inactive'), $member->status == 1 ? 'success' : 'danger')); ?></td>
                                    </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <tr><td colspan="5" class="text-center"><?php echo e(_lang('No members found')); ?></td></tr>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            
            <div id="branch_loans" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Loans')); ?></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(_lang('Loan ID')); ?></th>
                                        <th><?php echo e(_lang('Borrower')); ?></th>
                                        <th><?php echo e(_lang('Product')); ?></th>
                                        <th class="text-right"><?php echo e(_lang('Applied Amount')); ?></th>
                                        <th class="text-right"><?php echo e(_lang('Amount Paid')); ?></th>
                                        <th class="text-right"><?php echo e(_lang('Outstanding')); ?></th>
                                        <th><?php echo e(_lang('Status')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr>
                                        <td><a href="<?php echo e(route('loans.show', $loan->id)); ?>"><?php echo e($loan->loan_id); ?></a></td>
                                        <td><?php echo e($loan->borrower->first_name ?? ''); ?> <?php echo e($loan->borrower->last_name ?? ''); ?></td>
                                        <td><?php echo e($loan->loan_product->name ?? '-'); ?></td>
                                        <td class="text-right"><?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name ?? ''))); ?></td>
                                        <td class="text-right"><?php echo e(decimalPlace($loan->total_paid ?? 0, currency($loan->currency->name ?? ''))); ?></td>
                                        <td class="text-right"><?php echo e(decimalPlace(($loan->applied_amount ?? 0) - ($loan->total_paid ?? 0), currency($loan->currency->name ?? ''))); ?></td>
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
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <tr><td colspan="7" class="text-center"><?php echo e(_lang('No loans found')); ?></td></tr>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
(function ($) {
    "use strict";
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        var tab = $(e.target).attr("href");
        history.pushState({}, null, window.location.pathname + "?tab=" + tab.substring(1));
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });
    <?php if(isset($_GET['tab'])): ?>
        $('.nav-tabs a[href="#<?php echo e($_GET['tab']); ?>"]').tab('show');
    <?php endif; ?>
})(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/branch/view.blade.php ENDPATH**/ ?>