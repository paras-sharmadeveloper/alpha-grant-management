

<?php $__env->startSection('content'); ?>
<style>
    .kyc-top-bar  { background:#214942; text-align:center; padding:15px; color:#fff; font-family:"Poppins",sans-serif; font-size:14px; font-weight:400; }
    .kyc-bottom-bar { background:#214942; height:8px; border-radius:0 0 6px 6px; }
    .kyc-body     { padding:24px; font-family:"Poppins",sans-serif; font-size:14px; }
    .kyc-section  { margin-bottom:20px; }
    .kyc-section-title { font-size:12px; font-weight:600; color:#214942; text-transform:uppercase; letter-spacing:.8px; border-left:3px solid #44a74a; padding-left:8px; margin-bottom:12px; }
    .kyc-row      { display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #f0f0f0; }
    .kyc-label    { color:#666; font-size:13px; }
    .kyc-value    { color:#214942; font-size:13px; font-weight:500; text-align:right; }
    .badge-Approved,.badge-approved { background:#27ae60; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Declined,.badge-declined { background:#e74c3c; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Review,.badge-review     { background:#f39c12; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-pending,.badge-Unknown   { background:#aaa;    color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .vh-table th  { background:#214942; color:#fff; font-size:12px; font-weight:500; }
    .vh-table td  { font-size:12px; vertical-align:middle; }
</style>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body p-0">

            <div class="kyc-top-bar">
                <?php echo e(_lang('KYC')); ?> &mdash; <?php echo e($member->first_name.' '.$member->last_name); ?>

                <span style="font-size:12px;opacity:.7;margin-left:10px;">Loan #<?php echo e($loan->loan_id); ?></span>
            </div>

            <div class="kyc-body">

                
                <div class="row">
                    <div class="col-md-6">
                        <div class="kyc-section">
                            <div class="kyc-section-title"><?php echo e(_lang('Personal Information')); ?></div>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Full Name')); ?></span><span class="kyc-value"><?php echo e($member->first_name.' '.$member->last_name); ?></span></div>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Member No')); ?></span><span class="kyc-value"><?php echo e($member->member_no ?? '—'); ?></span></div>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Email')); ?></span><span class="kyc-value"><?php echo e($member->email ?? '—'); ?></span></div>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Mobile')); ?></span><span class="kyc-value"><?php echo e(($member->country_code ? '+'.$member->country_code.' ' : '').$member->mobile); ?></span></div>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Gender')); ?></span><span class="kyc-value"><?php echo e(ucfirst($member->gender ?? '—')); ?></span></div>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Business Name')); ?></span><span class="kyc-value"><?php echo e($member->business_name ?? '—'); ?></span></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->credit_source): ?>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Credit Source')); ?></span><span class="kyc-value"><?php echo e($member->credit_source); ?></span></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->kyc_status): ?>
                            <div class="kyc-row">
                                <span class="kyc-label"><?php echo e(_lang('KYC Status')); ?></span>
                                <span class="kyc-value">
                                    <?php $ks = ucfirst(strtolower($member->kyc_status)); ?>
                                    <span class="badge-<?php echo e($ks); ?>"><?php echo e($ks); ?></span>
                                </span>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="kyc-section">
                            <div class="kyc-section-title"><?php echo e(_lang('Address')); ?></div>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Address')); ?></span><span class="kyc-value"><?php echo e($member->address ?? '—'); ?></span></div>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('City')); ?></span><span class="kyc-value"><?php echo e($member->city ?? '—'); ?></span></div>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('State')); ?></span><span class="kyc-value"><?php echo e($member->state ?? '—'); ?></span></div>
                            <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Zip')); ?></span><span class="kyc-value"><?php echo e($member->zip ?? '—'); ?></span></div>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->photo): ?>
                        <div class="kyc-section">
                            <div class="kyc-section-title"><?php echo e(_lang('Photo')); ?></div>
                            <img src="<?php echo e(asset('public/uploads/media/'.$member->photo)); ?>"
                                 style="max-width:100px;border-radius:6px;border:2px solid #214942;"
                                 onerror="this.onerror=null;this.src='<?php echo e(asset('public/backend/images/avatar.png')); ?>';">
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($memberDocuments->isNotEmpty()): ?>
                        <div class="kyc-section">
                            <div class="kyc-section-title"><?php echo e(_lang('Documents')); ?></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $memberDocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <div class="kyc-row">
                                <span class="kyc-label"><?php echo e($doc->name); ?></span>
                                <span class="kyc-value">
                                    <a href="<?php echo e(asset('public/uploads/media/'.$doc->document)); ?>" target="_blank"><?php echo e(_lang('View')); ?></a>
                                </span>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                
                <div class="kyc-section-title mt-3"><?php echo e(_lang('Verification History')); ?></div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($verifications->isEmpty()): ?>
                    <p class="text-muted" style="font-size:13px;"><?php echo e(_lang('No verifications submitted yet.')); ?></p>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered vh-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Loan</th>
                                <th>Request ID</th>
                                <th>Status</th>
                                <th>Result / Warnings</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $verifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <?php
                                $typeKey      = $v->type;
                                $nested       = $v->response_data[$typeKey] ?? null;
                                $warnings     = $nested['warnings'] ?? [];
                                $nestedStatus = $nested['status'] ?? null;
                                $displayStatus = ucfirst(strtolower($nestedStatus ?? $v->status ?? 'Unknown'));
                                $extras = [];
                                if ($typeKey === 'age_estimation' && isset($nested['age_estimation'])) {
                                    $extras[] = 'Age: ' . round($nested['age_estimation'], 1);
                                }
                                if (isset($nested['score']) && $nested['score'] !== null) {
                                    $extras[] = 'Score: ' . $nested['score'];
                                }
                            ?>
                            <tr>
                                <td><?php echo e($v->id); ?></td>
                                <td><?php echo e(str_replace('_', ' ', ucfirst($v->type))); ?></td>
                                <td><?php echo e($v->loan_id ? '#'.$v->loan_id : '—'); ?></td>
                                <td style="max-width:130px;word-break:break-all;color:#888;"><?php echo e($v->verification_request_id ?? '—'); ?></td>
                                <td><span class="badge-<?php echo e($displayStatus); ?>"><?php echo e($displayStatus); ?></span></td>
                                <td style="max-width:200px;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($extras): ?><div style="margin-bottom:3px;"><?php echo e(implode(' · ', $extras)); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $warnings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <div style="background:#fff3cd;border-left:3px solid #f39c12;padding:3px 7px;margin-bottom:3px;border-radius:3px;">
                                        <span style="font-weight:600;color:#856404;"><?php echo e($w['risk'] ?? ''); ?></span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($w['short_description'])): ?><br><span style="color:#555;"><?php echo e($w['short_description']); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($warnings) && empty($extras)): ?>—<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td><?php echo e($v->created_at->format('d M Y H:i')); ?></td>
                                <td>
                                    <button class="btn btn-xs btn-outline-secondary" data-toggle="modal" data-target="#vmodal_<?php echo e($v->id); ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-2" style="border-left:3px solid #214942;border-right:3px solid #214942;padding:10px 12px;border-radius:0 0 4px 4px;"><?php echo e($verifications->links()); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div style="margin-top:20px;">
                    <a href="<?php echo e(route('loans.show', $loan->id)); ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i><?php echo e(_lang('Back')); ?>

                    </a>
                    <a href="<?php echo e(route('kyc.show', $member->id)); ?>" class="btn btn-sm" style="background:#214942;color:#fff;">
                        <i class="ti-id-badge mr-1"></i><?php echo e(_lang('Run Verification')); ?>

                    </a>
                </div>

            </div>

            <div class="kyc-bottom-bar"></div>
        </div>
    </div>
</div>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $verifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
<div class="modal fade" id="vmodal_<?php echo e($v->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#214942;color:#fff;">
                <h6 class="modal-title"><?php echo e(str_replace('_',' ',ucfirst($v->type))); ?> — Response #<?php echo e($v->id); ?></h6>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <pre style="font-size:11px;background:#f8f9fa;padding:12px;border-radius:4px;max-height:400px;overflow:auto;"><?php echo e(json_encode($v->response_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></pre>
            </div>
        </div>
    </div>
</div>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/loan/kyc.blade.php ENDPATH**/ ?>