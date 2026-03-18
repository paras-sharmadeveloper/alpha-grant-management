<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Add Offline Payment')); ?></span>
			</div>
			<div class="card-body">
			    <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('admin.subscription_payments.store')); ?>" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Tenant')); ?></label>						
								<div class="col-xl-9">
									<select class="form-control select2 auto-select" data-selected="<?php echo e(old('tenant_id')); ?>" name="tenant_id" required>
										<option value=""><?php echo e(_lang('Select One')); ?></option>
										<?php $__currentLoopData = \App\Models\Tenant::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($tenant->id); ?>"><?php echo e($tenant->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Payment Method')); ?></label>						
								<div class="col-xl-9">
									<select class="form-control auto-select" data-selected="<?php echo e(old('payment_method')); ?>" name="payment_method" value="<?php echo e(old('payment_method')); ?>" required>
										<option value=""><?php echo e(_lang('Select One')); ?></option>
										<?php $__currentLoopData = \App\Models\PaymentGateway::offline()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($gateway->name); ?>"><?php echo e($gateway->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Order / Transaction ID')); ?></label>						
								<div class="col-xl-9">
									<input type="text" class="form-control" name="order_id" value="<?php echo e(old('order_id')); ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Subscription Plan')); ?></label>						
								<div class="col-xl-9">
									<select class="form-control auto-select select2" data-selected="<?php echo e(old('package_id')); ?>" name="package_id" required>
										<option value=""><?php echo e(_lang('Select One')); ?></option>
										<?php $__currentLoopData = \App\Models\Package::active()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($package->id); ?>"><?php echo e($package->name); ?> (<?php echo e(decimalPlace($package->cost, currency_symbol()).'/'.ucwords($package->package_type)); ?>)</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Amount')); ?> (<?php echo e(currency_symbol()); ?>)</label>						
								<div class="col-xl-9">
									<input type="text" class="form-control float-field" name="amount" value="<?php echo e(old('amount')); ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Status')); ?></label>						
								<div class="col-xl-9">
									<select class="form-control auto-select" data-selected="<?php echo e(old('status', 1)); ?>" name="status" required>
										<option value="1"><?php echo e(_lang('Completed')); ?></option>
										<option value="0"><?php echo e(_lang('Pending')); ?></option>						
									</select>
								</div>
							</div>
						
							<div class="form-group row mt-2">
                                <div class="col-xl-9 offset-xl-3">
                                    <button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Submit')); ?></button>
                                </div>
                            </div>
						</div>
					</div>
			    </form>
			</div>
		</div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/subscription_payment/create.blade.php ENDPATH**/ ?>