<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-sm-flex align-items-center justify-content-between">
				<span class="panel-title"><?php echo e(_lang('Email Subscribers')); ?></span>
                <div>
				    <a class="btn btn-dark btn-xs" href="<?php echo e(route('admin.email_subscribers.export')); ?>"><i class="fas fa-file-excel mr-2"></i><?php echo e(_lang('Export')); ?></a>
				    <a class="btn btn-primary btn-xs" href="<?php echo e(route('admin.email_subscribers.send_email')); ?>"><i class="fas fa-paper-plane mr-2"></i><?php echo e(_lang('Send Email')); ?></a>
			    </div>
			</div>
			<div class="card-body">
				<table id="email_subscribers_table" class="table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Subscribed At')); ?></th>
						    <th><?php echo e(_lang('Email Address')); ?></th>
						    <th><?php echo e(_lang('Ip Address')); ?></th>
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

	$('#email_subscribers_table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '<?php echo e(url('admin/email_subscribers/get_table_data')); ?>',
		"columns" : [
			{ data : 'created_at', name : 'created_at' },
			{ data : 'email_address', name : 'email_address' },
			{ data : 'ip_address', name : 'ip_address' },
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/email_subscriber/list.blade.php ENDPATH**/ ?>