

<?php $__env->startSection('content'); ?>
<style>
    .vh-head  { background:#214942; color:#fff; padding:14px 20px; border-radius:6px 6px 0 0; display:flex; align-items:center; justify-content:space-between; font-family:"Poppins",sans-serif; font-size:14px; }
    .vh-body  { background:#fff; border:1px solid #ddd; border-top:none; border-radius:0 0 6px 6px; padding:20px; }
    .vh-table th { background:#214942; color:#fff; font-size:12px; font-weight:500; }
    .vh-table td { font-size:12px; vertical-align:middle; }
    .badge-Approved,.badge-approved { background:#27ae60; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Declined,.badge-declined { background:#e74c3c; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Review,.badge-review     { background:#f39c12; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-pending,.badge-Unknown   { background:#aaa;    color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
</style>

<div class="col-lg-12">
    <div style="max-width:1000px;margin:20px auto;">
        <div class="vh-head">
            <a href="<?php echo e(route('kyc.show', $member->id)); ?>" class="btn btn-sm"
               style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.4);font-size:12px;">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
            <span style="flex:1;text-align:center;">
                KYC History — <?php echo e($member->first_name); ?> <?php echo e($member->last_name); ?>

            </span>
            <span style="width:70px;"></span>
        </div>

        <div class="vh-body">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($verifications->isEmpty()): ?>
                <p class="text-muted" style="font-size:13px;">No verifications submitted yet.</p>
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
                            <th>Vendor Data</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $verifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php
                            $typeKey       = $v->type;
                            $nested        = $v->response_data[$typeKey] ?? null;
                            $warnings      = $nested['warnings'] ?? [];
                            $nestedStatus  = $nested['status'] ?? null;
                            $displayStatus = ucfirst(strtolower($nestedStatus ?? $v->status ?? 'Unknown'));
                            $extras = [];
                            if ($typeKey === 'age_estimation' && isset($nested['age_estimation'])) {
                                $extras[] = 'Age: ' . round($nested['age_estimation'], 1);
                            }
                            if (isset($nested['score']) && $nested['score'] !== null) {
                                $extras[] = 'Score: ' . $nested['score'];
                            }
                            if (isset($nested['method'])) {
                                $extras[] = 'Method: ' . $nested['method'];
                            }
                        ?>
                        <tr>
                            <td><?php echo e($v->id); ?></td>
                            <td><?php echo e(str_replace('_', ' ', ucfirst($v->type))); ?></td>
                            <td><?php echo e($v->loan_id ? '#'.$v->loan_id : '—'); ?></td>
                            <td style="max-width:140px;word-break:break-all;color:#888;"><?php echo e($v->verification_request_id ?? '—'); ?></td>
                            <td><span class="badge-<?php echo e($displayStatus); ?>"><?php echo e($displayStatus); ?></span></td>
                            <td style="max-width:220px;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($extras): ?><div style="margin-bottom:3px;"><?php echo e(implode(' · ', $extras)); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $warnings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <div style="background:#fff3cd;border-left:3px solid #f39c12;padding:3px 7px;margin-bottom:3px;border-radius:3px;">
                                    <span style="font-weight:600;color:#856404;"><?php echo e($w['risk'] ?? ''); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($w['short_description'])): ?><br><span style="color:#555;"><?php echo e($w['short_description']); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($warnings) && empty($extras)): ?>—<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td style="font-size:11px;color:#888;"><?php echo e($v->vendor_data); ?></td>
                            <td style="font-size:11px;"><?php echo e($v->created_at->format('d M Y H:i')); ?></td>
                            <td>
                                <button class="btn btn-xs btn-outline-secondary" data-toggle="modal" data-target="#hmodal_<?php echo e($v->id); ?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-2"><?php echo e($verifications->links()); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
    </div>
</div>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $verifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
<div class="modal fade" id="hmodal_<?php echo e($v->id); ?>" tabindex="-1">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/member/kyc_history.blade.php ENDPATH**/ ?>