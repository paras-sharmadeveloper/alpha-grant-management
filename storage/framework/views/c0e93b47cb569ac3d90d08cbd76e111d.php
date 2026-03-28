

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<span class="panel-title"><?php echo e(_lang('Loan Products')); ?></span>
				<a class="btn btn-primary btn-xs float-right" href="<?php echo e(route('loan_products.create')); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add New')); ?></a>
			</div>
			<div class="card-body">
				<table id="loan_products_table" class="table table-bordered data-table">
					<thead>
						<tr>
							<th><?php echo e(_lang('Name')); ?></th>
							<th><?php echo e(_lang('Interest Rate')); ?></th>
							<th><?php echo e(_lang('Interest Type')); ?></th>
							<th><?php echo e(_lang('Term (Years)')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loanproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
						<tr data-id="row_<?php echo e($loanproduct->id); ?>">
							<td class='name'><?php echo e($loanproduct->name); ?></td>
							<td class='interest_rate'><?php echo e($loanproduct->interest_rate.' %'); ?></td>
							<td class='interest_type'><?php echo e(ucwords(str_replace("_"," ", $loanproduct->interest_type))); ?></td>
							<td class='term'><?php echo e(round($loanproduct->term / 12, 1)); ?> <?php echo e($loanproduct->term == 12 ? 'Year' : 'Years'); ?></td>
							<td class="text-center">
								<div class="dropdown">
									<button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php echo e(_lang('Action')); ?>

									</button>
									<form action="<?php echo e(route('loan_products.destroy', $loanproduct['id'])); ?>" method="post">
									<?php echo csrf_field(); ?>
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="<?php echo e(route('loan_products.edit', $loanproduct['id'])); ?>" class="dropdown-item dropdown-edit dropdown-edit"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
										<button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;<?php echo e(_lang('Delete')); ?></button>
									</div>
									</form>
								</div>
							</td>
						</tr>
						<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/loan_product/list.blade.php ENDPATH**/ ?>