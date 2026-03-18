<?php $__env->startSection('content'); ?>
<!-- Features section-->
<?php if(isset($pageData->features_status) && $pageData->features_status == 1): ?>
<section id="services" class="bg-light test-dv">
    <div class="container my-3 px-4">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center section-header">
                    <h3 class="wow animate__zoomIn"><?php echo e(_lang('Features')); ?></h3>
                    <h2 class="wow animate__fadeInUp"><?php echo e(isset($pageData->features_heading) ? $pageData->features_heading : ''); ?></h2>
                    <p class="wow animate__fadeInUp"><?php echo e(isset($pageData->features_sub_heading) ? $pageData->features_sub_heading : ''); ?></p>
                </div>
            </div>
        </div>

        <div class="row align-items-stretch">
            <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 mb-5 d-flex">
                <div class="feature wow animate__zoomIn flex-fill" data-wow-delay=".2s">
                    <div class="icon text-primary fw-bold mb-4">
                        <?php echo xss_clean($feature->icon); ?>

                    </div>
                    <h2 class="mb-1 mb-3"><?php echo e($feature->translation->title); ?></h2>
                    <p><?php echo e($feature->translation->content); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if(isset($pageData->pricing_status) && $pageData->pricing_status == 1): ?>
<!--Pricing Table-->
<section id="pricing-table">
    <div class="container my-3 px-4">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center section-header">
                    <h3 class="wow animate__zoomIn"><?php echo e(_lang('Pricing')); ?></h3>
                    <h2 class="wow animate__fadeInUp"><?php echo e(isset($pageData->pricing_heading) ? $pageData->pricing_heading : ''); ?></h2>
                    <p class="wow animate__fadeInUp"><?php echo e(isset($pageData->pricing_sub_heading) ? $pageData->pricing_sub_heading : ''); ?></p>
                </div>
            </div>
        </div>

        <div class="row gx-5 justify-content-center">

            <div class="d-flex align-items-center justify-content-center">
                <?php if($packages->where('package_type', 'monthly')->count() > 0): ?>
                <div class="form-check form-switch custom-switch mb-5 me-3">
                    <input class="form-check-input plan_type" type="checkbox" value="monthly" name="plan_type" id="monthy-plans" checked>
                    <label class="form-check-label ms-1 text-primary" for="monthy-plans"><b><?php echo e(_lang('Monthly')); ?></b></label>
                </div>
                <?php endif; ?>

                <?php if($packages->where('package_type', 'yearly')->count() > 0): ?>
                <div class="form-check form-switch custom-switch mb-5 me-3">
                    <input class="form-check-input plan_type" type="checkbox" value="yearly" name="plan_type" id="yearly-plans">
                    <label class="form-check-label ms-1 text-primary" for="yearly-plans"><b><?php echo e(_lang('Yearly')); ?></b></label>
                </div>
                <?php endif; ?>

                <?php if($packages->where('package_type', 'lifetime')->count() > 0): ?>
                <div class="form-check form-switch custom-switch mb-5">
                    <input class="form-check-input plan_type" type="checkbox" value="lifetime" name="plan_type" id="lifetime-plans">
                    <label class="form-check-label ms-1 text-primary" for="lifetime-plans"><b><?php echo e(_lang('Lifetime')); ?></b></label>
                </div>
                <?php endif; ?>
            </div>

            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 mb-5 <?php echo e($package->package_type); ?>-plan">
                <div class="pricing-plan popular h-100 <?php echo e($package->package_type == 'monthly' ? 'wow' : ''); ?> animate__zoomIn" data-wow-delay=".6s">
                    <div class="pricing-plan-header">
                        <?php if($package->is_popular == 1): ?>
                        <span><?php echo e(_lang('Most popular')); ?></span>
                        <?php endif; ?>
                        <h5><?php echo e($package->name); ?></h5>
                        <?php if($package->discount > 0): ?>
                        <p class="d-inline-block">
                            <small><del><?php echo e(decimalPlace($package->cost, currency_symbol())); ?></del></small>
                            <span class="bg-primary d-inline-block text-white px-3 py-1 rounded-pill ms-1"><?php echo e($package->discount.'% '._lang('Discount')); ?></span>
                        </p>
                        <h4><span><?php echo e(decimalPlace($package->cost - ($package->discount / 100) * $package->cost, currency_symbol())); ?></span> / <?php echo e(ucwords($package->package_type)); ?></h4>
                        <?php else: ?>
                        <h4><span><?php echo e(decimalPlace($package->cost, currency_symbol())); ?></span> / <?php echo e(ucwords($package->package_type)); ?></h4>
                        <?php endif; ?>

                        <?php if($package->trial_days > 0): ?>
                        <h6 class="mt-2 text-danger"><?php echo e($package->trial_days.' '._lang('Days Free Trial')); ?></h6>
                        <?php else: ?>
                        <h6 class="mt-2 text-dark"><?php echo e(_lang('No Trial Available')); ?></h6>
                        <?php endif; ?>
                    </div>
                    <div class="pricing-plan-body">
                        <ul>
                            <li><i class="bi bi-check2-circle me-2"></i><?php echo e(str_replace('-1',_lang('Unlimited'), $package->user_limit).' '._lang('Role Based User')); ?></li>
                            <li><i class="bi bi-check2-circle me-2"></i><?php echo e(str_replace('-1',_lang('Unlimited'), $package->member_limit).' '._lang('Members')); ?></li>
                            <li><i class="bi bi-check2-circle me-2"></i><?php echo e(str_replace('-1',_lang('Unlimited'), $package->branch_limit).' '._lang('Additional Branch')); ?></li>
                            <li><i class="bi bi-check2-circle me-2"></i><?php echo e(str_replace('-1',_lang('Unlimited'), $package->account_type_limit).' '._lang('Account Type')); ?></li>
                            <li><i class="bi bi-check2-circle me-2"></i><?php echo e(str_replace('-1',_lang('Unlimited'), $package->account_limit).' '._lang('Account')); ?></li>
                            <li><i class="bi <?php echo e($package->member_portal == 0 ? 'bi-x-circle' : 'bi-check2-circle'); ?> me-2"></i><?php echo e(_lang('Member Portal')); ?></li>
                        </ul>
                        <a href="<?php echo e(route('register')); ?>?package_id=<?php echo e($package->id); ?>"><?php echo e(_lang('Select')); ?> <i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<!--End Pricing Table-->
