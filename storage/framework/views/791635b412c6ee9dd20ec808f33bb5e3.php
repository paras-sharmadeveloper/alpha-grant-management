<li>
	<a href="<?php echo e(route('dashboard.index')); ?>"><i class="fas fa-tachometer-alt"></i><span><?php echo e(_lang('Dashboard')); ?></span></a>
</li>



 <li>
	<a href="<?php echo e(route('loans.my_loans')); ?>"><i class="fas fa-calculator"></i><span><?php echo e(_lang('My Loan')); ?></span></a>
</li>






<li>
	<a href="javascript: void(0);"><i class="fas fa-cog"></i><span><?php echo e(_lang('General Settings')); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<?php $isAadminRoute = auth()->user()->user_type == 'superadmin' ? 'admin.' : ''; ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('profile.membership_details')); ?>"><?php echo e(_lang('Membership Details')); ?></a></li>
		
        <li class="nav-item"><a class="nav-link" href="<?php echo e(route($isAadminRoute.'profile.change_password')); ?>"><?php echo e(_lang('Change Password')); ?></a></li>
    </ul>
</li>


<?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/layouts/menus/customer.blade.php ENDPATH**/ ?>