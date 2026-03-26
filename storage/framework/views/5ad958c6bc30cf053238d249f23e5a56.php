

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-tools" style="font-size: 4rem; color: #ccc;"></i>
                <h2 class="mt-4"><?php echo e(_lang($title)); ?></h2>
                <p class="text-muted mt-2"><?php echo e(_lang('This feature is coming soon. We are working hard to bring it to you.')); ?></p>
                <span class="badge badge-warning mt-2" style="font-size: 0.9rem; padding: 6px 14px;"><?php echo e(_lang('Coming Soon')); ?></span>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/coming_soon.blade.php ENDPATH**/ ?>