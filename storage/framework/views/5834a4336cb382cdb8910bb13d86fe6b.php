<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Add Loan Product')); ?></span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="<?php echo e(route('loan_products.store')); ?>" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Name')); ?></label>
								<input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Loan ID Prefix')); ?></label>						
								<input type="text" class="form-control" name="loan_id_prefix" value="<?php echo e(old('loan_id_prefix')); ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Starting Loan ID')); ?></label>						
								<input type="number" class="form-control" name="starting_loan_id" value="<?php echo e(old('starting_loan_id')); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Minimum Amount').' '.currency()); ?></label>
								<input type="text" class="form-control float-field" name="minimum_amount" value="<?php echo e(old('minimum_amount')); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Maximum Amount').' '.currency()); ?></label>
								<input type="text" class="form-control float-field" name="maximum_amount" value="<?php echo e(old('maximum_amount')); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Interest Rate Per Year')); ?> (%)</label>
								<input type="text" class="form-control float-field" name="interest_rate" value="<?php echo e(old('interest_rate')); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Interest Type')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e(old('interest_type','flat_rate')); ?>" name="interest_type" required>
									<option value="flat_rate"><?php echo e(_lang('Flat Rate')); ?></option>
									<option value="fixed_rate"><?php echo e(_lang('Fixed Rate')); ?></option>
									<option value="mortgage"><?php echo e(_lang('Mortgage amortization')); ?></option>
									<option value="reducing_amount"><?php echo e(_lang('Reducing Amount')); ?></option>
									<option value="one_time"><?php echo e(_lang('One-time payment')); ?></option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Max Term')); ?></label>
								<input type="number" class="form-control" name="term" value="<?php echo e(old('term')); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Term Period')); ?></label>
								<select class="form-control select2 auto-select" data-selected="<?php echo e(old('term_period','+1 month')); ?>" name="term_period" id="term_period" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<option value="+1 day"><?php echo e(_lang('Daily')); ?></option>
									<option value="+3 day"><?php echo e(_lang('Every 3 days')); ?></option>
									<option value="+5 day"><?php echo e(_lang('Every 5 days')); ?></option>
									<option value="+7 day"><?php echo e(_lang('Weekly')); ?></option>
									<option value="+10 day"><?php echo e(_lang('Every 10 days')); ?></option>
									<option value="+15 day"><?php echo e(_lang('Every 15 days')); ?></option>
									<option value="+21 day"><?php echo e(_lang('Every 21 days')); ?></option>
									<option value="+1 month"><?php echo e(_lang('Monthly')); ?></option>
									<option value="+2 month"><?php echo e(_lang('Every 2 months')); ?></option>
									<option value="+3 month"><?php echo e(_lang('Quarterly (Every 3 months)')); ?></option>
									<option value="+4 month"><?php echo e(_lang('Every 4 months')); ?></option>
									<option value="+6 month"><?php echo e(_lang('Biannually (Every 6 months)')); ?></option>
									<option value="+9 month"><?php echo e(_lang('Every 9 months')); ?></option>
									<option value="+1 year"><?php echo e(_lang('Yearly')); ?></option>
									<option value="+2 year"><?php echo e(_lang('Every 2 years')); ?></option>
									<option value="+3 year"><?php echo e(_lang('Every 3 years')); ?></option>
									<option value="+5 year"><?php echo e(_lang('Every 5 years')); ?></option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Late Payment Penalties')); ?> / <?php echo e(_lang('Each Day')); ?></label>
								<div class="input-group">
									<input type="text" class="form-control float-field" name="late_payment_penalties" value="<?php echo e(old('late_payment_penalties')); ?>" required>
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Status')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e(old('status',1)); ?>" name="status" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<option value="1"><?php echo e(_lang('Active')); ?></option>
									<option value="0"><?php echo e(_lang('Deactivate')); ?></option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Loan Application Fee')); ?></label>
								<input type="text" class="form-control float-field" name="loan_application_fee" value="<?php echo e(old('loan_application_fee', 0)); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Loan Application Fee Type')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e(old('loan_application_fee_type', 0)); ?>" name="loan_application_fee_type" required>
									<option value="0"><?php echo e(_lang('Fixed')); ?></option>
									<option value="1"><?php echo e(_lang('Percentage')); ?></option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Loan Processing Fee')); ?></label>
								<input type="text" class="form-control float-field" name="loan_processing_fee" value="<?php echo e(old('loan_processing_fee', 0)); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Loan Processing Fee Type')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e(old('loan_processing_fee_type', 0)); ?>" name="loan_processing_fee_type" required>
									<option value="0"><?php echo e(_lang('Fixed')); ?></option>
									<option value="1"><?php echo e(_lang('Percentage')); ?></option>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Description')); ?></label>
								<textarea class="form-control" name="description"><?php echo e(old('description')); ?></textarea>
							</div>
						</div>

						<div class="col-md-12 mt-2">
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Save Changes')); ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/loan_product/create.blade.php ENDPATH**/ ?>