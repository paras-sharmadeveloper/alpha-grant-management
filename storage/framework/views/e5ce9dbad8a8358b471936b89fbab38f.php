<?php
$inbox = request_count('messages');
$deposit_requests = request_count('deposit_requests', true);
$withdraw_requests = request_count('withdraw_requests', true);
$member_requests = request_count('member_requests', true);
$pending_loans = request_count('pending_loans', true);
$upcomming_repayments = request_count('upcomming_repayments', true);
?>

<li>
	<a href="<?php echo e(route('dashboard.index')); ?>"><i class="fas fa-th-large"></i><span><?php echo e(_lang('Dashboard')); ?></span></a>
</li>

<li>
	<a href="<?php echo e(route('branches.index')); ?>"><i class="fas fa-building"></i><span><?php echo e(_lang('Branches')); ?></span></a>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-user-friends"></i><span><?php echo e(_lang('Members')); ?> <?php echo xss_clean($member_requests); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('members.index')); ?>"><?php echo e(_lang('Member List')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('members.create')); ?>"><?php echo e(_lang('Add Member')); ?></a></li>
		
		
		
	</ul>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-hand-holding-usd"></i><span><?php echo e(_lang('Loans')); ?> <?php echo xss_clean($pending_loans); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('loans.index')); ?>"><?php echo e(_lang('All Loans')); ?></a></li>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo e(route('loans.filter', 'pending')); ?>">
				<?php echo e(_lang('Pending Loans')); ?>

				<?php echo xss_clean($pending_loans); ?>

			</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('loans.filter', 'active')); ?>"><?php echo e(_lang('Active Loans')); ?></a></li>
		
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('loan_products.index')); ?>"><?php echo e(_lang('Loan Products')); ?></a></li>
		<li><a class="nav-link" href="<?php echo e(route('loan_payments.index')); ?>"><?php echo e(_lang('Loan Repayments')); ?></a></li>

		
	</ul>
</li>



















<li>
	<a href="javascript: void(0);"><i class="ti-settings"></i><span><?php echo e(_lang('System Settings')); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('settings.index')); ?>"><?php echo e(_lang('System Settings')); ?></a></li>
		<?php $isAadminRoute = auth()->user()->user_type == 'superadmin' ? 'admin.' : ''; ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route($isAadminRoute.'profile.edit')); ?>"><?php echo e(_lang('Profile Settings')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route($isAadminRoute.'profile.change_password')); ?>"><?php echo e(_lang('Change Password')); ?></a></li>

        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('users.index')); ?>"><?php echo e(_lang('Manage Users')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(_lang('Roles & Permission')); ?></a></li>
		
		
	</ul>
</li>
<?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/layouts/menus/admin.blade.php ENDPATH**/ ?>