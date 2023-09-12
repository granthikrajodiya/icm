<?php($usrData = \Session::get('userInfo')) ?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'title'        => 'ImageSource',
    'header'       => null,
    'actionButton' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'title'        => 'ImageSource',
    'header'       => null,
    'actionButton' => null,
]); ?>
<?php foreach (array_filter(([
    'title'        => 'ImageSource',
    'header'       => null,
    'actionButton' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if(!isset($header)): ?>
	<?php
		$header = $title;
	?>
<?php endif; ?>

<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title
            data-dash="<?php echo e(Utility::getSiteContent('header_text') ? Utility::getSiteContent('header_text') : config('app.name')); ?>"
            id="title_text"><?php echo e($title); ?> &dash;
            <?php echo e(Utility::getSiteContent('header_text') ? Utility::getSiteContent('header_text') : config('app.name')); ?>

        </title>
        <link rel="icon" href="<?php echo e(asset(\Storage::url('logo/favicon.ico?v=2'))); ?>" type="image/png">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <link rel="stylesheet" href="<?php echo e(asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/libs/animate.css/animate.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/' . Utility::getSiteContent('default_theme') . '.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/datatables.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/jqueryscripttop.css')); ?>"  type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/daterangepicker/daterangepicker.css')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/jquery/dist/jquery-ui.min.css')); ?>"/>
        <?php echo $__env->yieldPushContent('css'); ?>

        <style>
            .welcome-message {
                padding-left: 20px;
            }
        </style>

        <?php if(Utility::getSiteContent('banner_type') == 'image' && !empty(tenant()?->banner_path)): ?>
            <style>
                .application-offset .container-application:before {
                    background: url("<?php echo e(tenant()?->banner_path); ?>") !important;
                }
                @media (max-width: 767.98px) {
                    .application .sidenav.show:before {
                        background: url("<?php echo e(tenant()?->banner_path); ?>") !important;
                    }
                }

            </style>
        <?php endif; ?>
    </head>

    <body class="application application-offset">
        <div class="main-nav-container">
            <div class="nav-flex-container">
                <div class="sidenav-header align-items-center">
                    <a class="navbar-brand" href="<?php echo e(route('home',tenant('tenant_id'))); ?>">
                        <img src="<?php echo e(tenant()?->logo_path); ?>" class="navbar-brand-img" alt="...">
                    </a>
                    <div class="ml-auto">
                        <!-- Sidenav toggler -->
                        <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin"
                             data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (isset($component)) { $__componentOriginal0dec19eaffc45c80312d8711c964ba9f5372541b = $component; } ?>
<?php $component = App\View\Components\Layouts\Partials\Navbar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layouts.partials.navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Layouts\Partials\Navbar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['header' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($header),'actionButton' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionButton)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0dec19eaffc45c80312d8711c964ba9f5372541b)): ?>
<?php $component = $__componentOriginal0dec19eaffc45c80312d8711c964ba9f5372541b; ?>
<?php unset($__componentOriginal0dec19eaffc45c80312d8711c964ba9f5372541b); ?>
<?php endif; ?>
            </div>
        </div>
        <div class="container-fluid container-application">
            <div class="sidenav pb-2" id="sidenav-main">
                <?php if (isset($component)) { $__componentOriginal44ec645cc864dcaae355fc45d4a32bbdcb8903da = $component; } ?>
