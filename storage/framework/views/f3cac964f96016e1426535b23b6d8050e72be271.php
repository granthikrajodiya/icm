<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'title' => 'ImageSource'
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'title' => 'ImageSource'
]); ?>
<?php foreach (array_filter(([
    'title' => 'ImageSource'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<!doctype html>
<html lang="<?php echo e(Str::replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' *.googleapis.com *.gstatic.com; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' *.googleapis.com *.gstatic.com; font-src 'self' 'unsafe-inline' data: *.googleapis.com *.gstatic.com; img-src 'self' 'unsafe-inline' data:">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title); ?> &dash; <?php echo e(config('app.name', 'ILINXEngage')); ?></title>
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <link rel="icon" href="<?php echo e(tenant()?->fav_icon_path); ?>" type="image/png">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/'.Utility::getSiteContent('default_theme').'.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/jqueryscripttop.css')); ?>"  type="text/css">
    <?php if(Utility::getSiteContent('banner_type') == 'image' && !empty(tenant()?->banner_path)): ?>
        <style>
            .application-offset .container-application:before {
                background: url('<?php echo e(tenant()?->banner_path); ?>') !important;
            }
        </style>
    <?php endif; ?>
</head>
<body class="application application-offset">
<div id="app">
    <div class="container-fluid container-application">
        <div class="main-content position-relative">
            <div class="page-content">
                <div class="py-5 d-flex align-items-center">
                    <div class="w-100">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="text-center pb-2 <?php echo e(!is_null(tenant('small_logo')) ? '': 'pt-5'); ?>">
                                    <img src="<?php echo e(tenant()?->logo_path); ?>" class="auth-logo">
                                </div>
                                <?php if(!is_null(tenant('small_logo'))): ?>
                                <div class="text-center pb-2">
                                    <img src="<?php echo e(!is_null(tenant('small_logo')) ? asset(\Storage::url(tenant('small_logo'))) : ''); ?>" class="small_logo" />
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="min-vh-100 align-items-center pt-4">
                    <div class="w-100">
                        <div class="row justify-content-center">
                            <?php echo e($slot); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('assets/js/site.core.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/site.js')); ?>"></script>
<?php echo $__env->yieldPushContent('script'); ?>


</body>
</html>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/code /resources/views/components/layouts/auth.blade.php ENDPATH**/ ?>