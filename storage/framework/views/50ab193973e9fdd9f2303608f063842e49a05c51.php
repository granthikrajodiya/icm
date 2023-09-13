<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'size' => null,
    'sm' => null,
    'xs' => null,
    'md' => null,
    'lg' => null,
    'info' => null,
    'warning' => null,
    'danger' => null,
    'success' => null,
    'secondary' => null,
    'primary' => null,
    'color' => null,
    'id' => null,
    'label' => null,
    'labeless' => false,
    'current' => null,
    'name',
    'value'
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'size' => null,
    'sm' => null,
    'xs' => null,
    'md' => null,
    'lg' => null,
    'info' => null,
    'warning' => null,
    'danger' => null,
    'success' => null,
    'secondary' => null,
    'primary' => null,
    'color' => null,
    'id' => null,
    'label' => null,
    'labeless' => false,
    'current' => null,
    'name',
    'value'
]); ?>
<?php foreach (array_filter(([
    'size' => null,
    'sm' => null,
    'xs' => null,
    'md' => null,
    'lg' => null,
    'info' => null,
    'warning' => null,
    'danger' => null,
    'success' => null,
    'secondary' => null,
    'primary' => null,
    'color' => null,
    'id' => null,
    'label' => null,
    'labeless' => false,
    'current' => null,
    'name',
    'value'
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
        $label = __(Str::replace('_', ' ',  Str::title(Str::snake($name))));
    }
    $checked = old($name, $current ?? null) == $value;

    $size = $size ?? 'md';
    if ($xs) $size = 'xs';
    if ($sm) $size = 'sm';
    if ($lg) $size = 'lg';

    $color = $color ?? 'primary';
    if ($info) $color = 'info';
    if ($warning) $color = 'warning';
    if ($danger) $color = 'danger';
    if ($success) $color = 'success';
    if ($secondary) $color = 'secondary';
    if ($primary) $color = 'primary';
?>

<label <?php echo e($attributes->class([
    'btn',
    'active' => $checked,

    // sizes
    'btn-xs' => $size === 'xs',
    'btn-sm' => $size === 'sm',
    'btn-lg' => $size === 'lg',

    // colors
    'btn-info' => $color === 'info',
    'btn-warning' => $color === 'warning',
    'btn-danger' => $color === 'danger',
    'btn-success' => $color === 'success',
    'btn-secondary' => $color === 'secondary',
    'btn-primary' => $color === 'primary',
])); ?>>
    <input type="radio" name="<?php echo e($name); ?>" id="<?php echo e($id); ?>" value="<?php echo e($value); ?>" <?php if($checked): ?> checked <?php endif; ?>>
    <?php if (! ($labeless)): ?>
        <?php echo e($label); ?>

    <?php endif; ?>
</label>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/code /resources/views/components/input/toggle.blade.php ENDPATH**/ ?>