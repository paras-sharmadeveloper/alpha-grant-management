

<?php $__env->startSection('content'); ?>



<style>
    /* Theme colors: sidebar = #214942, active nav = #44a74a */
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
    .ld-bottom-bar {
        background: #214942;
        height: 40px;
        margin-top: 20px;
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
        font-size: 14px;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        letter-spacing: 0;
        text-transform: capitalize;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
    }
    .ld-tab.active {
        color: #214942;
        border-bottom: 3px solid #44a74a;
        font-weight: 400;
    }
    .ld-tab-content { display: none; width: 85%; margin: 20px auto; font-family: "Poppins", sans-serif; }
    .ld-tab-content.active { display: block; }

    /* Summary card */
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

    /* Detail rows */
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

    /* Transactions */
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

    .ld-gen-btn {
        background: #214942;
        color: #fff;
        border: none;
        padding: 16px;
        width: 100%;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 10px;
        font-weight: 600;
        font-size: 17px;
        font-family: "Poppins", sans-serif;
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

            
            <div class="ld-top-bar">
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
                        <span class="ld-label"><?php echo e(_lang('Loan Amount')); ?></span>
                        <span class="ld-value"><?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?></span>
                    </div>

                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Interest Rate')); ?></span>
                        <span class="ld-value"><?php echo e($loan->interest_rate ?? $loan->loan_product->interest_rate); ?>%</span>
                    </div>

                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Loan Term')); ?></span>
                        <span class="ld-value">
                            <?php echo e($loan->term ?? $loan->loan_product->term); ?> <?php echo e(preg_replace('/^\+\d+\s*/', '', $loan->loan_product->term_period)); ?>

                        </span>
                    </div>

                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Late Payment Penalties')); ?></span>
                        <span class="ld-value"><?php echo e($loan->late_payment_penalties); ?>%</span>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->status == 1): ?>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Loan Officer')); ?></span>
                        <span class="ld-value"><?php echo e($loan->approved_by->name); ?></span>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->description): ?>
                    <div class="ld-detail-row">
                        <span class="ld-label"><?php echo e(_lang('Description')); ?></span>
                        <span class="ld-value"><?php echo e($loan->description); ?></span>
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

                </div>

                
                <div style="background:#214942;border-radius:12px;padding:25px 30px;margin-top:25px;text-align:center;font-family:'Poppins',sans-serif;font-size:14px;font-weight:400;letter-spacing:0;">
                    <h5 style="font-weight:400;font-size:14px;margin-bottom:18px;color:#fff;text-transform:capitalize;"><?php echo e(_lang('How do I make extra repayments')); ?></h5>
                    <div style="background:#fff;border-radius:8px;padding:14px 20px;display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;font-size:14px;font-weight:400;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <span style="background:#214942;color:#fff;border-radius:6px;padding:6px 10px;font-weight:400;font-size:14px;">B</span>
                            <span style="text-transform:capitalize;"><?php echo e(_lang('Biller Code')); ?></span>
                        </div>
                        <span><?php echo e($loan->loan_id); ?></span>
                        <span style="border-left:1px solid #ccc;padding-left:20px;text-transform:capitalize;"><?php echo e(_lang('Ref #')); ?></span>
                        <span><?php echo e($loan->borrower->member_no ?? $loan->borrower_id); ?></span>
                    </div>
                    <p style="font-size:14px;font-weight:400;color:rgba(255,255,255,0.75);margin-bottom:15px;text-transform:capitalize;"><?php echo e(_lang('Telephone & Internet Banking - BPAY®')); ?></p>
                    <hr style="border-color:rgba(255,255,255,0.3);">
                    <p style="font-weight:400;font-size:14px;margin-bottom:6px;color:#fff;text-transform:capitalize;"><?php echo e(_lang('Need to change your direct debit details?')); ?></p>
                    <p style="font-size:14px;font-weight:400;color:rgba(255,255,255,0.75);text-transform:capitalize;"><?php echo e(_lang('Contact us Monday to Friday, 8:30am to 6pm.')); ?></p>
                </div>

            </div>

            
            <div id="ld_transactions" class="ld-tab-content">

                <?php
                    // Build all transactions as flat list, each entry has its own date
                    $allTx = [];

                    // Payment entries first (will be sorted desc by date)
                    foreach ($loan->payments as $payment) {
                        $pDate = $payment->getRawOriginal('paid_at');
                        $allTx[] = [
                            'date'   => $pDate,
                            'title'  => _lang('EMI Paid'),
                            'amount' => '+' . decimalPlace($payment->repayment_amount - $payment->interest, currency($loan->currency->name)),
                            'indent' => false,
                        ];
                        if ($payment->interest > 0) {
                            $allTx[] = [
                                'date'   => $pDate,
                                'title'  => _lang('Interest Charged'),
                                'amount' => '-' . decimalPlace($payment->interest, currency($loan->currency->name)),
                                'indent' => true,
                            ];
                        }
                        if ($payment->late_penalties > 0) {
                            $allTx[] = [
                                'date'   => $pDate,
                                'title'  => _lang('Late Penalty'),
                                'amount' => '-' . decimalPlace($payment->late_penalties, currency($loan->currency->name)),
                                'indent' => true,
                            ];
                        }
                    }

                    // Sort payments desc by date (keep indent rows grouped with parent)
                    // Group by payment then sort groups desc
                    $groups = [];
                    $current = [];
                    foreach ($allTx as $tx) {
                        if (!$tx['indent']) {
                            if (!empty($current)) $groups[] = $current;
                            $current = [$tx];
                        } else {
                            $current[] = $tx;
                        }
                    }
                    if (!empty($current)) $groups[] = $current;
                    usort($groups, fn($a, $b) => strtotime($b[0]['date']) - strtotime($a[0]['date']));

                    // Flatten groups back
                    $sortedTx = [];
                    foreach ($groups as $g) {
                        foreach ($g as $row) $sortedTx[] = $row;
                    }

                    // Append disbursement at the bottom (oldest)
                    if ($loan->getRawOriginal('release_date')) {
                        $sortedTx[] = [
                            'date'   => $loan->getRawOriginal('release_date'),
                            'title'  => _lang('Loan Disbursed'),
                            'amount' => '+' . decimalPlace($loan->applied_amount, currency($loan->currency->name)),
                            'indent' => false,
                        ];
                    }
                ?>

                <div id="tx-list"></div>
                <div id="tx-pagination" style="display:flex;justify-content:center;gap:8px;margin:20px 0;flex-wrap:wrap;"></div>

                <script>
                    const txData = <?php echo json_encode($sortedTx, 15, 512) ?>;
                    const TX_PER_PAGE = 5;
                    let txPage = 1;

                    function parseDateStr(dateStr) {
                        const parts = dateStr.split(/[-T ]/);
                        const y = parseInt(parts[0]), m = parseInt(parts[1]) - 1, d = parseInt(parts[2]);
                        const dt = new Date(y, m, d);
                        const days   = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
                        const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                        return days[dt.getDay()] + ', ' + String(d).padStart(2,'0') + ' ' + months[m] + ' ' + y;
                    }

                    function renderTx(page) {
                        txPage = page;
                        const start = (page - 1) * TX_PER_PAGE;
                        const slice = txData.slice(start, start + TX_PER_PAGE);
                        let html = '';
                        if (txData.length === 0) {
                            html = '<p class="text-center mt-4 text-muted" style="font-family:Poppins,sans-serif;font-size:14px;">No transactions found.</p>';
                        }
                        slice.forEach(tx => {
                            const dateStr = tx.date ? parseDateStr(tx.date) : '—';
                            const bg      = tx.indent ? 'background:#fafafa;padding-left:20px;' : '';
                            html += `<div class="ld-transaction" style="${bg}">
                                <div class="ld-tx-left">
                                    <span class="ld-tx-date">${dateStr}</span>
                                    <span class="ld-tx-title">${tx.title}</span>
                                </div>
                                <span class="ld-tx-amount">${tx.amount}</span>
                            </div>`;
                        });
                        document.getElementById('tx-list').innerHTML = html;

                        const totalPages = Math.ceil(txData.length / TX_PER_PAGE);
                        let pHtml = '';
                        for (let i = 1; i <= totalPages; i++) {
                            const active = i === page ? 'background:#214942;color:#fff;' : 'background:#f0f0f0;color:#214942;';
                            pHtml += `<span onclick="renderTx(${i})" style="${active}padding:6px 12px;border-radius:4px;cursor:pointer;font-family:Poppins,sans-serif;font-size:14px;">${i}</span>`;
                        }
                        document.getElementById('tx-pagination').innerHTML = pHtml;
                    }

                    document.addEventListener('DOMContentLoaded', () => renderTx(1));
                </script>
            </div>

            
            <div id="ld_statements" class="ld-tab-content">

                <?php
                    // $repayments passed from controller (global scopes bypassed)
                ?>

                
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
                        <a href="<?php echo e(route('loans.customer_print_schedule', $loan->id)); ?>" target="_blank"
                           style="background:#214942;color:#fff;padding:9px 20px;border-radius:4px;font-size:14px;font-weight:400;text-decoration:none;font-family:Poppins,sans-serif;text-transform:capitalize;">
                            🖨 <?php echo e(_lang('Print Schedule')); ?>

                        </a>
                        <a href="<?php echo e(route('loans.customer_print_schedule', $loan->id)); ?>?download=1" target="_blank"
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
                    const printBase = "<?php echo e(route('loans.customer_print_schedule', $loan->id)); ?>";

                    function filterStatements() {
                        const from = document.getElementById('stmt-from').value;
                        const to   = document.getElementById('stmt-to').value;
                        const isFiltered = from || to;

                        const filteredBtn = document.getElementById('stmt-filtered-btn');
                        if (isFiltered) {
                            let url = printBase;
                            const params = [];
                            if (from) params.push('from=' + from);
                            if (to)   params.push('to=' + to);
                            params.push('download=1');
                            url += '?' + params.join('&');
                            filteredBtn.href = url;
                            filteredBtn.style.display = '';
                        } else {
                            filteredBtn.style.display = 'none';
                        }
                    }

                    function resetStatements() {
                        document.getElementById('stmt-from').value = '';
                        document.getElementById('stmt-to').value   = '';
                        document.getElementById('stmt-filtered-btn').style.display = 'none';
                    }
                </script>
                    }
                </script>
            </div>

            
            <div id="ld_documents" class="ld-tab-content">
                <?php
                    $visibleDocs = $memberDocuments->where('show_to_customer', 1);
                    $hasDocs = $visibleDocs->isNotEmpty() || $loancollaterals->isNotEmpty();
                ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$hasDocs): ?>
                <p class="text-center mt-4 text-muted"><?php echo e(_lang('No documents found.')); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($visibleDocs->isNotEmpty()): ?>
                <div style="font-size:13px;font-weight:600;color:#214942;text-transform:uppercase;letter-spacing:1px;margin:16px 0 8px;border-left:3px solid #44a74a;padding-left:10px;"><?php echo e(_lang('My Documents')); ?></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $visibleDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="ld-detail-row">
                    <span class="ld-label"><?php echo e($doc->name); ?></span>
                    <span class="ld-value" style="display:flex;align-items:center;gap:12px;">
                        <span style="background:#27ae60;color:#fff;font-size:11px;padding:2px 8px;border-radius:10px;"><?php echo e(_lang('On')); ?></span>
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
            </div>

            <div class="ld-bottom-bar"></div>

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

    // Reset transaction pagination when leaving transactions tab
    if (tabId === 'ld_transactions') {
        renderTx(1);
    } else {
        const pg = document.getElementById('tx-pagination');
        if (pg) pg.innerHTML = '';
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/customer/loan/loan_details.blade.php ENDPATH**/ ?>