<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title"><?php echo e(_lang('Account Types')); ?></span>
				<a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="<?php echo e(_lang('New Account Type')); ?>" href="<?php echo e(route('savings_products.create')); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add New')); ?></a>
			</div>
			<div class="card-body">
				<table id="savings_products_table" class="table table-bordered data-table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Name')); ?></th>
							<th><?php echo e(_lang('Interest Rate')); ?></th>
							<th><?php echo e(_lang('Interest Method')); ?></th>
							<th><?php echo e(_lang('Interest Period')); ?></th>
							<th><?php echo e(_lang('Status')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					    <?php $__currentLoopData = $savingsproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $savingsproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr data-id="row_<?php echo e($savingsproduct->id); ?>">
							<td class='name'><?php echo e($savingsproduct->name); ?> - <?php echo e($savingsproduct->currency->name); ?></td>
							<td class='interest_rate'><?php echo e($savingsproduct->interest_rate != NULL ? $savingsproduct->interest_rate : 0); ?> %</td>
							<td class='interest_method'>
								<?php echo e($savingsproduct->interest_method == 'minimum_balance' ? _lang('Minimum Savings Balance') : _lang('Daily Outstanding Balance')); ?>

							</td>
							<td class='interest_period'>
								<?php if($savingsproduct->interest_period != NULL): ?>
								<?php echo e(_lang('Every').' '.$savingsproduct->interest_period.' '._lang('month')); ?>

								<?php endif; ?>
							</td>
							<td class='status'>
								<?php echo xss_clean(status($savingsproduct->status)); ?>

							</td>			
							
							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <?php echo e(_lang('Action')); ?>

								  
								  </button>
								  <form action="<?php echo e(route('savings_products.destroy', $savingsproduct['id'])); ?>" method="post">
									<?php echo csrf_field(); ?>
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="<?php echo e(route('savings_products.edit', $savingsproduct['id'])); ?>" data-title="<?php echo e(_lang('Update Account Type')); ?>" class="dropdown-item dropdown-edit ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
										<a href="<?php echo e(route('savings_products.show', $savingsproduct['id'])); ?>" data-title="<?php echo e(_lang('Account Type Details')); ?>" class="dropdown-item dropdown-view ajax-modal"><i class="ti-eye"></i>&nbsp;<?php echo e(_lang('View')); ?></a>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/savings_product/list.blade.php ENDPATH**/ ?>