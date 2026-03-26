

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title"><?php echo e(_lang('All Branch')); ?></span>
				<a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="<?php echo e(_lang('Add New Branch')); ?>" href="<?php echo e(route('branches.create')); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add New')); ?></a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
				<table id="branches_table" class="table data-table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Branch Name')); ?></th>
							<th><?php echo e(_lang('Branch Code')); ?></th>
							<th class="text-right"><?php echo e(_lang('Active Loans')); ?></th>
							<th class="text-right"><?php echo e(_lang('Total Portfolio Value')); ?></th>
							<th class="text-right"><?php echo e(_lang('Outstanding Balance')); ?></th>
							<th class="text-right"><?php echo e(_lang('Arrears')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $branchs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
					    <tr data-id="row_<?php echo e($branch->id); ?>">
							<td class='name'>
								<?php echo e($branch->name); ?>

								<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($branch->contact_phone): ?>
									<br><small class="text-muted"><i class="ti-mobile"></i> <?php echo e($branch->contact_phone); ?></small>
								<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
							</td>
							<td class='branch_code'><span class="badge badge-secondary"><?php echo e($branch->branch_code); ?></span></td>
							<td class='text-right'><?php echo e($branch->active_loans_count ?? 0); ?></td>
							<td class='text-right'><?php echo e(decimalPlace($branch->total_portfolio_value ?? 0, currency_symbol())); ?></td>
							<td class='text-right'><?php echo e(decimalPlace($branch->outstanding_balance ?? 0, currency_symbol())); ?></td>
							<td class='text-right'><?php echo e(decimalPlace($branch->arrears ?? 0, currency_symbol())); ?></td>
							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <?php echo e(_lang('Action')); ?>

								  </button>
								  <form action="<?php echo e(route('branches.destroy', $branch['id'])); ?>" method="post">
									<?php echo csrf_field(); ?>
									<input name="_method" type="hidden" value="DELETE">
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="<?php echo e(route('branches.edit', $branch['id'])); ?>" data-title="<?php echo e(_lang('Update Branch')); ?>" class="dropdown-item dropdown-edit ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
										<a href="<?php echo e(route('branches.show', $branch['id'])); ?>" class="dropdown-item"><i class="ti-eye"></i>&nbsp;<?php echo e(_lang('View')); ?></a>
										<button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;<?php echo e(_lang('Delete')); ?></button>
									</div>
								  </form>
								</span>
							</td>
					    </tr>
					    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/branch/list.blade.php ENDPATH**/ ?>