<?php endif; ?>

<?php if(isset($pageData->blog_status) && $pageData->blog_status == 1): ?>
<!-- Blog preview section-->
<section id="blogs" class="bg-light">
    <div class="container my-3 px-4">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center section-header">
                    <h3 class="wow animate__zoomIn"><?php echo e(_lang('Blogs')); ?></h3>
                    <h2 class="wow animate__fadeInUp"><?php echo e(isset($pageData->blog_heading) ? $pageData->blog_heading : ''); ?></h2>
                    <p class="wow animate__fadeInUp"><?php echo e(isset($pageData->blog_sub_heading) ? $pageData->blog_sub_heading : ''); ?></p>
                </div>
            </div>
        </div>
        <div class="row gx-4">
            <?php $__currentLoopData = $blog_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 mb-5">
                <div class="latest-post h-100 wow animate__zoomIn" data-wow-delay=".2s">
                    <img class="card-img-top" src="<?php echo e(asset('public/uploads/media/'.$post->image)); ?>" alt="<?php echo e($post->translation->title); ?>" />
                    <div class="post-body p-4">
                        <p class="post-date"><?php echo e($post->created_at); ?></p>
                        <a class="text-decoration-none" href="<?php echo e(url('/blogs/'.$post->slug)); ?>">
                            <h4 class="post-title mb-3"><?php echo e($post->translation->title); ?></h4>
                        </a>
                        <a href="<?php echo e(url('/blogs/'.$post->slug)); ?>" class="read-more"><?php echo e(_lang('Read More')); ?> <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if(isset($pageData->testimonials_status) && $pageData->testimonials_status == 1): ?>
<section id="testimonial">
    <div class="container my-3 px-4">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center section-header mb-5">
                    <h3 class="wow animate__zoomIn"><?php echo e(_lang('Testimonials')); ?></h3>
                    <h2 class="wow animate__fadeInUp"><?php echo e(isset($pageData->testimonials_heading) ? $pageData->testimonials_heading : ''); ?></h2>
                    <p class="wow animate__fadeInUp"><?php echo e(isset($pageData->testimonials_sub_heading) ? $pageData->testimonials_sub_heading : ''); ?></p>
                </div>
            </div>
        </div>

        <div class="testimonial-slider">
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card single-testimonial h-100 mt-5">
                <div class="card-body d-flex align-items-center flex-column justify-content-center text-center">
                    <picture class="avatar">
                        <img class="img-fluid rounded-circle" src="<?php echo e(asset('public/uploads/media/'.$testimonial->image)); ?>" alt="<?php echo e($testimonial->translation->name); ?>">
                    </picture>

                    <div class="px-4">
                        <p class="lead fw-bolder mb-4 mt-4 text-dark"><?php echo e($testimonial->translation->name); ?></p>

                        <p class="font-weight-normal mb-4"><i>"<?php echo e($testimonial->translation->testimonial); ?>"</i></p>

                        <span class="ratings">
                            <i class="bi bi-star-fill text-primary"></i>
                            <i class="bi bi-star-fill text-primary"></i>
                            <i class="bi bi-star-fill text-primary"></i>
                            <i class="bi bi-star-fill text-primary"></i>
                            <i class="bi bi-star-fill text-primary"></i>
                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if(isset($pageData->newsletter_status) && $pageData->newsletter_status == 1): ?>
<!-- Call to action-->
<section id="newsletter" style="background-image: url(<?php echo e(isset($pageMedia->newsletter_bg_image) ? 'public/uploads/media/'.$pageMedia->newsletter_bg_image : 'public/website/assets/call-to-action.jpg'); ?>)">
    <div class="container px-4">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center section-header mb-5">
                    <h3 class="wow animate__zoomIn"><?php echo e(_lang('Newsletter')); ?></h3>
                    <h2 class="text-white wow animate__fadeInUp"><?php echo e(isset($pageData->newsletter_heading) ? $pageData->newsletter_heading : ''); ?></h2>
                    <p class="text-white wow animate__fadeInUp"><?php echo e(isset($pageData->newsletter_sub_heading) ? $pageData->newsletter_sub_heading : ''); ?></p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center wow animate__zoomIn" data-wow-duration="1s">
            <div class="col-lg-6">
                <form action="<?php echo e(url('/email_subscription')); ?>" id="email_subscription" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="input-group">
                        <input class="form-control" type="text" name="email_address" placeholder="<?php echo e(_lang('Email address')); ?>" aria-label="<?php echo e(_lang('Email address')); ?>" aria-describedby="button-newsletter" required/>
                        <button class="btn btn-primary border-radius-10 px-3" id="button-newsletter" type="submit"><?php echo e(_lang('Subscribe')); ?> <i class="bi bi-arrow-right ms-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/website/index.blade.php ENDPATH**/ ?>