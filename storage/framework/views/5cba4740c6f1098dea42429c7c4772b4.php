<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-sm-flex align-items-center justify-content-between">
                <div class="panel-title"><?php echo e(_lang('View Loan Details')); ?></div>
                <?php if($loan->status == 0): ?>
                <div>
                <a class="btn btn-primary btn-xs" href="<?php echo e(route('loans.approve', $loan['id'])); ?>">
                    <i class="fas fa-check-circle mr-1"></i><?php echo e(_lang('Click to Approve')); ?></a>
                <a class="btn btn-danger btn-xs confirm-alert" data-message="<?php echo e(_lang('Are you sure you want to reject this loan application?')); ?>" href="#">
                    <i class="fas fa-times-circle mr-1"></i><?php echo e(_lang('Click to Reject')); ?>

                </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#loan_details"><?php echo e(_lang("Loan Details")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#guarantor"><?php echo e(_lang("Guarantor")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#collateral"><?php echo e(_lang("Collateral")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#schedule"><?php echo e(_lang("Repayments Schedule")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#repayments"><?php echo e(_lang("Repayments")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('loans.edit', $loan['id'])); ?>"><?php echo e(_lang("Edit")); ?></a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="loan_details">
                        <?php if($loan->status == 0): ?>
                        <div class="alert alert-warning mt-4">
                            <span>
                            <?php echo e(_lang("Add Loan ID, Release Date and First Payment Date before approving loan request")); ?>

                            </span>
                        </div>
                        <?php endif; ?>
                        <table class="table table-bordered mt-4">
                            <tr>
                                <td><?php echo e(_lang("Loan ID")); ?></td>
                                <td><?php echo e($loan->loan_id); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Loan Type")); ?></td>
                                <td><?php echo e($loan->loan_product->name); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Borrower")); ?></td>
                                <td><?php echo e($loan->borrower->first_name.' '.$loan->borrower->last_name); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Member No")); ?></td>
                                <td><?php echo e($loan->borrower->member_no); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Status")); ?></td>
                                <td>
                                <?php if($loan->status == 0): ?>
                                <?php echo xss_clean(show_status(_lang('Pending'), 'warning')); ?>

                                <?php elseif($loan->status == 1): ?>
                                <?php echo xss_clean(show_status(_lang('Approved'), 'success')); ?>

                                <?php elseif($loan->status == 2): ?>
                                <?php echo xss_clean(show_status(_lang('Completed'), 'info')); ?>

                                <?php elseif($loan->status == 3): ?>
                                <?php echo xss_clean(show_status(_lang('Cancelled'), 'danger')); ?>

                                <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("First Payment Date")); ?></td>
                                <td><?php echo e($loan->first_payment_date); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Release Date")); ?></td>
                                <td>
                                <?php echo e($loan->release_date != '' ? $loan->release_date : ''); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Applied Amount")); ?></td>
                                <td>
                                <?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Total Principal Paid")); ?></td>
                                <td class="text-success">
                                <?php echo e(decimalPlace($loan->total_paid, currency($loan->currency->name))); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Total Interest Paid")); ?></td>
                                <td class="text-success">
                                <?php echo e(decimalPlace($loan->payments->sum('interest'), currency($loan->currency->name))); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Total Penalties Paid")); ?></td>
                                <td class="text-success">
                                <?php echo e(decimalPlace($loan->payments->sum('late_penalties'), currency($loan->currency->name))); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Due Amount")); ?></td>
                                <td class="text-danger">
                                <?php echo e(decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name))); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Late Payment Penalties")); ?></td>
                                <td><?php echo e($loan->late_payment_penalties); ?> %</td>
                            </tr>
                            <!--Custom Fields-->
                            <?php if(! $customFields->isEmpty()): ?>
                                <?php $customFieldsData = json_decode($loan->custom_fields, true); ?>
                                <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <td><?php echo e($customField->field_name); ?></td>
                                <td>
                                        <?php if($customField->field_type == 'file'): ?>
                                        <?php $file = $customFieldsData[$customField->field_name]['field_value'] ?? null; ?>
                                        <?php echo $file != null ? '<a href="'. asset('public/uploads/media/'.$file) .'" target="_blank" class="btn btn-xs btn-outline-primary"><i class="far fa-eye mr-2"></i>'._lang('Preview').'</a>' : ''; ?>

                                        <?php else: ?>
                                        <?php echo e($customFieldsData[$customField->field_name]['field_value'] ?? null); ?>

                                        <?php endif; ?>
                                </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <?php if($loan->status == 1): ?>
                            <tr>
                                <td><?php echo e(_lang("Disburse Method")); ?></td>
                                <td><?php echo e($loan->disburse_method == 'cash' ? ucwords($loan->disburse_method) : _lang('Transfer to Account')); ?></td>
                            </tr>

                            <?php if($loan->disburse_method == 'account'): ?>
                            <tr>
                                <td><?php echo e(_lang("Disburse Account Details")); ?></td>
                                <?php if($loan->disburseTransaction): ?>
                                <td><?php echo e($loan->disburseTransaction->account->account_number); ?> (<?php echo e($loan->disburseTransaction->account->savings_type->name); ?> - <?php echo e($loan->disburseTransaction->account->savings_type->currency->name); ?>)</td>
                                <?php else: ?>
                                <td><?php echo e(_lang("No Account Found")); ?></td>
                                <?php endif; ?>
                            </tr>
                            <?php endif; ?>

                            <tr>
                                <td><?php echo e(_lang("Approved Date")); ?></td>
                                <td><?php echo e($loan->approved_date); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Approved By")); ?></td>
                                <td><?php echo e($loan->approved_by->name); ?></td>
                            </tr>
                            <?php endif; ?>

                            <tr>
                                <td><?php echo e(_lang("Created By")); ?></td>
                                <td><?php echo e($loan->created_by->name); ?></td>
                            </tr>

                            <tr>
                                <td><?php echo e(_lang("Attachment")); ?></td>
                                <td>
                                <?php echo $loan->attachment == "" ? '' : '<a href="'. asset('public/uploads/media/'.$loan->attachment) .'" target="_blank">'._lang('Download').'</a>'; ?>

                                </td>
                            </tr>
                            
                            <tr>
                                <td><?php echo e(_lang("Description")); ?></td>
                                <td><?php echo e($loan->description); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang("Remarks")); ?></td>
                                <td><?php echo e($loan->remarks); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane fade mt-4" id="guarantor">
                        <div class="card">
                            <div class="card-header border d-flex align-items-center">
                                <span><?php echo e(_lang("Guarantors")); ?></span>
                                <a
                                class="btn btn-primary btn-xs ml-auto ajax-modal"
                                href="<?php echo e(route('guarantors.create')); ?>" data-title="<?php echo e(_lang('Add Guarantor')); ?>"
                                ><i class="ti-plus"></i>
                                <?php echo e(_lang("Add New")); ?></a
                                >
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="guarantors_table" class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th class="pl-4"><?php echo e(_lang('Loan ID')); ?></th>
                                                <th><?php echo e(_lang('Guarantor')); ?></th>
                                                <th><?php echo e(_lang('Amount')); ?></th>
                                                <th class="text-center"><?php echo e(_lang('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($guarantors->count() == 0): ?>
                                            <tr>
                                                <td colspan="4" class="text-center"><?php echo e(_lang('No Guarantor Found !')); ?></td>
                                            </tr>
                                            <?php endif; ?>

                                            <?php $__currentLoopData = $guarantors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guarantor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr data-id="row_<?php echo e($guarantor->id); ?>">
                                                <td class='pl-4 loan_id'><?php echo e($guarantor->loan->loan_id); ?></td>
                                                <td class='member_id'><?php echo e($guarantor->member->name); ?></td>
                                                <td class='amount'><?php echo e(decimalPlace($guarantor->amount, currency($loan->currency->name))); ?></td>
                                                <td class="text-center">
                                                <span class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?php echo e(_lang('Action')); ?>

                                                    </button>
                                                    <form action="<?php echo e(route('guarantors.destroy', $guarantor['id'])); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a href="<?php echo e(route('guarantors.edit', $guarantor['id'])); ?>" data-title="<?php echo e(_lang('Update Guarantor')); ?>" class="dropdown-item dropdown-edit ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
                                                            <button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;<?php echo e(_lang('Delete')); ?></button>
                                                        </div>
                                                    </form>
                                                </span>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php if($guarantors->count() > 0): ?>
                                            <tr>
                                                <td class="pl-4" colspan="2"><b><?php echo e(_lang('Grand Total')); ?></b></td>
                                                <td colspan="2"><b><?php echo e(decimalPlace($guarantors->sum('amount'), currency($loan->currency->name))); ?></b></td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade mt-4" id="collateral">
                        <div class="card">
                            <div class="card-header border d-flex align-items-center">
                                <span><?php echo e(_lang("All Collaterals")); ?></span>
                                <a
                                class="btn btn-primary btn-xs ml-auto"
                                href="<?php echo e(route('loan_collaterals.create',['loan_id' => $loan->id])); ?>"
                                ><i class="ti-plus"></i>
                                <?php echo e(_lang("New Collateral")); ?></a
                                >
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th class="pl-4"><?php echo e(_lang("Name")); ?></th>
                                                <th><?php echo e(_lang("Collateral Type")); ?></th>
                                                <th><?php echo e(_lang("Serial Number")); ?></th>
                                                <th><?php echo e(_lang("Estimated Price")); ?></th>
                                                <th class="text-center"><?php echo e(_lang("Action")); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($loancollaterals->count() == 0): ?>
                                            <tr>
                                                <td colspan="5" class="text-center"><?php echo e(_lang('No Collateral Found !')); ?></td>
                                            </tr>
                                            <?php endif; ?>

                                            <?php $__currentLoopData = $loancollaterals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loancollateral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr data-id="row_<?php echo e($loancollateral->id); ?>">
                                                <td class="pl-4 name"><?php echo e($loancollateral->name); ?></td>
                                                <td class="collateral_type">
                                                <?php echo e($loancollateral->collateral_type); ?>

                                                </td>
                                                <td class="serial_number">
                                                <?php echo e($loancollateral->serial_number); ?>

                                                </td>
                                                <td class="estimated_price">
                                                <?php echo e(decimalPlace($loancollateral->estimated_price, currency($loan->currency->name))); ?>

                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <?php echo e(_lang("Action")); ?>

                                                        </button>
                                                        <form action="<?php echo e(route('loan_collaterals.destroy', $loancollateral['id'])); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <input name="_method" type="hidden" value="DELETE"/>
                                                            <div
                                                                class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a href="<?php echo e(route('loan_collaterals.edit', $loancollateral['id'])); ?>"
                                                                class="dropdown-item dropdown-edit dropdown-edit"><i class="ti-pencil-alt"></i><?php echo e(_lang("Edit")); ?></a>
                                                                <a href="<?php echo e(route('loan_collaterals.show', $loancollateral['id'])); ?>"
                                                                class="dropdown-item dropdown-view dropdown-view"><i class="ti-eye"></i><?php echo e(_lang("View")); ?></a>
                                                                <button class="btn-remove dropdown-item" type="submit">
                                                                <i class="ti-trash"></i>
                                                                <?php echo e(_lang("Delete")); ?>

                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade mt-4" id="schedule">
                        <div class="report-header">
                            <h4><?php echo e(get_tenant_option('business_name', request()->tenant->name)); ?></h4>
                            <h5><?php echo e(_lang('Repayments Schedule')); ?></h5>
                            <p><?php echo e($loan->borrower->name); ?>, <?php echo e(_lang('Loan ID').': '.$loan->loan_id); ?></p>
                        </div>
                        <table class="table table-bordered report-table">
                            <thead>
                                <tr>
                                <th><?php echo e(_lang("Date")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Amount to Pay")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Principal Amount")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Interest")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Late Penalty")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Balance")); ?></th>
                                <th class="text-center"><?php echo e(_lang("Status")); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $repayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <td><?php echo e($repayment->repayment_date); ?></td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($repayment['amount_to_pay'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($repayment['principal_amount'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($repayment['interest'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($repayment['penalty'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($repayment['balance'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-center">
                                    <?php if($repayment['status'] == 0 && date('Y-m-d') > $repayment->getRawOriginal('repayment_date')): ?>
                                    <?php echo xss_clean(show_status(_lang('Due'),'danger')); ?>

                                    <?php elseif($repayment['status'] == 0 && date('Y-m-d') <= $repayment->getRawOriginal('repayment_date')): ?>
                                    <?php echo xss_clean(show_status(_lang('Unpaid'),'warning')); ?>

                                    <?php else: ?>
                                    <?php echo xss_clean(show_status(_lang('Paid'),'success')); ?>

                                    <?php endif; ?>
                                </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade mt-4" id="repayments">
                        <div class="report-header">
                            <h4><?php echo e(get_tenant_option('business_name', request()->tenant->name)); ?></h4>
                            <h5><?php echo e(_lang('Loan Payments')); ?></h5>
                            <p><?php echo e($loan->borrower->name); ?>, <?php echo e(_lang('Loan ID').': '.$loan->loan_id); ?></p>
                        </div>
                        <table class="table table-bordered report-table" id="repayments-table">
                            <thead>
                                <tr>
                                <th><?php echo e(_lang("Date")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Principal Amount")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Interest")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Late Penalty")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Total Amount")); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <td><?php echo e($payment->paid_at); ?></td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($payment['repayment_amount'] - $payment['interest'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($payment['interest'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($payment['late_penalties'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($payment['total_amount'], currency($loan->currency->name))); ?>

                                </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js-script'); ?>
<script>
   (function($) {
       "use strict";
   
   	$('.nav-tabs a').on('shown.bs.tab', function(event){
   		var tab = $(event.target).attr("href");
   		var url = "<?php echo e(route('loans.show',$loan->id)); ?>";
   	    history.pushState({}, null, url + "?tab=" + tab.substring(1));
   	});
   
   	<?php if(isset($_GET['tab'])): ?>
   	   $('.nav-tabs a[href="#<?php echo e($_GET['tab']); ?>"]').tab('show');
   	<?php endif; ?>
   
   })(jQuery);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/loan/view.blade.php ENDPATH**/ ?>