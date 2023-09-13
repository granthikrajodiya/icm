<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['action' => null, 'put' => false, 'get' => false, 'patch' => false, 'delete' => false, 'upload' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['action' => null, 'put' => false, 'get' => false, 'patch' => false, 'delete' => false, 'upload' => false]); ?>
<?php foreach (array_filter((['action' => null, 'put' => false, 'get' => false, 'patch' => false, 'delete' => false, 'upload' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $method = isset($method) ? 'GET' : 'POST';
?>

<form <?php echo e($attributes); ?> method="<?php echo e($method); ?>"
      <?php if($action): ?> action="<?php echo e($action); ?>" <?php endif; ?>
      <?php if($upload): ?> enctype="multipart/form-data" <?php endif; ?>>
    <?php if($method === 'POST'): ?>
        <?php echo csrf_field(); ?>
    <?php endif; ?>

    <?php if($put): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <?php if($patch): ?>
        <?php echo method_field('PATCH'); ?>
    <?php endif; ?>

    <?php if($delete): ?>
        <?php echo method_field('DELETE'); ?>
    <?php endif; ?>

    <?php echo e($slot); ?>

</form>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/code /resources/views/components/form.blade.php ENDPATH**/ ?>