

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="<?php echo e($alert_col); ?>">
		<div class="card">
			<div class="card-header">
				<span class="panel-title"><?php echo e(_lang('Apply New Loan')); ?></span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="<?php echo e(route('loans.apply_loan')); ?>" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="row">

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Loan Product')); ?></label>
								<select class="form-control auto-select select2"  data-selected="<?php echo e(request()->product ?? old('loan_product_id')); ?>" name="loan_product_id" required>
									<option value=""><?php echo e(_lang('Select One')); ?></option>
									<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\LoanProduct::active()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
									<option value="<?php echo e($loanProduct->id); ?>" data-penalties="<?php echo e($loanProduct->late_payment_penalties); ?>" data-loan-id="<?php echo e($loanProduct->loan_id_prefix.$loanProduct->starting_loan_id); ?>" data-details="<?php echo e($loanProduct); ?>"><?php echo e($loanProduct->name); ?></option>
									<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Currency')); ?></label>
								
								<?php $audCurrency = \App\Models\Currency::where('name', 'AUD')->where('status', 1)->first(); ?>
								<input type="text" class="form-control" value="Australian Dollar (AUD)" disabled>
								<input type="hidden" name="currency_id" value="<?php echo e($audCurrency->id ?? ''); ?>">
							</div>
						</div>

						

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Applied Amount')); ?></label>
								<input type="text" class="form-control float-field" name="applied_amount" id="applied-amount-input" value="<?php echo e(old('applied_amount')); ?>" required>
							</div>
						</div>

						<div class="col-lg-6" id="term-field" style="display:none;">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Term')); ?> <span id="term-period-label" class="text-muted" style="font-size:12px;"></span></label>
								<input type="number" class="form-control" name="term" id="term-input" value="<?php echo e(old('term')); ?>" min="1" max="999">
								<small class="text-muted" id="term-hint"></small>
							</div>
						</div>

						<div class="col-lg-6" id="interest-rate-field" style="display:none;">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Interest Rate')); ?></label>
								<input type="text" class="form-control" id="interest-rate-display" disabled>
							</div>
						</div>

						<!--Custom Fields-->
						<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $customFields->isEmpty()): ?>
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
							<div class="<?php echo e($customField->field_width); ?>">
								<div class="form-group">
									<label class="control-label"><?php echo e($customField->field_name); ?></label>
									<?php echo xss_clean(generate_input_field($customField)); ?>

								</div>
							</div>
							<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

						

						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Attachment')); ?></label>
								<input type="file" class="file-uploader" name="attachment">
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Description')); ?></label>
								<textarea class="form-control" name="description"><?php echo e(old('description')); ?></textarea>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label"><?php echo e(_lang('Remarks')); ?></label>
								<textarea class="form-control" name="remarks"><?php echo e(old('remarks')); ?></textarea>
							</div>
						</div>

						<div class="col-md-12 mt-2">
							<div id="summary-error" class="alert alert-danger" style="display:none; font-family:Poppins,sans-serif; font-size:13px;"></div>
							<div class="form-group">
								<button type="button" class="btn btn-secondary mr-2" id="btn-loan-summary" style="display:none;"><i class="ti-eye"></i>&nbsp;<?php echo e(_lang('View Loan Summary')); ?></button>
								<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Submit Application')); ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<!-- Loan Summary Modal -->
