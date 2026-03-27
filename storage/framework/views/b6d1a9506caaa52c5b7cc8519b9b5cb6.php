

<?php $__env->startSection('content'); ?>


<div class="row">
    <div class="col-lg-12">
        <div class="card no-export">
            <div class="card-header d-flex align-items-center">
                <span class="panel-title"><?php echo e(_lang('Payments')); ?></span>
                <button class="btn btn-primary btn-xs ml-auto" data-toggle="modal" data-target="#payModal">
                    <i class="ti-plus"></i>&nbsp;<?php echo e(_lang('Pay')); ?>

                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pay_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo e(_lang('Loan ID')); ?></th>
                                <th><?php echo e(_lang('Member')); ?></th>
                                <th class="text-right"><?php echo e(_lang('Amount')); ?></th>
                                <th><?php echo e(_lang('Method')); ?></th>
                                <th><?php echo e(_lang('Date')); ?></th>
                                <th><?php echo e(_lang('Paid By')); ?></th>
                                <th class="text-center"><?php echo e(_lang('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="payModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(_lang('Make Payment')); ?></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">

                
                <div id="step_search">
                    <div class="form-group">
                        <label><?php echo e(_lang('Search by Loan ID / Member ID / Member Name')); ?></label>
                        <input type="text" id="loan_search_input" class="form-control" placeholder="<?php echo e(_lang('Type to search...')); ?>" autocomplete="off">
                    </div>
                    <div id="search_results" class="mt-2"></div>
                </div>

                
                <div id="step_payment" style="display:none;">
                    <div class="alert alert-info d-flex justify-content-between align-items-center py-2" id="selected_loan_info"></div>

                    <form id="pay_form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="loan_id" id="pay_loan_id">
                        <input type="hidden" name="due_amount_of" id="pay_due_amount_of">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Payment Date')); ?></label>
                                    <input type="text" class="form-control datepicker" name="paid_at" id="pay_paid_at" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Next Due Date')); ?></label>
                                    <input type="text" class="form-control" id="pay_due_date" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Principal Amount')); ?></label>
                                    <input type="number" step="0.01" class="form-control" name="principal_amount" id="pay_principal" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Interest')); ?></label>
                                    <input type="number" step="0.01" class="form-control" name="interest" id="pay_interest" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Late Penalties')); ?></label>
                                    <input type="number" step="0.01" class="form-control" name="late_penalties" id="pay_penalties" value="0">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Total Amount')); ?></label>
                                    <input type="number" step="0.01" class="form-control font-weight-bold" id="pay_total" readonly>
                                </div>
                            </div>

                            
                            <div class="col-md-12">
                                <label><?php echo e(_lang('Payment Method')); ?></label>
                                <div class="d-flex flex-wrap mb-3" id="method_tabs">
                                    <button type="button" class="btn btn-outline-primary mr-2 mb-2 method-btn active" data-method="cash">
                                        <i class="fas fa-money-bill-wave"></i> <?php echo e(_lang('Cash')); ?>

                                    </button>
                                    <button type="button" class="btn btn-outline-primary mr-2 mb-2 method-btn" data-method="bank_transfer">
                                        <i class="fas fa-university"></i> <?php echo e(_lang('Bank Transfer')); ?>

                                    </button>
                                    <a href="#" id="stripe_pay_link" class="btn btn-outline-danger mr-2 mb-2">
                                        <i class="fab fa-stripe-s"></i> <?php echo e(_lang('Stripe')); ?>

                                    </a>
                                </div>
                                <input type="hidden" name="payment_method" id="pay_method" value="cash">
                            </div>

                            
                            <div class="col-md-12" id="bank_details_section" style="display:none;">
                                <div class="card border mb-3">
                                    <div class="card-header py-2"><strong><?php echo e(_lang('Bank Transfer')); ?></strong></div>
                                    <div class="card-body">
                                        <div class="form-group mb-0">
                                            <label><?php echo e(_lang('Transaction / Reference Number')); ?></label>
                                            <input type="text" class="form-control" name="utr_number" id="pay_utr" placeholder="<?php echo e(_lang('Enter the reference number provided by your bank')); ?>">
                                            <small class="text-muted"><?php echo e(_lang('e.g. UTR, IMPS, NEFT, RTGS or any bank-provided reference')); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo e(_lang('Remarks')); ?></label>
                                    <textarea class="form-control" name="remarks" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" id="btn_back_search">
                                <i class="ti-arrow-left"></i> <?php echo e(_lang('Back')); ?>

                            </button>
                            <button type="submit" class="btn btn-primary" id="btn_submit_pay">
                                <i class="ti-check"></i> <?php echo e(_lang('Process Payment')); ?>

                            </button>
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

    var stripeBaseUrl = '<?php echo e(url(request()->route("tenant") . "/pay/stripe")); ?>';

    // ── Payments DataTable ────────────────────────────────────────────────────
    var payTable = $('#pay_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: _tenant_url + '/loan_payments/get_table_data',
        columns: [
            { data: 'loan.loan_id',  name: 'loan.loan_id' },
            { data: 'member_name',   name: 'member_name', orderable: false },
            { data: 'total_amount',  name: 'total_amount', className: 'text-right' },
            { data: 'remarks',       name: 'remarks', orderable: false,
              render: function(d) {
                  var r = d || '';
                  if (r.indexOf('Stripe') !== -1) return '<span class="badge badge-danger">Stripe</span>';
                  if (r.indexOf('BANK_TRANSFER') !== -1) return '<span class="badge badge-info">Bank Transfer</span>';
                  return '<span class="badge badge-success">Cash</span>';
              }
            },
            { data: 'paid_at',       name: 'paid_at' },
            { data: 'remarks',       name: 'remarks_by', orderable: false,
              render: function(d, t, row) {
                  var r = d || '';
                  return r.indexOf('Self') !== -1 ? (row.member_name || '-') : '<?php echo e(auth()->user()->name); ?>';
              }
            },
            { data: 'action',        name: 'action', orderable: false, className: 'text-center' },
        ],
        responsive: true,
        ordering: false,
        language: {
            emptyTable:  "<?php echo e(_lang('No Data Found')); ?>",
            search:      "<?php echo e(_lang('Search')); ?>",
            zeroRecords: "<?php echo e(_lang('No matching records found')); ?>",
            paginate: { previous: "<i class='fas fa-angle-left'></i>", next: "<i class='fas fa-angle-right'></i>" }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-bordered");
        }
    });

    // ── Search ────────────────────────────────────────────────────────────────
    var searchTimer;
    $('#loan_search_input').on('input', function () {
        clearTimeout(searchTimer);
        var q = $(this).val().trim();
        if (q.length < 1) { $('#search_results').html(''); return; }
        searchTimer = setTimeout(function () {
            $.get('<?php echo e(route("pay.search")); ?>', { q: q }, function (data) {
                if (!data.length) {
                    $('#search_results').html('<p class="text-muted"><?php echo e(_lang("No active loans found")); ?></p>');
                    return;
                }
                var html = '<div class="table-responsive"><table class="table table-sm table-hover">'
                    + '<thead><tr><th><?php echo e(_lang("Loan ID")); ?></th><th><?php echo e(_lang("Member")); ?></th>'
                    + '<th class="text-right"><?php echo e(_lang("Outstanding")); ?></th><th><?php echo e(_lang("Next Due")); ?></th><th></th></tr></thead><tbody>';
                $.each(data, function (i, loan) {
                    html += '<tr>'
                        + '<td>' + loan.loan_id + '</td>'
                        + '<td>' + loan.borrower_name + ' <small class="text-muted">(' + loan.member_no + ')</small></td>'
                        + '<td class="text-right">' + loan.currency + ' ' + parseFloat(loan.outstanding).toFixed(2) + '</td>'
                        + '<td>' + (loan.next_due_date || '-') + '</td>'
                        + '<td><button class="btn btn-primary btn-xs btn-select-loan" data-loan=\'' + JSON.stringify(loan) + '\'><?php echo e(_lang("Pay")); ?></button></td>'
                        + '</tr>';
                });
                html += '</tbody></table></div>';
                $('#search_results').html(html);
            });
        }, 300);
    });

    // ── Select loan → show payment form ──────────────────────────────────────
    $(document).on('click', '.btn-select-loan', function () {
        var loan = $(this).data('loan');
        $('#pay_loan_id').val(loan.id);
        $('#pay_due_amount_of').val(loan.next_repayment_id);
        $('#pay_principal').val(parseFloat(loan.next_principal).toFixed(2));
        $('#pay_interest').val(parseFloat(loan.next_interest).toFixed(2));
        $('#pay_penalties').val(0);
        $('#pay_due_date').val(loan.next_due_date || '-');
        recalcTotal();

        // Stripe link — carry late_penalties so it pre-fills on the stripe page
        $('#stripe_pay_link').attr('href', stripeBaseUrl + '/' + loan.id + '?late=' + (parseFloat(loan.next_penalty) || 0));

        $('#selected_loan_info').html(
            '<strong>' + loan.loan_id + '</strong> &mdash; ' + loan.borrower_name +
            ' &nbsp;|&nbsp; <?php echo e(_lang("Outstanding")); ?>: <strong>' + loan.currency + ' ' + parseFloat(loan.outstanding).toFixed(2) + '</strong>'
        );

        $('#step_search').hide();
        $('#step_payment').show();
    });

    $('#btn_back_search').on('click', function () {
        $('#step_payment').hide();
        $('#step_search').show();
    });

    // ── Method tabs ───────────────────────────────────────────────────────────
    $(document).on('click', '.method-btn', function () {
        $('.method-btn').removeClass('active');
        $(this).addClass('active');
        var method = $(this).data('method');
        $('#pay_method').val(method);
        $('#bank_details_section').toggle(method === 'bank_transfer');
    });

    // ── Recalc total ──────────────────────────────────────────────────────────
    function recalcTotal() {
        var p   = parseFloat($('#pay_principal').val()) || 0;
        var i   = parseFloat($('#pay_interest').val()) || 0;
        var pen = parseFloat($('#pay_penalties').val()) || 0;
        $('#pay_total').val((p + i + pen).toFixed(2));
        // Keep stripe link in sync with current late penalties
        var loanId = $('#pay_loan_id').val();
        if (loanId) {
            $('#stripe_pay_link').attr('href', stripeBaseUrl + '/' + loanId + '?late=' + pen);
        }
    }
    $('#pay_principal, #pay_interest, #pay_penalties').on('input', recalcTotal);

    // ── Submit payment ────────────────────────────────────────────────────────
    $('#pay_form').on('submit', function (e) {
        e.preventDefault();
        var btn = $('#btn_submit_pay').prop('disabled', true).text('<?php echo e(_lang("Processing...")); ?>');
        $.ajax({
            url: '<?php echo e(route("pay.process")); ?>',
            method: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                if (res.result === 'success') {
                    $('#payModal').modal('hide');
                    payTable.ajax.reload();
                    toastr.success(res.message);
                    // Reset modal
                    $('#step_payment').hide();
                    $('#step_search').show();
                    $('#loan_search_input').val('');
                    $('#search_results').html('');
                    $('#pay_form')[0].reset();
                } else {
                    toastr.error(Array.isArray(res.message) ? res.message.join('<br>') : res.message);
                }
            },
            error: function () { toastr.error('<?php echo e(_lang("An error occurred")); ?>'); },
            complete: function () { btn.prop('disabled', false).text('<?php echo e(_lang("Process Payment")); ?>'); }
        });
    });

    // Reset modal on close
    $('#payModal').on('hidden.bs.modal', function () {
        $('#step_payment').hide();
        $('#step_search').show();
        $('#loan_search_input').val('');
        $('#search_results').html('');
    });

})(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/pay/index.blade.php ENDPATH**/ ?>