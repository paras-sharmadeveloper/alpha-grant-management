

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<div class="panel-title"><?php echo e(_lang('Loan Repayment Details')); ?></div>

				<div class="dropdown">
					<button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
						<i class="fas fa-print mr-2"></i><?php echo e(_lang('Print Receipt')); ?>

					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item print print-1" href="#" data-print="receipt" data-title="<?php echo e(_lang('Loan Payment Receipt')); ?>"><i class="fas fa-print mr-2"></i><?php echo e(_lang('Print')); ?></a>
						<a class="dropdown-item print print-2" href="#" data-print="pos-receipt" data-title="<?php echo e(_lang('Loan Payment Receipt')); ?>"><i class="fas fa-print mr-2"></i><?php echo e(_lang('POS Print')); ?></a>
					</div>
				</div>		
			</div>
			
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<td><?php echo e(_lang('Loan ID')); ?></td>
						<td><a href="<?php echo e(route('loans.show', $loanpayment->loan->id)); ?>" target="_blank"><?php echo e($loanpayment->loan->loan_id); ?></a></td>
					</tr>
					<tr>
						<td><?php echo e(_lang('Borrower')); ?></td>
						<td><?php echo e($loanpayment->loan->borrower->name); ?></td>
					</tr>
					<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loanpayment->transaction_id != NULL): ?>
						<tr><td><?php echo e(_lang('Transaction')); ?></td><td><a target="_blank" href="<?php echo e(route('transactions.show', $loanpayment->transaction_id)); ?>"><?php echo e(_lang('View Transaction Details')); ?></a></td></tr>
					<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
					<tr><td><?php echo e(_lang('Payment Date')); ?></td><td><?php echo e($loanpayment->paid_at); ?></td></tr>
					<tr><td><?php echo e(_lang('Principal Amount')); ?></td><td><?php echo e(decimalPlace($loanpayment->repayment_amount - $loanpayment->interest, currency($loanpayment->loan->currency->name))); ?></td></tr>
					<tr><td><?php echo e(_lang('Interest')); ?></td><td><?php echo e(decimalPlace($loanpayment->interest, currency($loanpayment->loan->currency->name))); ?></td></tr>
					<tr><td><?php echo e(_lang('Late Penalties')); ?></td><td><?php echo e(decimalPlace($loanpayment->late_penalties, currency($loanpayment->loan->currency->name))); ?></td></tr>
					<tr><td><?php echo e(_lang('Total Amount')); ?></td><td><?php echo e(decimalPlace($loanpayment->total_amount, currency($loanpayment->loan->currency->name))); ?></td></tr>
					<tr><td><?php echo e(_lang('Remarks')); ?></td><td><?php echo e($loanpayment->remarks); ?></td></tr>
				</table>

				<div id="pos-receipt" class="print-only">
					<div class="pos-print">
						<div class="receipt-header">
							<h4><?php echo e(get_tenant_option('business_name', request()->tenant->name)); ?></h4>
							<p><?php echo e(_lang('Loan Payment Receipt')); ?></p>
							<p><?php echo e(get_tenant_option('address')); ?></p>
							<p><?php echo e(get_tenant_option('email')); ?>, <?php echo e(get_tenant_option('phone')); ?></p>
							<p><?php echo e(_lang('Print Date').': '.date(get_date_format())); ?></p>
						</div>

						<table class="mt-4 mx-auto">
							<tr><td><?php echo e(_lang('Date')); ?></td><td>: <?php echo e($loanpayment->paid_at); ?></td></tr>
							<tr>
								<td><?php echo e(_lang('Loan ID')); ?></td>
								<td>: <?php echo e($loanpayment->loan->loan_id); ?></td>
							</tr>
							<tr>
								<td><?php echo e(_lang('Borrower')); ?></td>
								<td>: <?php echo e($loanpayment->loan->borrower->name); ?></td>
							</tr>
							<tr><td><?php echo e(_lang('Principal')); ?></td><td>: <?php echo e(decimalPlace($loanpayment->repayment_amount - $loanpayment->interest, currency($loanpayment->loan->currency->name))); ?></td></tr>
							<tr><td><?php echo e(_lang('Interest')); ?></td><td>: <?php echo e(decimalPlace($loanpayment->interest, currency($loanpayment->loan->currency->name))); ?></td></tr>
							<tr><td><?php echo e(_lang('Penalties')); ?></td><td>: <?php echo e(decimalPlace($loanpayment->late_penalties, currency($loanpayment->loan->currency->name))); ?></td></tr>
							<tr><td><?php echo e(_lang('Total Amount')); ?></td><td>: <?php echo e(decimalPlace($loanpayment->total_amount, currency($loanpayment->loan->currency->name))); ?></td></tr>
							<tr><td><?php echo e(_lang('Remarks')); ?></td><td>: <?php echo e($loanpayment->remarks ?? _lang('N/A')); ?></td></tr>
						</table>
					</div>
				</div>

				<div id="receipt" class="print-only">
					<div class="receipt-header text-center">
						<img src="<?php echo e(get_logo()); ?>" class="logo" alt="logo"/>
						<p><?php echo e(_lang('Loan Payment Receipt')); ?></p>
						<p><?php echo e(get_tenant_option('address')); ?></p>
						<p><?php echo e(get_tenant_option('email')); ?>, <?php echo e(get_tenant_option('phone')); ?></p>
						<p><?php echo e(_lang('Print Date').': '.date(get_date_format())); ?></p>
					</div>

					<table class="table table-bordered mt-4 mx-auto">
						<tr><td><?php echo e(_lang('Date')); ?></td><td><?php echo e($loanpayment->paid_at); ?></td></tr>
						<tr>
							<td><?php echo e(_lang('Loan ID')); ?></td>
							<td><?php echo e($loanpayment->loan->loan_id); ?></td>
						</tr>
						<tr>
							<td><?php echo e(_lang('Borrower')); ?></td>
							<td><?php echo e($loanpayment->loan->borrower->name); ?></td>
						</tr>
						<tr><td><?php echo e(_lang('Principal Amount')); ?></td><td><?php echo e(decimalPlace($loanpayment->repayment_amount - $loanpayment->interest, currency($loanpayment->loan->currency->name))); ?></td></tr>
						<tr><td><?php echo e(_lang('Interest')); ?></td><td><?php echo e(decimalPlace($loanpayment->interest, currency($loanpayment->loan->currency->name))); ?></td></tr>
						<tr><td><?php echo e(_lang('Late Penalties')); ?></td><td><?php echo e(decimalPlace($loanpayment->late_penalties, currency($loanpayment->loan->currency->name))); ?></td></tr>
						<tr><td><?php echo e(_lang('Total Amount')); ?></td><td><?php echo e(decimalPlace($loanpayment->total_amount, currency($loanpayment->loan->currency->name))); ?></td></tr>
						<tr><td><?php echo e(_lang('Remarks')); ?></td><td><?php echo e($loanpayment->remarks ?? _lang('N/A')); ?></td></tr>
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



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/loan_payment/view.blade.php ENDPATH**/ ?>