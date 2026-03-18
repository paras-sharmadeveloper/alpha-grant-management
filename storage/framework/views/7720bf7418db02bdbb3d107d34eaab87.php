<script>
(function($) {
    "use strict";

    //Show success message
    <?php if(Session::has('success')): ?>
        $("#main_alert > span.msg").html(" <?php echo e(session('success')); ?> ");
        $("#main_alert").addClass("alert-success").removeClass("alert-danger");
        $("#main_alert").css('display','block');
    <?php endif; ?>
    
    //Show error message
    <?php if(Session::has('error')): ?>
        $("#main_alert > span.msg").html(" <?php echo e(session('error')); ?> ");
        $("#main_alert").addClass("alert-danger").removeClass("alert-success");
        $("#main_alert").css('display','block');
    <?php endif; ?>


    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($loop->first): ?>
            $("#main_alert > span.msg").html("<i class='fas fa-exclamation-circle mr-1'></i><?php echo e($error); ?> ");
            $("#main_alert").addClass("alert-danger").removeClass("alert-success");
        <?php else: ?>
            $("#main_alert > span.msg").append("<br><i class='fas fa-exclamation-circle mr-1'></i><?php echo e($error); ?> ");					
        <?php endif; ?>
        
        <?php if($loop->last): ?>
            $("#main_alert").css('display','block');
        <?php endif; ?>

        <?php if(isset($errors->keys()[$loop->index])): ?>
            var name = "<?php echo e($errors->keys()[$loop->index]); ?>";

            $("input[name='" + name + "']").addClass('error is-invalid');
            $("select[name='" + name + "'] + span").addClass('error is-invalid');

            if(! $("input[name='"+name+"'], select[name='"+name+"']").prev().hasClass('col-form-label')){
                if(! $("input[name='"+name+"'], select[name='"+name+"']").hasClass('no-msg')){
                    $("input[name='"+name+"'], select[name='"+name+"']").after("<span class='v-error'><i class='fas fa-exclamation-circle mr-1'></i><?php echo e($error); ?></span>");
                }
            }else{
                if(! $("input[name='"+name+"'], select[name='"+name+"']").hasClass('no-msg')){
                    $("input[name='"+name+"'], select[name='"+name+"']").parent().parent().append("<span class='v-error'><i class='fas fa-exclamation-circle mr-1'></i><?php echo e($error); ?></span>");
                }
            }
        <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

})(jQuery);

</script><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/layouts/others/alert.blade.php ENDPATH**/ ?>