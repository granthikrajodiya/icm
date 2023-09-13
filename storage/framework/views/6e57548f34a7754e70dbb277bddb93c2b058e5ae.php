<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'id' => null,
    'class' => null
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'id' => null,
    'class' => null
]); ?>
<?php foreach (array_filter(([
    'id' => null,
    'class' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<button type="<?php echo e($type); ?>" <?php echo e($attributes->class($class)); ?> id="<?php echo e($id); ?>">
    <?php echo e($slot); ?>

</button>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/code /resources/views/components/button.blade.php ENDPATH**/ ?>