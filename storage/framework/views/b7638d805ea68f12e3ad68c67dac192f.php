<?php $__env->startSection('content'); ?>
<?php $permissions = permission_list(); ?>
<div class="row">
	<?php if(in_array('dashboard.total_customer_widget', $permissions)): ?>
	<div class="col-xl-3 col-md-6">
		<a href="<?php echo e(route('members.index')); ?>">
			<div class="card mb-4 dashboard-card">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5><?php echo e(_lang('Total Members')); ?></h5>
							<h4 class="pt-1 mb-0"><b><?php echo e($total_customer); ?></b></h4>
						</div>
						<div class="ml-2 text-center">
							<i class="fas fa-users bg-success text-white"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<?php endif; ?>

	<?php if(in_array('dashboard.deposit_requests_widget',$permissions)): ?>
	<div class="col-xl-3 col-md-6">
		<a href="<?php echo e(route('deposit_requests.index')); ?>">
			<div class="card mb-4 dashboard-card">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5><?php echo e(_lang('Deposit Requests')); ?></h5>
							<h4 class="pt-1 mb-0"><b><?php echo e(request_count('deposit_requests')); ?></b></h4>
						</div>
						<div class="ml-2 text-center">
							<i class="fas fa-calendar-alt bg-info text-white"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<?php endif; ?>

	<?php if(in_array('dashboard.withdraw_requests_widget',$permissions)): ?>
	<div class="col-xl-3 col-md-6">
		<a href="<?php echo e(route('withdraw_requests.index')); ?>">
			<div class="card mb-4 dashboard-card">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5><?php echo e(_lang('Withdraw Requests')); ?></h5>
							<h4 class="pt-1 mb-0"><b><?php echo e(request_count('withdraw_requests')); ?></b></h4>
						</div>
						<div class="ml-2 text-center">
							<i class="fas fa-coins bg-primary text-white"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<?php endif; ?>

	<?php if(in_array('dashboard.loan_requests_widget',$permissions)): ?>
	<div class="col-xl-3 col-md-6">
		<a href="<?php echo e(route('loans.filter', 'pending')); ?>">
			<div class="card mb-4 dashboard-card">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5><?php echo e(_lang('Pending Loans')); ?></h5>
							<h4 class="pt-1 mb-0"><b><?php echo e(request_count('pending_loans')); ?></b></h4>
						</div>
						<div class="ml-2 text-center">
							<i class="fas fa-dollar-sign bg-danger text-white"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<?php endif; ?>
</div>

