<?php if(isset($assets)): ?>
<?php if(is_array($assets) && in_array("datatable", $assets)): ?>
<link href="<?php echo e(asset('public/backend/plugins/datatable/datatables.min.css')); ?>" rel="stylesheet" type="text/css" /> 
<?php endif; ?>

<?php if(is_array($assets) && in_array("summernote", $assets)): ?>
<link href="<?php echo e(asset('public/backend/plugins/summernote/summernote-bs4.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php endif; ?>
<?php endif; ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/layouts/others/import-css.blade.php ENDPATH**/ ?>