

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <span class="panel-title"><?php echo e(_lang('Pay Loan')); ?></span>
            </div>
            <div class="card-body">

                
                <div class="form-group">
                    <label style="font-family:Poppins,sans-serif;font-size:14px;"><?php echo e(_lang('Search by Loan ID')); ?></label>
                    <input type="text" id="pay_search_input" class="form-control"
                           placeholder="<?php echo e(_lang('Type loan ID...')); ?>" autocomplete="off">
                </div>

                <div id="pay_search_results" class="mt-3"></div>

                
                <div id="pay_all_loans">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                        <div>
                            <div style="font-family:Poppins,sans-serif;font-size:14px;font-weight:500;color:#214942;">
                                <?php echo e($loan->loan_id); ?>

                            </div>
                            <div style="font-family:Poppins,sans-serif;font-size:12px;color:#888;margin-top:4px;">
                                <?php echo e(_lang('Next Due')); ?>: <?php echo e($loan->next_payment ? $loan->next_payment->repayment_date : '—'); ?>

                                &nbsp;|&nbsp;
                                <?php echo e(_lang('Outstanding')); ?>: <?php echo e(decimalPlace(($loan->applied_amount - $loan->total_paid), currency($loan->currency->name))); ?>

                            </div>
                        </div>
                        <a href="<?php echo e(route('loans.stripe_payment', $loan->id)); ?>"
                           class="btn btn-danger btn-sm">
                            <i class="fab fa-stripe-s mr-1"></i> <?php echo e(_lang('Pay via Stripe')); ?>

                        </a>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <p class="text-center text-muted mt-3" style="font-family:Poppins,sans-serif;font-size:14px;">
                        <?php echo e(_lang('No active loans found.')); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
(function ($) {
    var timer;
    $('#pay_search_input').on('input', function () {
        clearTimeout(timer);
        var q = $(this).val().trim();

        if (q.length === 0) {
            $('#pay_search_results').html('');
            $('#pay_all_loans').show();
            return;
        }

        $('#pay_all_loans').hide();
        timer = setTimeout(function () {
            $.get('<?php echo e(route("customer.pay.search")); ?>', { q: q }, function (data) {
                if (!data.length) {
                    $('#pay_search_results').html(
                        '<p class="text-muted text-center" style="font-family:Poppins,sans-serif;font-size:14px;"><?php echo e(_lang("No active loans found.")); ?></p>'
                    );
                    return;
                }
                var html = '';
                $.each(data, function (i, loan) {
                    html += '<div class="d-flex justify-content-between align-items-center py-3 border-bottom">'
                        + '<div>'
                        + '<div style="font-family:Poppins,sans-serif;font-size:14px;font-weight:500;color:#214942;">' + loan.loan_id + '</div>'
                        + '<div style="font-family:Poppins,sans-serif;font-size:12px;color:#888;margin-top:4px;">'
                        + '<?php echo e(_lang("Next Due")); ?>: ' + (loan.next_due_date || '—')
                        + ' &nbsp;|&nbsp; <?php echo e(_lang("Outstanding")); ?>: ' + loan.currency + ' ' + parseFloat(loan.outstanding).toFixed(2)
                        + '</div>'
                        + '</div>'
                        + '<a href="' + loan.stripe_url + '" class="btn btn-danger btn-sm">'
                        + '<i class="fab fa-stripe-s mr-1"></i> <?php echo e(_lang("Pay via Stripe")); ?>'
                        + '</a>'
                        + '</div>';
                });
                $('#pay_search_results').html(html);
            });
        }, 300);
    });
})(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/customer/loan/pay.blade.php ENDPATH**/ ?>