<div class="row">
	<?php if(in_array('dashboard.expense_overview_widget',$permissions)): ?>
	<div class="col-lg-4 col-md-5 mb-4">
		<div class="card h-100">
			<div class="card-header d-flex align-items-center">
				<span><?php echo e(_lang('Expense Overview').' - '.date('M Y')); ?></span>
			</div>
			<div class="card-body">
				<canvas id="expenseOverview"></canvas>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if(in_array('dashboard.deposit_withdraw_analytics',$permissions)): ?>
	<div class="col-lg-8 col-md-7 mb-4">
		<div class="card h-100">
			<div class="card-header d-flex align-items-center">
				<span><?php echo e(_lang('Deposit & Withdraw Analytics').' - '.date('Y')); ?></span>
				<select class="filter-select ml-auto py-0 auto-select" data-selected="<?php echo e(base_currency_id()); ?>">
					<?php $__currentLoopData = \App\Models\Currency::where('status',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($currency->id); ?>" data-symbol="<?php echo e(currency_symbol($currency->name)); ?>"><?php echo e($currency->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
			<div class="card-body">
				<canvas id="transactionAnalysis"></canvas>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>

<?php if(in_array('dashboard.active_loan_balances',$permissions)): ?>
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card mb-4">
			<div class="card-header">
				<?php echo e(_lang('Active Loan Balances')); ?>

			</div>
			<div class="card-body px-0 pt-0">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap pl-4"><?php echo e(_lang('Currency')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Applied Amount')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Paid Amount')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Due Amount')); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php if(count($loan_balances) == 0): ?>
								<tr>
									<td colspan="4"><p class="text-center"><?php echo e(_lang('No Data Available')); ?></p></td>
								</tr>
							<?php endif; ?>
							<?php $__currentLoopData = $loan_balances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan_balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td class="pl-4"><?php echo e($loan_balance->currency->name); ?></td>
								<td><?php echo e(decimalPlace($loan_balance->total_amount, currency($loan_balance->currency->name))); ?></td>
								<td><?php echo e(decimalPlace($loan_balance->total_paid, currency($loan_balance->currency->name))); ?></td>
								<td><?php echo e(decimalPlace($loan_balance->total_amount - $loan_balance->total_paid, currency($loan_balance->currency->name))); ?></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if(in_array('dashboard.due_loan_list',$permissions)): ?>
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="card mb-4">
			<div class="card-header">
				<?php echo e(_lang('Due Loan Payments')); ?>

			</div>
			<div class="card-body px-0 pt-0">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-nowrap pl-4"><?php echo e(_lang('Loan ID')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Member No')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Member')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Last Payment Date')); ?></th>
								<th class="text-nowrap"><?php echo e(_lang('Due Repayments')); ?></th>
								<th class="text-nowrap text-right pr-4"><?php echo e(_lang('Total Due')); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php if(count($due_repayments) == 0): ?>
								<tr>
									<td colspan="6"><p class="text-center"><?php echo e(_lang('No Data Available')); ?></p></td>
								</tr>
							<?php endif; ?>

							<?php $__currentLoopData = $due_repayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td class="pl-4"><?php echo e($repayment->loan->loan_id); ?></td>
								<td><?php echo e($repayment->loan->borrower->member_no); ?></td>
								<td><?php echo e($repayment->loan->borrower->name); ?></td>
								<td class="text-nowrap"><?php echo e($repayment->repayment_date); ?></td>
								<td class="text-nowrap"><?php echo e($repayment->total_due_repayment); ?></td>
								<td class="text-nowrap text-right pr-4"><?php echo e(decimalPlace($repayment->total_due, currency($repayment->loan->currency->name))); ?></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if(in_array('dashboard.recent_transaction_widget',$permissions)): ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-4">
			<div class="card-header">
				<?php echo e(_lang('Recent Transactions')); ?>

			</div>
			<div class="card-body px-0 pt-0">
				<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					    <tr>
						    <th class="pl-4"><?php echo e(_lang('Date')); ?></th>
							<th><?php echo e(_lang('Member')); ?></th>
							<th class="text-nowrap"><?php echo e(_lang('Account Number')); ?></th>
							<th><?php echo e(_lang('Amount')); ?></th>
							<th class="text-nowrap"><?php echo e(_lang('Debit/Credit')); ?></th>
							<th><?php echo e(_lang('Type')); ?></th>
							<th><?php echo e(_lang('Status')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					<?php if(count($recent_transactions) == 0): ?>
						<tr>
							<td colspan="8"><p class="text-center"><?php echo e(_lang('No Data Available')); ?></p></td>
						</tr>
					<?php endif; ?>
					<?php $__currentLoopData = $recent_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php
						$symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
						$class  = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
						?>
						<tr>
							<td class="text-nowrap pl-4"><?php echo e($transaction->trans_date); ?></td>
							<td><?php echo e($transaction->member->name); ?></td>
							<td><?php echo e($transaction->account->account_number); ?></td>
							<td><span class="text-nowrap <?php echo e($class); ?>"><?php echo e($symbol.' '.decimalPlace($transaction->amount, currency($transaction->account->savings_type->currency->name))); ?></span></td>
							<td><?php echo e(strtoupper($transaction->dr_cr)); ?></td>
							<td><?php echo e(ucwords(str_replace('_',' ',$transaction->type))); ?></td>
							<td><?php echo xss_clean(transaction_status($transaction->status)); ?></td>
							<td class="text-center"><a href="<?php echo e(route('transactions.show', $transaction->id)); ?>" target="_blank" class="btn btn-outline-primary btn-xs"><i class="ti-arrow-right"></i>&nbsp;<?php echo e(_lang('View')); ?></a></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script src="<?php echo e(asset('public/backend/plugins/chartJs/chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend/assets/js/dashboard.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/dashboard-user.blade.php ENDPATH**/ ?>