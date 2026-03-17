<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title"><?php echo e(_lang('Custom Fields')); ?></span>
				<a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="<?php echo e(_lang('Add New Field')); ?>" href="<?php echo e(route('custom_fields.create')); ?>?table=<?php echo e($table); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add New')); ?></a>
			</div>
			<div class="card-body">
				<table id="custom_fields_table" class="table table-bordered data-table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Name')); ?></th>
							<th><?php echo e(_lang('Field Type')); ?></th>
							<th><?php echo e(_lang('Status')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					    <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr data-id="row_<?php echo e($customField->id); ?>">
							<td class='field_name'><?php echo e($customField->field_name); ?></td>
							<td class='field_type'>
								<?php if($customField->field_type == 'text'): ?>
									<?php echo e(_lang('Text Box')); ?>

								<?php elseif($customField->field_type == 'number'): ?>
									<?php echo e(_lang('Number')); ?>

								<?php elseif($customField->field_type == 'textarea'): ?>
									<?php echo e(_lang('Textarea')); ?>

								<?php elseif($customField->field_type == 'select'): ?>
									<?php echo e(_lang('Select Box')); ?>

								<?php elseif($customField->field_type == 'file'): ?>
									<?php echo e(_lang('File (PNG,JPG,PDF)')); ?>

								<?php endif; ?>
							</td>
							<td class='status'><?php echo xss_clean(status($customField->status)); ?></td>

							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <?php echo e(_lang('Action')); ?>

								  
								  </button>
								  <form action="<?php echo e(route('custom_fields.destroy', $customField['id'])); ?>" method="post">
									<?php echo csrf_field(); ?>
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="<?php echo e(route('custom_fields.edit', $customField['id'])); ?>" data-title="<?php echo e(_lang('Update Custom Field')); ?>" class="dropdown-item dropdown-edit ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/custom_field/list.blade.php ENDPATH**/ ?>