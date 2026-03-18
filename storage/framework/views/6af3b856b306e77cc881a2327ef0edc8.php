<?php
$inbox = request_count('messages');
$deposit_requests = request_count('deposit_requests', true);
$withdraw_requests = request_count('withdraw_requests', true);
$member_requests = request_count('member_requests', true);
$pending_loans = request_count('pending_loans', true);
$upcomming_repayments = request_count('upcomming_repayments', true);
$permissions = permission_list();
?>

<li>
	<a href="<?php echo e(route('dashboard.index')); ?>"><i class="fas fa-tachometer-alt"></i><span><?php echo e(_lang('Dashboard')); ?></span></a>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-user-friends"></i><span><?php echo e(_lang('Members')); ?> <?php echo xss_clean($member_requests); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<?php if(in_array('members.index',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('members.index')); ?>"><?php echo e(_lang('View Members')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('members.create',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('members.create')); ?>"><?php echo e(_lang('Add Member')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('members.import',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('members.import')); ?>"><?php echo e(_lang('Bulk Import')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('custom_fields.index',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('custom_fields.index', 'members')); ?>"><?php echo e(_lang('Custom Fields')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('members.pending_requests',$permissions)): ?>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo e(route('members.pending_requests')); ?>"><?php echo e(_lang('Member Requests')); ?> <?php echo xss_clean($member_requests); ?></a>
		</li>
		<?php endif; ?>
		
	</ul>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-hand-holding-usd"></i><span><?php echo e(_lang('Loans')); ?> <?php echo xss_clean($pending_loans); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<?php if(in_array('loans.index',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('loans.index')); ?>"><?php echo e(_lang('All Loans')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('loans.filter',$permissions)): ?>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo e(route('loans.filter', 'pending')); ?>">
				<?php echo e(_lang('Pending Loans')); ?>

				<?php echo xss_clean($pending_loans); ?>

			</a>
		</li>
		<?php endif; ?>

		<?php if(in_array('loans.filter',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('loans.filter', 'active')); ?>"><?php echo e(_lang('Active Loans')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('loans.admin_calculator',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('loans.admin_calculator')); ?>"><?php echo e(_lang('Loan Calculator')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('custom_fields.index',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('custom_fields.index', 'loans')); ?>"><?php echo e(_lang('Custom Fields')); ?></a></li>
		<?php endif; ?>
	</ul>
</li>

<?php if(in_array('loans.upcoming_loan_repayments',$permissions)): ?>
<li><a href="<?php echo e(route('loans.upcoming_loan_repayments')); ?>"><i class="fas fa-calendar-alt"></i><span><?php echo e(_lang('Upcomming Payments')); ?>  <?php echo xss_clean($upcomming_repayments); ?></span></a></li>
<?php endif; ?>

<?php if(in_array('loan_payments.index',$permissions)): ?>
<li><a href="<?php echo e(route('loan_payments.index')); ?>"><i class="fas fa-receipt"></i><span><?php echo e(_lang('Loan Repayments')); ?></span></a></li>
<?php endif; ?>

<li>
	<a href="javascript: void(0);"><i class="fas fa-landmark"></i><span><?php echo e(_lang('Accounts')); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<?php if(in_array('savings_accounts.index',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('savings_accounts.index')); ?>"><?php echo e(_lang('Member Accounts')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('interest_calculation.calculator',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('interest_calculation.calculator')); ?>"><?php echo e(_lang('Interest Calculation')); ?></a></li>
		<?php endif; ?>
	</ul>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-coins"></i><span><?php echo e(_lang('Deposit')); ?> <?php echo xss_clean($deposit_requests); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<?php if(in_array('transactions.create',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('transactions.create')); ?>?type=deposit"><?php echo e(_lang('Deposit Money')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('deposit_requests.index',$permissions)): ?>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo e(route('deposit_requests.index')); ?>">
				<?php echo e(_lang('Deposit Requests')); ?>

				<?php echo xss_clean($deposit_requests); ?>

			</a>
		</li>
		<?php endif; ?>
	</ul>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-money-check"></i><span><?php echo e(_lang('Withdraw')); ?> <?php echo xss_clean($withdraw_requests); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<?php if(in_array('transactions.create',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('transactions.create')); ?>?type=withdraw"><?php echo e(_lang('Withdraw Money')); ?></a></li>
		<?php endif; ?>
		<?php if(in_array('withdraw_requests.index',$permissions)): ?>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo e(route('withdraw_requests.index')); ?>">
				<?php echo e(_lang('Withdraw Requests')); ?>

				<?php echo xss_clean($withdraw_requests); ?>

			</a>
		</li>
		<?php endif; ?>
	</ul>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-wallet"></i><span><?php echo e(_lang('Transactions')); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<?php if(in_array('transactions.create',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('transactions.create')); ?>"><?php echo e(_lang('New Transaction')); ?></a></li>
		<?php endif; ?>
		<?php if(in_array('transactions.index',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('transactions.index')); ?>"><?php echo e(_lang('Transaction History')); ?></a></li>
		<?php endif; ?>
	</ul>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-money-bill-wave"></i><span><?php echo e(_lang('Expense')); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<?php if(in_array('expenses.index',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('expenses.index')); ?>"><?php echo e(_lang('Expenses')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('expense_categories.index',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('expense_categories.index')); ?>"><?php echo e(_lang('Categories')); ?></a></li>
		<?php endif; ?>
	</ul>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-landmark"></i><span><?php echo e(_lang('Bank Accounts')); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<?php if(in_array('bank_accounts.index',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('bank_accounts.index')); ?>"><?php echo e(_lang('Bank Accounts')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('bank_transactions.index',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('bank_transactions.index')); ?>"><?php echo e(_lang('Bank Transactions')); ?></a></li>
		<?php endif; ?>
	</ul>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-envelope"></i><span><?php echo e(_lang('Messages')); ?></span> <?php echo $inbox > 0 ? xss_clean('<div class="circle-animation"></div>') : ''; ?><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('messages.compose')); ?>"><?php echo e(_lang('New Message')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('messages.inbox')); ?>"><?php echo e(_lang('Inbox Items')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('messages.sent')); ?>"><?php echo e(_lang('Sent Items')); ?></a></li>
	</ul>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-chart-bar"></i><span><?php echo e(_lang('Reports')); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<?php if(in_array('reports.account_statement',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.account_statement')); ?>"><?php echo e(_lang('Account Statement')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('reports.account_balances',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.account_balances')); ?>"><?php echo e(_lang('Account Balance')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('reports.loan_report',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.loan_report')); ?>"><?php echo e(_lang('Loan Report')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('reports.loan_due_report',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.loan_due_report')); ?>"><?php echo e(_lang('Loan Due Report')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('reports.loan_repayment_report',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.loan_repayment_report')); ?>"><?php echo e(_lang('Loan Repayment Report')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('reports.transactions_report',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.transactions_report')); ?>"><?php echo e(_lang('Transaction Report')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('reports.expense_report',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.expense_report')); ?>"><?php echo e(_lang('Expense Report')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('reports.cash_in_hand',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.cash_in_hand')); ?>"><?php echo e(_lang('Cash In Hand')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('reports.bank_transactions',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.bank_transactions')); ?>"><?php echo e(_lang('Bank Transactions')); ?></a></li>
		<?php endif; ?>
		
		<?php if(in_array('reports.bank_balances',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.bank_balances')); ?>"><?php echo e(_lang('Bank Account Balance')); ?></a></li>
		<?php endif; ?>

		<?php if(in_array('reports.revenue_report',$permissions)): ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.revenue_report')); ?>"><?php echo e(_lang('Revenue Report')); ?></a></li>
		<?php endif; ?>
	</ul>
</li><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/layouts/menus/user.blade.php ENDPATH**/ ?>