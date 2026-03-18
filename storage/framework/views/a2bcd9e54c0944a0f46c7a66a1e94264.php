<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
        <?php if(count($accounts) < 2): ?>
        <div class="alert alert-danger">
            <i class="fas fa-info-circle mr-1"></i><?php echo e(_lang("You don't have multiple accounts")); ?>!
        </div>
        <?php endif; ?>
		<div class="card">
			<div class="card-header">
				<h4 class="header-title text-center"><?php echo e(_lang('Own Account Transfer')); ?></h4>
			</div>
          
			<div class="card-body">
			    <form method="post" class="validate" autocomplete="off" action="#">
					<?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('From Account')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e(old('from_account')); ?>" name="from_account" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($account->id); ?>"><?php echo e($account->account_number); ?> (<?php echo e($account->savings_type->name); ?> - <?php echo e($account->savings_type->currency->name); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>

                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('To Account')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e(old('to_account')); ?>" name="to_account" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($account->id); ?>"><?php echo e($account->account_number); ?> (<?php echo e($account->savings_type->name); ?> - <?php echo e($account->savings_type->currency->name); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Amount')); ?></label>
								<input type="text" class="form-control float-field" name="amount" value="<?php echo e(old('amount')); ?>" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Note')); ?></label>
								<textarea class="form-control" name="note"><?php echo e(old('note')); ?></textarea>
							</div>
						</div>

						<div class="col-md-12 mt-4">
							<div class="form-group">
								<button type="submit" class="btn btn-primary  btn-block" <?php echo e(count($accounts) < 2 ? 'disabled' : ''); ?>><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Send Money')); ?></button>
							</div>
						</div>
					</div>
			    </form>
			</div>
		</div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/customer/transfer/own_account_transfer.blade.php ENDPATH**/ ?>