<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('public/backend/plugins/intl-tel-input/css/intlTelInput.css')); ?>"/>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <span class="panel-title"><?php echo e(_lang('Add New User')); ?></span>
            </div>
            <div class="card-body">
                <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('users.store')); ?>"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('Name')); ?></label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('Email')); ?></label>
                                <div class="col-xl-9">
                                    <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('Password')); ?></label>
                                <div class="col-xl-9">
                                    <input type="password" class="form-control" name="password" value="" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('User Type')); ?></label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="<?php echo e(old('user_type')); ?>"
                                        name="user_type" id="user_type" required>
                                        <option value=""><?php echo e(_lang('Select One')); ?></option>
                                        <option value="admin"><?php echo e(_lang('Admin')); ?></option>
                                        <option value="user"><?php echo e(_lang('User')); ?></option>
                                    </select>
                                    <small class="text-primary"><i class="ti-info-alt"></i> <i><?php echo e(_lang('Admin will get full access and user will get role based access only.')); ?></i></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('User Role')); ?></label>
                                <div class="col-xl-9">
                                    <select class="form-control select2-ajax" data-href="<?php echo e(route('roles.create')); ?>" data-title="<?php echo e(_lang('Add New Role')); ?>" data-value="id" data-display="name"
                                        data-table="roles" data-where="3" name="role_id" id="role_id" disabled>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('Branch')); ?></label>
                                <div class="col-xl-9">
                                    <select class="form-control select2 auto-select" data-selected="<?php echo e(old('branch_id')); ?>" name="branch_id" id="user_branch_id">
                                        <option value="all_branch"><?php echo e(_lang('All Branch')); ?></option>
                                        <option value=""><?php echo e(get_tenant_option('default_branch_name', 'Main Branch')); ?></option>
                                        <?php $__currentLoopData = \App\Models\Branch::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <small class="text-primary"><i class="ti-info-alt"></i> <i><?php echo e(_lang('If not assign any branch then user will get default branch access.')); ?></i></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('Status')); ?></label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="<?php echo e(old('status', 1)); ?>"
                                        name="status" required>
                                        <option value=""><?php echo e(_lang('Select One')); ?></option>
                                        <option value="1"><?php echo e(_lang('Active')); ?></option>
                                        <option value="0"><?php echo e(_lang('In Active')); ?></option>
                                    </select>
                                    <a href="" class="mt-3 d-block toggle-optional-fields" data-toggle-title="<?php echo e(_lang('Hide Optional Fields')); ?>"><?php echo e(_lang('Show Optional Fields')); ?></a>
                                </div>
                            </div>

                            <div class="form-group row optional-field">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('Mobile')); ?></label>

                                <div class="col-xl-3">
                                    <select class="form-control<?php echo e($errors->has('country_code') ? ' is-invalid' : ''); ?> select2 no-msg" name="country_code">
                                        <option value=""><?php echo e(_lang('Country Code')); ?></option>
                                        <?php $__currentLoopData = get_country_codes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value['dial_code']); ?>" <?php echo e(old('country_code') == $value['dial_code'] ? 'selected' : ''); ?>><?php echo e($value['country'].' (+'.$value['dial_code'].')'); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="col-xl-6 mt-2 mt-xl-0">
                                    <input id="mobile" type="tel" class="form-control" name="mobile" value="<?php echo e(old('mobile')); ?>">
                                </div>
                            </div>

                            <div class="form-group row optional-field">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('City')); ?></label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="city" value="<?php echo e(old('city')); ?>">
                                </div>
                            </div>

                            <div class="form-group row optional-field">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('State')); ?></label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="state" value="<?php echo e(old('state')); ?>">
                                </div>
                            </div>

                            <div class="form-group row optional-field">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('ZIP')); ?></label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="zip" value="<?php echo e(old('zip')); ?>">
                                </div>
                            </div>

                            <div class="form-group row optional-field">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('Address')); ?></label>
                                <div class="col-xl-9">
                                    <textarea class="form-control" name="address"><?php echo e(old('address')); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row optional-field">
                                <label class="col-xl-3 col-form-label"><?php echo e(_lang('Profile Picture')); ?></label>
                                <div class="col-xl-9">
                                    <input type="file" class="dropify" name="profile_picture">
                                </div>
                            </div>
    
                            <div class="form-group row mt-4">
                                <div class="col-xl-9 offset-xl-3">
                                    <button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Create User')); ?></button>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/user/create.blade.php ENDPATH**/ ?>