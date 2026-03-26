<?php
$inbox = request_count('messages');
$deposit_requests = request_count('deposit_requests', true);
$withdraw_requests = request_count('withdraw_requests', true);
$member_requests = request_count('member_requests', true);
$pending_loans = request_count('pending_loans', true);
$upcomming_repayments = request_count('upcomming_repayments', true);

$membersActive  = request()->routeIs('members.*') || request()->routeIs('kyc.*');
$loansActive    = request()->routeIs('loans.*') || request()->routeIs('loan_products.*') || request()->routeIs('loan_payments.*') || request()->routeIs('documents.*') || request()->routeIs('audit_log.*') || request()->routeIs('securities.*') || request()->routeIs('collections.*');
$settingsActive = request()->routeIs('settings.*') || request()->routeIs('profile.*') || request()->routeIs('users.*') || request()->routeIs('roles.*');
?>

<li>
	<a href="<?php echo e(route('dashboard.index')); ?>"><i class="fas fa-th-large"></i><span><?php echo e(_lang('Dashboard')); ?></span></a>
</li>

<li>
	<a href="<?php echo e(route('branches.index')); ?>"><i class="fas fa-building"></i><span><?php echo e(_lang('Branches')); ?></span></a>
</li>

<li class="<?php echo e($membersActive ? 'active menu-open' : ''); ?>">
	<a href="javascript: void(0);" class="<?php echo e($membersActive ? 'active' : ''); ?>"><i class="fas fa-user-friends"></i><span><?php echo e(_lang('Members')); ?> <?php echo xss_clean($member_requests); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="<?php echo e($membersActive ? 'true' : 'false'); ?>" style="<?php echo e($membersActive ? 'display:block;' : ''); ?>">
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('members.index')); ?>"><?php echo e(_lang('Member List')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('members.create')); ?>"><?php echo e(_lang('Add Member')); ?></a></li>
		
		
		
	</ul>
</li>

<li class="<?php echo e($loansActive ? 'active menu-open' : ''); ?>">
	<a href="javascript: void(0);" class="<?php echo e($loansActive ? 'active' : ''); ?>"><i class="fas fa-hand-holding-usd"></i><span><?php echo e(_lang('Loans')); ?> <?php echo xss_clean($pending_loans); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="<?php echo e($loansActive ? 'true' : 'false'); ?>" style="<?php echo e($loansActive ? 'display:block;' : ''); ?>">
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('loans.index')); ?>"><?php echo e(_lang('All Loans')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('loans.loan_book')); ?>"><?php echo e(_lang('Loan Book')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('loan_payments.index')); ?>"><?php echo e(_lang('Loan Repayments')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('loan_products.index')); ?>"><?php echo e(_lang('Loan Products')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('documents.index')); ?>"><?php echo e(_lang('Documents')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('audit_log.index')); ?>"><?php echo e(_lang('Audit Log')); ?> <span class="badge badge-secondary badge-sm ml-1">Soon</span></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('securities.index')); ?>"><?php echo e(_lang('Securities')); ?> <span class="badge badge-secondary badge-sm ml-1">Soon</span></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('collections.index')); ?>"><?php echo e(_lang('Collections')); ?> <span class="badge badge-secondary badge-sm ml-1">Soon</span></a></li>
	</ul>
</li>



















<li class="<?php echo e($settingsActive ? 'active menu-open' : ''); ?>">
	<a href="javascript: void(0);" class="<?php echo e($settingsActive ? 'active' : ''); ?>"><i class="ti-settings"></i><span><?php echo e(_lang('System Settings')); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="<?php echo e($settingsActive ? 'true' : 'false'); ?>" style="<?php echo e($settingsActive ? 'display:block;' : ''); ?>">
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('settings.index')); ?>"><?php echo e(_lang('System Settings')); ?></a></li>
		<?php $isAadminRoute = auth()->user()->user_type == 'superadmin' ? 'admin.' : ''; ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route($isAadminRoute.'profile.edit')); ?>"><?php echo e(_lang('Profile Settings')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route($isAadminRoute.'profile.change_password')); ?>"><?php echo e(_lang('Change Password')); ?></a></li>

        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('users.index')); ?>"><?php echo e(_lang('Manage Users')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(_lang('Roles & Permission')); ?></a></li>
		
		
	</ul>
</li>
<?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/layouts/menus/admin.blade.php ENDPATH**/ ?>