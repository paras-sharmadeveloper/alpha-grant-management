<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-lg-12">
        <div class="alert alert-info">
            <span><i class="ti-info-alt"></i>&nbsp;<?php echo e(_lang('Calculation process may take longer depends on members limit')); ?></span>
        </div>
        <div id="last-run"></div>
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Interest Calculation')); ?></span>
			</div>
			<div class="card-body">
                <div class="col-lg-8">
                    <form method="post" class="validate" autocomplete="off" action="<?php echo e(route('interest_calculation.calculator')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label class="col-md-4 control-label"><?php echo e(_lang('Account Type')); ?></label>
                            <div class="col-md-8">
                                <select class="form-control" name="account_type" id="account_type" required>
                                    <option value=""><?php echo e(_lang('Select One')); ?></option>
                                    <?php $__currentLoopData = App\Models\SavingsProduct::active()->where('interest_rate','>',0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($product->id); ?>" data-rate="<?php echo e($product->interest_rate); ?>" data-period="<?php echo e($product->interest_period); ?>"><?php echo e($product->name); ?> (<?php echo e($product->currency->name); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 control-label"><?php echo e(_lang('Start Date')); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control datepicker" name="start_date" id="start_date" value="<?php echo e(old('start_date')); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 control-label"><?php echo e(_lang('End Date')); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control datepicker" name="end_date" id="end_date" value="<?php echo e(old('end_date')); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 control-label"><?php echo e(_lang('Interest Posting Date')); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control datetimepicker" name="posting_date" value="<?php echo e(old('posting_date', now())); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 control-label"><?php echo e(_lang('Interest Rate')); ?> %</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="interest_rate" id="interest_rate" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary"><?php echo e(_lang('Calculate Interest')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
(function ($) {
    "use strict";

    $(document).on('change','#account_type', function(){
        var percent = $(this).find(':selected').data('rate');
        var interestPeriod = $(this).find(':selected').data('period');
        $(this).val() != '' ? $("#interest_rate").val(percent + '%') : $("#interest_rate").val(null);

        var accountType = "<?php echo e(_lang('Interest of')); ?>" + ' ' + $(this).find(':selected').text();
        var lastPosted = "<?php echo e(_lang('last posted on')); ?>";

        $.ajax({
            url: "<?php echo e(route('interest_calculation.get_last_posting')); ?>/" + $(this).val(),
            beforeSend: function(){
                $("#preloader").fadeIn();
            }, success: function(data){
                $("#preloader").fadeOut();
                var json = JSON.parse(JSON.stringify(data));
                if(json['result'] == true){
                    $("#last-run").html(`<div class="alert alert-danger">
                        <p>${accountType +' '+ lastPosted} ${json['data']['created_at']}</p>
                    </div>`);
                }else{
                    $("#last-run").html(null);
                }
            }
        });
    });
})(jQuery);
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/interest_calculation/create.blade.php ENDPATH**/ ?>