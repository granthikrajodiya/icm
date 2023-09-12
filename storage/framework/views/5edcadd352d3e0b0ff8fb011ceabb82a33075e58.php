<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'wrap' => true,
    'label',
    'labeless' => '',
    'noError' => false,
    'id',
    'caption',
    'containerClass' => null,
    'labelClass' =>'',
    'name',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'wrap' => true,
    'label',
    'labeless' => '',
    'noError' => false,
    'id',
    'caption',
    'containerClass' => null,
    'labelClass' =>'',
    'name',
]); ?>
<?php foreach (array_filter(([
    'wrap' => true,
    'label',
    'labeless' => '',
    'noError' => false,
    'id',
    'caption',
    'containerClass' => null,
    'labelClass' =>'',
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
    if (!$label) {
        $label = __(Str::replace('_', ' ',  Str::title(Str::snake($name))));
    }
?>

<?php if($wrap): ?> <div <?php echo e($attributes->class([
    'form-group',
    'col-12' => !\Illuminate\Support\Str::contains($containerClass, 'col-')
])->merge(['class' => $containerClass])); ?>> <?php endif; ?>
    <?php if (! ($labeless)): ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => $id,'class' => $labelClass]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($id),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labelClass)]); ?>
            <?php echo e($label); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php endif; ?>
    <?php if(isset($help)): ?>
        <small class="font-weight-bold">
            <?php echo e(__($help)); ?>

        </small>
    <?php endif; ?>

    <?php echo e($slot); ?>


    <?php if($caption): ?>
        <small class="form-text text-muted mb-2 mt-0">
            <?php echo e($caption); ?>

        </small>
    <?php endif; ?>

    <?php if (! ($noError)): ?>
        <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div id="<?php echo e($id); ?>" class="invalid-feedback">
                <?php echo e($message); ?>

            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php endif; ?>
<?php if($wrap): ?> </div> <?php endif; ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/ILINXEngage/resources/views/components/input.blade.php ENDPATH**/ ?>