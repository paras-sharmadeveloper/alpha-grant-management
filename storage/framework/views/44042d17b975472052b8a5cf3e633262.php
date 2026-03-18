<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-4 offset-lg-4">
		<div class="card">
		    <div class="card-header text-center">
				<span class="panel-title"><?php echo e(_lang('Restore Backup')); ?></span>
			</div>
			<div class="card-body">
                <form action="<?php echo e(route('admin.backup.restore')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label for="backup_file"><?php echo e(_lang('Select Backup File')); ?></label>
                        <select name="backup_file" id="backup_file" class="form-control">
                            <option value=""><?php echo e(_lang('Select One')); ?></option>
                            <?php $__currentLoopData = $backupFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($file); ?>"><?php echo e(str_replace('backups/', '', $file)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="upload_file"><?php echo e(_lang('Or Upload Backup File')); ?></label>
                        <input type="file" name="upload_file" id="upload_file" class="file-uploader" data-placeholder="<?php echo e(_lang('Select a file')); ?>">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-undo mr-1"></i><?php echo e(_lang('Restore Backup')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/administration/backup/restore.blade.php ENDPATH**/ ?>