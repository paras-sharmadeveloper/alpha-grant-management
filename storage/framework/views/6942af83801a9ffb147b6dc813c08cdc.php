<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <span class="header-title"><?php echo e(_lang('User Details')); ?></span>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" class="text-center"><img class="thumb-xl rounded" src="<?php echo e(profile_picture($user->profile_picture)); ?>"></td>
                    </tr>
                    <tr>
                        <td><?php echo e(_lang('Name')); ?></td>
                        <td><?php echo e($user->name); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(_lang('Email')); ?></td>
                        <td><?php echo e($user->email); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(_lang('Status')); ?></td>
                        <td><?php echo xss_clean(user_status($user->status)); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(_lang('Phone')); ?></td>
                        <td><?php echo e($user->country_code.$user->mobile); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(_lang('City')); ?></td>
                        <td><?php echo e($user->city); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(_lang('State')); ?></td>
                        <td><?php echo e($user->state); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(_lang('ZIP')); ?></td>
                        <td><?php echo e($user->zip); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(_lang('Address')); ?></td>
                        <td><?php echo e($user->address); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo e(_lang('Registered At')); ?></td>
                        <td><?php echo e($user->created_at); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/user/view.blade.php ENDPATH**/ ?>