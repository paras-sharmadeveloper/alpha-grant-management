

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-4 col-lg-3">
		<ul class="nav flex-column nav-tabs settings-tab" role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#member_details"><i class="ti-user"></i>&nbsp;<?php echo e(_lang('Member Details')); ?></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#transaction-history"><i class="ti-view-list-alt"></i><?php echo e(_lang('Transactions')); ?></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#member_loans"><i class="ti-agenda"></i>&nbsp;<?php echo e(_lang('Loans')); ?></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kyc_documents"><i class="ti-files"></i>&nbsp;<?php echo e(_lang('KYC Documents')); ?></a></li>
           
             <li class="nav-item"><a class="nav-link" href="<?php echo e(route('members.edit', $member->id)); ?>"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit Member Details')); ?></a></li>
		</ul>
	</div>

	<div class="col-md-8 col-lg-9">
		<div class="tab-content">
			<div id="member_details" class="tab-pane active">
				<div class="card">
					<div class="card-header">
						<span class="header-title"><?php echo e(_lang('Member Details')); ?></span>
					</div>

					<div class="card-body">
						<table class="table table-bordered">
							<tr>
								<td colspan="2" class="profile_picture text-center">
                                        <img src="<?php echo e(($member->photo && $member->photo !== 'default.png') 
                                            ? profile_picture($member->photo) 
                                            : asset('public/backend/images/avatar.png')); ?>" 
                                            class="thumb-image-md">
                                    </td>
							</tr>
							<tr><td><?php echo e(_lang('First Name')); ?></td><td><?php echo e($member->first_name); ?></td></tr>
							<tr><td><?php echo e(_lang('Last Name')); ?></td><td><?php echo e($member->last_name); ?></td></tr>
							<tr><td><?php echo e(_lang('Business Name')); ?></td><td><?php echo e($member->business_name); ?></td></tr>
							<tr><td><?php echo e(_lang('Member No')); ?></td><td><?php echo e($member->member_no); ?></td></tr>
							<tr><td><?php echo e(_lang('Branch')); ?></td><td><?php echo e($member->branch->name); ?></td></tr>
							<tr><td><?php echo e(_lang('Email')); ?></td><td><?php echo e($member->email); ?></td></tr>
							<tr><td><?php echo e(_lang('Mobile')); ?></td><td><?php echo e($member->country_code.$member->mobile); ?></td></tr>
							<tr><td><?php echo e(_lang('Gender')); ?></td><td><?php echo e(ucwords($member->gender)); ?></td></tr>
							<tr><td><?php echo e(_lang('City')); ?></td><td><?php echo e($member->city); ?></td></tr>
							<tr><td><?php echo e(_lang('State')); ?></td><td><?php echo e($member->state); ?></td></tr>
							<tr><td><?php echo e(_lang('Zip')); ?></td><td><?php echo e($member->zip); ?></td></tr>
                            <!--Custom Fields-->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $customFields->isEmpty()): ?>
                                <?php $customFieldsData = json_decode($member->custom_fields, true); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td><?php echo e($customField->field_name); ?></td>
                                    <td>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customField->field_type == 'file'): ?>
                                        <?php $file = $customFieldsData[str_replace(' ', '_', $customField->field_name)]['field_value'] ?? null; ?>
                                        <?php echo $file != null ? '<a href="'. asset('public/uploads/media/'.$file) .'" target="_blank" class="btn btn-xs btn-primary"><i class="fas fa-download mr-2"></i>'._lang('Download').'</a>' : ''; ?>

                                        <?php else: ?>
                                        <?php echo e($customFieldsData[str_replace(' ', '_', $customField->field_name)]['field_value'] ?? null); ?>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
							<tr><td><?php echo e(_lang('Address')); ?></td><td><?php echo e($member->address); ?></td></tr>
							<tr><td><?php echo e(_lang('Credit Source')); ?></td><td><?php echo e($member->credit_source); ?></td></tr>
						</table>
					</div>
				</div>
			</div>

			<div id="account_overview" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Account Overview')); ?></span>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap pl-4"><?php echo e(_lang('Account Number')); ?></th>
                                        <th class="text-nowrap"><?php echo e(_lang('Account Type')); ?></th>
                                        <th><?php echo e(_lang('Currency')); ?></th>
                                        <th class="text-right"><?php echo e(_lang('Balance')); ?></th>
                                        <th class="text-nowrap text-right"><?php echo e(_lang('Loan Guarantee')); ?></th>
                                        <th class="text-nowrap text-right pr-4"><?php echo e(_lang('Current Balance')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = get_account_details($member->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr>
                                        <td class="pl-4"><?php echo e($account->account_number); ?></td>
                                        <td class="text-nowrap"><?php echo e($account->savings_type->name); ?></td>
                                        <td><?php echo e($account->savings_type->currency->name); ?></td>
                                        <td class="text-nowrap text-right"><?php echo e(decimalPlace($account->balance, currency($account->savings_type->currency->name))); ?></td>
                                        <td class="text-nowrap text-right"><?php echo e(decimalPlace($account->blocked_amount, currency($account->savings_type->currency->name))); ?></td>
                                        <td class="text-nowrap text-right pr-4"><?php echo e(decimalPlace($account->balance - $account->blocked_amount, currency($account->savings_type->currency->name))); ?></td>
                                    </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </tbody>
                            </table>
					    </div>
					</div>
				</div>
			</div>

			<div id="transaction-history" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Transactions')); ?></span>
                    </div>

                    <div class="card-body">
						<table id="transactions_table" class="table table-bordered">
							<thead>
								<tr>
									<th><?php echo e(_lang('Date')); ?></th>
									<th><?php echo e(_lang('Member')); ?></th>
									<th><?php echo e(_lang('Account Number')); ?></th>
									<th><?php echo e(_lang('Amount')); ?></th>
									<th><?php echo e(_lang('Debit/Credit')); ?></th>
									<th><?php echo e(_lang('Type')); ?></th>
									<th><?php echo e(_lang('Status')); ?></th>
									<th class="text-center"><?php echo e(_lang('Action')); ?></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div><!--End Transaction Table-->

			<div id="member_loans" class="tab-pane">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <span class="header-title"><?php echo e(_lang('Loans')); ?></span>
                        <button class="btn btn-primary btn-xs ml-auto" id="btn_member_pay">
                            <i class="ti-credit-card"></i>&nbsp;<?php echo e(_lang('Pay')); ?>

                        </button>
                    </div>

                    <div class="card-body">
						<table id="loans_table" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(_lang('Loan ID')); ?></th>
                                    <th><?php echo e(_lang('Loan Product')); ?></th>
                                    <th class="text-right"><?php echo e(_lang('Applied Amount')); ?></th>
                                    <th class="text-right"><?php echo e(_lang('Amount Paid')); ?></th>
                                    <th class="text-right"><?php echo e(_lang('Due Amount')); ?></th>
                                    <th><?php echo e(_lang('Release Date')); ?></th>
                                    <th><?php echo e(_lang('Status')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $member->loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td><a href="<?php echo e(route('loans.show',$loan->id)); ?>"><?php echo e($loan->loan_id); ?></a></td>
                                    <td><?php echo e($loan->loan_product->name); ?></td>
                                    <td class="text-right"><?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?></td>
                                    <td class="text-right"><?php echo e(decimalPlace($loan->total_paid, currency($loan->currency->name))); ?></td>
                                    <td class="text-right"><?php echo e(decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name))); ?></td>
                                    <td><?php echo e($loan->release_date); ?></td>
                                    <td>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->status == 0): ?>
                                            <?php echo xss_clean(show_status(_lang('Pending'), 'warning')); ?>

                                        <?php elseif($loan->status == 1): ?>
                                            <?php echo xss_clean(show_status(_lang('Approved'), 'success')); ?>

                                        <?php elseif($loan->status == 2): ?>
                                            <?php echo xss_clean(show_status(_lang('Completed'), 'info')); ?>

                                        <?php elseif($loan->status == 3): ?>
                                            <?php echo xss_clean(show_status(_lang('Cancelled'), 'danger')); ?>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
					</div>
				</div>
			</div>

			<div id="kyc_documents" class="tab-pane">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <span class="header-title"><?php echo e(_lang('Documents of').' '.$member->first_name.' '.$member->last_name); ?></span>
                        <a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="<?php echo e(_lang('Add New Document')); ?>" href="<?php echo e(route('member_documents.create', $member->id)); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add New')); ?></a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(_lang('Document Name')); ?></th>
                                    <th><?php echo e(_lang('Document File')); ?></th>
                                    <th><?php echo e(_lang('Submitted At')); ?></th>
                                    <th><?php echo e(_lang('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $member->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td><?php echo e($document->name); ?></td>
                                    <td><a target="_blank" href="<?php echo e(asset('public/uploads/documents/'.$document->document )); ?>"><?php echo e($document->document); ?></a></td>
                                    <td><?php echo e(date('d M, Y H:i:s',strtotime($document->created_at))); ?></td>
                                    <td class="text-center">
                                        <span class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e(_lang('Action')); ?>

                                        </button>
                                        <form action="<?php echo e(route('member_documents.destroy', $document->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <input name="_method" type="hidden" value="DELETE">

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="<?php echo e(route('member_documents.edit', $document->id)); ?>" data-title="<?php echo e(_lang('Update Document')); ?>" class="dropdown-item dropdown-edit ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
                                                <button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;<?php echo e(_lang('Delete')); ?></button>
                                            </div>
                                        </form>
                                        </span>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--End KYC Documents Tab-->

			<div id="email" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Send Email')); ?></span>
                    </div>

                    <div class="card-body">
                        <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('members.send_email')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo e(_lang('User Email')); ?></label>
                                        <input type="email" class="form-control" name="user_email" value="<?php echo e($member->email); ?>" required="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo e(_lang('Subject')); ?></label>
                                        <input type="text" class="form-control" name="subject" value="<?php echo e(old('subject')); ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo e(_lang('Message')); ?></label>
                                        <textarea class="form-control" rows="8" name="message" required><?php echo e(old('message')); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Send')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--End Send Email Tab-->

            <div id="sms" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title"><?php echo e(_lang('Send SMS')); ?></span>
                    </div>

                    <div class="card-body">
                        <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('members.send_sms')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo e(_lang('User Mobile')); ?></label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo e($member->country_code.$member->mobile); ?>" required="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo e(_lang('Message')); ?></label>
                                        <textarea class="form-control" name="message" required><?php echo e(old('message')); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Send')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--End Send SMS Tab-->

		</div>
	</div>
</div>


<div class="modal fade" id="memberPayModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(_lang('Make Payment')); ?> — <?php echo e($member->first_name); ?> <?php echo e($member->last_name); ?></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="mp_step_search">
                    <div class="form-group">
                        <label><?php echo e(_lang('Search Loan')); ?></label>
                        <input type="text" id="member_pay_search" class="form-control" placeholder="<?php echo e(_lang('Loan ID or member name...')); ?>" autocomplete="off">
                    </div>
                    <div id="member_pay_results" class="mt-2"></div>
                </div>
                <div id="mp_step_form" style="display:none;">
                    <div class="alert alert-info py-2" id="mp_loan_info"></div>
                    <form id="mp_form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="loan_id" id="mp_loan_id">
                        <input type="hidden" name="due_amount_of" id="mp_due_amount_of">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Payment Date')); ?></label>
                                    <input type="text" class="form-control datepicker" name="paid_at" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Principal')); ?></label>
                                    <input type="number" step="0.01" class="form-control" name="principal_amount" id="mp_principal" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Interest')); ?></label>
                                    <input type="number" step="0.01" class="form-control" name="interest" id="mp_interest" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Late Penalties')); ?></label>
                                    <input type="number" step="0.01" class="form-control" name="late_penalties" id="mp_penalties" value="0">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Total')); ?></label>
                                    <input type="number" step="0.01" class="form-control" id="mp_total" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex flex-wrap mb-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm mr-2 mb-1 mp-method-btn active" data-method="cash"><i class="fas fa-money-bill-wave"></i> <?php echo e(_lang('Cash')); ?></button>
                                    <button type="button" class="btn btn-outline-primary btn-sm mr-2 mb-1 mp-method-btn" data-method="bank_transfer"><i class="fas fa-university"></i> <?php echo e(_lang('Bank Transfer')); ?></button>
                                    <a href="#" id="stripe_mp_link" class="btn btn-outline-danger btn-sm mr-2 mb-1"><i class="fab fa-stripe-s"></i> <?php echo e(_lang('Stripe')); ?></a>
                                </div>
                                <input type="hidden" name="payment_method" id="mp_method" value="cash">
                            </div>
                            <div class="col-md-12" id="mp_bank_section" style="display:none;">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Transaction / Reference Number')); ?></label>
                                    <input type="text" class="form-control" name="utr_number" placeholder="<?php echo e(_lang('Bank reference number')); ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Remarks')); ?></label>
                                    <textarea class="form-control" name="remarks" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary btn-sm" id="mp_back"><i class="ti-arrow-left"></i> <?php echo e(_lang('Back')); ?></button>
                            <button type="submit" class="btn btn-primary btn-sm" id="mp_submit"><i class="ti-check"></i> <?php echo e(_lang('Process Payment')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
(function ($) {
	"use strict";

	$('#transactions_table').DataTable({
		processing: true,
		serverSide: true,
		ajax: _tenant_url + '/members/get_member_transaction_data/<?php echo e($member->id); ?>',
		"columns" : [
			{ data : 'trans_date', name : 'trans_date' },
			{ data : 'member.first_name', name : 'member.first_name' },
			{ data : 'account_number', name : 'account_number', orderable: false },
			{ data : 'amount', name : 'amount' },
			{ data : 'dr_cr', name : 'dr_cr' },
			{ data : 'type', name : 'type' },
			{ data : 'status', name : 'status' },
			{ data : "action", name : "action" },
		],
		responsive: true,
		"bStateSave": true,
		"bAutoWidth":false,
		"ordering": false,
		"language": {
		   "decimal":        "",
		   "emptyTable":     "<?php echo e(_lang('No Data Found')); ?>",
		   "info":           "<?php echo e(_lang('Showing')); ?> _START_ <?php echo e(_lang('to')); ?> _END_ <?php echo e(_lang('of')); ?> _TOTAL_ <?php echo e(_lang('Entries')); ?>",
		   "infoEmpty":      "<?php echo e(_lang('Showing 0 To 0 Of 0 Entries')); ?>",
		   "infoFiltered":   "(filtered from _MAX_ total entries)",
		   "infoPostFix":    "",
		   "thousands":      ",",
		   "lengthMenu":     "<?php echo e(_lang('Show')); ?> _MENU_ <?php echo e(_lang('Entries')); ?>",
		   "loadingRecords": "<?php echo e(_lang('Loading...')); ?>",
		   "processing":     "<?php echo e(_lang('Processing...')); ?>",
		   "search":         "<?php echo e(_lang('Search')); ?>",
		   "zeroRecords":    "<?php echo e(_lang('No matching records found')); ?>",
		   "paginate": {
			  "first":      "<?php echo e(_lang('First')); ?>",
			  "last":       "<?php echo e(_lang('Last')); ?>",
              "previous":   "<i class='fas fa-angle-left'></i>",
        	  "next" :      "<i class='fas fa-angle-right'></i>",
		  }
		},
        drawCallback: function () {
			$(".dataTables_paginate > .pagination").addClass("pagination-bordered");
		}
	});

    $('.nav-tabs a').on('shown.bs.tab', function(event){
   		var tab = $(event.target).attr("href");
   		var url = "<?php echo e(route('members.show',$member->id)); ?>";
   	    history.pushState({}, null, url + "?tab=" + tab.substring(1));
   	});

   	<?php if(isset($_GET['tab'])): ?>
   	   $('.nav-tabs a[href="#<?php echo e($_GET['tab']); ?>"]').tab('show');
   	<?php endif; ?>

    $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });

    // ── Member Pay Button ─────────────────────────────────────────────────────
    var memberNo   = '<?php echo e($member->member_no); ?>';
    var stripeBase = '<?php echo e(url(request()->route("tenant") . "/pay/stripe")); ?>';

    $('#btn_member_pay').on('click', function () {
        $('#memberPayModal').modal('show');
        // Auto-search by member number
        $('#member_pay_search').val(memberNo).trigger('input');
    });

    var memberPayTimer;
    $('#member_pay_search').on('input', function () {
        clearTimeout(memberPayTimer);
        var q = $(this).val().trim();
        if (!q) { $('#member_pay_results').html(''); return; }
        memberPayTimer = setTimeout(function () {
            $.get('<?php echo e(route("pay.search")); ?>', { q: q }, function (data) {
                if (!data.length) {
                    $('#member_pay_results').html('<p class="text-muted small"><?php echo e(_lang("No active loans found")); ?></p>');
                    return;
                }
                var html = '<table class="table table-sm table-hover"><thead><tr>'
                    + '<th><?php echo e(_lang("Loan ID")); ?></th><th><?php echo e(_lang("Outstanding")); ?></th><th><?php echo e(_lang("Next Due")); ?></th><th></th>'
                    + '</tr></thead><tbody>';
                $.each(data, function (i, loan) {
                    html += '<tr>'
                        + '<td>' + loan.loan_id + '</td>'
                        + '<td>' + loan.currency + ' ' + parseFloat(loan.outstanding).toFixed(2) + '</td>'
                        + '<td>' + (loan.next_due_date || '-') + '</td>'
                        + '<td><button class="btn btn-primary btn-xs btn-mp-select" data-loan=\'' + JSON.stringify(loan) + '\'><?php echo e(_lang("Pay")); ?></button></td>'
                        + '</tr>';
                });
                html += '</tbody></table>';
                $('#member_pay_results').html(html);
            });
        }, 300);
    });

    $(document).on('click', '.btn-mp-select', function () {
        var loan = $(this).data('loan');
        $('#mp_loan_id').val(loan.id);
        $('#mp_due_amount_of').val(loan.next_repayment_id);
        $('#mp_principal').val(parseFloat(loan.next_principal).toFixed(2));
        $('#mp_interest').val(parseFloat(loan.next_interest).toFixed(2));
        $('#mp_penalties').val(0);
        mpRecalc();
        $('#stripe_mp_link').attr('href', stripeBase + '/' + loan.id + '?late=0');
        $('#mp_loan_info').html('<strong>' + loan.loan_id + '</strong> &mdash; <?php echo e(_lang("Outstanding")); ?>: ' + loan.currency + ' ' + parseFloat(loan.outstanding).toFixed(2));
        $('#mp_step_search').hide();
        $('#mp_step_form').show();
    });

    $('#mp_back').on('click', function () { $('#mp_step_form').hide(); $('#mp_step_search').show(); });

    $(document).on('click', '.mp-method-btn', function () {
        $('.mp-method-btn').removeClass('active');
        $(this).addClass('active');
        $('#mp_method').val($(this).data('method'));
        $('#mp_bank_section').toggle($(this).data('method') === 'bank_transfer');
    });

    function mpRecalc() {
        var p = parseFloat($('#mp_principal').val()) || 0;
        var i = parseFloat($('#mp_interest').val()) || 0;
        var pen = parseFloat($('#mp_penalties').val()) || 0;
        $('#mp_total').val((p + i + pen).toFixed(2));
        var loanId = $('#mp_loan_id').val();
        if (loanId) $('#stripe_mp_link').attr('href', stripeBase + '/' + loanId + '?late=' + pen);
    }
    $('#mp_principal, #mp_interest, #mp_penalties').on('input', mpRecalc);

    $('#mp_form').on('submit', function (e) {
        e.preventDefault();
        var btn = $('#mp_submit').prop('disabled', true).text('<?php echo e(_lang("Processing...")); ?>');
        $.ajax({
            url: '<?php echo e(route("pay.process")); ?>',
            method: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                if (res.result === 'success') {
                    $('#memberPayModal').modal('hide');
                    toastr.success(res.message);
                    location.reload();
                } else {
                    toastr.error(Array.isArray(res.message) ? res.message.join('<br>') : res.message);
                }
            },
            error: function () { toastr.error('<?php echo e(_lang("An error occurred")); ?>'); },
            complete: function () { btn.prop('disabled', false).text('<?php echo e(_lang("Process Payment")); ?>'); }
        });
    });

    $('#memberPayModal').on('hidden.bs.modal', function () {
        $('#mp_step_form').hide();
        $('#mp_step_search').show();
        $('#member_pay_results').html('');
    });

})(jQuery);
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/member/view.blade.php ENDPATH**/ ?>