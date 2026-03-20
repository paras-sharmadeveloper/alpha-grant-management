

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
    .ld-summary-item { flex: 1; display: flex; flex-direction: column; gap: 8px; }
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
                        <span class="ld-value"><?php echo e(decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name))); ?></span>
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
                        <span class="ld-value"><?php echo e($loan->loan_product->interest_rate); ?>%</span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Loan Term')); ?></span>
                        <span class="ld-value"><?php echo e($loan->loan_product->term); ?> <?php echo e(preg_replace('/^\+\d+\s*/', '', $loan->loan_product->term_period)); ?></span>
                    </div>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Total Principal Paid')); ?></span>
                        <span class="ld-value" style="color:#44a74a;"><?php echo e(decimalPlace($loan->total_paid, currency($loan->currency->name))); ?></span>
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
                    <a href="<?php echo e(route('loans.edit', $loan->id)); ?>" class="btn btn-warning btn-sm">
                        <i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit Loan')); ?>

                    </a>
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
                            <input type="date" id="stmt-from" style="border:1px solid #ccc;border-radius:4px;padding:8px 12px;font-family:Poppins,sans-serif;font-size:14px;color:#214942;">
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
                <script>
                    const adminPrintBase = "<?php echo e(route('loans.print_schedule', $loan->id)); ?>";
                    function filterStatements() {
                        const from=document.getElementById('stmt-from').value, to=document.getElementById('stmt-to').value;
                        const btn=document.getElementById('stmt-filtered-btn');
                        if(from||to){
                            const p=[]; if(from)p.push('from='+from); if(to)p.push('to='+to); p.push('download=1');
                            btn.href=adminPrintBase+'?'+p.join('&'); btn.style.display='';
                        } else { btn.style.display='none'; }
                    }
                    function resetStatements() {
                        document.getElementById('stmt-from').value=''; document.getElementById('stmt-to').value='';
                        document.getElementById('stmt-filtered-btn').style.display='none';
                    }
                </script>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div id="ld_documents" class="ld-tab-content">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPending): ?>
                <div class="ld-pending-notice">⏳ <?php echo e(_lang('Loan is pending approval. Documents will be available once approved.')); ?></div>
                <?php else: ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $loancollaterals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collateral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="ld-detail-row">
                    <span class="ld-label"><?php echo e($collateral->name); ?></span>
                    <span class="ld-value">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($collateral->attachments): ?>
                            <a href="<?php echo e(asset('public/uploads/media/'.$collateral->attachments)); ?>" target="_blank"><?php echo e(_lang('View')); ?></a>
                        <?php else: ?>
                            <?php echo e($collateral->collateral_type); ?> &mdash; <?php echo e(decimalPlace($collateral->estimated_price)); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <p class="text-center mt-4 text-muted" style="font-family:Poppins,sans-serif;font-size:14px;"><?php echo e(_lang('No documents found.')); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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