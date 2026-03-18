<!DOCTYPE html>
<html>
<head>
    <title><?php echo new \Illuminate\Support\EncodedHtmlString($content->subject); ?></title>
	<style type="text/css">
	   .g-container{
		   padding: 15px 30px;
	   }
	</style>
</head>
<body>
	<div class="g-container">
		<?php echo xss_clean($content->body); ?>

	</div>
</body>
</html><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/email/general_template.blade.php ENDPATH**/ ?>