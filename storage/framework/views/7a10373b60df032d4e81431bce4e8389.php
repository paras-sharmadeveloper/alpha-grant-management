<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header text-center">
				<span class="panel-title"><?php echo e(_lang('Send email to all Subscriber')); ?></span>
			</div>
			<div class="card-body">
			    <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('admin.email_subscribers.send_email')); ?>" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Subject')); ?></label>						
                                <input type="text" class="form-control" value="<?php echo e(old('subject')); ?>" name="subject">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Message')); ?></label>						
                                <textarea class="form-control summernote" name="message"><?php echo e(old('message')); ?></textarea>
                            </div>
                        </div>
			
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-2"></i><?php echo e(_lang('Send Email')); ?></button>
								<a href="<?php echo e(url()->previous()); ?>" class="btn btn-dark"><i class="fas fa-undo-alt mr-2"></i><?php echo e(_lang('Back')); ?></a>
							</div>
						</div>
					</div>
			    </form>
			</div>
		</div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/email_subscriber/send-email.blade.php ENDPATH**/ ?>