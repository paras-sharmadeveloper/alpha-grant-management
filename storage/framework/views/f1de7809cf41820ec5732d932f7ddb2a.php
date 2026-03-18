<li>
	<a href="<?php echo e(route('admin.dashboard.index')); ?>"><i class="fas fa-th-large"></i><span><?php echo e(_lang('Dashboard')); ?></span></a>
</li>

<li>
	<a href="javascript: void(0);"><i class="fas fa-user-friends"></i><span><?php echo e(_lang('Members')); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="false">
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.tenants.index')); ?>"><?php echo e(_lang('All Members')); ?></a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.tenants.create')); ?>"><?php echo e(_lang('Add New')); ?></a></li>
	</ul>
</li>








<li><a href="<?php echo e(route('admin.settings.update_settings')); ?>"><i class="fas fa-cog"></i><span><?php echo e(_lang('System Settings')); ?></span></a></li>


<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/app-alpha/resources/views/layouts/menus/superadmin.blade.php ENDPATH**/ ?>