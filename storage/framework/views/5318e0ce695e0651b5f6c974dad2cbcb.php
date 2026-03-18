<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="<?php echo e($alert_col); ?>">
        <div class="card">
		    <div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Inbox')); ?></span>
			</div>
			<div class="card-body px-0 pt-0">
                <?php if($messages->isEmpty()): ?>
                    <p class="text-center py-3"><?php echo e(_lang('No message found !')); ?></p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover border-bottom">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-dark pl-4"><?php echo e(_lang('Sender')); ?></th>
                                    <th class="text-dark"><?php echo e(_lang('Subject')); ?></th>
                                    <th class="text-dark"><?php echo e(_lang('Date')); ?></th>
                                    <th class="text-dark"><?php echo e(_lang('Status')); ?></th>
                                    <th class="text-dark"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $readStatus = isset($message->lastReplies()->status) ? 'font-weight-bolder' : ''; ?>
                                    <tr>
                                        <td class="pl-4 <?php echo e($readStatus); ?>"><?php echo e($message->sender->name); ?></td>
                                        <td class="<?php echo e($readStatus); ?>"><?php echo e($message->subject); ?></td>
                                        <td class="<?php echo e($readStatus); ?>"><?php echo e($message->created_at->format('M d, Y h:i A')); ?></td>
                                        <td class="<?php echo e($readStatus); ?>"><?php echo e(isset($message->lastReplies()->status) ? ucfirst($message->lastReplies()->status) : ucfirst($message->status)); ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-xs" href="<?php echo e(route('messages.show', $message->uuid)); ?>">
                                                <?php echo e(_lang('View Message')); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination pl-2">
                        <?php echo e($messages->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/messages/inbox.blade.php ENDPATH**/ ?>