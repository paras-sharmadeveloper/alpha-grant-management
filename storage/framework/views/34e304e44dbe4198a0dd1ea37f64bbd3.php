<?php $__env->startSection('content'); ?>

<?php $date_format = get_option('date_format','Y-m-d'); ?>

<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
					<span class="panel-title"><?php echo e(_lang('Profile Overview')); ?></span>

					<a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-secondary">
						<i class="ti-arrow-left mr-1"></i> <?php echo e(_lang('Back')); ?>

					</a>
				</div>
			
			<div class="card-body">
				<table class="table table-bordered" width="100%">
					<tbody>
						<tr class="text-center">
							<td colspan="2"><img class="thumb-xl rounded" src="<?php echo e(profile_picture()); ?>"></td>
						</tr>
							<tr>
								<td><?php echo e(_lang('Name')); ?></td>
								<td><?php echo e($profile->name); ?></td>
							</tr>
							<tr>
								<td><?php echo e(_lang('Email')); ?></td>
								<td><?php echo e($profile->email); ?></td>
							</tr>
							<tr>
								<td><?php echo e(_lang('User Type')); ?></td>
								<td><?php echo e(ucwords($profile->user_type)); ?></td>
							</tr>
							<tr>
								<td><?php echo e(_lang('Status')); ?></td>
								<td><?php echo xss_clean(user_status($profile->status)); ?></td>
							</tr>
							<tr>
								<td><?php echo e(_lang('Phone')); ?></td>
								<td><?php echo e($profile->country_code != '' ? '+'.$profile->country_code.' '.$profile->mobile : ''); ?></td>
							</tr>
							<tr>
								<td><?php echo e(_lang('City')); ?></td>
								<td><?php echo e($profile->city); ?></td>
							</tr>
							<tr>
								<td><?php echo e(_lang('State')); ?></td>
								<td><?php echo e($profile->state); ?></td>
							</tr>
							<tr>
								<td><?php echo e(_lang('ZIP')); ?></td>
								<td><?php echo e($profile->zip); ?></td>
							</tr>
							<tr>
								<td><?php echo e(_lang('Address')); ?></td>
								<td><?php echo e($profile->address); ?></td>
							</tr>
							<tr>
								<td><?php echo e(_lang('Registered At')); ?></td>
								<td><?php echo e($profile->created_at); ?></td>
							</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/profile/profile_view.blade.php ENDPATH**/ ?>