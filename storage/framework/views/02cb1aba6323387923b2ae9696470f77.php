<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title"><?php echo e(_lang('Bank Accounts')); ?></span>
				<a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="<?php echo e(_lang('Add Bank Account')); ?>" href="<?php echo e(route('bank_accounts.create')); ?>"><i class="ti-plus"></i> <?php echo e(_lang('Add New')); ?></a>
			</div>
			<div class="card-body">
				<table id="bank_accounts_table" class="table table-bordered data-table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Opening Date')); ?></th>
						    <th><?php echo e(_lang('Bank Name')); ?></th>
						    <th><?php echo e(_lang('Currency')); ?></th>
							<th><?php echo e(_lang('Account Name')); ?></th>
							<th><?php echo e(_lang('Account Number')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					    <?php $__currentLoopData = $bankAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bankAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr data-id="row_<?php echo e($bankAccount->id); ?>">
							<td class='opening_date'><?php echo e($bankAccount->opening_date); ?></td>
							<td class='bank_name'><?php echo e($bankAccount->bank_name); ?></td>
							<td class='currency_id'><?php echo e($bankAccount->currency->name); ?></td>
							<td class='account_name'><?php echo e($bankAccount->account_name); ?></td>
							<td class='account_number'><?php echo e($bankAccount->account_number); ?></td>
							
							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <?php echo e(_lang('Action')); ?>

								  </button>
								  <form action="<?php echo e(route('bank_accounts.destroy', $bankAccount['id'])); ?>" method="post">
									<?php echo csrf_field(); ?>
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="<?php echo e(route('bank_accounts.edit', $bankAccount['id'])); ?>" data-title="<?php echo e(_lang('Update Bank Account')); ?>" class="dropdown-item dropdown-edit ajax-modal"><i class="fas fa-pencil-alt"></i> <?php echo e(_lang('Edit')); ?></a>
										<a href="<?php echo e(route('bank_accounts.show', $bankAccount['id'])); ?>" data-title="<?php echo e(_lang('Bank Account Details')); ?>" class="dropdown-item dropdown-view ajax-modal"><i class="fas fa-eye"></i> <?php echo e(_lang('View')); ?></a>
										<button class="btn-remove dropdown-item" type="submit"><i class="fas fa-trash-alt"></i> <?php echo e(_lang('Delete')); ?></button>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/bank_account/list.blade.php ENDPATH**/ ?>