<?php $__env->startPush('css'); ?>
    
    <style>
        .form-builder-dialog{
            z-index: 9999999 !important;
        }

        .form-wrap.form-builder .frmb{
            min-height: 602px !important;
        }
    </style>

<?php $__env->stopPush(); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header actions-toolbar border-0">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="mb-0"><?php echo e(__('Quick Apps')); ?></h6>
                        </div>
                        <div class="col text-right">
                            <div class="actions">
                                <a href="#" data-url="<?php echo e(route('qapp.create', tenant('tenant_id'))); ?>" data-size="md" data-ajax-popup="true"
                                    data-title="<?php echo e(__('New Quick App')); ?>" class="action-item"><i class="fas fa-plus"></i><span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0 px-1 pb-3">
                    <div class="table-responsive" id="">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Online')); ?></th>
                                    <th><?php echo e(__('Description')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $qapps = \Engage\Ilinxengage_qapp\Models\QappDefinition::where('tenant_id', \Auth::user()->tenant_id)->get();
                                ?>
                                <?php $__currentLoopData = $qapps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qapp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($qapp->name); ?></td>
                                        <td>
                                            <?php if($qapp->online == 1): ?>
                                                <i class="fas fa-check text-success"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($qapp->description); ?></td>
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="action-item px-2" data-url="<?php echo e(route('qapp.edit', [tenant('tenant_id'), $qapp->id])); ?>"
                                                    data-ajax-popup="true" data-size="xl"
                                                    data-title="<?php echo e(__('Edit Quick App')); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="action-item text-danger px-2"
                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="document.getElementById('delete-faq-<?php echo e($qapp->id); ?>').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['qapp.destroy', [tenant('tenant_id'), $qapp->id]],
                                                'id' => 'delete-faq-' . $qapp->id,
                                            ]); ?>

                                            <?php echo Form::close(); ?>

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
<?php $__env->startPush('script'); ?>
    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/ILINXEngage/packages/engage/ilinxengage_qapp/src/resources/views/index.blade.php ENDPATH**/ ?>