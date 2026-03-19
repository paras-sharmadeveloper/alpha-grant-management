

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-sm-3">
		<ul class="nav flex-column nav-tabs settings-tab mb-4" role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#general"><i class="fas fa-cog"></i><span><?php echo e(_lang('General Settings')); ?></span></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile_settings"><i class="ti-pencil"></i><?php echo e(_lang('Profile Settings')); ?></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#change_password"><i class="ti-exchange-vertical"></i><?php echo e(_lang('Change Password')); ?></a></li>
        
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sms_gateway"><i class="ti-comment"></i><?php echo e(_lang('SMS Gateways')); ?></a></li>
			
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#logo"><i class="fas fa-tint"></i><span><?php echo e(_lang('Logo and Favicon')); ?></span></a></li>
			
		</ul>
	</div>

	<?php $settings = \App\Models\Setting::all(); ?>

	<div class="col-sm-9">
		<div class="tab-content">
			<div id="general" class="tab-pane active">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('General Settings')); ?></span>
					</div>

					<div class="card-body">
						 <form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.update_settings','store')); ?>" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Company Name')); ?></label>
										<input type="text" class="form-control" name="company_name" value="<?php echo e(get_setting($settings, 'company_name')); ?>" required>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Site Title')); ?></label>
										<input type="text" class="form-control" name="site_title" value="<?php echo e(get_setting($settings, 'site_title')); ?>" required>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Phone')); ?></label>
										<input type="text" class="form-control" name="phone" value="<?php echo e(get_setting($settings, 'phone')); ?>">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Email')); ?></label>
										<input type="email" class="form-control" name="email" value="<?php echo e(get_setting($settings, 'email')); ?>">
									</div>
								</div>

								<div class="col-md-6">
								  	<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Backend Direction')); ?></label>
										<select class="form-control" name="backend_direction" required>
											<option value="ltr" <?php echo e(get_setting($settings, 'backend_direction') == 'ltr' ? 'selected' : ''); ?>><?php echo e(_lang('LTR')); ?></option>
											<option value="rtl" <?php echo e(get_setting($settings, 'backend_direction') == 'rtl' ? 'selected' : ''); ?>><?php echo e(_lang('RTL')); ?></option>
										</select>
								  	</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Date Format')); ?></label>
										<select class="form-control auto-select" name="date_format" data-selected="<?php echo e(get_setting($settings, 'date_format','Y-m-d')); ?>" required>
											<option value="Y-m-d"><?php echo e(date('Y-m-d')); ?></option>
											<option value="d-m-Y"><?php echo e(date('d-m-Y')); ?></option>
											<option value="d/m/Y"><?php echo e(date('d/m/Y')); ?></option>
											<option value="m-d-Y"><?php echo e(date('m-d-Y')); ?></option>
											<option value="m.d.Y"><?php echo e(date('m.d.Y')); ?></option>
											<option value="m/d/Y"><?php echo e(date('m/d/Y')); ?></option>
											<option value="d.m.Y"><?php echo e(date('d.m.Y')); ?></option>
											<option value="d/M/Y"><?php echo e(date('d/M/Y')); ?></option>
											<option value="d/M/Y"><?php echo e(date('M/d/Y')); ?></option>
											<option value="d M, Y"><?php echo e(date('d M, Y')); ?></option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Time Format')); ?></label>
										<select class="form-control auto-select" name="time_format" data-selected="<?php echo e(get_setting($settings, 'time_format',24)); ?>" required>
											<option value="24"><?php echo e(_lang('24 Hours')); ?></option>
											<option value="12"><?php echo e(_lang('12 Hours')); ?></option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
								  	<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Email Verification')); ?></label>
										<select class="form-control" name="email_verification" required>
											<option value="0" <?php echo e(get_setting($settings, 'email_verification') == '0' ? 'selected' : ''); ?>><?php echo e(_lang('Disabled')); ?></option>
											<option value="1" <?php echo e(get_setting($settings, 'email_verification') == '1' ? 'selected' : ''); ?>><?php echo e(_lang('Enabled')); ?></option>
										</select>
								  	</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Timezone')); ?></label>
										<select class="form-control select2" name="timezone" required>
											<option value=""><?php echo e(_lang('-- Select One --')); ?></option>
											<?php echo e(create_timezone_option(get_setting($settings, 'timezone'))); ?>

										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Language')); ?></label>
										<select class="form-control select2" name="language">
											<option value=""><?php echo e(_lang('-- Select One --')); ?></option>
											<?php echo e(load_language( get_setting($settings, 'language') )); ?>

										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Member Signup')); ?></label>
										<select class="form-control auto-select" name="member_signup" data-selected="<?php echo e(get_setting($settings, 'member_signup', 1)); ?>" required>
											<option value="1"><?php echo e(_lang('Yes')); ?></option>
											<option value="0"><?php echo e(_lang('No')); ?></option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Landing Page')); ?></label>
										<select class="form-control auto-select" name="landing_page_status" data-selected="<?php echo e(get_setting($settings, 'landing_page_status', 1)); ?>" required>
											<option value="1"><?php echo e(_lang('Enabled')); ?></option>
											<option value="0"><?php echo e(_lang('Disabled')); ?></option>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Address')); ?></label>
										<textarea class="form-control" name="address"><?php echo e(get_setting($settings, 'address')); ?></textarea>
									</div>
								</div>

								<div class="col-md-12 mt-2">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Save Settings')); ?></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="profile_settings" class="tab-pane fade">
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
													<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = get_country_codes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
													<option value="<?php echo e($value['dial_code']); ?>" <?php echo e($profile->country_code == $value['dial_code'] ? 'selected' : ''); ?>><?php echo e($value['country'].' (+'.$value['dial_code'].')'); ?></option>
													<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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


			<div id="change_password" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('Change Password')); ?></span>
					</div>

					<div class="card-body"> 
						<?php $isAadminRoute = auth()->user()->user_type == 'superadmin' ? 'admin.' : ''; ?>
						<form action="<?php echo e(route($isAadminRoute.'profile.update_password')); ?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<?php echo csrf_field(); ?>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Old Password')); ?></label>
										<input type="password" class="form-control" name="oldpassword" required>
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('New Password')); ?></label>
										<input type="password" class="form-control" name="password" required>
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Confirm Password')); ?></label>
										<input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-block"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Update Password')); ?></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="currency_settings" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('Currency Settings')); ?></span>
					</div>

					<div class="card-body"> 
						<form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.update_settings','store')); ?>" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Currency')); ?></label>
										<select class="form-control select2" name="currency" required>
											<option value=""><?php echo e(_lang('Select One')); ?></option>
											<?php echo e(get_currency_list(get_setting($settings, 'currency'))); ?>

										</select>
									</div>
								</div>	
								
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Currency Position')); ?></label>						
										<select class="form-control auto-select" data-selected="<?php echo e(get_setting($settings, 'currency_position','left')); ?>" name="currency_position" required>
											<option value="left"><?php echo e(_lang('Left')); ?></option>
											<option value="right"><?php echo e(_lang('Right')); ?></option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Thousand Seperator')); ?></label>	
										<input type="text" class="form-control" name="thousand_sep" value="<?php echo e(get_setting($settings, 'thousand_sep',',')); ?>">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Decimal Seperator')); ?></label>	
										<input type="text" class="form-control" name="decimal_sep" value="<?php echo e(get_setting($settings, 'decimal_sep','.')); ?>">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Decimal Places')); ?></label>	
										<input type="text" class="form-control" name="decimal_places" value="<?php echo e(get_setting($settings, 'decimal_places',2)); ?>">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><?php echo e(_lang('Save Settings')); ?></button>
									</div>
								</div>	
							</div>							
						</form>
					</div>
				</div>
			</div>

			<div id="email" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('Email Settings')); ?></span>
					</div>

					<div class="card-body">
						<form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.update_settings','store')); ?>" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
							<div class="row">
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label"><?php echo e(_lang('Mail Type')); ?></label>
									<select class="form-control niceselect wide" name="mail_type" id="mail_type" required>
									  <option value="smtp" <?php echo e(get_setting($settings, 'mail_type')=="smtp" ? "selected" : ""); ?>><?php echo e(_lang('SMTP')); ?></option>
									  <option value="sendmail" <?php echo e(get_setting($settings, 'mail_type')=="sendmail" ? "selected" : ""); ?>><?php echo e(_lang('Sendmail')); ?></option>
									</select>
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label"><?php echo e(_lang('From Email')); ?></label>
									<input type="text" class="form-control" name="from_email" value="<?php echo e(get_setting($settings, 'from_email')); ?>" required>
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label"><?php echo e(_lang('From Name')); ?></label>
									<input type="text" class="form-control" name="from_name" value="<?php echo e(get_setting($settings, 'from_name')); ?>" required>
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label"><?php echo e(_lang('SMTP Host')); ?></label>
									<input type="text" class="form-control smtp" name="smtp_host" value="<?php echo e(get_setting($settings, 'smtp_host')); ?>">
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label"><?php echo e(_lang('SMTP Port')); ?></label>
									<input type="text" class="form-control smtp" name="smtp_port" value="<?php echo e(get_setting($settings, 'smtp_port')); ?>">
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label"><?php echo e(_lang('SMTP Username')); ?></label>
									<input type="text" class="form-control smtp" autocomplete="off" name="smtp_username" value="<?php echo e(get_setting($settings, 'smtp_username')); ?>">
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label"><?php echo e(_lang('SMTP Password')); ?></label>
									<input type="password" class="form-control smtp" autocomplete="off" name="smtp_password" value="<?php echo e(get_setting($settings, 'smtp_password')); ?>">
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label"><?php echo e(_lang('SMTP Encryption')); ?></label>
									<select class="form-control smtp" name="smtp_encryption">
									   <option value=""><?php echo e(_lang('None')); ?></option>
									   <option value="ssl" <?php echo e(get_setting($settings, 'smtp_encryption')=="ssl" ? "selected" : ""); ?>><?php echo e(_lang('SSL')); ?></option>
									   <option value="tls" <?php echo e(get_setting($settings, 'smtp_encryption')=="tls" ? "selected" : ""); ?>><?php echo e(_lang('TLS')); ?></option>
									</select>
								  </div>
								</div>

								<div class="col-md-12 mt-2">
								  	<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Save Settings')); ?></button>
								  	</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="card mt-4">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('Send Test Email')); ?></span>
					</div>

					<div class="card-body">
						<form action="<?php echo e(route('admin.settings.send_test_email')); ?>" class="settings-submit params-panel" method="post">
							<div class="row">
								<?php echo csrf_field(); ?>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Email To')); ?></label>
										<input type="email" class="form-control" name="email_address" required>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Message')); ?></label>
										<textarea class="form-control" name="message" required></textarea>
									</div>
								</div>

								<div class="col-md-12 mt-2">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="far fa-paper-plane"></i>&nbsp;<?php echo e(_lang('Send Test Email')); ?></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="sms_gateway" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('SMS Gateways')); ?></span>
					</div>

					<div class="card-body">
						<div class="alert alert-primary">
							<i class="fas fa-info-circle"></i> <?php echo e(_lang('Please make sure to configure your SMS Gateway settings correctly before enabling sms gateway.')); ?>

						</div>

						<div class="accordion" id="sms_gateway">
							<div class="card">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								  <strong><?php echo e(_lang('Twilio')); ?></strong>
								</div>

								<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.update_settings','store')); ?>" enctype="multipart/form-data">
											<?php echo csrf_field(); ?>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('SMS Gateway')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<select class="form-control auto-select" data-selected="<?php echo e(get_setting($settings, 'sms_gateway', 'none')); ?>" name="sms_gateway" required>
														<option value="none"><?php echo e(_lang('None')); ?></option>
														<option value="twilio"><?php echo e(_lang('Twilio')); ?></option>
														<option value="textmagic"><?php echo e(_lang('Textmagic')); ?></option>
														<option value="nexmo"><?php echo e(_lang('Nexmo')); ?></option>
														<option value="infobip"><?php echo e(_lang('Infobip')); ?></option>
													</select>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('Account SID')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="twilio_account_sid" value="<?php echo e(get_setting($settings, 'twilio_account_sid')); ?>" required>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('Auth Token')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="twilio_auth_token" value="<?php echo e(get_setting($settings, 'twilio_auth_token')); ?>" required>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('From Number')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="twilio_number" value="<?php echo e(get_setting($settings, 'twilio_number')); ?>" required>
												</div>
											</div>

											<div class="form-group row">
												<div class="col-xl-9 col-lg-8 offset-xl-3 offset-lg-4">
													<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Save Settings')); ?></button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="card mt-2">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
								  <strong><?php echo e(_lang('Textmagic')); ?></strong>
								</div>

								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.update_settings','store')); ?>" enctype="multipart/form-data">
											<?php echo csrf_field(); ?>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('SMS Gateway')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<select class="form-control auto-select" data-selected="<?php echo e(get_setting($settings, 'sms_gateway', 'none')); ?>" name="sms_gateway" required>
														<option value="none"><?php echo e(_lang('None')); ?></option>
														<option value="twilio"><?php echo e(_lang('Twilio')); ?></option>
														<option value="textmagic"><?php echo e(_lang('Textmagic')); ?></option>
														<option value="nexmo"><?php echo e(_lang('Nexmo')); ?></option>
														<option value="infobip"><?php echo e(_lang('Infobip')); ?></option>
													</select>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('Username')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="textmagic_username" value="<?php echo e(get_setting($settings, 'textmagic_username')); ?>" required>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('API V2 KEY')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="textmagic_api_key" value="<?php echo e(get_setting($settings, 'textmagic_api_key')); ?>" required>
												</div>
											</div>

											<div class="form-group row">
												<div class="col-xl-9 col-lg-8 offset-xl-3 offset-lg-4">
													<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Save Settings')); ?></button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div> <!--End Textmagic -->

							<div class="card mt-2">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
								  <strong><?php echo e(_lang('Nexmo')); ?></strong>
								</div>

								<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.update_settings','store')); ?>" enctype="multipart/form-data">
											<?php echo csrf_field(); ?>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('SMS Gateway')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<select class="form-control auto-select" data-selected="<?php echo e(get_setting($settings, 'sms_gateway', 'none')); ?>" name="sms_gateway" required>
														<option value="none"><?php echo e(_lang('None')); ?></option>
														<option value="twilio"><?php echo e(_lang('Twilio')); ?></option>
														<option value="textmagic"><?php echo e(_lang('Textmagic')); ?></option>
														<option value="nexmo"><?php echo e(_lang('Nexmo')); ?></option>
														<option value="infobip"><?php echo e(_lang('Infobip')); ?></option>
													</select>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('API KEY')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="nexmo_api_key" value="<?php echo e(get_setting($settings, 'nexmo_api_key')); ?>" required>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('API Secret')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="nexmo_api_secret" value="<?php echo e(get_setting($settings, 'nexmo_api_secret')); ?>" required>
												</div>
											</div>

											<div class="form-group row">
												<div class="col-xl-9 col-lg-8 offset-xl-3 offset-lg-4">
													<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Save Settings')); ?></button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div> <!--End Nexmo -->

							<div class="card mt-2">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">
								  <strong><?php echo e(_lang('Infobip')); ?></strong>
								</div>

								<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.update_settings','store')); ?>" enctype="multipart/form-data">
											<?php echo csrf_field(); ?>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('SMS Gateway')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<select class="form-control auto-select" data-selected="<?php echo e(get_setting($settings, 'sms_gateway', 'none')); ?>" name="sms_gateway" required>
														<option value="none"><?php echo e(_lang('None')); ?></option>
														<option value="twilio"><?php echo e(_lang('Twilio')); ?></option>
														<option value="textmagic"><?php echo e(_lang('Textmagic')); ?></option>
														<option value="nexmo"><?php echo e(_lang('Nexmo')); ?></option>
														<option value="infobip"><?php echo e(_lang('Infobip')); ?></option>
													</select>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('API KEY')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="infobip_api_key" value="<?php echo e(get_setting($settings, 'infobip_api_key')); ?>" required>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('API BASE URL')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="infobip_api_base_url" value="<?php echo e(get_setting($settings, 'infobip_api_base_url')); ?>" required>
												</div>
											</div>

											<div class="form-group row">
												<div class="col-xl-9 col-lg-8 offset-xl-3 offset-lg-4">
													<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Save Settings')); ?></button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div> <!--End Infobip -->

						</div>
					</div>
				</div>
			</div>


			<div id="recaptcha" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('GOOGLE RECAPTCHA V3')); ?></span>
					</div>
					<div class="card-body">
						<form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.update_settings','store')); ?>">
							<?php echo csrf_field(); ?>
							<div class="row">
								<div class="col-xl-12">
									<div class="form-group row">
										<label class="col-xl-4 col-form-label"><?php echo e(_lang('Enable Recaptcha v3')); ?></label>
										<div class="col-xl-8">
											<select class="form-control auto-select" data-selected="<?php echo e(get_setting($settings, 'enable_recaptcha', 0)); ?>" name="enable_recaptcha" required>
												<option value="0"><?php echo e(_lang('No')); ?></option>
												<option value="1"><?php echo e(_lang('Yes')); ?></option>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-xl-4 col-form-label"><?php echo e(_lang('RECAPTCHA SITE KEY')); ?></label>
										<div class="col-xl-8">
											<input type="text" class="form-control" name="recaptcha_site_key" value="<?php echo e(get_setting($settings, 'recaptcha_site_key')); ?>">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-xl-4 col-form-label"><?php echo e(_lang('RECAPTCHA SECRET KEY')); ?></label>
										<div class="col-xl-8">
											<input type="text" class="form-control" name="recaptcha_secret_key" value="<?php echo e(get_setting($settings, 'recaptcha_secret_key')); ?>">
										</div>
									</div>

									<div class="form-group row mt-2">
										<div class="col-xl-8 offset-xl-4">
											<button type="submit" class="btn btn-primary"><?php echo e(_lang('Save Settings')); ?></button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="logo" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('Logo and Favicon')); ?></span>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.uplaod_logo')); ?>" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>
									<div class="row">
										<div class="col-md-12">
										  <div class="form-group">
											<label class="control-label"><?php echo e(_lang('Upload Logo')); ?></label>
											<input type="file" class="form-control dropify" name="logo" data-max-file-size="2M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-show-remove="false" data-default-file="<?php echo e(get_logo()); ?>" required>
										  </div>
										</div>

										<br>
										<div class="col-md-12 mt-2">
										  <div class="form-group">
											<button type="submit" class="btn btn-primary btn-block"><?php echo e(_lang('Upload')); ?></button>
										  </div>
										</div>
									</div>
								</form>
							</div>

							<div class="col-md-6">
								<form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.update_settings','store')); ?>" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>
									<div class="row">
										<div class="col-md-12">
										  <div class="form-group">
											<label class="control-label"><?php echo e(_lang('Upload Favicon')); ?> (PNG)</label>
											<input type="file" class="form-control dropify" name="favicon" data-max-file-size="1M" data-allowed-file-extensions="png" data-default-file="<?php echo e(get_favicon()); ?>" data-show-remove="false" required>
										  </div>
										</div>

										<div class="col-md-12 mt-2">
										  <div class="form-group">
											<button type="submit" class="btn btn-primary btn-block"><?php echo e(_lang('Upload')); ?></button>
										  </div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div><!--End Logo Tab-->

			<div id="cron_jobs" class="tab-pane fade">
				<div class="card">
					<div class="card-header d-flex align-items-center justify-content-between">
						<span class="panel-title"><?php echo e(_lang('Cron Jobs')); ?></span>
						<span><?php echo e(get_option('cornjob_runs_at') != null ? _lang('Last Runs At').' ('.date(get_date_format().' '.get_time_format(), strtotime(get_option('cornjob_runs_at'))).' UTC)' : ''); ?></span>
					</div>

					<div class="card-body">
						<div class="alert alert-warning">
							<span><i class="ti-info-alt"></i>&nbsp;<?php echo e(_lang('Run Cronjobs at least every').' 5 '._lang('minutes')); ?></span>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label"><?php echo e(_lang('Schedule Task Command')); ?></label>
									<div class="border bg-light p-2 rounded">cd /<span class="text-danger">your-project-path</span> && php artisan schedule:run >> /dev/null 2>&1</div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label"><?php echo e(_lang('Cronjobs Command example 1 for cPanel')); ?></label>
									<div class="border bg-light p-2 rounded"><?php echo e('/usr/local/bin/php ' . base_path() . '/artisan schedule:run >> /dev/null 2>&1'); ?></div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label"><?php echo e(_lang('Cronjobs Command example 2 for cPanel')); ?></label>
									<div class="border bg-light p-2 rounded"><?php echo e('cd ' . base_path() .  ' && /usr/local/bin/php artisan schedule:run >> /dev/null 2>&1'); ?></div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label"><?php echo e(_lang('Schedule Task Command example for Plesk')); ?></label>
									<div class="border bg-light p-2 rounded"><?php echo e('cd ' . base_path() .  ' && /opt/plesk/php/'. substr(phpversion(), 0, 3) .'/bin/php artisan schedule:run >> /dev/null 2>&1'); ?></div>
								</div>
							</div>
						</div>
				   </div>
				</div>
			</div>

			<div id="cache" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('Cache Control')); ?></span>
					</div>

					<div class="card-body">
						<form method="post" class="params-panel" autocomplete="off" action="<?php echo e(route('admin.settings.remove_cache')); ?>">
							<?php echo csrf_field(); ?>
							<div class="row">
								<div class="col-md-12">
									<div class="checkbox">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="cache[view_cache]" value="view_cache" id="view_cache">
											<label class="custom-control-label" for="view_cache"><?php echo e(_lang('View Cache')); ?></label>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="checkbox">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="cache[application_cache]" value="application_cache" id="application_cache">
											<label class="custom-control-label" for="application_cache"><?php echo e(_lang('Application Cache')); ?></label>
										</div>
									</div>
								</div>

								<div class="col-md-12 mt-4">
								  <div class="form-group">
									<button type="submit" class="btn btn-primary"><?php echo e(_lang('Remove Cache')); ?></button>
								  </div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div><!--End Cache Tab-->
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/super_admin/administration/general_settings/settings.blade.php ENDPATH**/ ?>