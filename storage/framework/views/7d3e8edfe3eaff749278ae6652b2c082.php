<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Account Statement')); ?></span>
			</div>

			<div class="card-body">

				<div class="report-params">
					<form class="validate" method="post" action="<?php echo e(route('reports.account_statement')); ?>" autocomplete="off">
						<div class="row">
              				<?php echo csrf_field(); ?>

							<div class="col-xl-3 col-lg-4">
								<div class="form-group">
									<label class="control-label"><?php echo e(_lang('Start Date')); ?></label>
									<input type="text" class="form-control datepicker" name="date1" id="date1" value="<?php echo e(isset($date1) ? $date1 : old('date1')); ?>" readOnly="true" required>
								</div>
							</div>

							<div class="col-xl-3 col-lg-4">
								<div class="form-group">
									<label class="control-label"><?php echo e(_lang('End Date')); ?></label>
									<input type="text" class="form-control datepicker" name="date2" id="date2" value="<?php echo e(isset($date2) ? $date2 : old('date2')); ?>" readOnly="true" required>
								</div>
							</div>

							<div class="col-xl-3 col-lg-4">
								<div class="form-group">
									<label class="control-label"><?php echo e(_lang('Account Number')); ?></label>
									<input type="text" class="form-control" name="account_number" value="<?php echo e(isset($account_number) ? $account_number : old('account_number')); ?>" required>
								</div>
							</div>

							<div class="col-xl-2 col-lg-4">
								<button type="submit" class="btn btn-light btn-xs btn-block mt-26"><i class="ti-filter"></i>&nbsp;<?php echo e(_lang('Filter')); ?></button>
							</div>
						</form>

					</div>
				</div><!--End Report param-->

				<?php $date_format = get_date_format(); ?>
				<?php $currency = currency(); ?>

				<div class="report-header">
				   <img src="<?php echo e(get_logo()); ?>" class="logo"/>
				   <h4><?php echo e(_lang('Account Statement')); ?></h4>
				   <h5><?php echo e(isset($account) ? _lang('Account Name').': '.$account->member->name : ''); ?></h5>
				   <h5><?php echo e(isset($account_number) ? _lang('Account Number').': '.$account_number : ''); ?></h5>
				   <h5><?php echo e(isset($date1) ? date($date_format, strtotime($date1)).' '._lang('to').' '.date($date_format, strtotime($date2)) : '----------  '._lang('to').'  ----------'); ?></h5>
				</div>

				<table class="table table-bordered report-table">
					<thead>
                        <th><?php echo e(_lang('Date')); ?></th>
                        <th><?php echo e(_lang('Description')); ?></th>
                        <th class="text-right"><?php echo e(_lang('DEBIT')); ?></th>
                        <th class="text-right"><?php echo e(_lang('CREDIT')); ?></th>
                        <th class="text-right"><?php echo e(_lang('Balance')); ?></th>
					</thead>
					<tbody>
					<?php if(isset($report_data)): ?>
						<?php $date_format = get_date_format(); ?>
						<?php $__currentLoopData = $report_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e(date($date_format, strtotime($transaction->trans_date))); ?></td>
								<td><?php echo e($transaction->description); ?></td>
								<td class="text-right"><?php echo e(decimalPlace($transaction->debit, currency($account->savings_type->currency->name))); ?></td>
								<td class="text-right"><?php echo e(decimalPlace($transaction->credit, currency($account->savings_type->currency->name))); ?></td>
								<td class="text-right"><?php echo e(decimalPlace($transaction->balance, currency($account->savings_type->currency->name))); ?></td>							
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/reports/account_statement.blade.php ENDPATH**/ ?>