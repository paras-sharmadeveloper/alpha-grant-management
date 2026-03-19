

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="<?php echo e($alert_col); ?>">
		<ul class="nav nav-tabs business-settings-tabs" role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#general_settings"><i class="fas fa-cog mr-2"></i><span><?php echo e(_lang('General Settings')); ?></span></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#system_settings"><i class="fas fa-tools mr-2"></i><span><?php echo e(_lang('System Settings')); ?></span></a></li>

			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sms_gateway"><i class="fas fa-sms mr-2"></i><span><?php echo e(_lang('SMS Settings')); ?></span></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#logo"><i class="fas fa-camera mr-2"></i><span><?php echo e(_lang('Logo')); ?></span></a></li>
		</ul>

		<div class="tab-content settings-tab-content">
			<div id="general_settings" class="tab-pane active">
				<div class="card">
                    <div class="card-header">
                        <span><?php echo e(_lang('General Settings')); ?></span>
                    </div>
					<div class="card-body">
						<form action="<?php echo e(route('settings.store_general_settings')); ?>" class="settings-submit" autocomplete="off" method="post" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
                            <div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Business Name')); ?></label>	
								<div class="col-xl-9">
									<input type="text" class="form-control" name="business_name" value="<?php echo e(get_setting($settings, 'business_name', request()->tenant->name)); ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Email')); ?></label>	
								<div class="col-xl-9">
									<input type="email" class="form-control" name="email" value="<?php echo e(get_setting($settings, 'email')); ?>">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Phone')); ?></label>	
								<div class="col-xl-9">
									<input type="text" class="form-control" name="phone" value="<?php echo e(get_setting($settings, 'phone')); ?>">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Timezone')); ?></label>
								<div class="col-xl-9">
									<select class="form-control select2 auto-select" data-selected="<?php echo e(get_setting($settings, 'timezone','')); ?>" name="timezone" required>
										<option value=""><?php echo e(_lang('Select One')); ?></option>
										<?php echo e(create_timezone_option()); ?>

									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Language')); ?></label>
								<div class="col-xl-9">
									<select class="form-control select2 auto-select" name="language" data-selected="<?php echo e(get_setting($settings, 'language','')); ?>" required>
										<option value=""><?php echo e(_lang('Select One')); ?></option>
										<?php echo e(load_language()); ?>

									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Address')); ?></label>	
								<div class="col-xl-9">
									<textarea class="form-control" name="address"><?php echo e(get_setting($settings, 'address')); ?></textarea>
								</div>
							</div>

							<div class="form-group row mt-2">
								<div class="col-xl-9 offset-lg-3">
									<button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Save Changes')); ?></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="system_settings" class="tab-pane">
				<div class="card">
                    <div class="card-header">
                        <span><?php echo e(_lang('System Settings')); ?></span>
                    </div>
					<div class="card-body">
						<form action="<?php echo e(route('settings.store_general_settings')); ?>" class="settings-submit" autocomplete="off" method="post" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Starting Member No')); ?></label>	
								<div class="col-xl-9">
									<input type="text" class="form-control" name="starting_member_no" value="<?php echo e(get_setting($settings, 'starting_member_no')); ?>">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Members Sign Up Form')); ?></label>
								<div class="col-xl-9">
									<select class="form-control auto-select" name="members_sign_up" data-selected="<?php echo e(get_setting($settings, 'members_sign_up', 0)); ?>" required>
										<option value="0"><?php echo e(_lang('Disabled')); ?></option>
										<option value="1"><?php echo e(_lang('Active')); ?></option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Default Branch Name')); ?></label>	
								<div class="col-xl-9">
									<input type="text" class="form-control" name="default_branch_name" value="<?php echo e(get_setting($settings, 'default_branch_name', 'Main Branch')); ?>">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Backend Direction')); ?></label>
								<div class="col-xl-9">
									<select class="form-control auto-select" name="backend_direction" data-selected="<?php echo e(get_setting($settings, 'backend_direction', 'ltr')); ?>" required>
										<option value="ltr"><?php echo e(_lang('LTR')); ?></option>
										<option value="rtl"><?php echo e(_lang('RTL')); ?></option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Date Format')); ?></label>
								<div class="col-xl-9">
									<select class="form-control auto-select" name="date_format" data-selected="<?php echo e(get_setting($settings, 'date_format', 'Y-m-d')); ?>" required>
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

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Time Format')); ?></label>
								<div class="col-xl-9">
									<select class="form-control auto-select" name="time_format" data-selected="<?php echo e(get_setting($settings, 'time_format', 24)); ?>" required>
										<option value="24"><?php echo e(_lang('24 Hours')); ?></option>
										<option value="12"><?php echo e(_lang('12 Hours')); ?></option>
									</select>
								</div>
							</div>

							<div class="form-group row mt-2">
								<div class="col-xl-9 offset-lg-3">
									<button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Save Changes')); ?></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="currency_settings" class="tab-pane">
				<div class="card">
                    <div class="card-header">
                        <span><?php echo e(_lang('Currency Settings')); ?></span>
                    </div>
					<div class="card-body">
						<form method="post" class="settings-submit" autocomplete="off" action="<?php echo e(route('settings.store_currency_settings')); ?>" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>	                   
                            
							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Currency Position')); ?></label>						
								<div class="col-xl-9">
									<select class="form-control auto-select" data-selected="<?php echo e(get_setting($settings, 'currency_position', 'left')); ?>" name="currency_position" required>
										<option value="left"><?php echo e(_lang('Left')); ?></option>
										<option value="right"><?php echo e(_lang('Right')); ?></option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Thousand Seperator')); ?></label>	
								<div class="col-xl-9">
									<input type="text" class="form-control" name="thousand_sep" value="<?php echo e(get_setting($settings, 'thousand_sep', ',')); ?>">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Decimal Seperator')); ?></label>	
								<div class="col-xl-9">
									<input type="text" class="form-control" name="decimal_sep" value="<?php echo e(get_setting($settings, 'decimal_sep', '.')); ?>">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Decimal Places')); ?></label>	
								<div class="col-xl-9">
									<input type="text" class="form-control" name="decimal_places" value="<?php echo e(get_setting($settings, 'decimal_places', 2)); ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-xl-9 offset-xl-3">
									<button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Save Settings')); ?></button>
								</div>
							</div>								
						</form>
					</div>
				</div>
			</div>

            <div id="transaction_fee" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span><?php echo e(_lang('Transaction Fee')); ?></span>
                    </div>
                    <div class="card-body">
                        <form method="post" class="settings-submit" autocomplete="off" action="<?php echo e(route('settings.store_general_settings')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Own Account Transfer Fee Type')); ?></label>
										<select class="form-control auto-select" data-selected="percentage" name="own_account_transfer_fee_type">
											<option value="percentage"><?php echo e(_lang('Percentage')); ?></option>
											<option value="fixed"><?php echo e(_lang('Fixed')); ?></option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Own Account Transfer Fee')); ?></label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><?php echo e(get_base_currency()); ?> / %</span>
											</div>
											<input type="text" class="form-control float-field" name="own_account_transfer_fee" value="1" required="">
										</div>               
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Other Account Transfer Fee Type')); ?></label>
										<select class="form-control auto-select" data-selected="percentage" name="other_account_transfer_fee_type">
											<option value="percentage"><?php echo e(_lang('Percentage')); ?></option>
											<option value="fixed"><?php echo e(_lang('Fixed')); ?></option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Other Account Transfer Fee')); ?></label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><?php echo e(get_base_currency()); ?> / %</span>
											</div>
											<input type="text" class="form-control float-field" name="other_account_transfer_fee" value="1" required="">
										</div>               
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


			<div id="email" class="tab-pane">
				<div class="row">
					<div class="col-lg-8 mb-md-4">
						<div class="card">
							<div class="card-header">
								<span><?php echo e(_lang('Email Configuration')); ?></span>
							</div>
							<div class="card-body">
								<form method="post" class="settings-submit" autocomplete="off" action="<?php echo e(route('settings.store_email_settings')); ?>" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>
									<div class="form-group row">
										<label class="col-xl-3 col-form-label"><?php echo e(_lang('Mail Type')); ?></label>
										<div class="col-xl-9">
											<select class="form-control auto-select" data-selected="<?php echo e(get_setting($settings, 'mail_type', '')); ?>" name="mail_type" id="mail_type">
												<option value=""><?php echo e(_lang('None')); ?></option>
												<option value="smtp"><?php echo e(_lang('SMTP')); ?></option>
												<option value="sendmail"><?php echo e(_lang('Sendmail')); ?></option>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-xl-3 col-form-label"><?php echo e(_lang('From Email')); ?></label>
										<div class="col-xl-9">
											<input type="text" class="form-control" name="from_email" value="<?php echo e(get_setting($settings, 'from_email', '')); ?>">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-xl-3 col-form-label"><?php echo e(_lang('From Name')); ?></label>
										<div class="col-xl-9">
											<input type="text" class="form-control" name="from_name" value="<?php echo e(get_setting($settings, 'from_name', '')); ?>">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-xl-3 col-form-label"><?php echo e(_lang('SMTP Host')); ?></label>
										<div class="col-xl-9">
											<input type="text" class="form-control smtp" name="smtp_host" value="<?php echo e(get_setting($settings, 'smtp_host', '')); ?>">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-xl-3 col-form-label"><?php echo e(_lang('SMTP Port')); ?></label>
										<div class="col-xl-9">
											<input type="text" class="form-control smtp" name="smtp_port" value="<?php echo e(get_setting($settings, 'smtp_port', '')); ?>">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-xl-3 col-form-label"><?php echo e(_lang('SMTP Username')); ?></label>
										<div class="col-xl-9">
											<input type="text" class="form-control smtp" autocomplete="off" name="smtp_username" value="<?php echo e(get_setting($settings, 'smtp_username', '')); ?>">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-xl-3 col-form-label"><?php echo e(_lang('SMTP Password')); ?></label>
										<div class="col-xl-9">
											<input type="password" class="form-control smtp" autocomplete="off" name="smtp_password" value="<?php echo e(get_setting($settings, 'smtp_password', '')); ?>">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-xl-3 col-form-label"><?php echo e(_lang('SMTP Encryption')); ?></label>
										<div class="col-xl-9">
											<select class="form-control smtp auto-select" data-selected="<?php echo e(get_setting($settings, 'smtp_encryption', '')); ?>" name="smtp_encryption">
												<option value=""><?php echo e(_lang('None')); ?></option>
												<option value="ssl"><?php echo e(_lang('SSL')); ?></option>
												<option value="tls"><?php echo e(_lang('TLS')); ?></option>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-xl-9 offset-xl-3">
											<button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Save Settings')); ?></button>
										</div>
									</div>	
								</form>
							</div>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="card">
							<div class="card-header">
								<span><?php echo e(_lang('Send Test Email')); ?></span>
							</div>
							<div class="card-body">
								<form method="post" class="settings-submit" autocomplete="off" action="<?php echo e(route('settings.send_test_email')); ?>">
									<?php echo csrf_field(); ?>
									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Recipient Email')); ?></label>
										<input type="email" class="form-control" name="recipient_email">
									</div>

									<div class="form-group">
										<label class="control-label"><?php echo e(_lang('Message')); ?></label>
										<textarea class="form-control" name="message"></textarea>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-block"><i class="far fa-paper-plane mr-2"></i><?php echo e(_lang('Send Test Email')); ?></button>
									</div>	
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="sms_gateway" class="tab-pane fade">

				<div class="card">
					<div class="card-header">
						<span><?php echo e(_lang('SMS Gateways')); ?></span>
					</div>

					<div class="card-body">
						<div class="alert alert-primary">
							<i class="fas fa-info-circle"></i> <?php echo e(_lang('Please make sure to configure your SMS Gateway settings correctly. If you do not configure your SMS Gateway settings correctly, you will not be able to send SMS.')); ?>

						</div>
						<div class="accordion" id="sms_gateway">
							<div class="card border">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								  <strong><i class="fas fa-long-arrow-alt-right"></i> <?php echo e(_lang('Twilio')); ?></strong>
								</div>

								<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('settings.store_general_settings')); ?>">
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
													<input type="text" class="form-control" name="twilio_account_sid" value="<?php echo e(get_setting($settings, 'twilio_account_sid')); ?>">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('Auth Token')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="twilio_auth_token" value="<?php echo e(get_setting($settings, 'twilio_auth_token')); ?>">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('From Number')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="twilio_number" value="<?php echo e(get_setting($settings, 'twilio_number')); ?>">
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

							<div class="card border mt-2">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
								  <strong><i class="fas fa-long-arrow-alt-right"></i> <?php echo e(_lang('Textmagic')); ?></strong>
								</div>

								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('settings.store_general_settings')); ?>">
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
													<input type="text" class="form-control" name="textmagic_username" value="<?php echo e(get_setting($settings, 'textmagic_username')); ?>">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('API V2 KEY')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="textmagic_api_key" value="<?php echo e(get_setting($settings, 'textmagic_api_key')); ?>">
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

							<div class="card border mt-2">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
								  <strong><i class="fas fa-long-arrow-alt-right"></i> <?php echo e(_lang('Nexmo')); ?></strong>
								</div>

								<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('settings.store_general_settings')); ?>">
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
													<input type="text" class="form-control" name="nexmo_api_key" value="<?php echo e(get_setting($settings, 'nexmo_api_key')); ?>">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('API Secret')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="nexmo_api_secret" value="<?php echo e(get_setting($settings, 'nexmo_api_secret')); ?>">
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

							<div class="card border mt-2">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">
								  <strong><i class="fas fa-long-arrow-alt-right"></i> <?php echo e(_lang('Infobip')); ?></strong>
								</div>

								<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="<?php echo e(route('settings.store_general_settings')); ?>">
											<?php echo csrf_field(); ?>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('SMS Gateway')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<select class="form-control auto-select" data-selected="<?php echo e(get_setting($settings, 'sms_gateway', 'none')); ?>" name="sms_gateway">
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
													<input type="text" class="form-control" name="infobip_api_key" value="<?php echo e(get_setting($settings, 'infobip_api_key')); ?>">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-4 col-form-label"><?php echo e(_lang('API BASE URL')); ?></label>
												<div class="col-xl-9 col-lg-8">
													<input type="text" class="form-control" name="infobip_api_base_url" value="<?php echo e(get_setting($settings, 'infobip_api_base_url')); ?>">
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

			<div id="logo" class="tab-pane">
				<div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span><?php echo e(_lang('Business Logo')); ?></span>

						<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(get_setting($settings, 'logo') != ''): ?>
						<form action="<?php echo e(route('settings.store_general_settings')); ?>" method="post" class="d-inline-block">
							<?php echo csrf_field(); ?>
							<input type="hidden" name="logo" value="">
							<button type="submit" class="btn btn-danger btn-xs btn-remove"><i class="far fa-trash-alt mr-1"></i><?php echo e(_lang('Remove Logo')); ?></button>
						</form>
						<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
					<div class="card-body">
						<form method="post" class="settings-submit" autocomplete="off" action="<?php echo e(route('settings.upload_logo')); ?>" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
							<div class="form-group row">
								<label class="col-xl-3 col-form-label"><?php echo e(_lang('Business Logo')); ?></label>
								<div class="col-xl-9">
									<input type="file" class="dropify" name="logo" data-show-remove="false" data-default-file="<?php echo e(get_setting($settings, 'logo') != '' ? asset('public/uploads/media/'. get_setting($settings, 'logo')) : ''); ?>" required>
									<small><?php echo e(_lang('Allowed File Extensions: jpg, png')); ?></small>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-xl-9 offset-xl-3">
									<button type="submit" class="btn btn-primary"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Upload')); ?></button>
								</div>
							</div>	
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
(function($) {
    "use strict";
	
	function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    function updateQueryParam(tabName) {
        var newUrl = window.location.pathname + "?tab=" + tabName;
        history.replaceState(null, null, newUrl);
    }

    // Get tab name from query string
    var tabName = getQueryParam("tab");

    if (tabName) {
        var $tabLink = $('.nav-tabs a[href="#' + tabName + '"]');
        if ($tabLink.length) {
            $tabLink.tab("show");
        }
    } else {
        $('.nav-tabs a:first').tab("show");
    }

    // Update query string on tab click
    $(".nav-tabs [data-toggle='tab']").on("click", function (e) {
        e.preventDefault();
        $(this).tab("show");

        var tabId = $(this).attr("href").replace("#", "");
        updateQueryParam(tabId);
    });
})(jQuery);
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/settings/index.blade.php ENDPATH**/ ?>