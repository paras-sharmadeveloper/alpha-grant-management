<?php $__env->startSection('content'); ?>
<form method="post" class="validate" autocomplete="off" action="<?php echo e(route('members.update', $id)); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<div class="row">
		<div class="col-lg-8">
			<div class="card">
				<div class="card-header">
					<span class="header-title"><?php echo e(_lang('Update Member Information')); ?></span>
				</div>
				<div class="card-body">
					<input name="_method" type="hidden" value="PATCH">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('First Name')); ?></label>
								<input type="text" class="form-control" name="first_name" value="<?php echo e($member->first_name); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Last Name')); ?></label>
								<input type="text" class="form-control" name="last_name" value="<?php echo e($member->last_name); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Member No')); ?></label>
								<input type="text" class="form-control" name="member_no" value="<?php echo e($member->member_no); ?>" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Business Name')); ?></label>
								<input type="text" class="form-control" name="business_name" value="<?php echo e($member->business_name); ?>">
							</div>
						</div>

						<?php if(auth()->user()->user_type == 'admin'): ?>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Branch')); ?></label>
								<select class="form-control select2 auto-select" data-selected="<?php echo e($member->branch_id); ?>" name="branch_id">
									<option value=""><?php echo e(get_tenant_option('default_branch_name', 'Main Branch')); ?></option>
									<?php $__currentLoopData = \App\Models\Branch::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
							</div>
						</div>
						<?php else: ?>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Branch')); ?></label>
								<select class="form-control auto-select" name="branch_id" data-selected="<?php echo e($member->branch_id); ?>" disabled>
									<option value=""><?php echo e(get_tenant_option('default_branch_name', 'Main Branch')); ?></option>
									<?php $__currentLoopData = \App\Models\Branch::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
							</div>
						</div>
						<?php endif; ?>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Email')); ?></label>
								<input type="text" class="form-control" name="email" value="<?php echo e($member->email); ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Country Code')); ?></label>
								<select class="form-control select2 auto-select" name="country_code" data-selected="<?php echo e($member->country_code); ?>">
									<option value=""><?php echo e(_lang('Country Code')); ?></option>
									<?php $__currentLoopData = get_country_codes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value['dial_code']); ?>"><?php echo e($value['country'].' (+'.$value['dial_code'].')'); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Mobile')); ?></label>
								<input type="text" class="form-control" name="mobile" value="<?php echo e(old('mobile',$member->mobile)); ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Gender')); ?></label>
								<select class="form-control auto-select" data-selected="<?php echo e($member->gender); ?>" name="gender">
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<option value="male"><?php echo e(_lang('Male')); ?></option>
									<option value="female"><?php echo e(_lang('Female')); ?></option>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('City')); ?></label>
								<input type="text" class="form-control" name="city" value="<?php echo e($member->city); ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('State')); ?></label>
								<input type="text" class="form-control" name="state" value="<?php echo e($member->state); ?>">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Zip')); ?></label>
								<input type="text" class="form-control" name="zip" value="<?php echo e($member->zip); ?>">
							</div>
						</div>

						<!--Custom Fields-->
						<?php if(! $customFields->isEmpty()): ?>
							<?php $customFieldsData = json_decode($member->custom_fields, true); ?>
							<?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="<?php echo e($customField->field_width); ?>">
								<div class="form-group">
									<label class="control-label"><?php echo e($customField->field_name); ?></label>
									<?php echo xss_clean(generate_input_field($customField, $customFieldsData[$customField->field_name]['field_value'] ?? null)); ?>

								</div>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Credit Source')); ?></label>
								<input type="text" class="form-control" name="credit_source" value="<?php echo e($member->credit_source); ?>">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Address')); ?></label>
								<textarea class="form-control" name="address"><?php echo e($member->address); ?></textarea>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Photo')); ?></label>
								<input type="file" class="form-control dropify" name="photo" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="<?php echo e(profile_picture($member->photo)); ?>">
							</div>
						</div>

						<div class="col-md-12 mt-2">
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Update')); ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="card">
				<div class="card-header">
					<?php if($member->user_id == NULL): ?>
						<span class="header-title d-flex align-items-center justify-content-between">
							<span><?php echo e(_lang('Login Details')); ?></span>
							<label class="switch">
								<input type="checkbox" id="client_login" value="1" name="client_login" <?php echo e(request()->tenant->package->member_portal != 1 ? 'disabled' : ''); ?>>
								<span class="slider"></span>
							</label>  
                        </span>
					<?php else: ?>
						<span class="header-title"><?php echo e(_lang('Login Details')); ?></span>
						<input type="hidden" value="1" name="client_login">
					<?php endif; ?>
				</div>
				<div class="card-body" <?php echo e($member->user_id == NULL ? 'id=client_login_card' : ''); ?>>
					<div class="row">
						<?php if(request()->tenant->package->member_portal != 1): ?>
						<div class="col-md-12">
							<div class="alert alert-warning">
								<i class="fas fa-exclamation-circle"></i> <?php echo e(_lang('Your subscription plan does not include access to the Member Portal.')); ?>

							</div>
						</div>
						<?php endif; ?>
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Name')); ?></label>
								<input type="text" class="form-control" name="name" value="<?php echo e($member->user->name); ?>">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Email')); ?></label>
								<input type="text" class="form-control" name="login_email" value="<?php echo e($member->user->email); ?>">
							</div>
						</div>


						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Password')); ?></label>
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Status')); ?></label>
								<select class="form-control select2 auto-select" data-selected="<?php echo e($member->user->status); ?>" name="status">
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<option value="1"><?php echo e(_lang('Active')); ?></option>
									<option value="0"><?php echo e(_lang('In Active')); ?></option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js-script'); ?>
<script>
(function ($) {
	"use strict";

	if ($("#client_login").is(":checked") == false) {
		$("#client_login_card input, #client_login_card select").prop("disabled", true);
	}

	$(document).on("change", "#client_login", function() {
		if ($(this).is(":checked") == false) {
			$("#client_login_card input, #client_login_card select").prop(
				"disabled",
				true
			);
			$("#client_login_card input, #client_login_card select").prop(
				"required",
				false
			);
		} else {
			$("#client_login_card input, #client_login_card select").prop(
				"disabled",
				false
			);
			$("#client_login_card input, #client_login_card select").prop(
				"required",
				true
			);
		}
	});
})(jQuery);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/member/edit.blade.php ENDPATH**/ ?>