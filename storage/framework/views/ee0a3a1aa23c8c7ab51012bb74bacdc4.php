

<?php $__env->startSection('content'); ?>



<style>
    /* Theme: sidebar = #214942, active = #44a74a, font = Poppins 14px/400 */
    .ld-top-bar {
        background: #214942;
        text-align: center;
        padding: 15px;
        color: #fff;
        font-weight: 400;
        font-size: 14px;
        font-family: "Poppins", sans-serif;
        letter-spacing: 0;
        text-transform: capitalize;
    }
    .ld-bottom-bar { background: #214942; height: 40px; margin-top: 20px; }
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
        font-size: 14px;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        letter-spacing: 0;
        text-transform: capitalize;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
        user-select: none;
    }
    .ld-tab.active { color: #214942; border-bottom: 3px solid #44a74a; }
    .ld-tab.disabled { color: #aaa; cursor: not-allowed; }
    .ld-tab-content { display: none; width: 85%; margin: 20px auto; font-family: "Poppins", sans-serif; font-size: 14px; }
    .ld-tab-content.active { display: block; }

    .ld-summary-card {
        background: #214942;
        border-radius: 10px;
        padding: 25px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .ld-summary-item { flex: 1; display: flex; flex-direction: column; gap: 8px; align-items: center; text-align: center; }
    .ld-divider { width: 1px; height: 50px; background: #fff; margin-right: 30px; }
    .ld-label { font-size: 14px; color: rgba(255,255,255,0.75); font-family: "Poppins", sans-serif; font-weight: 400; letter-spacing: 0; text-transform: capitalize; }
    .ld-value { font-size: 14px; font-weight: 400; color: #fff; font-family: "Poppins", sans-serif; letter-spacing: 0; text-transform: capitalize; }

    .ld-details-section { background: #fff; padding: 10px 0; }
    .ld-detail-row {
        display: flex;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        letter-spacing: 0;
    }
    .ld-detail-row .ld-label { color: #2c3e50; font-size: 14px; font-weight: 400; text-transform: capitalize; }
    .ld-detail-row .ld-value { font-weight: 400; font-size: 14px; color: #214942; text-transform: capitalize; }

    .ld-transaction {
        padding: 15px 0;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        font-weight: 400;
        letter-spacing: 0;
    }
    .ld-tx-left { display: flex; flex-direction: column; }
    .ld-tx-date { font-size: 14px; font-weight: 400; color: #555; text-transform: capitalize; }
    .ld-tx-title { font-size: 14px; font-weight: 400; margin-top: 6px; text-transform: capitalize; }
    .ld-tx-amount { font-weight: 400; font-size: 14px; }

    .ld-action-bar {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }

    .ld-pending-notice {
        text-align: center;
        padding: 60px 20px;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
        color: #f39c12;
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
                <a href="<?php echo e(route('loans.kyc', $loan->id)); ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-user-check mr-1"></i><?php echo e(_lang('KYC')); ?>

                </a>
                <a href="<?php echo e(route('loans.approve', $loan->id)); ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-check-circle mr-1"></i><?php echo e(_lang('Approve')); ?>

                </a>
                <a href="<?php echo e(route('loans.reject', $loan->id)); ?>"
                   class="btn btn-danger btn-sm confirm-alert"
                   data-message="<?php echo e(_lang('Are you sure you want to reject this loan application?')); ?>">
                    <i class="fas fa-times-circle mr-1"></i><?php echo e(_lang('Reject')); ?>

                </a>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="ld-top-bar">
                <?php echo e($loan->loan_product->name); ?> &mdash; <?php echo e($loan->loan_id); ?>

            </div>

            
            <div style="width:85%;margin:0 auto 20px;">
                <div class="ld-summary-card">
                    <div class="ld-summary-item">
                        <span class="ld-label"><?php echo e(_lang('Next Payment Date')); ?></span>
                        <span class="ld-value"><?php echo e($loan->next_payment ? $loan->next_payment->repayment_date : '—'); ?></span>
                    </div>
                    <div class="ld-divider"></div>
                    <div class="ld-summary-item">
                        <span class="ld-label"><?php echo e(_lang('Pending Amount')); ?></span>
                        <span class="ld-value"><?php echo e(decimalPlace($loan->applied_amount - ($loan->total_paid ?? 0), currency($loan->currency->name))); ?></span>
                    </div>
                    <div class="ld-divider"></div>
                    <div class="ld-summary-item">
                        <span class="ld-label"><?php echo e(_lang('Status')); ?></span>
                        <span class="ld-value">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->status == 0): ?> <span style="color:#f39c12;"><?php echo e(_lang('Pending')); ?></span>
                            <?php elseif($loan->status == 1): ?> <span style="color:#44a74a;"><?php echo e(_lang('Approved')); ?></span>
                            <?php elseif($loan->status == 2): ?> <span style="color:#2980b9;"><?php echo e(_lang('Completed')); ?></span>
                            <?php else: ?> <span style="color:#e74c3c;"><?php echo e(_lang('Cancelled')); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>

            
            <?php $isPending = $loan->status == 0; ?>
            <div class="ld-tabs">
                <div class="ld-tab active" onclick="ldOpenTab('ld_details', this)"><?php echo e(_lang('Loan Details')); ?></div>
                <div class="ld-tab <?php echo e($isPending ? 'disabled' : ''); ?>" onclick="ldOpenTab('ld_transactions', this, <?php echo e($isPending ? 'true' : 'false'); ?>)"><?php echo e(_lang('Transactions')); ?></div>
                <div class="ld-tab <?php echo e($isPending ? 'disabled' : ''); ?>" onclick="ldOpenTab('ld_statements', this, <?php echo e($isPending ? 'true' : 'false'); ?>)"><?php echo e(_lang('Statements')); ?></div>
                <div class="ld-tab <?php echo e($isPending ? 'disabled' : ''); ?>" onclick="ldOpenTab('ld_documents', this, <?php echo e($isPending ? 'true' : 'false'); ?>)"><?php echo e(_lang('Documents')); ?></div>
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
                        <span class="ld-value"><?php echo e($loan->interest_rate ?? $loan->loan_product->interest_rate); ?>%</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Loan Term')); ?></span>
                        <?php $termMonths = $loan->term ?? $loan->loan_product->term; $termYears = round($termMonths / 12, 1); ?>
                        <span class="ld-value"><?php echo e($termYears); ?> <?php echo e($termYears == 1 ? 'Year' : 'Years'); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Total Principal Paid')); ?></span>
                        <span class="ld-value" style="color:#44a74a;"><?php echo e(decimalPlace($loan->total_paid ?? 0, currency($loan->currency->name))); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Due Amount')); ?></span>
                        <span class="ld-value" style="color:#e74c3c;"><?php echo e(decimalPlace($loan->applied_amount - ($loan->total_paid ?? 0), currency($loan->currency->name))); ?></span>
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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->status != 2): ?>
                    <a href="<?php echo e(route('loans.edit', $loan->id)); ?>" class="btn btn-warning btn-sm">
                        <i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit Loan')); ?>

                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div id="ld_transactions" class="ld-tab-content">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPending): ?>
                <div class="ld-pending-notice">⏳ <?php echo e(_lang('Loan is pending approval. Transactions will be available once approved.')); ?></div>
                <?php else: ?>
                <?php
                    $allTx = [];
                    foreach ($payments as $payment) {
                        $pDate = $payment->getRawOriginal('paid_at');
                        $allTx[] = ['date' => $pDate, 'title' => _lang('EMI Paid'), 'amount' => '+'.decimalPlace($payment->repayment_amount - $payment->interest, currency($loan->currency->name)), 'indent' => false];
                        if ($payment->interest > 0)
                            $allTx[] = ['date' => $pDate, 'title' => _lang('Interest Charged'), 'amount' => '-'.decimalPlace($payment->interest, currency($loan->currency->name)), 'indent' => true];
                        if ($payment->late_penalties > 0)
                            $allTx[] = ['date' => $pDate, 'title' => _lang('Late Penalty'), 'amount' => '-'.decimalPlace($payment->late_penalties, currency($loan->currency->name)), 'indent' => true];
                    }
                    $groups = []; $current = [];
                    foreach ($allTx as $tx) {
                        if (!$tx['indent']) { if (!empty($current)) $groups[] = $current; $current = [$tx]; }
                        else { $current[] = $tx; }
                    }
                    if (!empty($current)) $groups[] = $current;
                    usort($groups, fn($a, $b) => strtotime($b[0]['date']) - strtotime($a[0]['date']));
                    $sortedTx = [];
                    foreach ($groups as $g) foreach ($g as $row) $sortedTx[] = $row;
                    if ($loan->getRawOriginal('release_date'))
                        $sortedTx[] = ['date' => $loan->getRawOriginal('release_date'), 'title' => _lang('Loan Disbursed'), 'amount' => '+'.decimalPlace($loan->applied_amount, currency($loan->currency->name)), 'indent' => false];
                ?>
                <div id="tx-list"></div>
                <div id="tx-pagination" style="display:flex;justify-content:center;gap:8px;margin:20px 0;flex-wrap:wrap;"></div>
                <script>
                    const txData = <?php echo json_encode($sortedTx, 15, 512) ?>;
                    const TX_PER_PAGE = 5;
                    function parseDateStr(s) {
                        const p = s.split(/[-T ]/);
                        const y=+p[0],m=+p[1]-1,d=+p[2], dt=new Date(y,m,d);
                        const days=['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
                        const months=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                        return days[dt.getDay()]+', '+String(d).padStart(2,'0')+' '+months[m]+' '+y;
                    }
                    function renderTx(page) {
                        const start=(page-1)*TX_PER_PAGE, slice=txData.slice(start,start+TX_PER_PAGE);
                        let html = txData.length===0 ? '<p class="text-center mt-4 text-muted" style="font-family:Poppins,sans-serif;font-size:14px;">No transactions found.</p>' : '';
                        slice.forEach(tx => {
                            const bg = tx.indent ? 'background:#fafafa;padding-left:20px;' : '';
                            html += `<div class="ld-transaction" style="${bg}"><div class="ld-tx-left"><span class="ld-tx-date">${tx.date ? parseDateStr(tx.date) : '—'}</span><span class="ld-tx-title">${tx.title}</span></div><span class="ld-tx-amount">${tx.amount}</span></div>`;
                        });
                        document.getElementById('tx-list').innerHTML = html;
                        const total=Math.ceil(txData.length/TX_PER_PAGE); let pHtml='';
                        for(let i=1;i<=total;i++){const a=i===page?'background:#214942;color:#fff;':'background:#f0f0f0;color:#214942;';pHtml+=`<span onclick="renderTx(${i})" style="${a}padding:6px 12px;border-radius:4px;cursor:pointer;font-family:Poppins,sans-serif;font-size:14px;">${i}</span>`;}
                        document.getElementById('tx-pagination').innerHTML=pHtml;
                    }
                    document.addEventListener('DOMContentLoaded',()=>renderTx(1));
                </script>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div id="ld_statements" class="ld-tab-content">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPending): ?>
                <div class="ld-pending-notice">⏳ <?php echo e(_lang('Loan is pending approval. Statements will be available once approved.')); ?></div>
                <?php else: ?>
                <div style="background:#f8f9fa;border-radius:8px;padding:20px;margin-bottom:24px;">
                    <div style="display:flex;gap:16px;align-items:flex-end;flex-wrap:wrap;">
                        <div style="display:flex;flex-direction:column;gap:4px;">
                            <label style="font-family:Poppins,sans-serif;font-size:14px;color:#214942;text-transform:capitalize;"><?php echo e(_lang('From')); ?></label>
                            <input type="date" id="stmt-from" onchange="onFromChange()" style="border:1px solid #ccc;border-radius:4px;padding:8px 12px;font-family:Poppins,sans-serif;font-size:14px;color:#214942;">
                        </div>
                        <div style="display:flex;flex-direction:column;gap:4px;">
                            <label style="font-family:Poppins,sans-serif;font-size:14px;color:#214942;text-transform:capitalize;"><?php echo e(_lang('To')); ?></label>
                            <input type="date" id="stmt-to" style="border:1px solid #ccc;border-radius:4px;padding:8px 12px;font-family:Poppins,sans-serif;font-size:14px;color:#214942;">
                        </div>
                        <button onclick="filterStatements()" style="background:#214942;color:#fff;border:none;padding:9px 20px;border-radius:4px;font-family:Poppins,sans-serif;font-size:14px;cursor:pointer;text-transform:capitalize;"><?php echo e(_lang('Filter')); ?></button>
                        <button onclick="resetStatements()" style="background:#f0f0f0;color:#214942;border:none;padding:9px 20px;border-radius:4px;font-family:Poppins,sans-serif;font-size:14px;cursor:pointer;text-transform:capitalize;"><?php echo e(_lang('Reset')); ?></button>
                    </div>
                    <div style="display:flex;gap:12px;margin-top:16px;flex-wrap:wrap;">
                        <a href="<?php echo e(route('loans.print_schedule', $loan->id)); ?>" target="_blank"
                           style="background:#214942;color:#fff;padding:9px 20px;border-radius:4px;font-size:14px;font-weight:400;text-decoration:none;font-family:Poppins,sans-serif;text-transform:capitalize;">
                            🖨 <?php echo e(_lang('Print Schedule')); ?>

                        </a>
                        <a href="<?php echo e(route('loans.print_schedule', $loan->id)); ?>?download=1" target="_blank"
                           style="background:#44a74a;color:#fff;padding:9px 20px;border-radius:4px;font-size:14px;font-weight:400;text-decoration:none;font-family:Poppins,sans-serif;text-transform:capitalize;">
                            ⬇ <?php echo e(_lang('Download Schedule')); ?>

                        </a>
                        <a id="stmt-filtered-btn" href="#" target="_blank"
                           style="display:none;background:#f39c12;color:#fff;padding:9px 20px;border-radius:4px;font-size:14px;font-weight:400;text-decoration:none;font-family:Poppins,sans-serif;text-transform:capitalize;">
                            ⬇ <?php echo e(_lang('Download Filtered Records')); ?>

                        </a>
                    </div>
                </div>

                
                <div id="stmt-results" style="display:none;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" style="font-family:Poppins,sans-serif;font-size:13px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo e(_lang('Date')); ?></th>
                                    <th><?php echo e(_lang('Principal')); ?></th>
                                    <th><?php echo e(_lang('Interest')); ?></th>
                                    <th><?php echo e(_lang('Amount to Pay')); ?></th>
                                    <th><?php echo e(_lang('Balance')); ?></th>
                                    <th><?php echo e(_lang('Status')); ?></th>
                                </tr>
                            </thead>
                            <tbody id="stmt-tbody"></tbody>
                        </table>
                    </div>
                    <p id="stmt-no-records" style="display:none;text-align:center;color:#888;font-family:Poppins,sans-serif;font-size:13px;padding:20px 0;"><?php echo e(_lang('No records found for selected date range.')); ?></p>
                </div>

                <script>
                    const adminPrintBase = "<?php echo e(route('loans.print_schedule', $loan->id)); ?>";
                    <?php
                        $stmtData = $repayments->map(function($r) {
                            return [
                                'date'          => $r->getRawOriginal('repayment_date'),
                                'principal'     => $r->principal_amount,
                                'interest'      => $r->interest,
                                'amount_to_pay' => $r->amount_to_pay,
                                'balance'       => $r->balance,
                                'status'        => $r->status,
                            ];
                        });
                    ?>
                    const adminRepayments = <?php echo json_encode($stmtData); ?>;

                    function onFromChange() {
                        const from = document.getElementById('stmt-from').value;
                        const toEl = document.getElementById('stmt-to');
                        if (from) { toEl.min = from; if (toEl.value && toEl.value < from) toEl.value = from; }
                    }

                    function filterStatements() {
                        const from = document.getElementById('stmt-from').value;
                        const to   = document.getElementById('stmt-to').value;
                        if (!from && !to) { alert('Please select at least a From date.'); return; }

                        const filtered = adminRepayments.filter(r => {
                            if (from && r.date < from) return false;
                            if (to   && r.date > to)   return false;
                            return true;
                        });

                        const tbody = document.getElementById('stmt-tbody');
                        tbody.innerHTML = '';
                        if (filtered.length === 0) {
                            document.getElementById('stmt-no-records').style.display = '';
                        } else {
                            document.getElementById('stmt-no-records').style.display = 'none';
                            filtered.forEach((r, i) => {
                                const status = r.status == 1
                                    ? '<span class="badge badge-success">Paid</span>'
                                    : '<span class="badge badge-warning">Pending</span>';
                                tbody.innerHTML += `<tr>
                                    <td>${i+1}</td>
                                    <td>${r.date}</td>
                                    <td>${parseFloat(r.principal).toFixed(2)}</td>
                                    <td>${parseFloat(r.interest).toFixed(2)}</td>
                                    <td>${parseFloat(r.amount_to_pay).toFixed(2)}</td>
                                    <td>${parseFloat(r.balance).toFixed(2)}</td>
                                    <td>${status}</td>
                                </tr>`;
                            });
                        }
                        document.getElementById('stmt-results').style.display = '';

                        // Update download link
                        const btn = document.getElementById('stmt-filtered-btn');
                        const params = [];
                        if (from) params.push('from=' + from);
                        if (to)   params.push('to=' + to);
                        params.push('download=1');
                        btn.href = adminPrintBase + '?' + params.join('&');
                        btn.style.display = '';
                    }

                    function resetStatements() {
                        document.getElementById('stmt-from').value = '';
                        document.getElementById('stmt-to').value   = '';
                        document.getElementById('stmt-to').removeAttribute('min');
                        document.getElementById('stmt-results').style.display = 'none';
                        document.getElementById('stmt-filtered-btn').style.display = 'none';
                    }
                </script>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div id="ld_documents" class="ld-tab-content">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPending): ?>
                <div class="ld-pending-notice">⏳ <?php echo e(_lang('Loan is pending approval. Documents will be available once approved.')); ?></div>
                <?php else: ?>

                <?php $borrower = $loan->borrower; ?>
                <?php $memberDocuments = \App\Models\MemberDocument::withoutGlobalScopes()->where('loan_id', $loan->id)->get(); ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($memberDocuments->isNotEmpty()): ?>
                <div style="font-size:13px;font-weight:600;color:#214942;text-transform:uppercase;letter-spacing:1px;margin:16px 0 8px;border-left:3px solid #44a74a;padding-left:10px;"><?php echo e(_lang('Member Documents')); ?></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $memberDocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="ld-detail-row">
                    <span class="ld-label"><?php echo e($doc->name); ?></span>
                    <span class="ld-value" style="display:flex;align-items:center;gap:12px;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($doc->show_to_customer): ?>
                            <span style="background:#27ae60;color:#fff;font-size:11px;padding:2px 8px;border-radius:10px;" title="<?php echo e(_lang('Visible to customer')); ?>"><?php echo e(_lang('Customer: On')); ?></span>
                        <?php else: ?>
                            <span style="background:#e74c3c;color:#fff;font-size:11px;padding:2px 8px;border-radius:10px;" title="<?php echo e(_lang('Admin only')); ?>"><?php echo e(_lang('Customer: Off')); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <a href="<?php echo e(asset('public/uploads/media/'.$doc->document)); ?>" target="_blank"><?php echo e(_lang('View')); ?></a>
                    </span>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loancollaterals->isNotEmpty()): ?>
                <div style="font-size:13px;font-weight:600;color:#214942;text-transform:uppercase;letter-spacing:1px;margin:16px 0 8px;border-left:3px solid #44a74a;padding-left:10px;"><?php echo e(_lang('Loan Collaterals')); ?></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loancollaterals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collateral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="ld-detail-row">
                    <span class="ld-label"><?php echo e($collateral->name); ?></span>
                    <span class="ld-value" style="display:flex;align-items:center;gap:12px;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($collateral->attachments): ?>
                            <span style="background:#27ae60;color:#fff;font-size:11px;padding:2px 8px;border-radius:10px;"><?php echo e(_lang('On')); ?></span>
                            <a href="<?php echo e(asset('public/uploads/media/'.$collateral->attachments)); ?>" target="_blank"><?php echo e(_lang('View')); ?></a>
                        <?php else: ?>
                            <span style="background:#e74c3c;color:#fff;font-size:11px;padding:2px 8px;border-radius:10px;"><?php echo e(_lang('Off')); ?></span>
                            <span><?php echo e($collateral->collateral_type); ?> &mdash; <?php echo e(decimalPlace($collateral->estimated_price)); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($memberDocuments->isEmpty() && $loancollaterals->isEmpty()): ?>
                <p class="text-center mt-4 text-muted" style="font-family:Poppins,sans-serif;font-size:14px;"><?php echo e(_lang('No documents found.')); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <div style="font-size:13px;font-weight:600;color:#214942;text-transform:uppercase;letter-spacing:1px;margin:24px 0 8px;border-left:3px solid #44a74a;padding-left:10px;"><?php echo e(_lang('Upload Documents')); ?></div>
                <p style="font-size:13px;color:#888;font-family:Poppins,sans-serif;margin-bottom:12px;"><?php echo e(_lang('Check "Show to Customer" to make a document visible in the customer portal.')); ?></p>

                <form method="post" action="<?php echo e(route('loans.upload_document', $loan->id)); ?>" enctype="multipart/form-data" id="doc-upload-form">
                    <?php echo csrf_field(); ?>
                    <div id="admin-doc-list"></div>
                    <button type="button" onclick="adminAddDoc()" style="background:#214942;color:#fff;border:none;padding:7px 16px;border-radius:4px;font-family:Poppins,sans-serif;font-size:13px;cursor:pointer;display:inline-flex;align-items:center;gap:6px;">
                        <i class="fas fa-plus"></i> <?php echo e(_lang('Add More')); ?>

                    </button>
                    <div style="margin-top:16px;">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-upload mr-1"></i><?php echo e(_lang('Upload')); ?>

                        </button>
                    </div>
                </form>

                <script>
                var adminDocIdx = 0;
                function adminAddDoc() {
                    var i = adminDocIdx++;
                    var div = document.createElement('div');
                    div.style.cssText = 'display:flex;align-items:center;gap:10px;margin-bottom:10px;flex-wrap:wrap;';
                    div.id = 'adoc-' + i;
                    div.innerHTML =
                        '<input type="text" name="document_names['+i+']" placeholder="Document Name" style="border:1px solid #ccc;border-radius:4px;padding:7px 12px;font-family:Poppins,sans-serif;font-size:14px;width:200px;">' +
                        '<input type="file" name="documents['+i+']" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.zip">' +
                        '<label style="display:flex;align-items:center;gap:5px;font-family:Poppins,sans-serif;font-size:13px;cursor:pointer;white-space:nowrap;">' +
                            '<input type="checkbox" name="show_to_customer['+i+']" value="1" style="width:15px;height:15px;"> Show to Customer' +
                        '</label>' +
                        '<button type="button" onclick="document.getElementById(\'adoc-'+i+'\').remove()" style="background:#e74c3c;color:#fff;border:none;padding:5px 10px;border-radius:4px;font-size:12px;cursor:pointer;">&#x2715;</button>';
                    document.getElementById('admin-doc-list').appendChild(div);
                }
                // Auto-add one row on load
                document.addEventListener('DOMContentLoaded', adminAddDoc);
                </script>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="ld-bottom-bar"></div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
function ldOpenTab(tabId, el, disabled) {
    if (disabled) return;
    document.querySelectorAll('.ld-tab-content').forEach(c => c.classList.remove('active'));
    document.querySelectorAll('.ld-tab:not(.disabled)').forEach(t => t.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');
    el.classList.add('active');
    if (tabId === 'ld_transactions' && typeof renderTx === 'function') renderTx(1);
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/loan/view.blade.php ENDPATH**/ ?>