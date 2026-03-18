<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('public/backend/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>" rel="stylesheet">

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title"><?php echo e(_lang('Expense Categories')); ?></span>
				<a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="<?php echo e(_lang('Add New Category')); ?>" href="<?php echo e(route('expense_categories.create')); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add New')); ?></a>
			</div>
			<div class="card-body">
				<table id="expense_categories_table" class="table table-bordered data-table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Name')); ?></th>
						    <th><?php echo e(_lang('Color')); ?></th>
							<th><?php echo e(_lang('Description')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					    <?php $__currentLoopData = $expensecategorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expensecategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr data-id="row_<?php echo e($expensecategory->id); ?>">
							<td class='name'><?php echo e($expensecategory->name); ?></td>
							<td class='color'><div class="rounded-circle color-circle" style="background:<?php echo e($expensecategory->color); ?>"></div></td>
							<td class='description'><?php echo e($expensecategory->description); ?></td>
							
							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <?php echo e(_lang('Action')); ?>

								  
								  </button>
								  <form action="<?php echo e(route('expense_categories.destroy', $expensecategory['id'])); ?>" method="post">
									<?php echo csrf_field(); ?>
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="<?php echo e(route('expense_categories.edit', $expensecategory['id'])); ?>" data-title="<?php echo e(_lang('Update Expense Category')); ?>" class="dropdown-item dropdown-edit ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
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

<?php $__env->startSection('js-script'); ?>
<script src="<?php echo e(asset('public/backend/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/expense_category/list.blade.php ENDPATH**/ ?>