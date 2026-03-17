<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title"><?php echo e(_lang('Withdraw Requests')); ?></span>
                <select name="status" class="ml-auto select-filter filter-select">
					<option value="0"><?php echo e(_lang('Pending')); ?></option>
					<option value="2"><?php echo e(_lang('Approved')); ?></option>
					<option value="1"><?php echo e(_lang('Rejected')); ?></option>
				</select>
			</div>
			<div class="card-body">
				<table id="withdraw_requests_table" class="table table-bordered">
					<thead>
					    <tr>
							<th><?php echo e(_lang('Member')); ?></th>
						    <th><?php echo e(_lang('Account Number')); ?></th>
							<th><?php echo e(_lang('Currency')); ?></th>
							<th><?php echo e(_lang('Amount')); ?></th>
							<th><?php echo e(_lang('Method')); ?></th>
							<th><?php echo e(_lang('Status')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script src="<?php echo e(asset('public/backend/assets/js/datatables/withdraw_requests.js?v=1.0')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/withdraw_request/list.blade.php ENDPATH**/ ?>