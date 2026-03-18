<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <span class="header-title text-center"><?php echo e(_lang('Loan Repayment')); ?></span>
            </div>
            <div class="card-body">
                <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('loans.loan_payment', $loan->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Loan ID')); ?></label>
                                <input type="text" class="form-control" name="loan_id" value="<?php echo e($loan->loan_id); ?>" readonly="true" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Repayment Due Date')); ?></label>
                                <input type="text" class="form-control" name="due_amount_of" value="<?php echo e($loan->next_payment->repayment_date); ?>" readonly="true">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Late Penalties')); ?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control float-field" name="late_penalties" id="late_penalties" value="<?php echo e($late_penalties); ?>" readonly="true">
                                    <div class="input-group-append">
                                        <span class="input-group-text currency"><?php echo e($loan->currency->name); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Interest')); ?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control float-field" name="interest" id="interest" value="<?php echo e($loan->next_payment->interest); ?>" readonly="true" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text currency"><?php echo e($loan->currency->name); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Principal Amount')); ?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control float-field" name="principal_amount" id="principal_amount" value="<?php echo e($loan->next_payment->principal_amount); ?>" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text currency"><?php echo e($loan->currency->name); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Total Due Amount')); ?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control float-field" name="total_due" id="total_due" value="<?php echo e($loan->applied_amount - $loan->total_paid); ?>" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text currency"><?php echo e($loan->currency->name); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Total Amount')); ?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control float-field" name="total_amount" id="total_amount" value="<?php echo e($totalAmount); ?>" readonly="true" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text currency"><?php echo e($loan->currency->name); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Select Account')); ?></label>
                                <select class="form-control auto-select" data-selected="<?php echo e(old('account_id')); ?>" name="account_id" required>
                                    <option value=""><?php echo e(_lang('Select One')); ?></option>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($account->id); ?>"><?php echo e($account->account_number); ?> (<?php echo e($account->savings_type->name); ?> - <?php echo e($account->savings_type->currency->name); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(_lang('Remarks')); ?></label>
                                <textarea class="form-control" name="remarks"><?php echo e(old('remarks')); ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary  btn-block"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Make Payment')); ?></button>
							</div>
						</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js-script'); ?>
<script>
$(function() {
	"use strict";

	$(document).on('keyup','#principal_amount',function(){
		var penalty = $('#late_penalties').val();
		var principal_amount = $('#principal_amount').val();
		var interest = $('#interest').val();

		if(principal_amount == ''){
			principal_amount = 0;
		}

		if(penalty == ''){
			$("#total_amount").val(parseFloat(principal_amount) + parseFloat(interest));
		}else{
			$("#total_amount").val(parseFloat(principal_amount) + parseFloat(interest) + parseFloat(penalty));
		}
	});
});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/customer/loan/payment.blade.php ENDPATH**/ ?>