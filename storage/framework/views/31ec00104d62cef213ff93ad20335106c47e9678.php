<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'label' => null,
    'labeless' => false,
    'help' => null,
    'noError' => false,
    'caption' => null,
    'id' => null,
    'containerClass' => null,
    'checked' => false,
    'name',
    'value' => null,
    'disabled' => false,
    'error' => '',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'label' => null,
    'labeless' => false,
    'help' => null,
    'noError' => false,
    'caption' => null,
    'id' => null,
    'containerClass' => null,
    'checked' => false,
    'name',
    'value' => null,
    'disabled' => false,
    'error' => '',
]); ?>
<?php foreach (array_filter(([
    'label' => null,
    'labeless' => false,
    'help' => null,
    'noError' => false,
    'caption' => null,
    'id' => null,
    'containerClass' => null,
    'checked' => false,
    'name',
    'value' => null,
    'disabled' => false,
    'error' => '',
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
if (!$label) {
    $label = __(Str::replace('_', ' ', Str::title(Str::snake($name))));
}
$checked = $checked ?? old($name, $current ?? null) == $value;
?>

<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['wrap' => false,'label' => $label,'labeless' => true,'help' => $help,'noError' => $noError,'id' => 'checkbox_input_area_'.$id,'name' => 'checkbox_input_area_'.$name,'caption' => $caption,'containerClass' => $containerClass]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wrap' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'labeless' => true,'help' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($help),'no-error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($noError),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('checkbox_input_area_'.$id),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('checkbox_input_area_'.$name),'caption' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($caption),'container-class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($containerClass)]); ?>
    <div class="row custom-control custom-switch">
        <input type="checkbox" name="<?php echo e($name); ?>" id="<?php echo e($id); ?>" class="custom-control-input col-xs-12 col-sm-12 col-md-6 col-lg-6"
            value="<?php echo e($value); ?>" <?php if($disabled): ?> disabled <?php endif; ?> <?php if($checked): ?> checked <?php endif; ?>>
        <?php if (! ($labeless)): ?>
            <label class="custom-control-label form-control-label" for="<?php echo e($id); ?>">
                <?php echo e($label); ?>

            </label>
        <?php endif; ?>

        <?php if($noError): ?>
            <small class="form-text text-muted mb-2 mt-0 font-italic">
                <?php echo e($error); ?>

            </small>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/ILINXEngage/resources/views/components/input/checkbox.blade.php ENDPATH**/ ?>