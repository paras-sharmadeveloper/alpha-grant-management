<table class="table table-bordered">
	<tr><td><?php echo e(_lang('Name')); ?></td><td><?php echo e($savingsproduct->name); ?></td></tr>
	<tr><td><?php echo e(_lang('Account Number Prefix')); ?></td><td><?php echo e($savingsproduct->account_number_prefix); ?></td></tr>
	<tr><td><?php echo e(_lang('Next Account Number')); ?></td><td><?php echo e($savingsproduct->starting_account_number); ?></td></tr>
	<tr><td><?php echo e(_lang('Currency')); ?></td><td><?php echo e($savingsproduct->currency->name); ?></td></tr>
	<tr><td><?php echo e(_lang('Interest Rate')); ?></td><td><?php echo e($savingsproduct->interest_rate); ?> %</td></tr>
	<tr>
		<td><?php echo e(_lang('Interest Method')); ?></td>
		<td>
			<?php echo e(ucwords(str_replace('_', ' ', $savingsproduct->interest_method))); ?>

		</td>
	</tr>
	<tr>
		<td><?php echo e(_lang('Interest Period')); ?></td>
		<td><?php echo e(_lang('Every').' '.$savingsproduct->interest_period.' '._lang('month')); ?></td>
	</tr>
	<tr><td><?php echo e(_lang('Minimum Balance for Interest Rate')); ?></td><td><?php echo e(decimalPlace($savingsproduct->min_bal_interest_rate, currency($savingsproduct->currency->name))); ?></td></tr>
	<tr>
		<td><?php echo e(_lang('Allow Withdraw')); ?></td>
		<td><?php echo $savingsproduct->allow_withdraw == 1 ? xss_clean(show_status(_lang('Yes'), 'success')) : xss_clean(show_status(_lang('No'), 'danger')); ?></td>
	</tr>
	<tr>
		<td><?php echo e(_lang('Status')); ?></td>
		<td><?php echo xss_clean(status($savingsproduct->status)); ?></td>
	</tr>
	<tr><td><?php echo e(_lang('Minimum Deposit Amount')); ?></td><td><?php echo e(decimalPlace($savingsproduct->minimum_deposit_amount, currency_symbol($savingsproduct->currency->name))); ?></td></tr>
	<tr><td><?php echo e(_lang('Minimum Account Balance')); ?></td><td><?php echo e(decimalPlace($savingsproduct->minimum_account_balance, currency_symbol($savingsproduct->currency->name))); ?></td></tr>
	<tr><td><?php echo e(_lang('Maintenance Fee')); ?></td><td><?php echo e(decimalPlace($savingsproduct->maintenance_fee, currency_symbol($savingsproduct->currency->name))); ?></td></tr>
	<tr>
		<td><?php echo e(_lang('Maintenance Fee Posting Month')); ?></td>
		<td><?php echo e($savingsproduct->maintenance_fee_posting_period != null ? date('F', strtotime('2022-'.$savingsproduct->maintenance_fee_posting_period.'-01')) : ''); ?></td>
	</tr>	
	<tr>
		<td><?php echo e(_lang('Auto Account Create While New Member Signup')); ?></td>
		<td><?php echo e($savingsproduct->auto_create == 1 ? _lang('Yes') : _lang('No')); ?></td>
	</tr>	
</table>

<?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/savings_product/modal/view.blade.php ENDPATH**/ ?>