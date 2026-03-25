<table class="table table-sm table-bordered mb-0" style="font-family:Poppins,sans-serif;font-size:13px;">
    <tbody>
        <tr><td class="text-muted" style="width:35%;background:#f8f9fa;">Request ID</td><td style="word-break:break-all;"><?php echo e($rd['request_id'] ?? '—'); ?></td></tr>
        <tr><td class="text-muted" style="background:#f8f9fa;">Type</td><td><?php echo e(str_replace('_',' ',ucfirst($v->type))); ?></td></tr>
        <tr>
            <td class="text-muted" style="background:#f8f9fa;">Status</td>
            <td>
                <?php $s = ucfirst(strtolower($nested['status'] ?? $v->status ?? 'Unknown')); ?>
                <span class="badge-<?php echo e($s); ?>"><?php echo e($s); ?></span>
            </td>
        </tr>
        <tr><td class="text-muted" style="background:#f8f9fa;">Vendor Data</td><td><?php echo e($rd['vendor_data'] ?? '—'); ?></td></tr>
        <tr><td class="text-muted" style="background:#f8f9fa;">Submitted At</td><td><?php echo e($v->created_at->format('d M Y H:i')); ?></td></tr>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($typeKey === 'id_verification'): ?>
            <tr><td class="text-muted" style="background:#f8f9fa;">Full Name</td><td><?php echo e($nested['full_name'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">First Name</td><td><?php echo e($nested['first_name'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Last Name</td><td><?php echo e($nested['last_name'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Date of Birth</td><td><?php echo e($nested['date_of_birth'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Age</td><td><?php echo e($nested['age'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Gender</td><td><?php echo e($nested['gender'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Document Number</td><td><?php echo e($nested['document_number'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Document Type</td><td><?php echo e($nested['document_type'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Date of Issue</td><td><?php echo e($nested['date_of_issue'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Expiration Date</td><td><?php echo e($nested['expiration_date'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Issuing State</td><td><?php echo e(($nested['issuing_state'] ?? '—') . ' ' . ($nested['issuing_state_name'] ?? '')); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Nationality</td><td><?php echo e($nested['nationality'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Address</td><td><?php echo e($nested['formatted_address'] ?? $nested['address'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Marital Status</td><td><?php echo e($nested['marital_status'] ?? '—'); ?></td></tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($nested['front_image_quality_score'])): ?>
            <tr>
                <td class="text-muted" style="background:#f8f9fa;">Image Quality</td>
                <td>
                    Overall: <?php echo e($nested['front_image_quality_score']['overall_score'] ?? '—'); ?> &nbsp;|&nbsp;
                    Focus: <?php echo e($nested['front_image_quality_score']['focus_score'] ?? '—'); ?> &nbsp;|&nbsp;
                    Brightness: <?php echo e($nested['front_image_quality_score']['brightness_score'] ?? '—'); ?>

                </td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($nested['portrait_image'])): ?>
            <tr><td class="text-muted" style="background:#f8f9fa;">Portrait</td>
                <td><a href="<?php echo e($nested['portrait_image']); ?>" target="_blank">
                    <img src="<?php echo e($nested['portrait_image']); ?>" style="height:70px;border-radius:4px;border:1px solid #ddd;" onerror="this.style.display='none'">
                </a></td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($nested['front_image'])): ?>
            <tr><td class="text-muted" style="background:#f8f9fa;">Front Image</td>
                <td><a href="<?php echo e($nested['front_image']); ?>" target="_blank">
                    <img src="<?php echo e($nested['front_image']); ?>" style="height:70px;border-radius:4px;border:1px solid #ddd;" onerror="this.style.display='none'">
                </a></td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($nested['back_image'])): ?>
            <tr><td class="text-muted" style="background:#f8f9fa;">Back Image</td>
                <td><a href="<?php echo e($nested['back_image']); ?>" target="_blank">
                    <img src="<?php echo e($nested['back_image']); ?>" style="height:70px;border-radius:4px;border:1px solid #ddd;" onerror="this.style.display='none'">
                </a></td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php elseif($typeKey === 'age_estimation'): ?>
            <tr><td class="text-muted" style="background:#f8f9fa;">Estimated Age</td><td><?php echo e($nested['age_estimation'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Method</td><td><?php echo e($nested['method'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Score</td><td><?php echo e($nested['score'] ?? '—'); ?></td></tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($nested['user_image']['entities'])): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $nested['user_image']['entities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <tr>
                    <td class="text-muted" style="background:#f8f9fa;">Detected Entity</td>
                    <td>Age: <?php echo e($ent['age'] ?? '—'); ?> &nbsp;|&nbsp; Gender: <?php echo e($ent['gender'] ?? '—'); ?> &nbsp;|&nbsp; Confidence: <?php echo e($ent['confidence'] ?? '—'); ?></td>
                </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php elseif($typeKey === 'passive_liveness'): ?>
            <tr><td class="text-muted" style="background:#f8f9fa;">Score</td><td><?php echo e($nested['score'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Method</td><td><?php echo e($nested['method'] ?? '—'); ?></td></tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($nested['portrait_image'])): ?>
            <tr><td class="text-muted" style="background:#f8f9fa;">Portrait</td>
                <td><a href="<?php echo e($nested['portrait_image']); ?>" target="_blank">
                    <img src="<?php echo e($nested['portrait_image']); ?>" style="height:70px;border-radius:4px;border:1px solid #ddd;" onerror="this.style.display='none'">
                </a></td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php elseif($typeKey === 'poa'): ?>
            <tr><td class="text-muted" style="background:#f8f9fa;">Full Name</td><td><?php echo e($nested['full_name'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Address</td><td><?php echo e($nested['formatted_address'] ?? $nested['address'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Issuing Country</td><td><?php echo e($nested['issuing_country'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Issue Date</td><td><?php echo e($nested['issue_date'] ?? '—'); ?></td></tr>

        <?php elseif($typeKey === 'face_search'): ?>
            <tr><td class="text-muted" style="background:#f8f9fa;">Score</td><td><?php echo e($nested['score'] ?? '—'); ?></td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Match Found</td><td><?php echo e(isset($nested['match_found']) ? ($nested['match_found'] ? 'Yes' : 'No') : '—'); ?></td></tr>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
</table>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($warnings)): ?>
<div class="p-3" style="border-top:1px solid #dee2e6;">
    <div style="font-size:12px;font-weight:600;color:#856404;margin-bottom:6px;">Warnings</div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $warnings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
    <div style="background:#fff3cd;border-left:3px solid #f39c12;padding:6px 10px;margin-bottom:6px;border-radius:3px;font-size:12px;">
        <strong><?php echo e($w['feature'] ?? ''); ?><?php echo e(!empty($w['risk']) ? ' — '.$w['risk'] : ''); ?></strong>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($w['short_description'])): ?><br><?php echo e($w['short_description']); ?><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($w['long_description'])): ?><br><span style="color:#777;font-size:11px;"><?php echo e($w['long_description']); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/member/_kyc_detail_table.blade.php ENDPATH**/ ?>