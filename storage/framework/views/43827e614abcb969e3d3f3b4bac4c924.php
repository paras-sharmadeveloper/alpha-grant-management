<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header">
				<span class="header-title"><?php echo e(_lang('New Withdraw Method')); ?></span>
			</div>
			<div class="card-body">
			    <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('withdraw_methods.store')); ?>" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Name')); ?></label>
								<input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Image')); ?></label>
								<input type="file" class="form-control dropify" name="image">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Currency')); ?></label>
								<select class="form-control auto-select select2" data-selected="<?php echo e(old('currency_id')); ?>" name="currency_id" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<?php $__currentLoopData = \App\Models\Currency::where('status', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($currency->id); ?>"><?php echo e($currency->full_name); ?> (<?php echo e($currency->name); ?>)</option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Status')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e(old('status')); ?>" name="status">
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<option value="1"><?php echo e(_lang('Active')); ?></option>
									<option value="0"><?php echo e(_lang('Deactivate')); ?></option>
								</select>
							</div>
						</div>

						<div class="col-lg-12 mt-4 form-group mb-0">
							<div class="card">
								<div class="card-header d-flex align-items-center">
									<span class="panel-title"><?php echo e(_lang('Limits & Charges')); ?></span>
									<button type="button" class="btn btn-outline-primary btn-xs ml-auto" id="add-row"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add Row')); ?></button>
								</div>
								<div class="card-body p-0">
									<div class="table-responsive">
										<table id="charge-table" class="table table-bordered">
											<thead>
												<tr>
													<th class="pl-3"><?php echo e(_lang('Minimum Amount')); ?></th>
													<th><?php echo e(_lang('Maximum Amount')); ?></th>
													<th><?php echo e(_lang('Fixed Charge')); ?></th>
													<th><?php echo e(_lang('Charge')); ?> (%)</th>
													<th class="text-center"><?php echo e(_lang('Remove')); ?></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="pl-3">
														<input type="hidden" name="limit_id[]" value="">
														<input type="text" class="form-control float-field" placeholder="<?php echo e(_lang('Minimum Amount')); ?>" name="minimum_amount[]" value="" required>
													</td>
													<td>
														<input type="text" class="form-control float-field" placeholder="<?php echo e(_lang('Maximum Amount')); ?>" name="maximum_amount[]" value="" required>
													</td>
													<td>
														<input type="text" class="form-control float-field" placeholder="<?php echo e(_lang('Fixed Charge')); ?>" name="fixed_charge[]" value="0" required>
													</td>
													<td>
														<input type="text" class="form-control float-field" placeholder="<?php echo e(_lang('Charge In Percentage')); ?>" name="percent_charge[]" value="0" required>
													</td>
													<td class="text-center">
														<button type="button" class="btn btn-danger btn-xs remove-row"><i class="ti-trash"></i></button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Descriptions')); ?></label>
								<textarea class="form-control summernote" name="descriptions"><?php echo e(old('descriptions')); ?></textarea>
							</div>
						</div>

						<div class="col-md-12 mt-3">
							<div class="d-flex align-items-center">
								<h5><b><?php echo e(_lang('Withdrawn Informations')); ?></b></h5>
								<button type="button" id="add_row" class="btn btn-outline-primary btn-xs ml-auto"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add New Field')); ?></button>
							</div>
							<hr>
							<div class="row" id="custom_fields">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Field Name')); ?></label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" name="requirements[]" placeholder="EX: Wallet Number" required>
											<div class="input-group-append">
												<button class="btn btn-danger btn-xs" id="remove_field"><i class="ti-trash px-2"></i></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Field Name')); ?></label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" name="requirements[]" placeholder="EX: Email address" required>
											<div class="input-group-append">
												<button class="btn btn-danger btn-xs" id="remove_field"><i class="ti-trash px-2"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12 mt-2">
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Save')); ?></button>
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
  "use strict";

	$(document).on('click','#add_row', function(){
		$("#custom_fields").append(`<div class="col-md-6">
										<div class="form-group">
											<label class="control-label"><?php echo e(_lang('Field Name')); ?></label>
											<div class="input-group mb-3">
												<input type="text" class="form-control" name="requirements[]" required>
												<div class="input-group-append">
													<button class="btn btn-danger btn-xs" id="remove_field"><i class="ti-trash px-2"></i></button>
												</div>
											</div>
										</div>
									</div>`);
	});

	$(document).on('click','#remove_field', function(){
		$(this).closest('.col-md-6').remove();
	});

	$(document).on('click', '#add-row', function(){
		var row = `<tr>
						<td class="pl-3">
							<input type="text" class="form-control float-field" placeholder="<?php echo e(_lang('Minimum Amount')); ?>" name="minimum_amount[]" value="" required>
						</td>
						<td>
							<input type="text" class="form-control float-field" placeholder="<?php echo e(_lang('Maximum Amount')); ?>" name="maximum_amount[]" value="" required>
						</td>
						<td>
							<input type="text" class="form-control float-field" placeholder="<?php echo e(_lang('Fixed Charge')); ?>" name="fixed_charge[]" value="0" required>
						</td>
						<td>
							<input type="text" class="form-control float-field" placeholder="<?php echo e(_lang('Charge In Percentage')); ?>" name="percent_charge[]" value="0" required>
						</td>
						<td class="text-center">
							<button type="button" class="btn btn-danger btn-xs remove-row"><i class="ti-trash"></i></button>
						</td>
					</tr>`;
		$('#charge-table tbody').append(row);
	});

	$(document).on('click', '.remove-row', function(){
		if($('#charge-table tbody tr').length > 1){
			$(this).closest('tr').remove();
		}else{
			alert('You must set at least one limit');
		}	
	});

})(jQuery);
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/withdraw_method/create.blade.php ENDPATH**/ ?>