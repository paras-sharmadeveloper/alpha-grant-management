<li>
	<a href="<?php echo e(route('dashboard.index')); ?>"><i class="fas fa-tachometer-alt"></i><span><?php echo e(_lang('Dashboard')); ?></span></a>
</li>



 <li>
	<a href="<?php echo e(route('loans.my_loans')); ?>"><i class="fas fa-calculator"></i><span><?php echo e(_lang('My Loan')); ?></span></a>
</li>

<li>
	<a href="<?php echo e(route('loans.pending_loans')); ?>"><i class="fas fa-hourglass-half"></i><span><?php echo e(_lang('Pending Loans')); ?></span></a>
</li>

<li>
	<a href="<?php echo e(route('customer.pay.index')); ?>"><i class="fas fa-credit-card"></i><span><?php echo e(_lang('Pay')); ?></span></a>
</li>






<?php
    $myMemberId = auth()->user()->member->id ?? null;
    $kycRoutes  = $myMemberId ? [
        route('customer.kyc.show',    $myMemberId),
        route('customer.kyc.history', $myMemberId),
    ] : [];
    $settingsActive = request()->routeIs('profile.membership_details')
        || request()->routeIs('profile.change_password')
        || in_array(url()->current(), $kycRoutes);
?>
<li class="<?php echo e($settingsActive ? 'active menu-open' : ''); ?>">
	<a href="javascript: void(0);" class="<?php echo e($settingsActive ? 'active' : ''); ?>"><i class="fas fa-cog"></i><span><?php echo e(_lang('General Settings')); ?></span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
	<ul class="nav-second-level" aria-expanded="<?php echo e($settingsActive ? 'true' : 'false'); ?>" style="<?php echo e($settingsActive ? 'display:block;' : ''); ?>">
		<?php $isAadminRoute = auth()->user()->user_type == 'superadmin' ? 'admin.' : ''; ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo e(route('profile.membership_details')); ?>"><?php echo e(_lang('Membership Details')); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo e(route($isAadminRoute.'profile.change_password')); ?>"><?php echo e(_lang('Change Password')); ?></a></li>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($myMemberId): ?>
        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('customer.kyc.show', $myMemberId)); ?>"><i class="ti-id-badge mr-1"></i><?php echo e(_lang('KYC Verification')); ?></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('customer.kyc.history', $myMemberId)); ?>"><i class="ti-time mr-1"></i><?php echo e(_lang('KYC History')); ?></a></li>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </ul>
</li>


<?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/layouts/menus/customer.blade.php ENDPATH**/ ?>