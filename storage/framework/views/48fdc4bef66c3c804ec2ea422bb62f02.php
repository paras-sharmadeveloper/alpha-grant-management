<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="<?php echo e($alert_col); ?>">
		<div class="card">
		    <div class="card-header text-center">
				<span class="panel-title"><?php echo e(_lang('Compose New Message')); ?></span>
			</div>
			<div class="card-body">
                <form action="<?php echo e(route('messages.send')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="recipient"><?php echo e(_lang('Recipient')); ?></label>
                        <select name="recipient_id" class="form-control select2 auto-select no-msg" data-selected="<?php echo e(old('recipient_id')); ?>" required>
                            <option value=""><?php echo e(_lang('Select One')); ?></option>
                            <?php $__currentLoopData = \App\Models\User::where('id', '!=', auth()->id())->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subject"><?php echo e(_lang('Subject')); ?></label>
                        <input type="text" name="subject" class="form-control" value="<?php echo e(old('subject')); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="body"><?php echo e(_lang('Message')); ?></label>
                        <textarea name="body" class="form-control" rows="5" required><?php echo e(old('body')); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="attachments"><?php echo e(_lang('Attachments')); ?></label>
                        <input type="file" name="attachments[]" class="file-uploader" data-placeholder="<?php echo e(_lang('Attachments')); ?>" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-2"></i><?php echo e(_lang('Send')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/messages/compose.blade.php ENDPATH**/ ?>