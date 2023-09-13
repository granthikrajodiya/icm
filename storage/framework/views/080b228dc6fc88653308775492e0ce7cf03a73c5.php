<?php if (isset($component)) { $__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a = $component; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Layouts\App::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Dashboard')).'','header' => ''.e(Utility::getSalutation().' '.user()->name.'!').'']); ?>
    <?php if(!is_array($responseArr['top']) && !is_array($responseArr['middle']) && !is_array($responseArr['bottom'])): ?>
        <?php if($responseArr['top']->count() > 0 || $responseArr['middle']->count() > 0 || $responseArr['bottom']->count() > 0): ?>
            <?php if($responseArr['layout_type'] == 1): ?>
                <?php echo $__env->make('admin.fixed_layout',['layouts'=>$responseArr], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('admin.dynamic_layout',['layouts'=>$responseArr], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

        <?php endif; ?>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a)): ?>
<?php $component = $__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a; ?>
<?php unset($__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/code /resources/views/admin/dashboard.blade.php ENDPATH**/ ?>