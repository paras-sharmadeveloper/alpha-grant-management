<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 dashboard-card">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5><?php echo e(_lang('Total Members')); ?></h5>
						<h4 class="pt-1 mb-0"><b><?php echo e($total_tenant); ?></b></h4>
					</div>
					<div class="ml-2 text-center">
						<i class="fas fa-users bg-primary text-white"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 dashboard-card">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5><?php echo e(_lang('Trial Members')); ?></h5>
						<h4 class="pt-1 mb-0"><b><?php echo e($trial_tenant); ?></b></h4>
					</div>
					<div class="ml-2 text-center">
						<i class="fas fa-user-clock bg-info text-white"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 dashboard-card">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5><?php echo e(_lang('Paid Members')); ?></h5>
						<h4 class="pt-1 mb-0"><b><?php echo e($paid_tenant); ?></b></h4>
					</div>
					<div class="ml-2 text-center">
						<i class="fas fa-user-shield bg-success text-white"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="card mb-4 dashboard-card">
			<div class="card-body">
				<div class="d-flex">
					<div class="flex-grow-1">
						<h5><?php echo e(_lang('Active Members')); ?></h5>
						<h4 class="pt-1 mb-0"><b><?php echo e($active_tenant); ?></b></h4>
					</div>
					<div class="ml-2 text-center">
						<i class="fas fa-user-check bg-primary text-white"></i>
					</div>
				</div>
			</div>
		</div>
	</div>



</div>

<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<span><?php echo e(_lang('Monthly Signup').' - '.date('Y')); ?></span>
			</div>
			<div class="card-body">
				<h5 class="text-center loading-chart"><i class="fas fa-spinner fa-spin"></i> <?php echo e(_lang('Loading Chart')); ?></h5>
				<canvas id="signUpAnalysis"></canvas>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<span><?php echo e(_lang('Subscription Payments').' - '.date('Y')); ?></span>
			</div>
			<div class="card-body">
				<h5 class="text-center loading-chart"><i class="fas fa-spinner fa-spin"></i> <?php echo e(_lang('Loading Chart')); ?></h5>
				<canvas id="revenueAnalysis"></canvas>
			</div>
		</div>
	</div>
</div>

<div class="row">
	
	<div class="col-lg-12">
		<div class="card mb-4">
			<div class="card-header">
				<?php echo e(_lang('Recent Tenants')); ?>

			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table">
					<thead>
						<tr>
                            <th class="pl-4"><?php echo e(_lang('Date')); ?></th>
                            <th><?php echo e(_lang('Name')); ?></th>
                            <th><?php echo e(_lang('Package')); ?></th>
                            <th><?php echo e(_lang('Membership')); ?></th>
                            <th><?php echo e(_lang('Status')); ?></th>
                            <th></th>
                        </tr>
					</thead>
					<tbody>
						<?php if($newTenants->count() == 0): ?>
						<tr>
							<td colspan="5" class="text-center"><?php echo e(_lang('No Data Found !')); ?></td>
						</tr>
						<?php endif; ?>
						<?php $__currentLoopData = $newTenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
                            <td class="pl-4"><?php echo e($tenant->created_at); ?></td>
                            <td><?php echo e($tenant->name); ?></td>
                            <td><?php echo e($tenant->package->name); ?></td>
                            <td><?php echo e(ucwords($tenant->membership_type)); ?></td>
                            <td><?php echo xss_clean(status($tenant->status)); ?></td>
							<td>
								<a href="<?php echo e(route('admin.tenants.show', $tenant->id)); ?>" class="btn btn-outline-primary btn-xs"><?php echo e(_lang('Details')); ?></a>
							</td>
							</td>
                        </tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script src="<?php echo e(asset('public/backend/plugins/chartJs/chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend/assets/js/dashboard-admin.js?v=1.0')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/dashboard-superadmin.blade.php ENDPATH**/ ?>