<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title"><?php echo e(_lang('Subscription Payments')); ?></span>
				<a class="btn btn-primary btn-xs ml-auto" href="<?php echo e(route('admin.subscription_payments.create')); ?>"><i class="ti-plus mr-1"></i><?php echo e(_lang('Add New')); ?></a>
			</div>
			<div class="card-body">
				<table id="subscription_payments_table" class="table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Tenant')); ?></th>
							<th><?php echo e(_lang('Order ID')); ?></th>
							<th><?php echo e(_lang('Method')); ?></th>
							<th><?php echo e(_lang('Plan')); ?></th>
							<th><?php echo e(_lang('Amount')); ?></th>
							<th><?php echo e(_lang('Status')); ?></th>
							<th><?php echo e(_lang('Created')); ?></th>
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
<script>
(function ($) {
	"use strict";

	$('#subscription_payments_table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '<?php echo e(url('admin/subscription_payments/get_table_data')); ?>',
		"columns" : [
			{ data : 'tenant.name', name : 'tenant.name' },
			{ data : 'order_id', name : 'order_id' },
			{ data : 'payment_method', name : 'payment_method' },
			{ data : 'package.name', name : 'package.name' },
			{ data : 'amount', name : 'amount' },
			{ data : 'status', name : 'status' },
			{ data : 'created_by.name', name : 'created_by.name' },
			{ data : "action", name : "action" },
		],
		responsive: true,
		"bStateSave": true,
		"bAutoWidth":false,
		"ordering": false,
		"language": {
		   "decimal":        "",
		   "emptyTable":     "<?php echo e(_lang('No Data Found')); ?>",
		   "info":           "<?php echo e(_lang('Showing')); ?> _START_ <?php echo e(_lang('to')); ?> _END_ <?php echo e(_lang('of')); ?> _TOTAL_ <?php echo e(_lang('Entries')); ?>",
		   "infoEmpty":      "<?php echo e(_lang('Showing 0 To 0 Of 0 Entries')); ?>",
		   "infoFiltered":   "(filtered from _MAX_ total entries)",
		   "infoPostFix":    "",
		   "thousands":      ",",
		   "lengthMenu":     "<?php echo e(_lang('Show')); ?> _MENU_ <?php echo e(_lang('Entries')); ?>",
		   "loadingRecords": "<?php echo e(_lang('Loading...')); ?>",
		   "processing":     "<?php echo e(_lang('Processing...')); ?>",
		   "search":         "<?php echo e(_lang('Search')); ?>",
		   "zeroRecords":    "<?php echo e(_lang('No matching records found')); ?>",
		   "paginate": {
			  "first":      "<?php echo e(_lang('First')); ?>",
			  "last":       "<?php echo e(_lang('Last')); ?>",
			  "previous":   "<i class='fas fa-angle-left'></i>",
			  "next":       "<i class='fas fa-angle-right'></i>"
		  }
		}
	});
})(jQuery);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/subscription_payment/list.blade.php ENDPATH**/ ?>