<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo e(!isset($page_title) ? get_option('site_title', config('app.name')) : $page_title); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
		<!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo e(get_favicon()); ?>">

		<!-- App Css -->
        <link rel="stylesheet" href="<?php echo e(asset('public/backend/plugins/bootstrap/css/bootstrap.min.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/fontawesome.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/themify-icons.css')); ?>">

		<?php if(isset(request()->tenant->id)): ?>
			<?php if(get_tenant_option('backend_direction') == "rtl"): ?>
			<link rel="stylesheet" href="<?php echo e(asset('public/backend/plugins/bootstrap/css/bootstrap-rtl.min.css')); ?>">
			<?php endif; ?>
		<?php else: ?>
			<?php if(get_option('backend_direction') == "rtl"): ?>
			<link rel="stylesheet" href="<?php echo e(asset('public/backend/plugins/bootstrap/css/bootstrap-rtl.min.css')); ?>">
			<?php endif; ?>
		<?php endif; ?>
		
		<!-- Others css -->
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/typography.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/default-css.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/styles.css?v=1.1')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/responsive.css?v=1.0')); ?>">
		
		<!-- Modernizr -->
		<script src="<?php echo e(asset('public/backend/assets/js/vendor/modernizr-3.6.0.min.js')); ?>"></script>     

		<?php if(isset(request()->tenant->id)): ?>
			<?php if(get_tenant_option('backend_direction') == "rtl"): ?>
			<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/rtl/style.css?v=1.0')); ?>">
			<?php endif; ?>
		<?php else: ?>
			<?php if(get_option('backend_direction') == "rtl"): ?>
			<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/rtl/style.css?v=1.0')); ?>">
			<?php endif; ?>
		<?php endif; ?>
		
		<?php echo $__env->make('layouts.others.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>	
    </head>

    <body class="guest">  
		<!-- Main Modal -->
		<div id="main_modal" class="modal" tabindex="-1" role="dialog">
		    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
				    <div class="modal-header">
						<h5 class="modal-title ml-2"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true"><i class="ti-close text-danger"></i></span>
						</button>
				    </div>

				    <div class="alert alert-danger d-none mx-4 mt-3 mb-0"></div>
				    <div class="alert alert-primary d-none mx-4 mt-3 mb-0"></div>
				    <div class="modal-body overflow-hidden"></div>

				</div>
		    </div>
		</div>
	     
		<div class="container my-5">						
			<div class="row">
				<div class="<?php echo e(isset($alert_col) ? $alert_col : 'col-lg-12'); ?>">
					<div class="alert alert-success alert-dismissible" id="main_alert" role="alert">
						<button type="button" id="close_alert" class="close">
							<span aria-hidden="true"><i class="far fa-times-circle"></i></span>
						</button>
						<span class="msg"></span>
					</div>		
				</div>
			</div>		
			
			<?php if(session('login_as_user') == true && session('admin') != null): ?>
			<div class="row">
				<div class="<?php echo e(isset($alert_col) ? $alert_col : 'col-lg-12'); ?>">
					<div class="alert alert-warning" role="alert">
						<span><i class="fas fa-info-circle mr-2"></i><?php echo e(_lang('Back to admin portal?')); ?> <a href="<?php echo e(route('users.back_to_admin')); ?>"><?php echo e(_lang('Click Here')); ?></a></span>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php echo $__env->yieldContent('content'); ?>
		</div>


        <!-- jQuery  -->
		<script src="<?php echo e(asset('public/backend/assets/js/vendor/jquery-3.7.1.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/assets/js/popper.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script> 
		<script src="<?php echo e(asset('public/backend/assets/js/print.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/assets/js/guest.js')); ?>"></script>

		<?php echo $__env->make('layouts.others.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
		 
		<!-- Custom JS -->
		<?php echo $__env->yieldContent('js-script'); ?>	
    </body>
</html><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/layouts/guest.blade.php ENDPATH**/ ?>