<div class="modal fade" id="loanSummaryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#214942; color:#fff;">
                <h5 class="modal-title" style="font-family:Poppins,sans-serif; font-size:14px; font-weight:400;"><?php echo e(_lang('Loan Repayment Summary')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:1;"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="font-family:Poppins,sans-serif; font-size:14px;">
                <div id="summary-info" class="mb-3" style="background:#f8f9fa; padding:12px; border-radius:6px;"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" style="font-size:13px;">
                        <thead style="background:#214942; color:#fff;">
                            <tr>
                                <th>#</th>
                                <th><?php echo e(_lang('Date')); ?></th>
                                <th><?php echo e(_lang('Principal')); ?></th>
                                <th><?php echo e(_lang('Interest')); ?></th>
                                <th><?php echo e(_lang('Amount to Pay')); ?></th>
                                <th><?php echo e(_lang('Balance')); ?></th>
                            </tr>
                        </thead>
                        <tbody id="summary-table-body"></tbody>
                        <tfoot id="summary-table-foot" style="font-weight:600; background:#f0f0f0;"></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('js-script'); ?>
<script>
$(document).ready(function() {
    var $productSelect   = $('select[name="loan_product_id"]');
    var $termField       = $('#term-field');
    var $termInput       = $('#term-input');
    var $termHint        = $('#term-hint');
    var $termPeriodLabel = $('#term-period-label');
    var $interestField   = $('#interest-rate-field');
    var $interestDisplay = $('#interest-rate-display');
    var $summaryBtn      = $('#btn-loan-summary');
    var currentDetails   = null;

    function updateTermField() {
        var selected = $productSelect.find('option:selected');
        if (!selected.val()) {
            $termField.hide();
            $interestField.hide();
            $summaryBtn.hide();
            $termInput.removeAttr('required');
            currentDetails = null;
            return;
        }
        try {
            var details  = JSON.parse(selected.attr('data-details'));
            currentDetails = details;
            var minTerm  = parseInt(details.min_term) || 1;
            var maxTerm  = parseInt(details.term) || 1;

            // Term period label
            var tp = (details.term_period || '').replace(/^\+/, '').replace(/\d+\s*/, '').trim();
            $termPeriodLabel.text('(' + tp + 's)');

            $termInput.attr('min', minTerm).attr('max', maxTerm);
            var current = parseInt($termInput.val());
            if (!current || current < minTerm) $termInput.val(minTerm);
            else if (current > maxTerm) $termInput.val(maxTerm);

            $termHint.text('Min: ' + minTerm + ' — Max: ' + maxTerm);
            $termField.show();
            $termInput.attr('required', 'required');

            // Interest rate display
            $interestDisplay.val(details.interest_rate + '% (' + details.interest_type.replace(/_/g,' ') + ')');
            $interestField.show();
            $summaryBtn.show();
        } catch(e) {
            $termField.hide();
            $interestField.hide();
            $summaryBtn.hide();
        }
    }

    $productSelect.on('change', updateTermField);
    if ($productSelect.val()) updateTermField();

    // Advance date by term_period string e.g. "+1 month", "+7 day"
    function advanceDate(dateStr, termPeriod) {
        var d = new Date(dateStr + 'T00:00:00');
        var clean = termPeriod.replace(/^\+/, '').trim();
        var m = clean.match(/(\d+)\s*(day|month|year)s?/i);
        if (!m) return dateStr;
        var n = parseInt(m[1]), unit = m[2].toLowerCase();
        if (unit === 'day')   d.setDate(d.getDate() + n);
        if (unit === 'month') d.setMonth(d.getMonth() + n);
        if (unit === 'year')  d.setFullYear(d.getFullYear() + n);
        return d.toISOString().slice(0,10);
    }

    function fmt(n) { return parseFloat(n).toFixed(2); }

    function calcSchedule(details, amount, term) {
        var rate       = parseFloat(details.interest_rate) / 100;
        var termPeriod = details.term_period || '+1 month';
        var itype      = details.interest_type;
        var penalties  = parseFloat(details.late_payment_penalties) || 0;

        // First payment date: today + 1 month
        var fpd = new Date(); fpd.setMonth(fpd.getMonth() + 1);
        var firstDate = fpd.toISOString().slice(0,10);

        var schedule = [];
        var date = firstDate;

        // Duration in years helper
        function durationInYears() {
            var clean = termPeriod.replace(/^\+/, '').trim();
            var m = clean.match(/(\d+)\s*(day|month|year)s?/i);
            if (!m) return term / 12;
            var n = parseInt(m[1]), unit = m[2].toLowerCase();
            if (unit === 'day')   return (n * term) / 365;
            if (unit === 'month') return (n * term) / 12;
            if (unit === 'year')  return n * term;
            return term / 12;
        }

        if (itype === 'flat_rate') {
            var durYears     = durationInYears();
            var totalInt     = amount * rate * durYears;
            var totalPayable = amount + totalInt;
            var installment  = totalPayable / term;
            var principalPT  = amount / term;
            var interestPT   = totalInt / term;
            var penalty      = (penalties / 100) * principalPT;
            var balance      = amount;
            for (var i = 0; i < term; i++) {
                balance -= principalPT;
                schedule.push({ date: date, principal: principalPT, interest: interestPT, amount_to_pay: installment, balance: Math.max(balance, 0) });
                date = advanceDate(date, termPeriod);
            }

        } else if (itype === 'fixed_rate') {
            var totalPayable = ((rate * amount) * term) + amount;
            var principalPT  = amount / term;
            var interestPT   = rate * amount;
            var installment  = principalPT + interestPT;
            var balance      = amount;
            for (var i = 0; i < term; i++) {
                balance -= principalPT;
                schedule.push({ date: date, principal: principalPT, interest: interestPT, amount_to_pay: installment, balance: Math.max(balance, 0) });
                date = advanceDate(date, termPeriod);
            }

        } else if (itype === 'mortgage') {
            var monthlyRate  = rate / 12;
            var payment      = monthlyRate === 0 ? amount / term : amount * (monthlyRate / (1 - Math.pow(1 + monthlyRate, -term)));
            var balance      = amount;
            for (var i = 0; i < term; i++) {
                var interest  = balance * monthlyRate;
                var principal = payment - interest;
                balance -= principal;
                schedule.push({ date: date, principal: principal, interest: interest, amount_to_pay: payment, balance: Math.max(balance, 0) });
                date = advanceDate(date, termPeriod);
            }

        } else if (itype === 'one_time') {
            var interest     = rate * amount;
            var amount_to_pay = amount + interest;
            schedule.push({ date: date, principal: amount, interest: interest, amount_to_pay: amount_to_pay, balance: 0 });

        } else if (itype === 'reducing_amount') {
            var monthlyRate  = rate / 12;
            var payment      = monthlyRate === 0 ? amount / term : amount * (monthlyRate / (1 - Math.pow(1 + monthlyRate, -term)));
            var principalPT  = amount / term;
            var balance      = amount;
            for (var i = 0; i < term; i++) {
                var interest   = balance * monthlyRate;
                var amtToPay   = interest + principalPT;
                balance -= principalPT;
                schedule.push({ date: date, principal: principalPT, interest: interest, amount_to_pay: amtToPay, balance: Math.max(balance, 0) });
                date = advanceDate(date, termPeriod);
            }
        }

        return schedule;
    }

    function showError(msg) {
        $('#summary-error').text(msg).show();
        setTimeout(function() { $('#summary-error').fadeOut(); }, 4000);
    }

    $('#btn-loan-summary').on('click', function() {
        if (!currentDetails) return;
        var amount = parseFloat($('#applied-amount-input').val().replace(/,/g,''));
        var term   = parseInt($termInput.val());
        if (!amount || amount <= 0) { showError('Please enter the applied amount first.'); return; }
        if (!term   || term   <= 0) { showError('Please enter the term first.'); return; }

        var schedule = calcSchedule(currentDetails, amount, term);
        var totalPayable = 0, totalInterest = 0, totalPrincipal = 0;

        var rows = '';
        $.each(schedule, function(i, row) {
            totalPrincipal += row.principal;
            totalInterest  += row.interest;
            totalPayable   += row.amount_to_pay;
            rows += '<tr>' +
                '<td>' + (i+1) + '</td>' +
                '<td>' + row.date + '</td>' +
                '<td>' + fmt(row.principal) + '</td>' +
                '<td>' + fmt(row.interest) + '</td>' +
                '<td>' + fmt(row.amount_to_pay) + '</td>' +
                '<td>' + fmt(row.balance) + '</td>' +
            '</tr>';
        });

        var tp = (currentDetails.term_period || '').replace(/^\+/, '').replace(/\d+\s*/, '').trim();
        $('#summary-info').html(
            '<strong>Product:</strong> ' + currentDetails.name +
            ' &nbsp;|&nbsp; <strong>Amount:</strong> AUD ' + fmt(amount) +
            ' &nbsp;|&nbsp; <strong>Term:</strong> ' + term + ' ' + tp + '(s)' +
            ' &nbsp;|&nbsp; <strong>Rate:</strong> ' + currentDetails.interest_rate + '%' +
            ' &nbsp;|&nbsp; <strong>Type:</strong> ' + currentDetails.interest_type.replace(/_/g,' ')
        );
        $('#summary-table-body').html(rows);
        $('#summary-table-foot').html(
            '<tr><td colspan="2"><strong>Total</strong></td>' +
            '<td><strong>' + fmt(totalPrincipal) + '</strong></td>' +
            '<td><strong>' + fmt(totalInterest) + '</strong></td>' +
            '<td><strong>' + fmt(totalPayable) + '</strong></td>' +
            '<td></td></tr>'
        );

        $('#loanSummaryModal').modal('show');
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/customer/loan/apply_loan.blade.php ENDPATH**/ ?>