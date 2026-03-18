<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Transactions Report')); ?></span>
			</div>
			<div class="card-body">
				<div class="report-params">
					<form class="validate" method="post" action="<?php echo e(route('customer_reports.transactions_report')); ?>">
						<div class="row">
              				<?php echo csrf_field(); ?>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label"><?php echo e(_lang('Start Date')); ?></label>
									<input type="text" class="form-control datepicker" name="date1" id="date1" value="<?php echo e(isset($date1) ? $date1 : old('date1')); ?>" readOnly="true" required>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label"><?php echo e(_lang('End Date')); ?></label>
									<input type="text" class="form-control datepicker" name="date2" id="date2" value="<?php echo e(isset($date2) ? $date2 : old('date2')); ?>" readOnly="true" required>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Transaction Type')); ?></label>
									<select class="form-control auto-select" data-selected="<?php echo e(isset($transaction_type) ? $transaction_type : old('transaction_type')); ?>" name="transaction_type">
										<option value=""><?php echo e(_lang('All')); ?></option>
										<option value="Deposit"><?php echo e(_lang('Deposit')); ?></option>
										<option value="Withdraw"><?php echo e(_lang('Withdraw')); ?></option>
										<option value="Transfer"><?php echo e(_lang('Transfer')); ?></option>
                                        <option value="Loan_Repayment"><?php echo e(_lang('Loan Repayment')); ?></option>
										<option value="Interest"><?php echo e(_lang('Interest')); ?></option>
										<option value="Fee"><?php echo e(_lang('Fee')); ?></option>
										<option value="Account_Maintenance_Fee"><?php echo e(_lang('Account Maintenance Fee')); ?></option>
										<?php $__currentLoopData = App\Models\TransactionCategory::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($category->name); ?>"><?php echo e($category->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>

                            <div class="col-md-2">
								<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Status')); ?></label>
									<select class="form-control auto-select" data-selected="<?php echo e(isset($status) ? $status : old('status')); ?>" name="status">
										<option value=""><?php echo e(_lang('All')); ?></option>
										<option value="0"><?php echo e(_lang('Pending')); ?></option>
										<option value="2"><?php echo e(_lang('Completed')); ?></option>
										<option value="1"><?php echo e(_lang('Cancelled')); ?></option>
									</select>
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<div class="form-group">
									<label class="control-label"><?php echo e(_lang('Account Number')); ?></label>
									<select class="form-control auto-select" data-selected="<?php echo e(isset($account_number) ? $account_number : old('account_number')); ?>" name="account_number">
										<option value=""><?php echo e(_lang('All Account')); ?></option>
										<?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($acc->account_number); ?>"><?php echo e($acc->account_number); ?> (<?php echo e($acc->savings_type->name); ?> - <?php echo e($acc->savings_type->currency->name); ?>)</option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>

							<div class="col-md-2">
								<button type="submit" class="btn btn-light btn-xs btn-block mt-26"><i class="ti-filter"></i>&nbsp;<?php echo e(_lang('Filter')); ?></button>
							</div>
						</form>

					</div>
				</div><!--End Report param-->

				<?php $date_format = get_option('date_format','Y-m-d'); ?>
				<?php $currency = currency(); ?>

				<div class="report-header">
				   <img src="<?php echo e(get_logo()); ?>" class="logo"/>
				   <h4><?php echo e(_lang('Transactions Report')); ?></h4>
				   <p><?php echo e(isset($account) ? _lang('Account Name').': '.$account->member->name : ''); ?></p>
				   <p><?php echo e(isset($account_number) ? _lang('Account Number').': '.$account_number : ''); ?></p>
				   <p><?php echo e(isset($date1) ? date($date_format, strtotime($date1)).' '._lang('to').' '.date($date_format, strtotime($date2)) : '----------  '._lang('to').'  ----------'); ?></p>
				</div>

				<table class="table table-bordered report-table">
					<thead>
                        <th><?php echo e(_lang('Date')); ?></th>
                        <th><?php echo e(_lang('Member')); ?></th>
                        <th><?php echo e(_lang('AC Number')); ?></th>
                        <th class="text-right"><?php echo e(_lang('Amount')); ?></th>
                        <th><?php echo e(_lang('DR/CR')); ?></th>
                        <th><?php echo e(_lang('Type')); ?></th>
                        <th><?php echo e(_lang('Status')); ?></th>
                        <th class="text-center"><?php echo e(_lang('Details')); ?></th>
					</thead>
					<tbody>
					<?php if(isset($report_data)): ?>
						<?php $__currentLoopData = $report_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
							$symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
							$class  = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
							?>
							<tr>
								<td><?php echo e($transaction->created_at); ?></td>
								<td><?php echo e($transaction->member->name); ?></td>
								<td><?php echo e($transaction->account->account_number); ?> - <?php echo e($transaction->account->savings_type->name); ?> (<?php echo e($transaction->account->savings_type->currency->name); ?>)</td>
								<td class="text-right"><span class="<?php echo e($class); ?>"><?php echo e($symbol.' '.decimalPlace($transaction->amount, currency($transaction->account->savings_type->currency->name))); ?></span></td>
								<td><?php echo e(strtoupper($transaction->dr_cr)); ?></td>
								<td><?php echo e(str_replace('_',' ',$transaction->type)); ?></td>
								<td><?php echo xss_clean(transaction_status($transaction->status)); ?></td>
								<td class="text-center"><a href="<?php echo e(route('trasnactions.details', $transaction->id)); ?>" target="_blank" class="btn btn-outline-primary btn-xs"><?php echo e(_lang('View')); ?></a></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/customer/reports/all_transactions.blade.php ENDPATH**/ ?>