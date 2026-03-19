

<?php $__env->startSection('content'); ?>



<style>
    .ld-top-link {
        text-align: center;
        padding: 15px;
        color: #1a73e8;
        font-weight: 600;
        font-size: 16px;
    }
    .ld-tabs {
        display: flex;
        justify-content: center;
        gap: 80px;
        border-bottom: 2px solid #ddd;
        background: #fff;
        margin-bottom: 0;
    }
    .ld-tab {
        padding: 15px;
        cursor: pointer;
        color: #333;
        font-size: 17px;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
    }
    .ld-tab.active {
        color: #1a73e8;
        border-bottom: 3px solid #1a73e8;
        font-weight: 600;
    }
    .ld-tab-content { display: none; width: 85%; margin: 20px auto; }
    .ld-tab-content.active { display: block; }

    .ld-summary-card {
        background: #D6F2FF;
        border-radius: 10px;
        padding: 25px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .ld-summary-item { flex: 1; display: flex; flex-direction: column; gap: 8px; }
    .ld-divider { width: 1px; height: 50px; background: #111f28; margin-right: 30px; }
    .ld-label { font-size: 14px; color: #1f2d3d; }
    .ld-value { font-size: 20px; font-weight: 700; color: #000; }

    .ld-details-section { background: #fff; padding: 10px 0; }
    .ld-detail-row {
        display: flex;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid #ddd;
        font-size: 17px;
    }
    .ld-detail-row .ld-label { color: #2c3e50; font-size: 17px; }
    .ld-detail-row .ld-value { font-weight: 700; font-size: 17px; color: #0b1f3a; }

    .ld-transaction {
        padding: 15px 0;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .ld-tx-left { display: flex; flex-direction: column; }
    .ld-tx-date { font-size: 13px; font-weight: 600; color: #555; }
    .ld-tx-title { font-size: 17px; margin-top: 6px; }
    .ld-tx-amount { font-weight: 800; font-size: 16px; }

    .ld-action-bar {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }

    @media (max-width: 768px) {
        .ld-tab-content { width: 95%; }
        .ld-tabs { gap: 20px; }
        .ld-summary-card { flex-direction: column; gap: 15px; }
        .ld-divider { display: none; }
    }
</style>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body p-0">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->status == 0): ?>
            <div class="ld-action-bar">
                <a href="<?php echo e(route('loans.approve', $loan->id)); ?>" class="btn btn-success">
                    <i class="fas fa-check-circle mr-1"></i><?php echo e(_lang('Approve')); ?>

                </a>
                <a href="<?php echo e(route('loans.reject', $loan->id)); ?>"
                   class="btn btn-danger confirm-alert"
                   data-message="<?php echo e(_lang('Are you sure you want to reject this loan application?')); ?>">
                    <i class="fas fa-times-circle mr-1"></i><?php echo e(_lang('Reject')); ?>

                </a>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="ld-top-link">
                <?php echo e($loan->loan_product->name); ?> &mdash; <?php echo e($loan->loan_id); ?>

            </div>

            
            <div style="width:85%;margin:0 auto 20px;">
                <div class="ld-summary-card">
                    <div class="ld-summary-item">
                        <span class="ld-label"><?php echo e(_lang('Next Payment Date')); ?></span>
                        <span class="ld-value">
                            <?php echo e($loan->next_payment ? $loan->next_payment->repayment_date : '—'); ?>

                        </span>
                    </div>
                    <div class="ld-divider"></div>
                    <div class="ld-summary-item">
                        <span class="ld-label"><?php echo e(_lang('Pending Amount')); ?></span>
                        <span class="ld-value">
                            <?php echo e(decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name))); ?>

                        </span>
                    </div>
                    <div class="ld-divider"></div>
                    <div class="ld-summary-item">
                        <span class="ld-label"><?php echo e(_lang('Status')); ?></span>
                        <span class="ld-value">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->status == 0): ?> <span style="color:#f39c12;"><?php echo e(_lang('Pending')); ?></span>
                            <?php elseif($loan->status == 1): ?> <span style="color:#27ae60;"><?php echo e(_lang('Approved')); ?></span>
                            <?php elseif($loan->status == 2): ?> <span style="color:#2980b9;"><?php echo e(_lang('Completed')); ?></span>
                            <?php else: ?> <span style="color:#e74c3c;"><?php echo e(_lang('Cancelled')); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>

            
            <div class="ld-tabs">
                <div class="ld-tab active" onclick="ldOpenTab('ld_details', this)"><?php echo e(_lang('Loan Details')); ?></div>
                <div class="ld-tab" onclick="ldOpenTab('ld_transactions', this)"><?php echo e(_lang('Transactions')); ?></div>
                <div class="ld-tab" onclick="ldOpenTab('ld_statements', this)"><?php echo e(_lang('Statements')); ?></div>
                <div class="ld-tab" onclick="ldOpenTab('ld_documents', this)"><?php echo e(_lang('Documents')); ?></div>
            </div>

            
            <div id="ld_details" class="ld-tab-content active">
                <div class="ld-details-section">

                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Loan ID')); ?></span>
                        <span class="ld-value"><?php echo e($loan->loan_id); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Borrower')); ?></span>
                        <span class="ld-value"><?php echo e($loan->borrower->first_name.' '.$loan->borrower->last_name); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Member No')); ?></span>
                        <span class="ld-value"><?php echo e($loan->borrower->member_no); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Loan Amount')); ?></span>
                        <span class="ld-value"><?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Interest Rate')); ?></span>
                        <span class="ld-value"><?php echo e($loan->loan_product->interest_rate); ?>%</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Loan Term')); ?></span>
                        <span class="ld-value">
                            <?php echo e($loan->loan_product->term); ?> <?php echo e(preg_replace('/^\+\d+\s*/', '', $loan->loan_product->term_period)); ?>

                        </span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('First Payment Date')); ?></span>
                        <span class="ld-value"><?php echo e($loan->first_payment_date); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Release Date')); ?></span>
                        <span class="ld-value"><?php echo e($loan->release_date); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Total Principal Paid')); ?></span>
                        <span class="ld-value" style="color:#27ae60;"><?php echo e(decimalPlace($loan->total_paid, currency($loan->currency->name))); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Due Amount')); ?></span>
                        <span class="ld-value" style="color:#e74c3c;"><?php echo e(decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name))); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Late Payment Penalties')); ?></span>
                        <span class="ld-value"><?php echo e($loan->late_payment_penalties); ?>%</span>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->status == 1): ?>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Approved Date')); ?></span>
                        <span class="ld-value"><?php echo e($loan->approved_date); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Approved By')); ?></span>
                        <span class="ld-value"><?php echo e($loan->approved_by->name); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Disburse Method')); ?></span>
                        <span class="ld-value"><?php echo e($loan->disburse_method == 'cash' ? ucwords($loan->disburse_method) : _lang('Transfer to Account')); ?></span>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $customFields->isEmpty()): ?>
                        <?php $customFieldsData = json_decode($loan->custom_fields, true); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="ld-detail-row">
                            <span class="ld-label"><?php echo e($customField->field_name); ?></span>
                            <span class="ld-value">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customField->field_type == 'file'): ?>
                                    <?php $file = $customFieldsData[$customField->field_name]['field_value'] ?? null; ?>
                                    <?php echo $file ? '<a href="'.asset('public/uploads/media/'.$file).'" target="_blank">'._lang('Preview').'</a>' : ''; ?>

                                <?php else: ?>
                                    <?php echo e($customFieldsData[$customField->field_name]['field_value'] ?? ''); ?>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->description): ?>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Description')); ?></span>
                        <span class="ld-value"><?php echo e($loan->description); ?></span>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->remarks): ?>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Remarks')); ?></span>
                        <span class="ld-value"><?php echo e($loan->remarks); ?></span>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>

                
                <div style="text-align:center;margin-top:20px;">
                    <a href="<?php echo e(route('loans.edit', $loan->id)); ?>" class="btn btn-warning">
                        <i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit Loan')); ?>

                    </a>
                </div>
            </div>

            
            <div id="ld_transactions" class="ld-tab-content">

                
                <div class="ld-transaction">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date"><?php echo e(\Carbon\Carbon::parse($loan->getRawOriginal('release_date'))->format('D, d M Y')); ?></span>
                        <span class="ld-tx-title"><?php echo e(_lang('Loan Disbursed')); ?></span>
                    </div>
                    <span class="ld-tx-amount">
                        +<?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?>

                    </span>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                
                <div class="ld-transaction">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date"><?php echo e(\Carbon\Carbon::parse($payment->getRawOriginal('paid_at'))->format('D, d M Y')); ?></span>
                        <span class="ld-tx-title"><?php echo e(_lang('EMI Paid')); ?></span>
                    </div>
                    <span class="ld-tx-amount">
                        +<?php echo e(decimalPlace($payment->repayment_amount - $payment->interest, currency($loan->currency->name))); ?>

                    </span>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->interest > 0): ?>
                <div class="ld-transaction" style="padding-left:20px;background:#fafafa;">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date" style="font-size:12px;color:#888;"><?php echo e(_lang('Interest Charged')); ?></span>
                    </div>
                    <span class="ld-tx-amount" style="font-size:14px;font-weight:700;">
                        -<?php echo e(decimalPlace($payment->interest, currency($loan->currency->name))); ?>

                    </span>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->late_penalties > 0): ?>
                <div class="ld-transaction" style="padding-left:20px;background:#fafafa;">
                    <div class="ld-tx-left">
                        <span class="ld-tx-date" style="font-size:12px;color:#888;"><?php echo e(_lang('Late Penalty')); ?></span>
                    </div>
                    <span class="ld-tx-amount" style="font-size:14px;font-weight:700;">
                        -<?php echo e(decimalPlace($payment->late_penalties, currency($loan->currency->name))); ?>

                    </span>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->status != 1): ?>
                <p class="text-center mt-4 text-muted"><?php echo e(_lang('No transactions found.')); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div id="ld_statements" class="ld-tab-content">
                <div style="text-align:center;padding:40px 20px;">
                    <p style="font-size:16px;color:#555;margin-bottom:20px;">
                        <?php echo e(_lang('Download the full repayment schedule as PDF.')); ?>

                    </p>
                    <a href="<?php echo e(route('loans.print_schedule', $loan->id)); ?>" target="_blank"
                       style="background:#1a73e8;color:#fff;padding:14px 40px;border-radius:8px;font-size:16px;font-weight:600;text-decoration:none;display:inline-block;">
                        🖨 <?php echo e(_lang('Print / Download Schedule')); ?>

                    </a>
                </div>
            </div>

            
            <div id="ld_documents" class="ld-tab-content">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $loancollaterals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collateral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="ld-detail-row">
                    <span class="ld-label"><?php echo e($collateral->name); ?></span>
                    <span class="ld-value">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($collateral->attachments): ?>
                            <a href="<?php echo e(asset('public/uploads/media/'.$collateral->attachments)); ?>" target="_blank">
                                <?php echo e(_lang('View')); ?>

                            </a>
                        <?php else: ?>
                            <?php echo e($collateral->collateral_type); ?> &mdash; <?php echo e(decimalPlace($collateral->estimated_price)); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <p class="text-center mt-4 text-muted"><?php echo e(_lang('No documents found.')); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div style="background:#E5F6FE;height:40px;margin-top:20px;"></div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
function ldOpenTab(tabId, el) {
    document.querySelectorAll('.ld-tab-content').forEach(c => c.classList.remove('active'));
    document.querySelectorAll('.ld-tab').forEach(t => t.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');
    el.classList.add('active');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/loan/view.blade.php ENDPATH**/ ?>