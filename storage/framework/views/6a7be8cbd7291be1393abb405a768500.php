<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title"><?php echo e(_lang('Default Pages')); ?></span>
			</div>
			<div class="card-body p-0">
				<table class="table table-striped">
					<thead>
					    <tr>
						    <th class="pl-4"><?php echo e(_lang('Page')); ?></th>
							<th class="text-center"><?php echo e(_lang('Action')); ?></th>
					    </tr>
					</thead>
					<tbody>
					    <tr>
							<td class="pl-4"><?php echo e(_lang('Home Page')); ?></td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.pages.default_pages', 'home')); ?>" class="btn btn-outline-primary btn-xs"><i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit')); ?></a>
							</td>
					    </tr>
						<tr>
							<td class="pl-4"><?php echo e(_lang('About Page')); ?></td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.pages.default_pages', 'about')); ?>" class="btn btn-outline-primary btn-xs"><i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit')); ?></a>
							</td>
					    </tr>
						<tr>
							<td class="pl-4"><?php echo e(_lang('Feature Page')); ?></td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.pages.default_pages', 'features')); ?>" class="btn btn-outline-primary btn-xs"><i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit')); ?></a>
							</td>
					    </tr>
						<tr>
							<td class="pl-4"><?php echo e(_lang('Pricing Page')); ?></td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.pages.default_pages', 'pricing')); ?>" class="btn btn-outline-primary btn-xs"><i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit')); ?></a>
							</td>
					    </tr>
						<tr>
							<td class="pl-4"><?php echo e(_lang('Blog Page')); ?></td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.pages.default_pages', 'blogs')); ?>" class="btn btn-outline-primary btn-xs"><i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit')); ?></a>
							</td>
					    </tr>
						<tr>
							<td class="pl-4"><?php echo e(_lang('FAQ Page')); ?></td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.pages.default_pages', 'faq')); ?>" class="btn btn-outline-primary btn-xs"><i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit')); ?></a>
							</td>
					    </tr>
						<tr>
							<td class="pl-4"><?php echo e(_lang('Contact Page')); ?></td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.pages.default_pages', 'contact')); ?>" class="btn btn-outline-primary btn-xs"><i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit')); ?></a>
							</td>
					    </tr>
						<tr>
							<td class="pl-4"><?php echo e(_lang('Terms & Conditions')); ?></td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.pages.default_pages', 'terms-condition')); ?>" class="btn btn-outline-primary btn-xs"><i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit')); ?></a>
							</td>
					    </tr>
						<tr>
							<td class="pl-4"><?php echo e(_lang('Privacy Policy')); ?></td>
							<td class="text-center">
								<a href="<?php echo e(route('admin.pages.default_pages', 'privacy-policy')); ?>" class="btn btn-outline-primary btn-xs"><i class="ti-pencil-alt mr-1"></i><?php echo e(_lang('Edit')); ?></a>
							</td>
					    </tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/website_management/page/default-list.blade.php ENDPATH**/ ?>