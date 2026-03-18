<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('public/backend/plugins/intl-tel-input/css/intlTelInput.css')); ?>"/>
<div class="row">
	<div class="col-lg-10 offset-lg-1">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Profile Settings')); ?></span>
			</div>
			<div class="card-body">
				<?php $isAadminRoute = auth()->user()->user_type == 'superadmin' ? 'admin.' : ''; ?>
				<form action="<?php echo e(route($isAadminRoute.'profile.update')); ?>" autocomplete="off" class="form-horizontal form-group rows-bordered validate" enctype="multipart/form-data" method="post">
					<?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-lg-10">
							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Name')); ?></label>
								<div class="col-xl-9">
									<input type="text" class="form-control" name="name" value="<?php echo e($profile->name); ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Email')); ?></label>
								<div class="col-xl-9">
									<input type="email" class="form-control" name="email" value="<?php echo e($profile->email); ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Mobile')); ?></label>
								<div class="col-xl-3">
                                    <select class="form-control<?php echo e($errors->has('country_code') ? ' is-invalid' : ''); ?> select2 no-msg" name="country_code">
                                        <option value=""><?php echo e(_lang('Country Code')); ?></option>
                                        <?php $__currentLoopData = get_country_codes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value['dial_code']); ?>" <?php echo e($profile->country_code == $value['dial_code'] ? 'selected' : ''); ?>><?php echo e($value['country'].' (+'.$value['dial_code'].')'); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-xl-6 mt-2 mt-xl-0">
                                    <input id="mobile" type="tel" class="form-control" name="mobile" value="<?php echo e($profile->mobile); ?>">
                                </div>
                            </div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('City')); ?></label>
								<div class="col-xl-9">
									<input type="text" class="form-control" name="city" value="<?php echo e($profile->city); ?>">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('State')); ?></label>
								<div class="col-xl-9">
									<input type="text" class="form-control" name="state" value="<?php echo e($profile->state); ?>">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('ZIP')); ?></label>
								<div class="col-xl-9">
									<input type="text" class="form-control" name="zip" value="<?php echo e($profile->zip); ?>">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Address')); ?></label>
								<div class="col-xl-9">
									<textarea class="form-control" name="address"><?php echo e($profile->address); ?></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Image')); ?> (300 X 300)</label>
								<div class="col-xl-9">
									<input type="file" class="form-control dropify" data-default-file="<?php echo e($profile->profile_picture != "" ? asset('public/uploads/profile/'.$profile->profile_picture) : ''); ?>" name="profile_picture" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
								</div>
							</div>

							<div class="form-group row mt-2">
								<div class="col-xl-9 offset-lg-3">
									<button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Update Profile')); ?></button>
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

<?php $__env->startSection('js-script'); ?>
<script src="<?php echo e(asset('public/backend/plugins/intl-tel-input/js/intlTelInput.min.js')); ?>"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector("#phone");

    window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: (success, failure) => {
            fetch("https://ipapi.co/json")
            .then((res) => res.json())
            .then((data) => success(data.country_code))
            .catch(() => failure());
        },
        countrySearch: false,
        separateDialCode: true,
        autoPlaceholder: "polite",
        nationalMode: false,
        utilsScript: "<?php echo e(asset('public/backend/plugins/intl-tel-input/js/utils.js')); ?>"
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/profile/profile_edit.blade.php ENDPATH**/ ?>