<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		
        <title>Alpha Grant Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

		<link rel="shortcut icon" href="<?php echo e(get_favicon()); ?>">
		<link href="<?php echo e(asset('public/backend/plugins/dropify/css/dropify.min.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(asset('public/backend/plugins/sweet-alert2/css/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/backend/plugins/animate/animate.css')); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo e(asset('public/backend/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
	    <link href="<?php echo e(asset('public/backend/plugins/jquery-toast-plugin/jquery.toast.min.css')); ?>" rel="stylesheet" />
		<link href="<?php echo e(asset('public/backend/plugins/daterangepicker/daterangepicker.css')); ?>" rel="stylesheet" />

        <link rel="stylesheet" href="<?php echo e(asset('public/backend/plugins/bootstrap/css/bootstrap.min.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/fontawesome.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/themify-icons.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/plugins/metisMenu/metisMenu.css')); ?>">

		<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset(request()->tenant->id)): ?>
			<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(get_tenant_option('backend_direction') == "rtl"): ?>
			<link rel="stylesheet" href="<?php echo e(asset('public/backend/plugins/bootstrap/css/bootstrap-rtl.min.css')); ?>">
			<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
		<?php else: ?>
			<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(get_option('backend_direction') == "rtl"): ?>
			<link rel="stylesheet" href="<?php echo e(asset('public/backend/plugins/bootstrap/css/bootstrap-rtl.min.css')); ?>">
			<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
		<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

		<?php echo $__env->make('layouts.others.import-css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/typography.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/default-css.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/styles.css') . '?v=' . filemtime(public_path('backend/assets/css/styles.css'))); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/responsive.css?v=1.0')); ?>">

		<script src="<?php echo e(asset('public/backend/assets/js/vendor/modernizr-3.6.0.min.js')); ?>"></script>

		<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset(request()->tenant->id)): ?>
			<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(get_tenant_option('backend_direction') == "rtl"): ?>
			<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/rtl/style.css?v=1.1')); ?>">
			<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
		<?php else: ?>
			<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(get_option('backend_direction') == "rtl"): ?>
			<link rel="stylesheet" href="<?php echo e(asset('public/backend/assets/css/rtl/style.css?v=1.1')); ?>">
			<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
		<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

		<?php echo $__env->make('layouts.others.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

		<style>
			html,
			body {
				height: 100%;
				margin: 0;
				overflow: hidden;
			}

			.page-container {
				height: 100vh;
				display: flex;
				overflow: hidden;
			}

			.sidebar-menu {
				width: 330px;
				height: 100vh;
				overflow: hidden;
				flex-shrink: 0;
				display: flex;
				flex-direction: column;
				padding-bottom: 0 !important;
			}

			.extra-details {
				flex-shrink: 0;
			}

			.main-menu {
				flex: 1;
				display: flex;
				flex-direction: column;
				min-height: 0;
				padding-bottom: 0 !important;
			}

			.menu-inner {
				flex: 1;
				display: flex;
				flex-direction: column;
				min-height: 0;
				padding-bottom: 0 !important;
			}

			.sidebar-nav {
				flex: 1;
				display: flex;
				flex-direction: column;
				min-height: 0;
				height: 100%;
			}

			.menu-scroll {
				flex: 1;
				overflow-y: auto;
				min-height: 0;
			}

			#menu {
				margin: 0;
				padding: 0;
			}

			.logout-bottom {
				margin-top: auto;
				padding: 0 12px 12px 12px;
				flex-shrink: 0;
			}

			.logout-btn {
				display: block !important;
				width: 100% !important;
				text-align: center !important;
				color: #fff !important;
				margin: 0 !important;
			}

			.main-content {
				flex: 1;
				height: 100vh;
				overflow: hidden;
				display: flex;
				flex-direction: column;
				min-width: 0;
			}

			.header-area {
				flex-shrink: 0;
			}

			.page-title-area {
				flex-shrink: 0;
			}

			.main-content-inner {
				flex: 1;
				overflow-y: auto;
				min-height: 0;
				padding: 24px;
			}
		</style>
    </head>

    <body>
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

		<div id="secondary_modal" class="modal" tabindex="-1" role="dialog">
		    <div class="modal-dialog modal-dialog-centered" role="document">
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

		<div id="preloader">
			<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
		</div>

		<?php $user_type = auth()->user()->user_type; ?>

		<div class="page-container">
			<div class="sidebar-menu">
				<div class="extra-details">
					<a href="<?php echo e($user_type == 'superadmin' ? route('admin.dashboard.index') : route('dashboard.index')); ?>">
						<img class="sidebar-logo" src="<?php echo e(get_logo()); ?>" alt="logo">
					</a>
				</div>

				<div class="main-menu">
					<div class="menu-inner">
						<nav class="sidebar-nav">
							<div class="menu-scroll">
								<ul class="metismenu <?php echo e($user_type == 'user' ? 'staff-menu' : ''); ?>" id="menu">
									<?php echo $__env->make('layouts.menus.'.Auth::user()->user_type, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
								</ul>
							</div>

							<div class="logout-bottom">
								<a href="<?php echo e(route('logout')); ?>" class="btn btn-danger logout-btn">
									<i class="ti-power-off mr-2"></i> <?php echo e(_lang('Logout')); ?>

								</a>
							</div>
						</nav>
					</div>
				</div>
			</div>

			<div class="main-content">
				<div class="header-area">
					<div class="row align-items-center">
						<div class="col-lg-6 col-4 clearfix rtl-2">
							<div class="nav-btn float-left">
								<span></span>
								<span></span>
								<span></span>
							</div>
						</div>

						<div class="col-lg-6 col-8 clearfix rtl-1">
							<ul class="notification-area float-right d-flex align-items-center d-none">
								<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->user_type == 'customer'): ?>
									<?php $notifications = Auth::user()->member->notifications->take(15); ?>
									<?php $unreadNotification = Auth::user()->member->unreadNotifications(); ?>
								<?php else: ?>
									<?php $notifications = Auth::user()->notifications->take(15); ?>
									<?php $unreadNotification = Auth::user()->unreadNotifications(); ?>
								<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

								<li>
									<div class="user-profile">

									<h4 class="user-name ">
											<img class="avatar" src="<?php echo e(profile_picture()); ?>" alt="avatar">
											<?php echo e(Auth::user()->name); ?>

										</h4>

		                               
									</div>
	                            </li>
	                        </ul>
						</div>
					</div>
				</div>

				<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Request::is('dashboard') || Request::is('*/dashboard')): ?>
				<div class="page-title-area">
					<div class="row align-items-center py-3">
						<div class="col-sm-12">
							<div class="d-flex align-items-center justify-content-between">
								<h6><?php echo e(_lang('Dashboard')); ?></h6>

								<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->user_type == 'admin' || auth()->user()->all_branch_access == 1): ?>
								<div class="dropdown d-none">
									<a class="dropdown-toggle btn btn-dark btn-xs" type="button" id="selectLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?php echo e(session('branch') =='' ? _lang('All Branch') : session('branch')); ?>

									</a>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="selectLanguage">
										<a class="dropdown-item" href="<?php echo e(route('switch_branch')); ?>"><?php echo e(_lang('All Branch')); ?></a>
										<a class="dropdown-item" href="<?php echo e(route('switch_branch')); ?>?branch_id=default&branch=<?php echo e(get_option('default_branch_name', 'Main Branch')); ?>"><?php echo e(get_option('default_branch_name', 'Main Branch')); ?></a>
										<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\Branch::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
										<a class="dropdown-item" href="<?php echo e(route('switch_branch')); ?>?branch_id=<?php echo e($branch->id); ?>&branch=<?php echo e($branch->name); ?>"><?php echo e($branch->name); ?></a>
										<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
									</div>
								</div>
								<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

				<div class="main-content-inner">
					<div class="row">
						<div class="<?php echo e(isset($alert_col) ? $alert_col : 'col-lg-12'); ?>">
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->user_type == 'admin' && auth()->user()->tenant_owner == 1 && request()->tenant->membership_type == 'trial'): ?>
							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true"><i class="far fa-times-circle"></i></span>
								</button>
								<span><i class="fas fa-info-circle mr-2"></i><?php echo e(_lang('Your trial period will end on').' '.request()->tenant->valid_to); ?></span>
							</div>
							<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

							<div class="alert alert-success alert-dismissible" id="main_alert" role="alert">
								<button type="button" id="close_alert" class="close">
									<span aria-hidden="true"><i class="far fa-times-circle"></i></span>
								</button>
								<span class="msg"></span>
							</div>
						</div>
					</div>

					<?php echo $__env->yieldContent('content'); ?>
				</div>
			</div>
		</div>

		<script src="<?php echo e(asset('public/backend/assets/js/vendor/jquery-3.7.1.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/assets/js/popper.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/plugins/metisMenu/metisMenu.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/assets/js/print.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/plugins/pace/pace.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/backend/plugins/moment/moment.js')); ?>"></script>

        <?php echo $__env->make('layouts.others.import-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

		<script src="<?php echo e(asset('public/backend/plugins/dropify/js/dropify.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/plugins/sweet-alert2/js/sweetalert2.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/plugins/select2/js/select2.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/plugins/parsleyjs/parsley.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/plugins/jquery-toast-plugin/jquery.toast.min.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
		<script src="<?php echo e(asset('public/backend/plugins/slimscroll/jquery.slimscroll.min.js')); ?>"></script>

        <script src="<?php echo e(asset('public/backend/assets/js/scripts.js'). '?v=' . filemtime(public_path('backend/assets/js/scripts.js'))); ?>"></script>

		<?php echo $__env->make('layouts.others.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

		<?php echo $__env->yieldContent('js-script'); ?>
    </body>
</html><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/layouts/app.blade.php ENDPATH**/ ?>