<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
		    <div class="card-header d-flex justify-content-between align-items-center">
				<div class="header-title"><?php echo e(_lang('Transaction Details')); ?></div>

				<div class="dropdown">
					<button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
						<i class="fas fa-print mr-2"></i><?php echo e(_lang('Print Receipt')); ?>

					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item print print-1" href="#" data-print="receipt" data-title="<?php echo e(_lang('Transaction Receipt')); ?>"><i class="fas fa-print mr-2"></i><?php echo e(_lang('Print')); ?></a>
						<a class="dropdown-item print print-2" href="#" data-print="pos-receipt" data-title="<?php echo e(_lang('Transaction Receipt')); ?>"><i class="fas fa-print mr-2"></i><?php echo e(_lang('POS Print')); ?></a>
					</div>
				</div>
			</div>
			
			<div class="card-body">
			    <table class="table table-bordered">
				    <tr><td><?php echo e(_lang('Date')); ?></td><td><?php echo e($transaction->trans_date); ?></td></tr>
					<tr><td><?php echo e(_lang('Member')); ?></td><td><?php echo e($transaction->member->first_name.' '.$transaction->member->last_name); ?></td></tr>
					<tr><td><?php echo e(_lang('Account Number')); ?></td><td><?php echo e($transaction->account->account_number); ?></td></tr>
					<tr><td><?php echo e(_lang('Amount')); ?></td><td><?php echo e(decimalPlace($transaction->amount, currency($transaction->account->savings_type->currency->name))); ?></td></tr>
					<tr><td><?php echo e(_lang('Debit/Credit')); ?></td><td><?php echo e(strtoupper($transaction->dr_cr)); ?></td></tr>
					<tr><td><?php echo e(_lang('Type')); ?></td><td><?php echo e(ucwords(str_replace('_', ' ', $transaction->type))); ?></td></tr>
					<tr><td><?php echo e(_lang('Method')); ?></td><td><?php echo e($transaction->method); ?></td></tr>
					<tr><td><?php echo e(_lang('Status')); ?></td><td><?php echo xss_clean(transaction_status($transaction->status)); ?></td></tr>
					<tr><td><?php echo e(_lang('Note')); ?></td><td><?php echo e($transaction->note); ?></td></tr>
					<tr><td><?php echo e(_lang('Description')); ?></td><td><?php echo e($transaction->description); ?></td></tr>
					<tr><td><?php echo e(_lang('Created By')); ?></td><td><?php echo e($transaction->created_by->name); ?> (<?php echo e($transaction->created_at); ?>)</td></tr>
					<tr><td><?php echo e(_lang('Updated By')); ?></td><td><?php echo e($transaction->updated_by->name); ?> (<?php echo e($transaction->updated_at); ?>)</td></tr>
			    </table>

				<div id="pos-receipt" class="print-only">
					<div class="pos-print">
						<div class="receipt-header">
							<h4><?php echo e(get_tenant_option('business_name', request()->tenant->name)); ?></h4>
							<p><?php echo e(_lang('Transaction Receipt')); ?></p>
							<p><?php echo e(get_tenant_option('address')); ?></p>
							<p><?php echo e(get_tenant_option('email')); ?>, <?php echo e(get_tenant_option('phone')); ?></p>
							<p><?php echo e(_lang('Print Date').': '.date(get_date_format())); ?></p>
						</div>

						<table class="mt-4 mx-auto">
							<tr><td><?php echo e(_lang('Date')); ?></td><td>: <?php echo e($transaction->trans_date); ?></td></tr>
							<tr><td><?php echo e(_lang('Member')); ?></td><td>: <?php echo e($transaction->member->first_name.' '.$transaction->member->last_name); ?></td></tr>
							<tr><td><?php echo e(_lang('Account Number')); ?></td><td>: <?php echo e($transaction->account->account_number); ?></td></tr>
							<tr><td><?php echo e(_lang('Amount')); ?></td><td>: <?php echo e(decimalPlace($transaction->amount, currency($transaction->account->savings_type->currency->name))); ?></td></tr>
							<tr><td><?php echo e(_lang('Debit/Credit')); ?></td><td>: <?php echo e(strtoupper($transaction->dr_cr)); ?></td></tr>
							<tr><td><?php echo e(_lang('Type')); ?></td><td>: <?php echo e(ucwords(str_replace('_', ' ', $transaction->type))); ?></td></tr>
							<tr><td><?php echo e(_lang('Method')); ?></td><td>: <?php echo e($transaction->method); ?></td></tr>
							<tr><td><?php echo e(_lang('Status')); ?></td><td>: <?php echo xss_clean(transaction_status($transaction->status, false)); ?></td></tr>
							<tr><td><?php echo e(_lang('Note')); ?></td><td>: <?php echo e($transaction->note ?? _lang('N/A')); ?></td></tr>
							<tr><td><?php echo e(_lang('Description')); ?></td><td>: <?php echo e($transaction->description); ?></td></tr>
							<tr><td><?php echo e(_lang('Created By')); ?></td><td>: <?php echo e($transaction->created_by->name); ?></td></tr>
							<tr><td><?php echo e(_lang('Created At')); ?></td><td>: <?php echo e($transaction->created_at); ?></td></tr>
						</table>
					</div>
				</div>

				<div id="receipt" class="print-only">
					<div class="receipt-header text-center">
						<img src="<?php echo e(get_logo()); ?>" class="logo" alt="logo"/>
						<p><?php echo e(_lang('Transaction Receipt')); ?></p>
						<p><?php echo e(get_tenant_option('address')); ?></p>
						<p><?php echo e(get_tenant_option('email')); ?>, <?php echo e(get_tenant_option('phone')); ?></p>
						<p><?php echo e(_lang('Print Date').': '.date(get_date_format())); ?></p>
					</div>

					<table class="table table-bordered mt-4 mx-auto">
						<tr><td><?php echo e(_lang('Date')); ?></td><td><?php echo e($transaction->trans_date); ?></td></tr>
						<tr><td><?php echo e(_lang('Member')); ?></td><td><?php echo e($transaction->member->first_name.' '.$transaction->member->last_name); ?></td></tr>
						<tr><td><?php echo e(_lang('Account Number')); ?></td><td><?php echo e($transaction->account->account_number); ?></td></tr>
						<tr><td><?php echo e(_lang('Amount')); ?></td><td><?php echo e(decimalPlace($transaction->amount, currency($transaction->account->savings_type->currency->name))); ?></td></tr>
						<tr><td><?php echo e(_lang('Debit/Credit')); ?></td><td><?php echo e(strtoupper($transaction->dr_cr)); ?></td></tr>
						<tr><td><?php echo e(_lang('Type')); ?></td><td><?php echo e(str_replace('_', ' ', $transaction->type)); ?></td></tr>
						<tr><td><?php echo e(_lang('Method')); ?></td><td><?php echo e($transaction->method); ?></td></tr>
						<tr><td><?php echo e(_lang('Status')); ?></td><td><?php echo xss_clean(transaction_status($transaction->status, false)); ?></td></tr>
						<tr><td><?php echo e(_lang('Note')); ?></td><td><?php echo e($transaction->note ?? _lang('N/A')); ?></td></tr>
						<tr><td><?php echo e(_lang('Description')); ?></td><td><?php echo e($transaction->description); ?></td></tr>
						<tr><td><?php echo e(_lang('Created By')); ?></td><td><?php echo e($transaction->created_by->name); ?></td></tr>
						<tr><td><?php echo e(_lang('Created At')); ?></td><td><?php echo e($transaction->created_at); ?></td></tr>
					</table>
				</div>
			</div>
	    </div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
$(function() {
	"use strict";

	let params = new URLSearchParams(window.location.search);
    let value = params.get("print");

	if(value === 'general'){
		document.title = $('.print-1').data('title') ?? document.title;
		$('body').html($("#receipt").clone());
		window.print();
		setTimeout(function () {
			window.close();
		}, 300);
	}else if(value === 'pos'){
		document.title = $('.print-2').data('title') ?? document.title;
		$('body').html($("#pos-receipt").html());
		window.print();
		setTimeout(function () {
			window.close();
		}, 300);
	}
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/customer/transfer/transaction-details.blade.php ENDPATH**/ ?>