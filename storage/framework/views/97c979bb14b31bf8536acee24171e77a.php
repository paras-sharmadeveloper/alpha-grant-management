<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Payment Gateways')); ?></span>
			</div>
			<div class="card-body p-0">
				<table class="table table-striped">
					<thead>
						<th class="pl-4"><?php echo e(_lang('Name')); ?></th>
						<th class="text-center"><?php echo e(_lang('Status')); ?></th>
						<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					</thead>
					<tbody>
					<?php $__currentLoopData = $paymentgateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentgateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td class="pl-4">
								<div class="d-flex align-items-center">
									<img src="<?php echo e(asset('public/backend/images/gateways/'.$paymentgateway->image)); ?>" class="thumb-sm img-thumbnail rounded-circle mr-3">
									<div><span class="d-block text-height-0"><b><?php echo e($paymentgateway->name); ?></b></span></div>
								</div>
							</td>
							<td class="text-center"><?php echo xss_clean(status($paymentgateway->status)); ?></td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.payment_gateways.edit', $paymentgateway->id)); ?>" class="btn btn-outline-primary btn-xs"><i class="ti-pencil-alt mr-2"></i><?php echo e(_lang('Config')); ?></a>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/payment_gateway/list.blade.php ENDPATH**/ ?>