<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Loan Calculator')); ?></span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="<?php echo e(route('loans.calculate')); ?>">
					<?php echo csrf_field(); ?>
					<div class="row">

						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Apply Amount')); ?></label>
								<input type="text" class="form-control float-field" name="apply_amount" value="<?php echo e(old('apply_amount',$apply_amount)); ?>" required>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Interest Rate Per Year')); ?></label>
								<div class="input-group">
									<input type="text" class="form-control float-field" name="interest_rate" value="<?php echo e(old('interest_rate', $interest_rate)); ?>" required>
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Interest Type')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e(old('interest_type',$interest_type)); ?>" name="interest_type" id="interest_type" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<option value="flat_rate"><?php echo e(_lang('Flat Rate')); ?></option>
									<option value="fixed_rate"><?php echo e(_lang('Fixed Rate')); ?></option>
									<option value="mortgage"><?php echo e(_lang('Mortgage amortization')); ?></option>
									<option value="reducing_amount"><?php echo e(_lang('Reducing Amount')); ?></option>
									<option value="one_time"><?php echo e(_lang('One-time payment')); ?></option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Term')); ?></label>
								<input type="number" class="form-control" name="term" value="<?php echo e(old('term',$term)); ?>" id="term" required>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Term Period')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e(old('term_period', $term_period)); ?>" name="term_period" id="term_period" required>
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

						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('First Payment date')); ?></label>
								<input type="text" class="form-control datepicker" name="first_payment_date" value="<?php echo e(old('first_payment_date', $first_payment_date)); ?>" required>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Late Payment Penalties')); ?></label>
								<div class="input-group">
									<input type="text" class="form-control float-field" name="late_payment_penalties" value="<?php echo e(old('late_payment_penalties',$late_payment_penalties)); ?>" required>
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block" style="margin-top: 27px;"><?php echo e(_lang('Calculate')); ?></button>
							</div>
						</div>
					</div>
				</form>

				<?php if(isset($table_data)): ?>

					<h5 class="mt-4 text-center"><b><?php echo e(_lang('Payable Amount')); ?>: <?php echo e(decimalPlace($payable_amount)); ?></b></h5>

					<div class="table-responsive mt-5">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><?php echo e(_lang('Date')); ?></th>
									<th class="text-right"><?php echo e(_lang('Principal Amount')); ?></th>
									<th class="text-right"><?php echo e(_lang('Interest')); ?></th>
									<th class="text-right"><?php echo e(_lang('Penalty')); ?></th>
									<th class="text-right"><?php echo e(_lang('Amount to Pay')); ?></th>
									<th class="text-right"><?php echo e(_lang('Balance')); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $table_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $td): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e(date('d/m/Y',strtotime($td['date']))); ?></td>
									<td class="text-right"><?php echo e(decimalPlace($td['principal_amount'])); ?></td>
									<td class="text-right"><?php echo e(decimalPlace($td['interest'])); ?></td>
									<td class="text-right"><?php echo e(decimalPlace($td['penalty'])); ?>/ <?php echo e(_lang('Day')); ?></td>
									<td class="text-right"><?php echo e(decimalPlace($td['amount_to_pay'])); ?></td>
									<td class="text-right"><?php echo e(decimalPlace($td['balance'])); ?></td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js-script'); ?>
<script>
(function ($) {
  "use strict";

	$(document).on('change','#interest_type',function(){
		if($(this).val() == 'one_time'){
			$("#term").val(1);
			$("#term_period").val('+1 day');
			$("#term").prop('readonly',true);
			$("#term_period").prop('disabled',true);
		}else{
			$("#term").prop('readonly',false);
			$("#term_period").prop('disabled',false);
		}
	});

})(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/loan/calculator.blade.php ENDPATH**/ ?>