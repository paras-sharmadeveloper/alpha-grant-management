<form method="post" class="ajax-submit" autocomplete="off" action="<?php echo e(route('member_documents.update', $id)); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<input name="_method" type="hidden" value="PATCH">
	<div class="row px-2">					
		<input type="hidden" name="member_id" value="<?php echo e($memberdocument->member_id); ?>">

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Document Name')); ?></label>						
				<input type="text" class="form-control" name="name" value="<?php echo e($memberdocument->name); ?>" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Document')); ?></label>						
				<input type="file" class="form-control dropify" name="document" data-default-file="<?php echo e(asset('public/uploads/documents/'.$memberdocument->document)); ?>">
			</div>
		</div>
	
		<div class="col-md-12 mt-2">
			<div class="form-group">
			    <button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Update')); ?></button>
		    </div>
		</div>
	</div>
</form>

<?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/member_documents/modal/edit.blade.php ENDPATH**/ ?>