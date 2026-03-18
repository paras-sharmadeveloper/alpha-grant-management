<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<ul class="nav nav-tabs business-settings-tabs" role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#overview"><i class="far fa-user-circle mr-2"></i><span><?php echo e(_lang('Tenant Details')); ?></span></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#package_details"><i class="fas fa-box mr-2"></i><span><?php echo e(_lang('Subscription Plan')); ?></span></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payments"><i class="far fa-credit-card mr-2"></i><span><?php echo e(_lang('Payments')); ?></span></a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#email"><i class="fas fa-at mr-2"></i><span><?php echo e(_lang('Send Email')); ?></span></a></li>
			 <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.tenants.edit', $tenant->id)); ?>"><i class="far fa-edit mr-2"></i><span><?php echo e(_lang('Edit Tenant')); ?></span></a></li>
		</ul>

		<div class="tab-content settings-tab-content">
		
			<div id="overview" class="tab-pane active">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('Tenant Details')); ?></span>
					</div>
					
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr><td><?php echo e(_lang('Name')); ?></td><td><?php echo e($tenant->name); ?></td></tr>
								<tr><td><?php echo e(_lang('Email')); ?></td><td><?php echo e($tenant->owner->email); ?></td></tr>
								<tr>
									<td><?php echo e(_lang('Workspace')); ?></td>
									<td><?php echo e($tenant->slug); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang('Login URL')); ?></td>
									<td><?php echo e(url('/'.$tenant->slug.'/login')); ?></td>
								</tr>
								<tr><td><?php echo e(_lang('Status')); ?></td><td><?php echo xss_clean(status($tenant->status)); ?></td></tr>
								<tr><td><?php echo e(_lang('Membership Type')); ?></td><td><?php echo e(ucwords($tenant->membership_type)); ?></td></tr>
								<tr><td><?php echo e(_lang('Subscription Date')); ?></td><td><?php echo e($tenant->subscription_date); ?></td></tr>
								<tr><td><?php echo e(_lang('Expiration')); ?></td><td><?php echo e($tenant->valid_to); ?></td></tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div id="package_details" class="tab-pane">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('Package Details')); ?></span>
					</div>
					
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<td><?php echo e(_lang('Subscription Plan')); ?></td>
									<td><?php echo e($tenant->package->name); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang('Plan Type')); ?></td>
									<td><?php echo e(ucwords($tenant->package->package_type)); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang('Role Based User Limit')); ?></td>
									<td><?php echo e(str_replace('-1',_lang('Unlimited'), $tenant->package->user_limit)); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang('Member Limit')); ?></td>
									<td><?php echo e(str_replace('-1',_lang('Unlimited'), $tenant->package->member_limit)); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang('Branch Limit')); ?></td>
									<td><?php echo e(str_replace('-1',_lang('Unlimited'), $tenant->package->branch_limit)); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang('Account Type Limit')); ?></td>
									<td><?php echo e(str_replace('-1',_lang('Unlimited'), $tenant->package->account_type_limit)); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang('Account Limit')); ?></td>
									<td><?php echo e(str_replace('-1',_lang('Unlimited'), $tenant->package->account_limit)); ?></td>
								</tr>
								<tr>
									<td><?php echo e(_lang('Member Portal')); ?></td>
									<td><?php echo e($tenant->package->member_portal == 1 ? _lang('Yes') : _lang('No')); ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div id="payments" class="tab-pane">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('Payments')); ?></span>
					</div>
					
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table table-bordered mb-0">
								<thead>
									<tr>
										<th class="pl-4"><?php echo e(_lang('Order ID')); ?></th>
										<th><?php echo e(_lang('Payment Date')); ?></th>
										<th><?php echo e(_lang('Amount')); ?></th>
										<th><?php echo e(_lang('Payment Method')); ?></th>
										<th><?php echo e(_lang('Status')); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $tenant->subscriptionPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td class="pl-4"><?php echo e($payment->order_id); ?></td>
											<td><?php echo e($payment->created_at); ?></td>
											<td><?php echo e(decimalPlace($payment->amount, currency_symbol())); ?></td>
											<td><?php echo e($payment->payment_method); ?></td>
											<td>
												<?php if($payment->status == 0): ?>
													<?php echo xss_clean(show_status(_lang('Pending'), 'warning')); ?>

												<?php elseif($payment->status == 1): ?>
													<?php echo xss_clean(show_status(_lang('Completed'), 'success')); ?>

												<?php elseif($payment->status == 2): ?>
													<?php echo xss_clean(show_status(_lang('Hold'), 'primary')); ?>

												<?php elseif($payment->status == 3): ?>
													<?php echo xss_clean(show_status(_lang('Refund'), 'info')); ?>

												<?php elseif($payment->status == 4): ?>
													<?php echo xss_clean(show_status(_lang('Cancelled'), 'danger')); ?>

												<?php endif; ?>
											</td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div id="email" class="tab-pane">
				<div class="card">
					<div class="card-header">
						<span class="panel-title"><?php echo e(_lang('Send Email')); ?></span>
					</div>
					
					<div class="card-body">
						<form method="post" class="validate" autocomplete="off" action="<?php echo e(route('admin.tenants.send_email')); ?>">
							<?php echo csrf_field(); ?>
							<input type="hidden" name="tenant_id" value="<?php echo e($tenant->id); ?>">
							
							<div class="form-group<?php echo e($errors->has('subject') ? ' has-error' : ''); ?>">
								<label class="control-label"><?php echo e(_lang('Subject')); ?></label>
								<input type="text" class="form-control" name="subject" value="<?php echo e(old('subject')); ?>" required>
							</div>

							<div class="form-group<?php echo e($errors->has('message') ? ' has-error' : ''); ?>">
								<label class="control-label"><?php echo e(_lang('Message')); ?></label>
								<textarea class="form-control mini-summernote" name="message"><?php echo e(old('message')); ?></textarea>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-2"></i><?php echo e(_lang('Send Email')); ?></button>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/tenant/view.blade.php ENDPATH**/ ?>