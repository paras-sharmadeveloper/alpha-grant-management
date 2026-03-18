<?php $__env->startSection('content'); ?>
<form method="post" class="validate" autocomplete="off" action="<?php echo e(route('admin.pages.default_pages.store')); ?>" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-8 offset-lg-2">
			<div class="card">
				<div class="card-header d-flex align-items-center justify-content-between">
					<span class="panel-title"><?php echo e(_lang('Update About Page')); ?></span>
					<a href="<?php echo e(route('admin.pages.default_pages')); ?>" class="btn btn-outline-primary btn-xs"><i class="fas fa-chevron-left mr-2"></i><?php echo e(_lang('Back')); ?></a>
				</div>
				<div class="card-body">
					<?php echo csrf_field(); ?>
					<div class="row">
						<div class="col-md-6">
					        <div class="form-group">
						        <label class="control-label"><?php echo e(_lang('Title')); ?></label>
						        <input type="text" class="form-control" name="about_page[title]" value="<?php echo e(isset($pageData->title) ? $pageData->title : ''); ?>" required>
					        </div>
					    </div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Language')); ?></label>
								<select class="form-control" name="model_language" required>
									<?php echo e(load_language(get_language())); ?>

								</select>
							</div>
						</div>

						<div class="col-md-12">
					        <div class="form-group">
						        <label class="control-label"><?php echo e(_lang('Section 1 Heading')); ?></label>
						        <input type="text" class="form-control" name="about_page[section_1_heading]" value="<?php echo e(isset($pageData->section_1_heading) ? $pageData->section_1_heading : ''); ?>" required>
					        </div>
					    </div>

						<div class="col-md-12">
					        <div class="form-group">
						        <label class="control-label"><?php echo e(_lang('Section 1 Content')); ?></label>
						        <textarea class="form-control summernote" name="about_page[section_1_content]"><?php echo e(isset($pageData->section_1_content) ? $pageData->section_1_content : ''); ?></textarea>
					        </div>
					    </div>

						<div class="col-md-12">
					        <div class="form-group">
						        <label class="control-label"><?php echo e(_lang('About Image')); ?></label>
						        <input type="file" class="dropify" name="about_page_media[about_image]" data-default-file="<?php echo e(isset($pageMedia->about_image) ? asset('public/uploads/media/'.$pageMedia->about_image) : ''); ?>">
					        </div>
					    </div>

						<div class="col-md-12">
					        <div class="form-group">
						        <label class="control-label"><?php echo e(_lang('Section 2 Heading')); ?></label>
						        <input type="text" class="form-control" name="about_page[section_2_heading]" value="<?php echo e(isset($pageData->section_2_heading) ? $pageData->section_2_heading : ''); ?>" required>
					        </div>
					    </div>

						<div class="col-md-12">
					        <div class="form-group">
						        <label class="control-label"><?php echo e(_lang('Section 2 Content')); ?></label>
						        <textarea class="form-control summernote" name="about_page[section_2_content]"><?php echo e(isset($pageData->section_2_content) ? $pageData->section_2_content : ''); ?></textarea>
					        </div>
					    </div>

						<div class="col-md-12">
					        <div class="form-group">
						        <label class="control-label"><?php echo e(_lang('Section 3 Heading')); ?></label>
						        <input type="text" class="form-control" name="about_page[section_3_heading]" value="<?php echo e(isset($pageData->section_3_heading) ? $pageData->section_3_heading : ''); ?>" required>
					        </div>
					    </div>

						<div class="col-md-12">
					        <div class="form-group">
						        <label class="control-label"><?php echo e(_lang('Section 3 Content')); ?></label>
						        <textarea class="form-control summernote" name="about_page[section_3_content]"><?php echo e(isset($pageData->section_3_content) ? $pageData->section_3_content : ''); ?></textarea>
					        </div>
					    </div>

						<div class="col-md-12">
					        <div class="form-group">
						        <label class="control-label"><?php echo e(_lang('Team Heading')); ?></label>
						        <input type="text" class="form-control" name="about_page[team_heading]" value="<?php echo e(isset($pageData->team_heading) ? $pageData->team_heading : ''); ?>" required>
					        </div>
					    </div>

						<div class="col-md-12">
					        <div class="form-group">
						        <label class="control-label"><?php echo e(_lang('Team Sub Heading')); ?></label>
						        <input type="text" class="form-control" name="about_page[team_sub_heading]" value="<?php echo e(isset($pageData->team_sub_heading) ? $pageData->team_sub_heading : ''); ?>">
					        </div>
					    </div>

						<div class="col-md-12 mt-2">
							<div class="form-group">
								<button type="submit" class="btn btn-primary  mt-2"><i class="ti-check-box mr-2"></i><?php echo e(_lang('Save Changes')); ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
</form>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/super_admin/website_management/page/default/about.blade.php ENDPATH**/ ?>