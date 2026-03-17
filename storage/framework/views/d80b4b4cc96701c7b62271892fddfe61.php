<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<?php if(isset($_GET['type'])): ?>
					<span class="panel-title"><?php echo e($_GET['type'] == 'deposit_requests' ? _lang('Deposit Requests') : _lang('Withdraw Requests')); ?></span>
                <?php else: ?>
					<span class="panel-title">_lang('Deposit Requests')</span>
				<?php endif; ?>
				<select name="type" id="type" class="ml-auto auto-select filter-select" data-selected="<?php echo e(isset($_GET['type']) ? $_GET['type'] : 'deposit_requests'); ?>">
					<option value="deposit_requests"><?php echo e(_lang('Deposit Request')); ?></option>
					<option value="withdraw_requests"><?php echo e(_lang('Withdraw Request')); ?></option>
				</select>
			</div>
			<div class="card-body">
				<table class="table table-bordered data-table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Date')); ?></th>
						    <th><?php echo e(_lang('AC Number')); ?></th>
						    <th><?php echo e(_lang('Account Type')); ?></th>
							<th><?php echo e(_lang('Amount')); ?></th>
							<th><?php echo e(_lang('Method')); ?></th>
							<th class="text-center"><?php echo e(_lang('Status')); ?></th>
					    </tr>
					</thead>
					<tbody>		
						<?php $transaction_requests = $_GET['type'] == 'deposit_requests' ? $deposit_requests : $withdraw_requests; ?>
						
                        <?php $__currentLoopData = $transaction_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($transaction_request->created_at); ?></td>
                                <td><?php echo e($transaction_request->account->account_number); ?></td>
                                <td><?php echo e($transaction_request->account->savings_type->name); ?> (<?php echo e($transaction_request->account->savings_type->currency->name); ?>)</td>
                                <td><?php echo e(decimalPlace($transaction_request->amount, currency($transaction_request->account->savings_type->currency->name))); ?></td>
                                <td><?php echo e($transaction_request->method->name); ?></td>
                                <td class="text-center"><?php echo xss_clean(transaction_status($transaction_request->status)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
(function ($) {

	"use strict";
	$(document).on('change','#type', function(){
		var type = $(this).val();
		window.location.href = "<?php echo e(route('trasnactions.pending_requests')); ?>?type=" + type;
	});

})(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/customer/pending-requests.blade.php ENDPATH**/ ?>