

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="<?php echo e($alert_col); ?>">
		<div class="card">
			<div class="card-header text-center">
				<span class="panel-title"><?php echo e(_lang('Add New Loan')); ?></span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="<?php echo e(route('loans.store')); ?>" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="row">					
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Loan Product')); ?></label>
								<select class="form-control auto-select select2" data-selected="<?php echo e(old('loan_product_id')); ?>" name="loan_product_id" id="loan_product_id" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\LoanProduct::active()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
									<option value="<?php echo e($loanProduct->id); ?>" data-penalties="<?php echo e($loanProduct->late_payment_penalties); ?>" data-loan-id="<?php echo e($loanProduct->loan_id_prefix.$loanProduct->starting_loan_id); ?>" data-details="<?php echo e($loanProduct); ?>"><?php echo e($loanProduct->name); ?></option>
									<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Loan ID')); ?></label>
								<input type="text" class="form-control" name="loan_id" id="loan_id" value="<?php echo e(old('loan_id')); ?>" required readonly>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Borrower')); ?></label>
								<select class="form-control auto-select select2" data-selected="<?php echo e(old('borrower_id')); ?>" name="borrower_id" id="borrower_id" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\Member::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
										<option value="<?php echo e($member->id); ?>"><?php echo e($member->first_name.' '.$member->last_name .' ('. $member->member_no . ')'); ?></option>
									<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Currency')); ?></label>
								
								
								<?php $audCurrency = \App\Models\Currency::where('name', 'AUD')->where('status', 1)->first(); ?>
								<input type="text" class="form-control" value="Australian Dollar (AUD)" disabled>
								<input type="hidden" name="currency_id" value="<?php echo e($audCurrency->id ?? ''); ?>">
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('First Payment Date')); ?></label>
								<input type="date" class="form-control" name="first_payment_date" id="first_payment_date" value="<?php echo e(old('first_payment_date')); ?>" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Release Date')); ?></label>
								<input type="date" class="form-control" name="release_date" id="release_date" value="<?php echo e(old('release_date')); ?>" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Applied Amount')); ?></label>
								<input type="text" class="form-control float-field" name="applied_amount" value="<?php echo e(old('applied_amount')); ?>" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Late Payment Penalties')); ?></label>
								<div class="input-group">
									<input type="text" class="form-control float-field" name="late_payment_penalties" value="<?php echo e(old('late_payment_penalties')); ?>" id="late_payment_penalties" required>
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>
						</div>

						<!--Custom Fields-->
						<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $customFields->isEmpty()): ?>
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
							<div class="<?php echo e($customField->field_width); ?>">
								<div class="form-group">
									<label class="control-label">
										<?php echo e($customField->field_name); ?>

									</label>
									<?php echo xss_clean(generate_input_field($customField)); ?>

								</div>
							</div>
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

					
						
					
                   
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Attachment')); ?></label>
								<input type="file" class="dropify" name="attachment" value="<?php echo e(old('attachment')); ?>">
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

						<div class="col-lg-12 mt-2">
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Submit')); ?></button>
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
(function ($) {

	$(document).on('change', '#loan_product_id', function(){
		$("#late_payment_penalties").val($(this).find(':selected').data('penalties'));

		if($(this).val() != ''){
			var loanID = $(this).find(':selected').data('loan-id');
			loanID != '' ? $("#loan_id").val(loanID) :

			Swal.fire({
				text: "<?php echo e(_lang('Please set starting loan ID to your selected loan product before creating new loan!')); ?>",
				icon: "error",
				confirmButtonColor: "#e74c3c",
				confirmButtonText: "<?php echo e(_lang('Close')); ?>",
			});
		}else{
			$("#loan_id").val('');
		}
	});

	$(document).on('change','#borrower_id',function(){
		var member_id = $(this).val();
		if(member_id != ''){
			$.ajax({
				url: _tenant_url + '/savings_accounts/get_account_by_member_id/' + member_id,
				success: function(data){
					var json = JSON.parse(JSON.stringify(data));
					$("#debit_account").html('');
					$.each(json['accounts'], function(i, account) {
						$("#debit_account").append(`<option value="${account.id}">${account.account_number} (${account.savings_type.name} - ${account.savings_type.currency.name})</option>`);
					});

				}
			});
		}
	});

	$(document).on('change', '#loan_product_id', function(){
		let firstPaymentDate = $('#first_payment_date').val() ? new Date($('#first_payment_date').val()) : new Date();
		$.fn.calculateReleaseDate(firstPaymentDate);
	});

	$(document).on('change', '#first_payment_date', function(){
		$.fn.calculateReleaseDate(new Date($(this).val()));
	});

	$.fn.calculateReleaseDate = function(currentDate = new Date()) {
		let json = $('#loan_product_id').find(":selected").data('details');
		let releaseDate = new Date(currentDate);

		if (json) {
            if (typeof json === "string") {
                json = JSON.parse(details);
            }

			let term = parseInt(json.term);
			let period = json.term_period;

			if (!term || !period) {
				$("#release_date").val("");
				return;
			}

			let match = period.match(/(\+?\d+)\s(day|month|year)/);

			if (match) {
				term = term * parseInt(match[1]);
				let unit = match[2];

				// Calculate new date based on the unit
				if (unit === "day") {
					releaseDate.setDate(releaseDate.getDate() + term);
				} else if (unit === "month") {
					releaseDate.setMonth(releaseDate.getMonth() + term);
				} else if (unit === "year") {
					releaseDate.setFullYear(releaseDate.getFullYear() + term);
				}

				// Format date to YYYY-MM-DD for input field
				$("#first_payment_date").val(currentDate.toISOString().split("T")[0]);
				$("#release_date").val(releaseDate.toISOString().split("T")[0]);
			}
        }
    };

})(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/loan/create.blade.php ENDPATH**/ ?>