<?php 
$footer_color = isset($header_footer_settings->footer_color) ? $header_footer_settings->footer_color : '#061E5C';
$footer_text_color = isset($header_footer_settings->footer_text_color) ? $header_footer_settings->footer_text_color : '#ffffff';
$custom_css = isset($header_footer_settings->custom_css) ? $header_footer_settings->custom_css : '';
?>

<style type="text/css">
    .footer {
        background: <?php echo e($footer_color); ?> !important;
    }
    .footer .about .text, .footer .single-footer h4, .footer .links ul li a, 
    .footer .copyright p, .footer .copyright p a  {
        color: <?php echo e($footer_text_color); ?> !important;
    }

    <?php echo e($custom_css); ?>

</style><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/website/custom-css.blade.php ENDPATH**/ ?>