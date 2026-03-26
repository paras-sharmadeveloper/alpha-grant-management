<form method="post" class="ajax-submit" autocomplete="off" action="<?php echo e(route('member_documents.store')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<div class="row px-2">
				
		<input type="hidden" name="member_id" value="<?php echo e($id); ?>">

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Document Name')); ?></label>						
				<input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Document')); ?></label>						
				<input type="file" class="form-control dropify" name="document" required>
			</div>
		</div>
	
		<div class="col-md-12 mt-2">
		    <div class="form-group">
			    <button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Upload')); ?></button>
		    </div>
		</div>
	</div>
</form>
<?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/member_documents/modal/create.blade.php ENDPATH**/ ?>