

<?php $__env->startSection('content'); ?>
<script src="https://js.stripe.com/v3/"></script>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="header-title"><?php echo e(_lang('Stripe Payment')); ?></span>
                <a href="<?php echo e(route('pay.index')); ?>" class="btn btn-secondary btn-xs ml-auto"><i class="ti-arrow-left"></i> <?php echo e(_lang('Back')); ?></a>
            </div>
            <div class="card-body">

                <table class="table table-bordered mb-3">
                    <tr><td><?php echo e(_lang('Loan ID')); ?></td><td><?php echo e($loan->loan_id); ?></td></tr>
                    <tr><td><?php echo e(_lang('Borrower')); ?></td><td><?php echo e($loan->borrower->first_name); ?> <?php echo e($loan->borrower->last_name); ?></td></tr>
                    <tr><td><?php echo e(_lang('Due Date')); ?></td><td><?php echo e($loan->next_payment->repayment_date); ?></td></tr>
                    <tr><td><?php echo e(_lang('Principal')); ?></td><td><?php echo e(decimalPlace($loan->next_payment->principal_amount, currency($loan->currency->name))); ?></td></tr>
                    <tr><td><?php echo e(_lang('Interest')); ?></td><td><?php echo e(decimalPlace($loan->next_payment->interest, currency($loan->currency->name))); ?></td></tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($late_penalties > 0): ?>
                    <tr><td><?php echo e(_lang('Late Fees')); ?></td><td class="text-danger"><?php echo e(decimalPlace($late_penalties, currency($loan->currency->name))); ?></td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <tr>
                        <td><strong><?php echo e(_lang('Total')); ?></strong></td>
                        <td><strong id="total_display"><?php echo e(decimalPlace($totalAmount, currency($loan->currency->name))); ?></strong></td>
                    </tr>
                </table>

                <form action="<?php echo e(route('pay.stripe_callback', $loan->id)); ?>" method="post" id="payment-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="late_penalties" id="late_penalties_hidden" value="<?php echo e($late_penalties); ?>">
                    <input type="hidden" name="total_amount" id="total_amount_hidden" value="<?php echo e($totalAmount); ?>">

                    <div class="form-group">
                        <label><?php echo e(_lang('Card Details')); ?></label>
                        <div id="card-element" class="form-control" style="height:auto;padding:12px 14px;"></div>
                        <div id="card-errors" class="text-danger mt-1" role="alert"></div>
                    </div>

                    <button class="btn btn-danger btn-block mt-3" id="pay_now" type="submit">
                        <i class="fab fa-stripe-s mr-1"></i> <?php echo e(_lang('Pay Now')); ?>

                        <span id="pay_btn_amount"><?php echo e(decimalPlace($totalAmount, currency($loan->currency->name))); ?></span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-script'); ?>
<script>
var stripe = Stripe("<?php echo e($publishable_key); ?>");
var card   = stripe.elements().create('card', {
    style: { base: { color: '#32325d', fontSize: '16px', '::placeholder': { color: '#aab7c4' } }, invalid: { color: '#fa755a' } },
    hidePostalCode: true
});
card.mount('#card-element');
card.on('change', function(e) { document.getElementById('card-errors').textContent = e.error ? e.error.message : ''; });

document.getElementById('payment-form').addEventListener('submit', function(e) {
    e.preventDefault();
    document.getElementById('pay_now').disabled = true;
    stripe.createToken(card).then(function(result) {
        if (result.error) {
            document.getElementById('card-errors').textContent = result.error.message;
            document.getElementById('pay_now').disabled = false;
        } else {
            var input = document.createElement('input');
            input.type = 'hidden'; input.name = 'stripeToken'; input.value = result.token.id;
            document.getElementById('payment-form').appendChild(input);
            document.getElementById('payment-form').submit();
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/pay/stripe.blade.php ENDPATH**/ ?>