<?php if(isset($assets)): ?>

<?php if(is_array($assets) && in_array("datatable", $assets)): ?>
<script src="<?php echo e(asset('public/backend/plugins/datatable/datatables.min.js')); ?>"></script>
<?php endif; ?>

<?php if(is_array($assets) && in_array("slimscroll", $assets)): ?>
<script src="<?php echo e(asset('public/backend/plugins/slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<?php endif; ?>

<?php if(is_array($assets) && in_array("tinymce", $assets)): ?>
<script src="<?php echo e(asset('public/backend/plugins/tinymce/tinymce.min.js')); ?>"></script>
<?php endif; ?>

<?php if(is_array($assets) && in_array("summernote", $assets)): ?>
<script src="<?php echo e(asset('public/backend/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<?php endif; ?>

<?php endif; ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/layouts/others/import-js.blade.php ENDPATH**/ ?>