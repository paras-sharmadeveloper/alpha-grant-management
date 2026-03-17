<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
		    <div class="card-header d-sm-flex align-items-center justify-content-between">
				<span class="panel-title"><?php echo e(_lang('Data Backup')); ?></span>
				<div class="mt-2 sm-mt-0">
					<a class="btn btn-danger btn-xs" href="<?php echo e(route('admin.backup.restore')); ?>"><i class="fas fa-undo mr-1"></i><?php echo e(_lang('Restore Backup')); ?></a>
					<a class="btn btn-primary btn-xs" href="<?php echo e(route('admin.backup.create')); ?>"><i class="ti-plus mr-1"></i><?php echo e(_lang('New Backup')); ?></a>
				</div>
			</div>
			<div class="card-body">
				<table id="database_backups_table" class="table data-table">
					<thead>
					    <tr>
						    <th><?php echo e(_lang('Created')); ?></th>
						    <th><?php echo e(_lang('File Name')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					  <?php $__currentLoopData = $backupFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    <tr>
							<td class='created_at'><?php echo e(date(get_date_format().' '.get_time_format(), filemtime(storage_path('app/private/' . $file)))); ?></td>
							<td class='file'><?php echo e(str_replace('backups/', '', $file)); ?></td>
							<td class="text-center">
								<span class="dropdown">
									<button class="btn btn-outline-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php echo e(_lang('Action')); ?>

									
									</button>
									<form action="<?php echo e(route('admin.backup.destroy', str_replace('backups/', '', $file))); ?>" method="post">
										<?php echo csrf_field(); ?>
										<input name="_method" type="hidden" value="DELETE">

										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a href="<?php echo e(route('admin.backup.download', str_replace('backups/', '', $file))); ?>" class="dropdown-item dropdown-view"><i class="ti-download mr-2"></i><?php echo e(_lang('Download')); ?></a>
											<button class="btn-remove dropdown-item" type="submit"><i class="ti-trash mr-2"></i><?php echo e(_lang('Delete')); ?></button>
										</div>
									</form>
								</span>
							</td>
					    </tr>
					    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/administration/backup/list.blade.php ENDPATH**/ ?>