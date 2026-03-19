<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Schedule - <?php echo e($loan->loan_id); ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; margin: 30px; color: #222; }
        h2, h4 { text-align: center; margin: 4px 0; }
        p.sub { text-align: center; color: #555; margin: 4px 0 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #1a73e8; color: #fff; padding: 10px 8px; text-align: center; }
        td { padding: 9px 8px; border-bottom: 1px solid #ddd; text-align: center; }
        tr:nth-child(even) td { background: #f5f9ff; }
        .badge { padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .paid { background: #d4edda; color: #155724; }
        .unpaid { background: #fff3cd; color: #856404; }
        .due { background: #f8d7da; color: #721c24; }
        .summary { display: flex; gap: 20px; margin-bottom: 20px; }
        .summary-box { flex: 1; background: #D6F2FF; border-radius: 8px; padding: 12px 16px; }
        .summary-box .s-label { font-size: 12px; color: #555; }
        .summary-box .s-value { font-size: 16px; font-weight: 700; margin-top: 4px; }
        @media print {
            .no-print { display: none; }
            body { margin: 10px; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="text-align:right;margin-bottom:15px;">
        <button onclick="window.print()" style="background:#1a73e8;color:#fff;border:none;padding:10px 24px;border-radius:6px;font-size:15px;cursor:pointer;">
            🖨 Print / Save as PDF
        </button>
    </div>

    <h2><?php echo e(get_tenant_option('business_name', request()->tenant->name ?? 'Loan Statement')); ?></h2>
    <h4>Loan Repayment Schedule</h4>
    <p class="sub"><?php echo e($loan->borrower->first_name.' '.$loan->borrower->last_name); ?> &mdash; Loan ID: <?php echo e($loan->loan_id); ?></p>

    <div class="summary">
        <div class="summary-box">
            <div class="s-label">Loan Amount</div>
            <div class="s-value"><?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?></div>
        </div>
        <div class="summary-box">
            <div class="s-label">Interest Rate</div>
            <div class="s-value"><?php echo e($loan->loan_product->interest_rate); ?>%</div>
        </div>
        <div class="summary-box">
            <div class="s-label">Term</div>
            <div class="s-value"><?php echo e($loan->loan_product->term); ?> <?php echo e(preg_replace('/^\+\d+\s*/', '', $loan->loan_product->term_period)); ?></div>
        </div>
        <div class="summary-box">
            <div class="s-label">Total Paid</div>
            <div class="s-value"><?php echo e(decimalPlace($loan->total_paid, currency($loan->currency->name))); ?></div>
        </div>
        <div class="summary-box">
            <div class="s-label">Remaining</div>
            <div class="s-value"><?php echo e(decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name))); ?></div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>EMI (Amount to Pay)</th>
                <th>Principal (+)</th>
                <th>Interest (-)</th>
                <th>Late Penalty (-)</th>
                <th>Balance</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $repayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $repayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <tr>
                <td><?php echo e($i + 1); ?></td>
                <td><?php echo e($repayment->repayment_date); ?></td>
                <td><?php echo e(decimalPlace($repayment->amount_to_pay, currency($loan->currency->name))); ?></td>
                <td style="color:#27ae60;font-weight:600;">
                    +<?php echo e(decimalPlace($repayment->principal_amount, currency($loan->currency->name))); ?>

                </td>
                <td style="color:#e74c3c;font-weight:600;">
                    -<?php echo e(decimalPlace($repayment->interest, currency($loan->currency->name))); ?>

                </td>
                <td style="color:#e74c3c;font-weight:600;">
                    <?php echo e($repayment->penalty > 0 ? '-'.decimalPlace($repayment->penalty, currency($loan->currency->name)) : '—'); ?>

                </td>
                <td><?php echo e(decimalPlace($repayment->balance, currency($loan->currency->name))); ?></td>
                <td>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($repayment->status == 1): ?>
                        <span class="badge paid">Paid</span>
                    <?php elseif($repayment->status == 0 && date('Y-m-d') > $repayment->getRawOriginal('repayment_date')): ?>
                        <span class="badge due">Due</span>
                    <?php else: ?>
                        <span class="badge unpaid">Unpaid</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </td>
            </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </tbody>
    </table>

    <p style="margin-top:30px;font-size:12px;color:#888;text-align:center;">
        Generated on <?php echo e(date('d M Y, h:i A')); ?>

    </p>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/loan/print_schedule.blade.php ENDPATH**/ ?>