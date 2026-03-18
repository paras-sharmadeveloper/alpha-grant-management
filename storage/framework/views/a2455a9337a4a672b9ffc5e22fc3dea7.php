<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(get_favicon()); ?>">

    
    <title>Alpha Grant Management</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/backend/plugins/bootstrap/css/bootstrap.min.css')); ?>">
    <link href="<?php echo e(asset('public/auth/css/app.css?v=1.2')); ?>" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

	<script src="<?php echo e(asset('public/backend/assets/js/vendor/jquery-3.7.1.min.js')); ?>"></script>
	<?php echo $__env->yieldContent('js-script'); ?>
</body>
</html>
<?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/layouts/auth.blade.php ENDPATH**/ ?>