<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Notification Templates')); ?></span>
			</div>
			<div class="card-body">
				<table class="table data-table">
					<thead>
						<tr>
							<th><?php echo e(_lang('Name')); ?></th>
							<th><?php echo e(_lang('Template Type')); ?></th>
							<th><?php echo e(_lang('Allowed Channels')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $emailtemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emailtemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr id="row_<?php echo e($emailtemplate->id); ?>">
							<td class='name'><?php echo e(ucwords(str_replace('_',' ',$emailtemplate->name))); ?></td>
							<td class='name'><?php echo e(ucwords($emailtemplate->template_type)); ?></td>
							<td class='status'>
								<?php if($emailtemplate->template_type == 'admin'): ?>
								<?php if($emailtemplate->email_status == 1): ?>
								<?php echo xss_clean(show_status(_lang('Email'), 'primary')); ?>

								<?php endif; ?>

								<?php if($emailtemplate->sms_status == 1): ?>
								<?php echo xss_clean(show_status(_lang('SMS'), 'primary')); ?>

								<?php endif; ?>

								<?php if($emailtemplate->notification_status == 1): ?>
								<?php echo xss_clean(show_status(_lang('App'), 'primary')); ?>

								<?php endif; ?>

								<?php if($emailtemplate->email_status == 0 && $emailtemplate->sms_status == 0 && $emailtemplate->notification_status == 0): ?>
								<?php echo xss_clean(show_status(_lang('None'), 'secondary')); ?>

								<?php endif; ?>
								<?php endif; ?>
							</td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.notification_templates.edit', $emailtemplate->id)); ?>" class="btn btn-primary btn-xs"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/administration/notification_template/list.blade.php ENDPATH**/ ?>