<?php $component = App\View\Components\Layouts\Partials\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layouts.partials.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Layouts\Partials\Sidebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44ec645cc864dcaae355fc45d4a32bbdcb8903da)): ?>
<?php $component = $__componentOriginal44ec645cc864dcaae355fc45d4a32bbdcb8903da; ?>
<?php unset($__componentOriginal44ec645cc864dcaae355fc45d4a32bbdcb8903da); ?>
<?php endif; ?>
            </div>
            <div class="main-content position-relative">
                <div class="page-content min-750 pt-6">
                    <?php echo e($slot); ?>

                </div>
            </div>
        </div>

        
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer pt-5 pb-4 footer-light" id="footer-main">
                        <div class="row text-center text-sm-left align-items-sm-center">
                            <div class="col-sm-6">
                                <p class="text-sm mb-0"><?php echo e(Utility::getValByName('footer_text')); ?></p>
                            </div>
                            <div class="col-sm-6 mb-md-0">
                                <ul class="nav justify-content-center justify-content-md-end">
                                    <li class="nav-item dropdown border-right">
                                        <a class="nav-link" href="#" role="button" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                        <span class="h6 text-sm mb-0"><i class="fas fa-globe-asia"></i>
                                            <?php echo e(Str::upper(user()->lang)); ?></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <?php $__currentLoopData = Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('lang.change', [tenant('tenant_id'), $lang])); ?>"
                                                   class="dropdown-item
                                                   <?php echo e(basename(App::getLocale()) == $lang ? 'active' : ''); ?> "
                                                >
                                                    <?php echo e(Str::upper($lang)); ?>

                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" target="_blank"
                                           href="<?php echo e(Utility::getValByName('footer_value_1')); ?>"><?php echo e(Utility::getValByName('footer_link_1')); ?>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" target="_blank"
                                           href="<?php echo e(Utility::getValByName('footer_value_2')); ?>"><?php echo e(Utility::getValByName('footer_link_2')); ?>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" target="_blank"
                                           href="<?php echo e(Utility::getValByName('footer_value_3')); ?>"><?php echo e(Utility::getValByName('footer_link_3')); ?>

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="modal fade" tabindex="-1" role="dialog" id="commonModal" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        

        
        <div class="modal fade" tabindex="-1" role="dialog" id="commonModal2" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        

        
        <div class="modal fade modal-color" tabindex="-1" role="dialog" id="commonModal3" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        

        <?php if(\Session::get('first_time') == true): ?>
            <div class="modal fade" tabindex="-1" role="dialog" id="freshModal">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <iframe src="<?php echo e(route('first.time', tenant('tenant_id'))); ?>"
                                            style="height: 512px;width: 100%"></iframe>
                                </div>
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-sm btn-secondary rounded-pill"
                                            data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </body>

    <!-- Scripts -->

    <script src="<?php echo e(asset('assets/js/site.core.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/moment/min/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/moment/min/moment-timezone-with-data.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/progressbar.js/dist/progressbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/autosize/dist/autosize.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.repeater.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/jquery/dist/jquery-ui.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/libs/daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/site.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/letter.avatar.js')); ?>"></script>


    <script>
        var tableLangData = {
            "lengthMenu": "<?php echo e(__('Show')); ?> _MENU_ <?php echo e(__('entries')); ?>",
            "zeroRecords": "<?php echo e(__('No data found.')); ?>",
            "info": "<?php echo e(__('Showing page')); ?> _PAGE_ <?php echo e(__('of')); ?> _PAGES_",
            "infoEmpty": "<?php echo e(__('No page available')); ?>",
            "infoFiltered": "(<?php echo e(__('filtered from')); ?> _MAX_ <?php echo e(__('total records')); ?>)",
            "paginate": {
                "previous": "<?php echo e(__('Previous')); ?>",
                "next": "<?php echo e(__('Next')); ?>",
                "last": "<?php echo e(__('Last')); ?>"
            }
        };
        var tableDom = '<"float-left"B><"float-right"f>rt<<l><p>>';
    </script>
    <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            if ($('.dataTable').length > 0) {
                $(".dataTable").DataTable({
                    "aaSorting": [],
                    language: tableLangData,
                });

                var spanSorting = '<span class="arrow-hack sort">&nbsp;&nbsp;&nbsp;</span>';
                var spanAsc = '<span class="arrow-hack asc">&nbsp;&nbsp;&nbsp;</span>';
                var spanDesc = '<span class="arrow-hack desc">&nbsp;&nbsp;&nbsp;</span>';

                $(".dataTable").on('click', 'th', function() {
                    $(".dataTable thead th").each(function(i, th) {
                        $(th).find('.arrow-hack').remove();
                        var html = $(th).html(),
                            cls = $(th).attr('class');

                        if(cls.includes('sorting_asc')){
                            $(th).html(html+spanAsc);
                        }else if(cls.includes('sorting_desc')){
                            $(th).html(html+spanDesc);
                        }else if(cls.includes('sorting_disabled')){
                            $(th).html(html);
                        }else{
                            $(th).html(html+spanSorting);
                        }
                    });
                });

                $(".dataTable th").first().click().click();
            }

            <?php if(\Session::get('first_time') == true): ?>
            $('#freshModal').modal('show');
            <?php endif; ?>
        });

        $(document).on('click', '.main_title', function () {
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route('get.breadcrumb', tenant('tenant_id'))); ?>',
                data: {
                    title: $(this).attr('data-title')
                },
                cache: false,
                success: function(data, status, xhr) {
                    if (!xhr.responseJSON && xhr.responseText) {
                        location.reload();
                        return false;
                    }
                }
            });

            $('.main_title').removeClass('active');
            var url = $(this).attr('data-link');

            if (typeof annotationHelper !== 'undefined') {
                if (annotationHelper.isChanged()) {
                    annotationHelper.askSaveChange(
                        function() {
                            unlockRequestWithAction(url);
                        },
                        function() {
                            unlockRequestWithAction(url);
                        }
                    );
                } else {
                    unlockRequestWithAction(url);
                }
            } else {
                setTimeout(function () {
                    window.location.replace(url);
                }, 400);
            }
        });

        $(document).on('click', '.non_title', function () {
            var url = $(this).attr('data-link');
            if (typeof annotationHelper !== 'undefined') {
                if (annotationHelper.isChanged()) {
                    annotationHelper.askSaveChange(
                        function() {
                            unlockRequestWithAction(url);
                        },
                        function() {
                            unlockRequestWithAction(url);
                        }
                    );
                } else {
                    unlockRequestWithAction(url);
                }
            } else {
                setTimeout(function () {
                    window.location.replace(url);
                }, 400);
            }
        });

        $(document).on('click', '#bt-logout', function () {
            if (typeof annotationHelper !== 'undefined') {
                if (annotationHelper.isChanged()) {
                    annotationHelper.askSaveChange(
                        function() {
                            unlockRequestWithAction();
                        },
                        function() {
                            unlockRequestWithAction();
                        }
                    );
                } else {
                    unlockRequestWithAction();
                }
            } else {
                $('#logout-form').submit();
            }
        });

        $(document).on('click', '.from_notification', function (e) {
            var url = $(this).attr('href');
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route('get.breadcrumb', tenant('tenant_id'))); ?>',
                data: {
                    title: $(this).attr('data-title'),
                    notification: true
                },
                cache: false,
                success: function(data, status, xhr) {
                    if (!xhr.responseJSON) {
                        location.reload();
                        return false;
                    }
                }
            });

            setTimeout(function () {
                window.location.href = url;
            }, 400);
        });

        function unlockRequestWithAction(url) {
            const waitingUnlockRequest = async () => {
                await annotationHelper.unlockRequest();
                setTimeout(function () {
                    if (url) { // change url
                        window.location.replace(url);
                    } else {   // logout
                        $('#logout-form').submit();
                    }
                }, 2000);
            };
            waitingUnlockRequest();
        }
    </script>

    <?php echo $__env->yieldPushContent('theme-script'); ?>
    <?php echo $__env->yieldPushContent('script'); ?>

    <?php echo e(\Session::forget('first_time')); ?>


    <?php if(Session::has('success')): ?>
        <script>
            show_toastr('<?php echo e(__('Success')); ?>', "<?php echo session('success'); ?>", 'success');
        </script>
        <?php echo e(Session::forget('success')); ?>

    <?php endif; ?>
    <?php if(Session::has('error')): ?>
        <script>
            show_toastr('<?php echo e(__('Error')); ?>', "<?php echo session('error'); ?>", 'error');
        </script>
        <?php echo e(Session::forget('error')); ?>

    <?php endif; ?>
    <script>
        var chart_keyword = [
            "<?php echo e(__('Wed')); ?>",
            "<?php echo e(__('Tue')); ?>",
            "<?php echo e(__('Mon')); ?>",
            "<?php echo e(__('Sun')); ?>",
            "<?php echo e(__('Sat')); ?>",
            "<?php echo e(__('Fri')); ?>",
            "<?php echo e(__('Thu')); ?>",
        ];
    </script>

    <script type="text/javascript">
        var idleMax = <?php echo e(env('LOGOUT_TIME', 150)); ?>;
        var idleTime = 0;

        var idleInterval = setInterval(() => {
            idleTime++;
            if (idleTime >= idleMax) {
                $("#logout-form").submit();
            }
        }, 60 * 1000);

        $("body").on('mousemove keypress', function (event) {
            idleTime = 0;
        });
    </script>

</html>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/ILINXEngage/resources/views/components/layouts/app.blade.php ENDPATH**/ ?>