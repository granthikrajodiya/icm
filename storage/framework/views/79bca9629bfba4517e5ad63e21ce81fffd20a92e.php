<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'wrap' => true,
    'label' => null,
    'labeless' => false,
    'help' => null,
    'noError' => false,
    'caption' => null,
    'id' => null,
    'containerClass' => null,
    'labelClass' => null,
    'rows' => 2,
    'name',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'wrap' => true,
    'label' => null,
    'labeless' => false,
    'help' => null,
    'noError' => false,
    'caption' => null,
    'id' => null,
    'containerClass' => null,
    'labelClass' => null,
    'rows' => 2,
    'name',
]); ?>
<?php foreach (array_filter(([
    'wrap' => true,
    'label' => null,
    'labeless' => false,
    'help' => null,
    'noError' => false,
    'caption' => null,
    'id' => null,
    'containerClass' => null,
    'labelClass' => null,
    'rows' => 2,
    'name',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $id ??= $name;
    $value = old($name, $slot ?? null);
?>

<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['wrap' => $wrap,'label' => $label,'labeless' => $labeless,'help' => $help,'noError' => $noError,'id' => $id,'name' => $name,'caption' => $caption,'containerClass' => $containerClass,'labelClass' => $labelClass]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wrap' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($wrap),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'labeless' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labeless),'help' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($help),'no-error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($noError),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($id),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($name),'caption' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($caption),'container-class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($containerClass),'label-class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labelClass)]); ?>
    <textarea name="<?php echo e($name); ?>" id="<?php echo e($id); ?>" <?php if($rows): ?> rows="<?php echo e($rows); ?>" <?php endif; ?> <?php echo e($attributes->class([ 'form-control', 'is-invalid' => !empty($errors) ? $errors->has($name) : "", ])); ?>><?php echo e($value); ?></textarea>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/code /resources/views/components/input/textarea.blade.php ENDPATH**/ ?>