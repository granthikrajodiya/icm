<?php if($users->count() > 0): ?>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($user->name); ?></td>
            <td><?php echo e($user->email); ?></td>
            <?php if(user()->account_type == 4): ?>
                <td><?php if(tenant('primary_contact') == $user->id): ?><i class="fas fa-check text-success"></i><?php endif; ?></td>
            <?php endif; ?>
            <td><?php echo e($user->account_type_name ?? '-'); ?></td>
            <td><?php echo e(ucfirst($user->account_status)); ?></td>
            <td>
                <div class="actions">
                    <a href="#" class="action-item px-2"
                       data-url="<?php echo e(route('user.edit',[tenant('tenant_id'), $user])); ?>" data-ajax-popup="true"
                       data-size="xl" data-title="<?php echo e(__('Edit User')); ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <tr class="text-center">
        <td colspan="5"><h6><?php echo e(__('No data found.')); ?></h6></td>
    </tr>
<?php endif; ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/ILINXEngage/resources/views/users/list.blade.php ENDPATH**/ ?>