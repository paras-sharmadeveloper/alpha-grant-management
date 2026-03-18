<?php $custom_js_code = isset($header_footer_settings->custom_js) ? $header_footer_settings->custom_js : ''; ?>

<script type="text/javascript">
<?php echo xss_clean($custom_js_code); ?>

</script><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/website/custom-js.blade.php ENDPATH**/ ?>