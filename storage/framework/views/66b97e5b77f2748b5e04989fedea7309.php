<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<span class="panel-title"><?php echo e(_lang('Packages')); ?></span>
				<a class="btn btn-primary btn-xs ml-auto" href="<?php echo e(route('admin.packages.create')); ?>"><i class="ti-plus mr-1"></i><?php echo e(_lang('Add New')); ?></a>
			</div>
			<div class="card-body">
				<table id="packages_table" class="table data-table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Name')); ?></th>
							<th><?php echo e(_lang('Cost')); ?></th>
							<th><?php echo e(_lang('Package Type')); ?></th>
							<th><?php echo e(_lang('Discount')); ?></th>
							<th class="text-center"><?php echo e(_lang('Status')); ?></th>
							<th class="text-center"><?php echo e(_lang('Popular')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr data-id="row_<?php echo e($package->id); ?>">
							<td class='name'><?php echo e($package->name); ?></td>
							<td class='cost'><?php echo e(decimalPlace($package->cost, currency_symbol())); ?></td>
							<td class='package_type'><?php echo e(ucwords($package->package_type)); ?></td>
							<td class='discount'><?php echo e($package->discount); ?>%</td>
							<td class='status text-center'><?php echo xss_clean(status($package->status)); ?></td>
							<td class='is_popular text-center'>
								<?php if($package->is_popular == 1): ?>
								<?php echo xss_clean(show_status(_lang('Yes'), 'success')); ?>

								<?php else: ?>
								<?php echo xss_clean(show_status(_lang('No'), 'danger')); ?>

								<?php endif; ?>
							</td>
							
							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-outline-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <?php echo e(_lang('Action')); ?>

								  </button>
								  <form action="<?php echo e(route('admin.packages.destroy', $package['id'])); ?>" method="post">
									<?php echo csrf_field(); ?>
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="<?php echo e(route('admin.packages.edit', $package['id'])); ?>" class="dropdown-item dropdown-edit dropdown-edit"><i class="ti-pencil"></i> <?php echo e(_lang('Edit')); ?></a>
										<a href="<?php echo e(route('admin.packages.show', $package['id'])); ?>" class="dropdown-item dropdown-view dropdown-view"><i class="ti-eye"></i> <?php echo e(_lang('View')); ?></a>
										<button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i> <?php echo e(_lang('Delete')); ?></button>
									</div>
								  </form>
								</span>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/package/list.blade.php ENDPATH**/ ?>