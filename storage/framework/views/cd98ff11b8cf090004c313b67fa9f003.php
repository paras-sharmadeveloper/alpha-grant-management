<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<span class="panel-title"><?php echo e(_lang('Loan Repayments')); ?></span>
				<a class="btn btn-primary btn-xs float-right" href="<?php echo e(route('loan_payments.create')); ?>"><i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Add Repayment')); ?></a>
			</div>
			<div class="card-body">
				<table id="loan_payments_table" class="table table-bordered">
					<thead>
						<tr>
							<th><?php echo e(_lang('Loan ID')); ?></th>
							<th><?php echo e(_lang('Payment Date')); ?></th>
							<th><?php echo e(_lang('Principal Amount')); ?></th>
							<th><?php echo e(_lang('Interest')); ?></th>
							<th><?php echo e(_lang('Late Penalties')); ?></th>
							<th><?php echo e(_lang('Total Amount')); ?></th>
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
$(function() {
	"use strict";

	$('#loan_payments_table').DataTable({
		processing: true,
		serverSide: true,
		ajax: _tenant_url + '/loan_payments/get_table_data',
		"columns" : [
			{ data : 'loan.loan_id', name : 'loan.loan_id' },
			{ data : 'paid_at', name : 'paid_at' },
			{ data : 'repayment_amount', name : 'repayment_amount' },
			{ data : 'interest', name : 'interest' },
			{ data : 'late_penalties', name : 'late_penalties' },
			{ data : 'total_amount', name : 'total_amount' },
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
			  "previous": "<i class='fas fa-angle-left'></i>",
        	  "next" : "<i class='fas fa-angle-right'></i>",
		  }
		},
		drawCallback: function () {
			$(".dataTables_paginate > .pagination").addClass("pagination-bordered");
		}
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/loan_payment/list.blade.php ENDPATH**/ ?>