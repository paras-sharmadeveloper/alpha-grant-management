<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="<?php echo e($alert_col); ?>">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Apply New Loan')); ?></span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="<?php echo e(route('loans.apply_loan')); ?>" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="row">

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Loan Product')); ?></label>
								<select class="form-control auto-select select2"  data-selected="<?php echo e(request()->product ?? old('loan_product_id')); ?>" name="loan_product_id" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<?php $__currentLoopData = \App\Models\LoanProduct::active()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($loanProduct->id); ?>" data-penalties="<?php echo e($loanProduct->late_payment_penalties); ?>" data-loan-id="<?php echo e($loanProduct->loan_id_prefix.$loanProduct->starting_loan_id); ?>" data-details="<?php echo e($loanProduct); ?>"><?php echo e($loanProduct->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Currency')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e(old('currency_id')); ?>" name="currency_id" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<?php $__currentLoopData = \App\Models\Currency::where('status', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($currency->id); ?>"><?php echo e($currency->full_name); ?> (<?php echo e($currency->name); ?>)</option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>

						

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Applied Amount')); ?></label>
								<input type="text" class="form-control float-field" name="applied_amount" value="<?php echo e(old('applied_amount')); ?>" required>
							</div>
						</div>

						<!--Custom Fields-->
						<?php if(! $customFields->isEmpty()): ?>
							<?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="<?php echo e($customField->field_width); ?>">
								<div class="form-group">
									<label class="control-label"><?php echo e($customField->field_name); ?></label>
									<?php echo xss_clean(generate_input_field($customField)); ?>

								</div>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Fee Deduct Account')); ?></label>
								<select class="form-control auto-select select2" data-selected="<?php echo e(old('debit_account_id')); ?>" name="debit_account_id" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($account->id); ?>"><?php echo e($account->account_number); ?> (<?php echo e($account->savings_type->name); ?> - <?php echo e($account->savings_type->currency->name); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Attachment')); ?></label>
								<input type="file" class="file-uploader" name="attachment">
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Description')); ?></label>
								<textarea class="form-control" name="description"><?php echo e(old('description')); ?></textarea>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Remarks')); ?></label>
								<textarea class="form-control" name="remarks"><?php echo e(old('remarks')); ?></textarea>
							</div>
						</div>

						<div class="col-md-12 mt-2">
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Submit Application')); ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/customer/loan/apply_loan.blade.php ENDPATH**/ ?>