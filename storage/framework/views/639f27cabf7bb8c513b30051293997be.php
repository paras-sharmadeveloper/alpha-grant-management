

<?php $__env->startSection('content'); ?>

<?php $date_format = get_option('date_format','Y-m-d'); ?>

<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header panel-title text-center">
				<?php echo e(_lang('Membership Overview')); ?>

			</div>
			
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<td colspan="2" class="profile_picture text-center">
							<img src="<?php echo e(profile_picture($auth->member->photo)); ?>" class="thumb-image-md">
						</td>
					</tr>
					<tr><td><b><?php echo e(_lang('Member No')); ?></b></td><td><b><?php echo e($auth->member->member_no); ?></b></td></tr>
				    <tr><td><?php echo e(_lang('First Name')); ?></td><td><?php echo e($auth->member->first_name); ?></td></tr>
					<tr><td><?php echo e(_lang('Last Name')); ?></td><td><?php echo e($auth->member->last_name); ?></td></tr>
					<tr><td><?php echo e(_lang('Business Name')); ?></td><td><?php echo e($auth->member->business_name); ?></td></tr>			
					<tr><td><?php echo e(_lang('Branch')); ?></td><td><?php echo e($auth->member->branch->name); ?></td></tr>
					<tr><td><?php echo e(_lang('Email')); ?></td><td><?php echo e($auth->member->email); ?></td></tr>
					<tr><td><?php echo e(_lang('Mobile')); ?></td><td><?php echo e($auth->member->country_code.$auth->member->mobile); ?></td></tr>
					<tr><td><?php echo e(_lang('Gender')); ?></td><td><?php echo e($auth->member->gender); ?></td></tr>
					<tr><td><?php echo e(_lang('City')); ?></td><td><?php echo e($auth->member->city); ?></td></tr>
					<tr><td><?php echo e(_lang('State')); ?></td><td><?php echo e($auth->member->state); ?></td></tr>
					<tr><td><?php echo e(_lang('Zip')); ?></td><td><?php echo e($auth->member->zip); ?></td></tr>
					<tr><td><?php echo e(_lang('Address')); ?></td><td><?php echo e($auth->member->address); ?></td></tr>
					<tr><td><?php echo e(_lang('Credit Source')); ?></td><td><?php echo e($auth->member->credit_source); ?></td></tr>
			    </table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/profile/membership_details.blade.php ENDPATH**/ ?>