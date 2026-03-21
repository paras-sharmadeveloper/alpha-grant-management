

<?php $__env->startSection('content'); ?>
<style>
    .kyc-top-bar { background:#214942; text-align:center; padding:15px; color:#fff; font-family:"Poppins",sans-serif; font-size:14px; font-weight:400; text-transform:capitalize; }
    .kyc-bottom-bar { background:#214942; height:40px; margin-top:20px; }
    .kyc-body { width:85%; margin:20px auto; font-family:"Poppins",sans-serif; font-size:14px; }
    .kyc-row { display:flex; justify-content:space-between; padding:14px 0; border-bottom:1px solid #eee; font-size:14px; font-family:"Poppins",sans-serif; }
    .kyc-label { color:#2c3e50; font-weight:400; text-transform:capitalize; }
    .kyc-value { color:#214942; font-weight:400; }
    .kyc-section-title { font-size:13px; font-weight:600; color:#214942; text-transform:uppercase; letter-spacing:1px; margin:20px 0 8px; border-left:3px solid #44a74a; padding-left:10px; }
</style>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body p-0">

            <div class="kyc-top-bar">
                <?php echo e(_lang('KYC')); ?> &mdash; <?php echo e($member->first_name.' '.$member->last_name); ?>

            </div>

            <div class="kyc-body">

                <div class="kyc-section-title"><?php echo e(_lang('Personal Information')); ?></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Full Name')); ?></span><span class="kyc-value"><?php echo e($member->first_name.' '.$member->last_name); ?></span></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Member No')); ?></span><span class="kyc-value"><?php echo e($member->member_no ?? '—'); ?></span></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Email')); ?></span><span class="kyc-value"><?php echo e($member->email ?? '—'); ?></span></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Mobile')); ?></span><span class="kyc-value"><?php echo e(($member->country_code ? '+'.$member->country_code.' ' : '').$member->mobile); ?></span></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Gender')); ?></span><span class="kyc-value"><?php echo e(ucfirst($member->gender ?? '—')); ?></span></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Business Name')); ?></span><span class="kyc-value"><?php echo e($member->business_name ?? '—'); ?></span></div>

                <div class="kyc-section-title"><?php echo e(_lang('Address')); ?></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Address')); ?></span><span class="kyc-value"><?php echo e($member->address ?? '—'); ?></span></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('City')); ?></span><span class="kyc-value"><?php echo e($member->city ?? '—'); ?></span></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('State')); ?></span><span class="kyc-value"><?php echo e($member->state ?? '—'); ?></span></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Zip')); ?></span><span class="kyc-value"><?php echo e($member->zip ?? '—'); ?></span></div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->credit_source): ?>
                <div class="kyc-section-title"><?php echo e(_lang('Credit Information')); ?></div>
                <div class="kyc-row"><span class="kyc-label"><?php echo e(_lang('Credit Source')); ?></span><span class="kyc-value"><?php echo e($member->credit_source); ?></span></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->photo): ?>
                <div class="kyc-section-title"><?php echo e(_lang('Photo')); ?></div>
                <div style="padding:16px 0;">
                    <img src="<?php echo e(asset('public/uploads/media/'.$member->photo)); ?>" style="max-width:120px;border-radius:8px;border:2px solid #214942;">
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($memberDocuments->isNotEmpty()): ?>
                <div class="kyc-section-title"><?php echo e(_lang('Documents')); ?></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $memberDocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="kyc-row">
                    <span class="kyc-label"><?php echo e($doc->name); ?></span>
                    <span class="kyc-value">
                        <a href="<?php echo e(asset('public/uploads/media/'.$doc->document)); ?>" target="_blank"><?php echo e(_lang('View')); ?></a>
                    </span>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div style="margin-top:24px;">
                    <a href="<?php echo e(route('loans.show', $loan->id)); ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i><?php echo e(_lang('Back')); ?>

                    </a>
                </div>

            </div>

            <div class="kyc-bottom-bar"></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/loan/kyc.blade.php ENDPATH**/ ?>