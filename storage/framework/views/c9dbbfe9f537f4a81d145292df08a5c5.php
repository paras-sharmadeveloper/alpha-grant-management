

<?php $__env->startSection('content'); ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <span class="panel-title"><?php echo e(_lang('Loan Details')); ?></span>
        </div>

        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#loan_details"><?php echo e(_lang('Loan Details')); ?></a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#schedule"><?php echo e(_lang('Repayments Schedule')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#repayments"><?php echo e(_lang('Repayments')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#documents"><?php echo e(_lang('Documents')); ?></a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="loan_details">
                    <table class="table table-bordered mt-4">
                        <tr><td><?php echo e(_lang('Loan ID')); ?></td><td><?php echo e($loan->loan_id); ?></td></tr>
                        <tr><td><?php echo e(_lang('Borrower')); ?></td><td><?php echo e($loan->borrower->name); ?></td></tr>
                        <tr><td><?php echo e(_lang('Currency')); ?></td><td><?php echo e($loan->currency->name); ?></td></tr>
                        <tr>
                            <td><?php echo e(_lang('Status')); ?></td>
                            <td>
                                <?php echo $loan->status == 0 ? xss_clean(show_status(_lang('Pending'), 'warning')) : xss_clean(show_status(_lang('Approved'), 'success')); ?>

                            </td>
                        </tr>
                        
                        <tr>
                            <td><?php echo e(_lang('Release Date')); ?></td>
                            <td><?php echo e($loan->release_date); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(_lang('Applied Amount')); ?></td>
                            <td><?php echo e(decimalPlace($loan->applied_amount, currency($loan->currency->name))); ?></td>
                        </tr>
                        
                        <tr><td><?php echo e(_lang('Late Payment Penalties')); ?></td><td><?php echo e($loan->late_payment_penalties); ?> %</td></tr>
                        <!--Custom Fields-->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $customFields->isEmpty()): ?>
                            <?php $customFieldsData = json_decode($loan->custom_fields, true); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr>
                            <td><?php echo e($customField->field_name); ?></td>
                            <td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customField->field_type == 'file'): ?>
                                    <?php $file = $customFieldsData[$customField->field_name]['field_value'] ?? null; ?>
                                    <?php echo $file != null ? '<a href="'. asset('public/uploads/media/'.$file) .'" target="_blank" class="btn btn-xs btn-outline-primary"><i class="far fa-eye mr-2"></i>'._lang('Preview').'</a>' : ''; ?>

                                    <?php else: ?>
                                    <?php echo e($customFieldsData[$customField->field_name]['field_value'] ?? null); ?>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->status == 1): ?>
                            <tr>
                                <td><?php echo e(_lang('Approved Date')); ?></td>
                                <td><?php echo e($loan->approved_date); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo e(_lang('Loan Officer Name')); ?></td>
                                <td><?php echo e($loan->approved_by->name); ?></td>
                            </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <tr><td><?php echo e(_lang('Description')); ?></td><td><?php echo e($loan->description); ?></td></tr>
                        <tr><td><?php echo e(_lang('Remarks')); ?></td><td><?php echo e($loan->remarks); ?></td></tr>
                    </table>
                </div>

                <div class="tab-pane fade mt-4" id="guarantor">
                    <div class="table-responsive">
                        <table id="guarantors_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?php echo e(_lang('Loan ID')); ?></th>
                                    <th><?php echo e(_lang('Guarantor')); ?></th>
                                    <th><?php echo e(_lang('Amount')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->guarantors->count() == 0): ?>
                                <tr>
                                    <td colspan="3" class="text-center"><?php echo e(_lang('No Guarantor Found !')); ?></td>
                                </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loan->guarantors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guarantor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr data-id="row_<?php echo e($guarantor->id); ?>">
                                    <td class='loan_id'><?php echo e($guarantor->loan->loan_id); ?></td>
                                    <td class='member_id'><?php echo e($guarantor->member->name); ?></td>
                                    <td class='amount'><?php echo e(decimalPlace($guarantor->amount, currency($loan->currency->name))); ?></td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loan->guarantors->count() > 0): ?>
                                <tr>
                                    <td colspan="2"><?php echo e(_lang('Grand Total')); ?></td>
                                    <td colspan="2"><b><?php echo e(decimalPlace($loan->guarantors->sum('amount'), currency($loan->currency->name))); ?></b></td>
                                </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade mt-4" id="collateral">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(_lang('Name')); ?></th>
                                    <th><?php echo e(_lang('Collateral Type')); ?></th>
                                    <th><?php echo e(_lang('Serial Number')); ?></th>
                                    <th><?php echo e(_lang('Estimated Price')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loan->collaterals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loancollateral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr data-id="row_<?php echo e($loancollateral->id); ?>">
                                    <td class='name'><?php echo e($loancollateral->name); ?></td>
                                    <td class='collateral_type'><?php echo e($loancollateral->collateral_type); ?></td>
                                    <td class='serial_number'><?php echo e($loancollateral->serial_number); ?></td>
                                    <td class='estimated_price'><?php echo e($loancollateral->estimated_price); ?></td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
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
                                <th class="text-right"><?php echo e(_lang("Late Penalty")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Principal Amount")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Interest")); ?></th>
                                <th class="text-right"><?php echo e(_lang("Balance")); ?></th>
                                <th class="text-center"><?php echo e(_lang("Status")); ?></th>
                                <th class="text-center"><?php echo e(_lang("Action")); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loan->repayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr>
                                <td><?php echo e($repayment->repayment_date); ?></td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($repayment['amount_to_pay'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($repayment['penalty'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($repayment['principal_amount'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($repayment['interest'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-right">
                                    <?php echo e(decimalPlace($repayment['balance'], currency($loan->currency->name))); ?>

                                </td>
                                <td class="text-center">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($repayment['status'] == 0 && date('Y-m-d') > $repayment->getRawOriginal('repayment_date')): ?>
                                        <?php echo xss_clean(show_status(_lang('Due'),'danger')); ?>

                                    <?php elseif($repayment['status'] == 0 && date('Y-m-d') <= $repayment->getRawOriginal('repayment_date')): ?>
                                        <?php echo xss_clean(show_status(_lang('Unpaid'),'warning')); ?>

                                    <?php else: ?>
                                        <?php echo xss_clean(show_status(_lang('Paid'),'success')); ?>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($repayment['status'] == 0 && $loan->next_payment->id == $repayment->id): ?>
                                        <a href="<?php echo e(route('loans.stripe_payment', $repayment->loan_id)); ?>" class="btn btn-primary btn-xs"><?php echo e(_lang('Pay Now')); ?></a>
                                    <?php elseif($repayment['status'] == 0 && date('Y-m-d') > $repayment->repayment_date): ?>
                                        <span class="btn btn-secondary btn-xs disabled"><?php echo e(_lang('No Action')); ?></span>
                                    <?php else: ?>
                                        <span class="btn btn-success btn-xs px-4 disabled"><?php echo e(_lang('Paid')); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade mt-4" id="repayments">
                    <div class="report-header">
                        <h4><?php echo e(get_tenant_option('business_name', request()->tenant->name)); ?></h4>
                        <h5><?php echo e(_lang('Loan Payments')); ?></h5>
                        <p><?php echo e($loan->borrower->name); ?>, <?php echo e(_lang('Loan ID').': '.$loan->loan_id); ?></p>
                    </div>
                    <table class="table table-bordered report-table">
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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loan->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade mt-4" id="documents">
    
                        <div class="report-header">
                            <h5><?php echo e(_lang('Loan Documents')); ?></h5>
                            <p><?php echo e($loan->borrower->name); ?>, <?php echo e(_lang('Loan ID').': '.$loan->loan_id); ?></p>
                        </div>

                        <table class="table table-bordered report-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(_lang("Document Name")); ?></th>
                                    <th><?php echo e(_lang("Document Type")); ?></th>
                                    <th><?php echo e(_lang("Uploaded Date")); ?></th>
                                    <th class="text-center"><?php echo e(_lang("File")); ?></th>
                                    <th class="text-center"><?php echo e(_lang("Action")); ?></th>
                                </tr>
                            </thead>

                            <tbody>

                               <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($loan->documents)): ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loan->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr>
                                        <td><?php echo e($document->name); ?></td>
                                        <td><?php echo e($document->type); ?></td>
                                        <td><?php echo e($document->created_at); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(asset('uploads/documents/'.$document->file)); ?>" target="_blank" class="btn btn-primary btn-sm">
                                                <?php echo e(_lang('View')); ?>

                                            </a>
                                        </td>
                                    </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                                <?php else: ?>
                                <tr>
                                    <td colspan="5">
                                        <p class="text-center"><?php echo e(_lang('No Documents Available')); ?></p>
                                    </td>
                                </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </tbody>
                        </table>

                </div>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/customer/loan/loan_details.blade.php ENDPATH**/ ?>