

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card no-export">
            <div class="card-header d-flex align-items-center">
                <span class="panel-title"><?php echo e(_lang('Documents')); ?></span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="documents_table" class="table data-table">
                        <thead>
                            <tr>
                                <th><?php echo e(_lang('Member ID')); ?></th>
                                <th><?php echo e(_lang('Member Name')); ?></th>
                                <th><?php echo e(_lang('Document Name')); ?></th>
                                <th><?php echo e(_lang('Document')); ?></th>
                                <th><?php echo e(_lang('Uploaded At')); ?></th>
                                <th class="text-center"><?php echo e(_lang('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $memberdocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr data-id="row_<?php echo e($doc->id); ?>">
                                <td><?php echo e($doc->member->member_no ?? '-'); ?></td>
                                <td>
                                    <a href="<?php echo e(route('members.show', $doc->member_id)); ?>">
                                        <?php echo e($doc->member->first_name ?? ''); ?> <?php echo e($doc->member->last_name ?? ''); ?>

                                    </a>
                                </td>
                                <td><?php echo e($doc->name); ?></td>
                                <td>
                                    <a target="_blank" href="<?php echo e(asset('public/uploads/documents/' . $doc->document)); ?>">
                                        <i class="ti-file"></i> <?php echo e($doc->document); ?>

                                    </a>
                                </td>
                                <td><?php echo e($doc->created_at); ?></td>
                                <td class="text-center">
                                    <span class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">
                                            <?php echo e(_lang('Action')); ?>

                                        </button>
                                        <form action="<?php echo e(route('member_documents.destroy', $doc->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <input name="_method" type="hidden" value="DELETE">
                                            <div class="dropdown-menu">
                                                <a href="<?php echo e(route('member_documents.edit', $doc->id)); ?>" data-title="<?php echo e(_lang('Update Document')); ?>" class="dropdown-item ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;<?php echo e(_lang('Edit')); ?></a>
                                                <button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;<?php echo e(_lang('Delete')); ?></button>
                                            </div>
                                        </form>
                                    </span>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\alpha-grant-management\resources\views/backend/admin/member_documents/all.blade.php ENDPATH**/ ?>