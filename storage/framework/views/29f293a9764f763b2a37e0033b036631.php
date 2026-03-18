<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<span class="header-title"><?php echo e(_lang('Withdraw Methods')); ?></span>
				<a class="btn btn-primary btn-xs ml-auto" href="<?php echo e(route('withdraw_methods.create')); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add New')); ?></a>
			</div>
			<div class="card-body">
				<table id="withdraw_methods_table" class="table table-bordered data-table">
					<thead>
					    <tr>
							<th><?php echo e(_lang('Image')); ?></th>
						    <th><?php echo e(_lang('Name')); ?></th>
							<th><?php echo e(_lang('Currency')); ?></th>
							<th><?php echo e(_lang('Status')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					    <?php $__currentLoopData = $withdrawmethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawmethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr data-id="row_<?php echo e($withdrawmethod->id); ?>">
							<td class='image'><img class="thumb-sm" src="<?php echo e($withdrawmethod->image != null ? asset('public/uploads/media/'.$withdrawmethod->image) : asset('public/backend/images/no-image.png')); ?>"/></td>
							<td class='name'><?php echo e($withdrawmethod->name); ?></td>
							<td class='currency'><?php echo e($withdrawmethod->currency->name); ?></td>
							<td class='status'><?php echo xss_clean(status($withdrawmethod->status)); ?></td>

							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <?php echo e(_lang('Action')); ?>

								  
								  </button>
								  <form action="<?php echo e(route('withdraw_methods.destroy', $withdrawmethod['id'])); ?>" method="post">
									<?php echo csrf_field(); ?>
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="<?php echo e(route('withdraw_methods.edit', $withdrawmethod['id'])); ?>" class="dropdown-item dropdown-edit dropdown-edit"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/withdraw_method/list.blade.php ENDPATH**/ ?>