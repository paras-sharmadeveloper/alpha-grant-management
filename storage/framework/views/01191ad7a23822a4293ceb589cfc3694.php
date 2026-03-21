

<?php $__env->startSection('content'); ?>
<style>
    .kyc-wrap  { max-width:860px; margin:30px auto; font-family:"Poppins",sans-serif; font-size:14px; }
    .kyc-head  { background:#214942; color:#fff; padding:14px 20px; border-radius:6px 6px 0 0; display:flex; align-items:center; justify-content:space-between; }
    .kyc-body  { background:#fff; border:1px solid #ddd; border-top:none; border-radius:0 0 6px 6px; padding:24px; }
    .section-title { font-size:13px; font-weight:600; color:#214942; text-transform:uppercase; letter-spacing:.5px; margin-bottom:14px; border-bottom:2px solid #44a74a; padding-bottom:6px; }
    .badge-Approved,.badge-approved { background:#27ae60; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Declined,.badge-declined { background:#e74c3c; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Review,.badge-review     { background:#f39c12; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-pending                  { background:#aaa;    color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .type-panel { display:none; }
    .type-panel.active { display:block; }
    .form-label { font-size:13px; color:#444; margin-bottom:4px; }
    .history-table th { background:#214942; color:#fff; font-size:12px; font-weight:500; }
    .history-table td { font-size:12px; vertical-align:middle; }
</style>

<div class="kyc-wrap">
    <div class="kyc-head">
        <a href="<?php echo e(auth()->user()->user_type === 'customer' ? route('loans.my_loans') : route('members.show', $member->id)); ?>" class="btn btn-sm"
           style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.4);font-size:12px;">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
        <span style="flex:1;text-align:center;font-size:15px;">
            KYC Verification — <?php echo e($member->first_name); ?> <?php echo e($member->last_name); ?>

        </span>
        <span style="width:70px;"></span>
    </div>

    <div class="kyc-body">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?><div><?php echo e($e); ?></div><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="section-title">Submit Verification</div>

        <form action="<?php echo e(route('kyc.submit', $member->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Verification Type <span class="text-danger">*</span></label>
                        <select name="type" id="kyc_type" class="form-control" required>
                            <option value="">— Select Type —</option>
                            <option value="id_verification">ID Verification (Document OCR)</option>
                            <option value="poa">Proof of Address</option>
                            <option value="passive_liveness">Passive Liveness</option>
                            <option value="face_search">Face Search</option>
                            <option value="age_estimation">Age Estimation</option>
                        </select>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->user_type !== 'customer'): ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Link to Loan (optional)</label>
                        <select name="loan_id" class="form-control">
                            <option value="">— None —</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <option value="<?php echo e($loan->id); ?>">Loan #<?php echo e($loan->loan_id ?? $loan->id); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div id="panel_id_verification" class="type-panel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Front Image <span class="text-danger">*</span></label>
                            <input type="file" name="front_image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.tiff">
                            <small class="text-muted">JPEG, PNG, WebP, TIFF — max 15MB</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Back Image (optional)</label>
                            <input type="file" name="back_image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.tiff">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Expiry Not Detected</label>
                            <select name="expiration_date_not_detected_action" class="form-control form-control-sm">
                                <option value="DECLINE">DECLINE</option>
                                <option value="NO_ACTION">NO_ACTION</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Invalid MRZ Action</label>
                            <select name="invalid_mrz_action" class="form-control form-control-sm">
                                <option value="DECLINE">DECLINE</option>
                                <option value="NO_ACTION">NO_ACTION</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Inconsistent Data</label>
                            <select name="inconsistent_data_action" class="form-control form-control-sm">
                                <option value="DECLINE">DECLINE</option>
                                <option value="NO_ACTION">NO_ACTION</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            
            <div id="panel_poa" class="type-panel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Document <span class="text-danger">*</span></label>
                            <input type="file" name="document" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png,.webp,.tiff">
                            <small class="text-muted">PDF, JPEG, PNG, WebP, TIFF — max 15MB</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Expected Country</label>
                            <input type="text" name="expected_country" class="form-control form-control-sm" placeholder="e.g. US">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Expected First Name</label>
                            <input type="text" name="expected_first_name" class="form-control form-control-sm" value="<?php echo e($member->first_name); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Expected Last Name</label>
                            <input type="text" name="expected_last_name" class="form-control form-control-sm" value="<?php echo e($member->last_name); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Expected Address</label>
                            <input type="text" name="expected_address" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>

            
            <div id="panel_passive_liveness" class="type-panel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Face Image <span class="text-danger">*</span></label>
                            <input type="file" name="user_image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.tiff">
                            <small class="text-muted">JPEG, PNG, WebP, TIFF — max 5MB</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Liveness Score Decline Threshold (0–100)</label>
                            <input type="number" name="face_liveness_score_decline_threshold" class="form-control form-control-sm" value="30" min="0" max="100">
                        </div>
                    </div>
                </div>
            </div>

            
            <div id="panel_face_search" class="type-panel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Face Image <span class="text-danger">*</span></label>
                            <input type="file" name="user_image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.tiff">
                            <small class="text-muted">JPEG, PNG, WebP, TIFF — max 5MB</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Search Type</label>
                            <select name="search_type" class="form-control form-control-sm">
                                <option value="most_similar">Most Similar</option>
                                <option value="blocklisted_or_approved">Blocklisted or Approved</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            
            <div id="panel_age_estimation" class="type-panel">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Face Image <span class="text-danger">*</span></label>
                            <input type="file" name="user_image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.tiff">
                            <small class="text-muted">JPEG, PNG, WebP, TIFF — max 5MB</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Liveness Score Threshold (0–100)</label>
                            <input type="number" name="face_liveness_score_decline_threshold" class="form-control form-control-sm" value="30" min="0" max="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Min Age Threshold</label>
                            <input type="number" name="age_estimation_decline_threshold" class="form-control form-control-sm" value="18" min="0" max="120">
                        </div>
                    </div>
                </div>
            </div>

            <div id="submit_btn" style="display:none; margin-top:8px;">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-paper-plane mr-1"></i> Submit Verification
                </button>
            </div>
        </form>

        
        <div class="section-title mt-4" style="display:flex;align-items:center;justify-content:space-between;">
            <span>Recent Verifications</span>
            <a href="<?php echo e(auth()->user()->user_type === 'customer' ? route('customer.kyc.history', $member->id) : route('kyc.history', $member->id)); ?>" style="font-size:12px;color:#44a74a;font-weight:400;text-transform:none;letter-spacing:0;">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($verifications->isEmpty()): ?>
            <p class="text-muted" style="font-size:13px;">No verifications submitted yet.</p>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered history-table">
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
                        <th>Raw</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $verifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <?php
                        $typeKey  = $v->type; // e.g. age_estimation
                        $nested   = $v->response_data[$typeKey] ?? null;
                        $warnings = $nested['warnings'] ?? [];
                        $nestedStatus = $nested['status'] ?? null;
                        $displayStatus = $nestedStatus ?? $v->status ?? 'Unknown';

                        // Extra result fields per type
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
                        <td style="font-size:11px;color:#888;max-width:140px;word-break:break-all;"><?php echo e($v->verification_request_id ?? '—'); ?></td>
                        <td>
                            <?php $s = ucfirst(strtolower($displayStatus)); ?>
                            <span class="badge-<?php echo e($s); ?>"><?php echo e($s); ?></span>
                        </td>
                        <td style="font-size:11px;max-width:220px;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($extras): ?>
                                <div style="margin-bottom:4px;"><?php echo e(implode(' · ', $extras)); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $warnings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <div style="background:#fff3cd;border-left:3px solid #f39c12;padding:3px 7px;margin-bottom:3px;border-radius:3px;">
                                    <span style="font-weight:600;color:#856404;"><?php echo e($w['risk'] ?? ''); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($w['short_description'])): ?>
                                        <br><span style="color:#555;"><?php echo e($w['short_description']); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($warnings) && empty($extras)): ?> — <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td style="font-size:11px;color:#888;"><?php echo e($v->vendor_data); ?></td>
                        <td style="font-size:11px;"><?php echo e($v->created_at->format('d M Y H:i')); ?></td>
                        <td>
                            <button class="btn btn-xs btn-outline-secondary"
                                    data-toggle="modal"
                                    data-target="#modal_<?php echo e($v->id); ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $verifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <div class="modal fade" id="modal_<?php echo e($v->id); ?>" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background:#214942;color:#fff;">
                        <h6 class="modal-title">Response — <?php echo e(str_replace('_',' ',ucfirst($v->type))); ?> #<?php echo e($v->id); ?></h6>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <pre style="font-size:11px;background:#f8f9fa;padding:12px;border-radius:4px;max-height:400px;overflow:auto;"><?php echo e(json_encode($v->response_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></pre>
                    </div>
                </div>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
document.getElementById('kyc_type').addEventListener('change', function () {
    var type = this.value;
    document.querySelectorAll('.type-panel').forEach(function (p) {
        p.classList.remove('active');
    });
    document.getElementById('submit_btn').style.display = 'none';
    if (type) {
        var panel = document.getElementById('panel_' + type);
        if (panel) {
            panel.classList.add('active');
            document.getElementById('submit_btn').style.display = 'block';
        }
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/member/kyc.blade.php ENDPATH**/ ?>