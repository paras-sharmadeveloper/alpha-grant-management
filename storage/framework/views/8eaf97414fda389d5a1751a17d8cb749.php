<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
		    <div class="card-header d-flex align-items-center">
				<h4 class="header-title"><?php echo e(_lang('User Roles')); ?></h4>
				<a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="<?php echo e(_lang('Create Role')); ?>" href="<?php echo e(route('roles.create')); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add New')); ?></a>
			</div>
			<div class="card-body">
				<table id="roles_table" class="table data-table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Name')); ?></th>
							<th><?php echo e(_lang('Description')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr data-id="row_<?php echo e($role->id); ?>">
							<td class='name'><?php echo e($role->name); ?></td>
							<td class='description'><?php echo e($role->description); ?></td>

							<td class="text-center">
								<span class="dropdown">
									<button class="btn btn-outline-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php echo e(_lang('Action')); ?>

									
									</button>
									<form action="<?php echo e(route('roles.destroy', $role['id'])); ?>" method="post">
										<?php echo csrf_field(); ?>
										<input name="_method" type="hidden" value="DELETE">

										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a href="<?php echo e(route('roles.edit', $role['id'])); ?>" data-title="<?php echo e(_lang('Update Role')); ?>" class="dropdown-item ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
											<a href="<?php echo e(route('permission.show', $role->id)); ?>" class="dropdown-item"><i class="ti-lock mr-1"></i><?php echo e(_lang('Access Control')); ?></a>
											<button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;<?php echo e(_lang('Delete')); ?></button>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/user/role/list.blade.php ENDPATH**/ ?>