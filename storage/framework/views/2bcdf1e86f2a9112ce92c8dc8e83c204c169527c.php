<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'title'        => 'ImageSource',
    'header',
    'actionButton',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'title'        => 'ImageSource',
    'header',
    'actionButton',
]); ?>
<?php foreach (array_filter(([
    'title'        => 'ImageSource',
    'header',
    'actionButton',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<nav
    class="navbar navbar-main navbar-expand-lg navbar-dark <?php echo e((Utility::getSiteContent('banner_type') == 'color') ? 'bg-primary' : ''); ?> navbar-border"
    id="navbar-main">
    <div class="container-fluid">
        <!-- User's navbar -->
        <div class="navbar-user d-lg-none ml-auto">
            <ul class="navbar-nav flex-row align-items-center">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                       data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                
                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link nav-link-icon <?php echo e((user()->getUnreadNotification()->count() > 0) ? 'beep':''); ?>"
                           href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fas fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                            <div class="py-3 px-3">
                                <h5 class="heading h6 mb-0 float-left"><?php echo e(__('Notifications')); ?></h5>
                                <a href="#" data-link="<?php echo e(route('notification.mark.read',tenant('tenant_id'))); ?>"
                                   class="link link-sm link--style-3 float-right non_title"><?php echo e(__('Mark All As Read')); ?></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="list-group list-group-flush mh-430 overflow-auto">
                                <?php if(user()->getUnreadNotification()->count() > 0): ?>
                                    <?php $__currentLoopData = user()->getUnreadNotification(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="list-group-item list-group-item-action">
                                            
                                            
                                            <?php if( $notification->created_at > user()->last_login_at && $notification->created_at > user()->notifications_read ): ?>
                                                <small
                                                    class="float-right badge badge-sm badge-success"><?php echo e(__('New')); ?></small>
                                            <?php endif; ?>
                                            <div class="d-flex align-items-center" data-toggle="tooltip"
                                                 data-placement="right"
                                                 data-title="<?php echo e(Utility::getDateFormatted($notification->created_at,true)); ?>">
                                                <div>
                                                    <span class="avatar bg-dark text-white rounded-circle"><i
                                                            class="fas <?php echo e((!empty($notification->type)) ? $notification->type : 'fa-cogs'); ?>"></i></span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0"><?php echo e(mb_strimwidth($notification->text, 0, 100, "...")); ?></div>
                                                    <p class="text-sm lh-140 mb-0"><?php echo e(Utility::getDateFormatted($notification->created_at,true)); ?></p>
                                                    <?php if(!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type)): ?>

                                                    <?php if($notification->link_type == 'calendar'): ?>
                                                        <a class="calendar_notif"
                                                        href="<?php echo \App\Models\UserNotification::getLink( $notification->id); ?>"
                                                        data-notification="<?php echo e($notification->id); ?>"
                                                        data-title="<?php echo \App\Models\Calendar::getCalendarName($notification->link_url); ?>">
                                                            <small
                                                                class="float-left badge badge-sm <?php echo e($notification->link_color); ?> text-white"
                                                                data-type='<?php echo e($notification->link_type); ?>'
                                                            >
                                                                <?php echo e($notification->link_title); ?>

                                                            </small>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo \App\Models\UserNotification::getLink($notification->id); ?>"
                                                        data-title="<?php echo $notification->link_title; ?>"
                                                        data-notification="<?php echo e($notification->id); ?>"
                                                        class="from_notification on-click-notification">
                                                            <small class="float-left badge badge-sm <?php echo e($notification->link_color); ?> text-white" >
                                                                <?php echo e($notification->link_title); ?>

                                                            </small>
                                                        </a>
                                                    <?php endif; ?>

                                                        <div class="clearfix"></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="text-center">
                                            <div
                                                class="text-sm lh-150 font-weight-bold"><?php echo e(__('No New Notifications')); ?></div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="py-3 text-center">
                                <a href="#" data-link="<?php echo e(route('notification.index',tenant('tenant_id'),)); ?>"
                                   class="link link-sm link--style-3 non_title"><?php echo e(__('See all notifications')); ?></a>
                            </div>
                        </div>
                    </li>
                    <?php
                        $layoutDefinitionslist = \App\Models\LayoutDefinition::layoutDefinitions();
                    ?>
                    <?php if(count($layoutDefinitionslist)>0): ?>
                        <li class="nav-item dropdown dropdown-animate">
                            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i class="fas fa-th"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-md dropdown-menu-arrow p-0">
                                <div class="py-3 px-3">
                                    <h5 class="heading h6 mb-0 float-left"><?php echo e(__('Layout')); ?></h5>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="list-group list-group-flush">
                                    <?php $__currentLoopData = $layoutDefinitionslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $did => $dtitle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="#" data-link="<?php echo e(route('update.layout.store',[tenant('tenant_id'),$did])); ?>"
                                           class="list-group-item list-group-item-action non_title">
                                            <div class="flex-fill">
                                                <div class="h6 text-sm mb-0"><?php echo e($dtitle); ?></div>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="py-1 text-center"></div>
                            </div>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                      <span class="avatar avatar-sm rounded-circle">
                        <img class="avatar avatar-sm rounded-circle" <?php echo e(user()->img_avatar); ?> >
                      </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                            <h6 class="dropdown-header px-0"><?php echo e(__('Hi,')); ?> <?php echo e(user()->name); ?></h6>
                            <a href="#" data-link="<?php echo e(route('profile',tenant('tenant_id'))); ?>" class="dropdown-item non_title">
                                <i class="fas fa-user"></i>
                                <span><?php echo e(__('My profile')); ?></span>
                            </a>

                            <?php if(user()->account_type == 1 && Utility::getValByName('show_activities') == '1'): ?>
                                <a href="#" data-link="<?php echo e(route('activity.index',tenant('tenant_id'),)); ?>" class="dropdown-item non_title">
                                    <i class="fas fa-list-ul"></i>
                                    <span><?php echo e(__('Activities')); ?></span>
                                </a>
                            <?php elseif(Utility::getSiteContent('show_activities') == '1'): ?>
                                <a href="#" data-link="<?php echo e(route('activity.index',tenant('tenant_id'),)); ?>" class="dropdown-item non_title">
                                    <i class="fas fa-list-ul"></i>
                                    <span><?php echo e(__('Activities')); ?></span>
                                </a>
                            <?php endif; ?>
                            <?php if(user()->account_type == 1 || user()->account_type == 4): ?>
                                <a href="#" data-link="<?php echo e(route('settings',tenant('tenant_id'))); ?>" class="dropdown-item non_title">
                                    <i class="fas fa-user"></i>
                                    <span><?php echo e(__('Settings')); ?></span>
                                </a>
                            <?php endif; ?>
                            <?php
                                $packageExtraProfileNav = [];
                                $packageLayout = config('package-layout');
                                if ($packageLayout) {
                                    foreach ($packageLayout as $pk => $v) {
                                        if (isset($v['extra_profile_navigation']) && !empty($v['extra_profile_navigation']) && \Illuminate\Support\Facades\Route::has($v['extra_profile_navigation']['route'])) {
                                            $packageExtraProfileNav[$pk] = $v['extra_profile_navigation'];
                                        }
                                    }
                                }
                            ?>
                            <?php if($packageExtraProfileNav): ?>
                                <?php $__currentLoopData = $packageExtraProfileNav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pk => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route($v['route'], tenant('tenant_id'))); ?>" class="custom-nav-link">
                                        <?php echo $v['icon']; ?>

                                        <span><?php echo e($v['title']); ?></span>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <a
                                class="dropdown-item"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            >
                                <i class="fas fa-sign-out-alt"></i>
                                <span><?php echo e(__('Logout')); ?></span>
                            </a>
                        </div>
                    </li>
                
            </ul>
        </div>

        <!-- Navbar nav -->
        <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
            <ul class="navbar-nav align-items-lg-center">
                <li class="border-top opacity-2 my-2"></li>
                <li class="nav-item <?php echo e((Session::get('navigation_title') == 'home') ? 'active' : ''); ?>">
                    <a class="nav-link pl-lg-0 main_title" href="#" data-link="<?php echo e(route('home',tenant('tenant_id'))); ?>"><?php echo e(__('Home')); ?></a>
                </li>

                <?php $__currentLoopData = \App\Models\Navigation::navigationResult('top'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topbar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <?php if($topbar['contentType'] == 'Custom HTML' && $topbar['advConfig']  == '1'): ?>
                            <a class="nav-link pl-lg-0 <?php echo e((Session::get('navigation_title') == $topbar['title']) ? 'active' : ''); ?> " target="_blank"
                            href="<?php echo e($topbar['datasource']); ?>" data-title="<?php echo e($topbar['title']); ?>">
                                <?php echo e($topbar['title']); ?>

                            </a>
                        <?php else: ?>
                            <a class="nav-link pl-lg-0 <?php echo e((Session::get('navigation_title') == $topbar['title']) ? 'active' : ''); ?> main_title"
                                href="#" data-link="<?php echo e($topbar['link']); ?>" data-title="<?php echo e($topbar['title']); ?>">
                                <?php echo e($topbar['title']); ?>

                            </a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <ul class="navbar-nav ml-lg-auto align-items-center d-none d-lg-flex">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                       data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                
                
                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link nav-link-icon <?php echo e((user()->getUnreadNotification()->count() > 0) ? 'beep':''); ?>"
                           href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fas fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                            <div class="py-3 px-3">
                                <h5 class="heading h6 mb-0 float-left"><?php echo e(__('Notifications')); ?></h5>
                                <a href="#" data-link="<?php echo e(route('notification.mark.read',tenant('tenant_id'))); ?>"
                                    class="link link-sm link--style-3 float-right non_title"><?php echo e(__('Mark All As Read')); ?></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="list-group list-group-flush mh-430 overflow-auto">
                                <?php if(user()->getUnreadNotification()->count() > 0): ?>
                                    <?php $__currentLoopData = user()->getUnreadNotification(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="list-group-item list-group-item-action"  >

                                            
                                                
                                            <?php if( $notification->created_at > user()->last_login_at && $notification->created_at > user()->notifications_read ): ?>
                                                <small
                                                    class="float-right badge badge-sm badge-success"><?php echo e(__('New')); ?></small>
                                            <?php endif; ?>
                                            <div class="d-flex align-items-center" data-toggle="tooltip"
                                                data-placement="right"
                                                data-title="<?php echo e(Utility::getDateFormatted($notification->created_at,true)); ?>">
                                                <div>
                                                    <span class="avatar bg-dark text-white rounded-circle"><i
                                                            class="fas <?php echo e((!empty($notification->type)) ? $notification->type : 'fa-cogs'); ?>"></i></span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0"><?php echo e(mb_strimwidth($notification->text, 0, 100, "...")); ?></div>
                                                    <p class="text-sm lh-140 mb-0"><?php echo e(Utility::getDateFormatted($notification->created_at,true)); ?></p>

                                                    <?php if(!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type)): ?>

                                                    <?php if($notification->link_type == 'calendar'): ?>
                                                        <a class=" calendar_notif non_title" href="#" data-link="<?php echo \App\Models\UserNotification::getLink($notification->id); ?>"
                                                            data-notification="<?php echo e($notification->id); ?>"
                                                            data-title="<?php echo \App\Models\Calendar::getCalendarName($notification->link_url); ?>"
                                                            >
                                                            <small class="float-left badge badge-sm <?php echo e($notification->link_color); ?> text-white"
                                                                data-type='<?php echo e($notification->link_type); ?>'>
                                                                <?php echo e($notification->link_title); ?>

                                                            </small>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="#" data-link="<?php echo \App\Models\UserNotification::getLink($notification->id); ?>"
                                                            class="from_notification on-click-notification non_title"
                                                            data-title="<?php echo $notification->link_title; ?>"
                                                            data-notification="<?php echo e($notification->id); ?>"
                                                            >

                                                            <small class="float-left badge badge-sm  <?php echo e($notification->link_color); ?> text-white" >
                                                                <?php echo e($notification->link_title); ?>

                                                            </small>
                                                        </a>
                                                    <?php endif; ?>
                                                        <div class="clearfix"></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                    </div >
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="text-center">
                                            <div
                                                class="text-sm lh-150 font-weight-bold"><?php echo e(__('No New Notifications')); ?></div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="py-3 text-center">
                                <a href="#" data-link="<?php echo e(route('notification.index',tenant('tenant_id'),)); ?>"
                                   class="link link-sm link--style-3 non_title"><?php echo e(__('See all notifications')); ?></a>
                            </div>
                        </div>
                    </li>
                    <?php
                        $layoutDefinitionslist = \App\Models\LayoutDefinition::layoutDefinitions();
                    ?>
                    <?php if(count($layoutDefinitionslist)>0): ?>
                        <li class="nav-item dropdown dropdown-animate">
                            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i class="fas fa-th"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-md dropdown-menu-arrow p-0">
                                <div class="py-3 px-3">
                                    <h5 class="heading h6 mb-0 float-left"><?php echo e(__('Layout')); ?></h5>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="list-group list-group-flush">
                                    <?php $__currentLoopData = $layoutDefinitionslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $did => $dtitle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="#" data-link="<?php echo e(route('update.layout.store',[tenant('tenant_id'),$did])); ?>"
                                           class="list-group-item list-group-item-action non_title">
                                            <div class="flex-fill">
                                                <div
                                                    class="h6 text-sm mb-0 <?php echo e((user()->layout_definition == $did) ? 'text-primary' : '-'); ?>"><?php echo e($dtitle); ?></div>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="py-1 text-center"></div>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php
                        $userPerms = \App\Models\ModulePermissionAssignment::userPermissions();
                    ?>
                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="media media-pill align-items-center">
                            <span class="avatar rounded-circle">
                              <img class="avatar rounded-circle" <?php echo e(user()->img_avatar); ?>>
                            </span>
                                <div class="ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?php echo e(user()->name); ?></span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                            <h6 class="dropdown-header px-0"><?php echo e(__('Hi,')); ?> <?php echo e(user()->name); ?></h6>
                            <a href="#" data-link="<?php echo e(route('profile',tenant('tenant_id'))); ?>" class="dropdown-item non_title">
                                <i class="fas fa-user"></i>
                                <span><?php echo e(__('My profile')); ?></span>
                            </a>
                            <?php if(user()->account_type == 1 && Utility::getValByName('show_activities') == '1'): ?>

                                <a href="#" data-link="<?php echo e(route('activity.index',tenant('tenant_id'),)); ?>"
                                   class="dropdown-item non_title">
                                    <i class="fas fa-list-ul"></i>
                                    <span><?php echo e(__('Activities')); ?></span>
                                </a>
                            <?php elseif(Utility::getSiteContent('show_activities') == '1'): ?>

                                <a href="#" data-link="<?php echo e(route('activity.index',tenant('tenant_id'),)); ?>"
                                   class="dropdown-item non_title">
                                    <i class="fas fa-list-ul"></i>
                                    <span><?php echo e(__('Activities')); ?></span>
                                </a>
                            <?php endif; ?>
                            <?php if(user()->account_type == 1 ||
                                    user()->account_type == 4 ||
                                    in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms) ||
                                    in_array('FAQ_ALL_CONTENT', $userPerms) ||
                                    in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms)
                                ): ?>
                                <a href="#" data-link="<?php echo e(route('settings',tenant('tenant_id'))); ?>" class="dropdown-item non_title">
                                    <i class="fas fa-cogs"></i>
                                    <span><?php echo e(__('Settings')); ?></span>
                                </a>
                            <?php endif; ?>
                            <?php
                                $packageExtraProfileNav = [];
                                $packageLayout = config('package-layout');
                                if ($packageLayout) {
                                    foreach ($packageLayout as $pk => $v) {
                                        if (isset($v['extra_profile_navigation']) && !empty($v['extra_profile_navigation']) && \Illuminate\Support\Facades\Route::has($v['extra_profile_navigation']['route'])) {
                                            $packageExtraProfileNav[$pk] = $v['extra_profile_navigation'];
                                        }
                                    }
                                }
                            ?>
                            <?php if($packageExtraProfileNav): ?>
                                <?php $__currentLoopData = $packageExtraProfileNav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pk => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route($v['route'], tenant('tenant_id'))); ?>" class="custom-nav-link">
                                        <?php echo $v['icon']; ?>

                                        <span><?php echo e($v['title']); ?></span>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item btn"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <span><?php echo e(__('Logout')); ?></span>
                            </a>
                        </div>
                    </li>
                
            </ul>
            
                <form id="logout-form" action="<?php echo e(route('logout',tenant('tenant_id'))); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            
        </div>
    </div>
    <?php if(!empty($header)): ?>
        <div style="z-index: 2; /*position: absolute;*/" class="welcome-message">
            <div class="row justify-content-between align-items-center">
                <div class="row col-md-12 overflow-hidden">
                    <div class="col-md-2 overflow-hidden">
                        <?php if(!is_null(tenant('small_logo'))): ?>
                            <a class="" href="<?php echo e(route('home',tenant('tenant_id'))); ?>">
                                <img src="<?php echo e(!is_null(tenant('small_logo')) ? asset(\Storage::url(tenant('small_logo'))) : ''); ?>" class="small_logo" />
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="<?php if(!is_null(tenant('small_logo'))): ?> col-md-10 <?php else: ?> col-md-12 <?php endif; ?>">
                        <h5 class="h4 font-weight-400 mb-0 text-white" id="header_title">
                            <?php echo e($header); ?>

                        </h5>
                    </div>
                </div>
                <?php if($actionButton): ?>
                    <div class="col-xs-12 col-sm-12 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
                        <?php echo e($actionButton); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</nav>
<?php $__env->startPush('script'); ?>
<script>
    $('.on-click-notification').click(async function (event) {
        event.preventDefault();
        const notificationId = event.currentTarget.dataset.notification;
        const destinationUrl = event.currentTarget.href
        await storeNotificationRead(notificationId)
        window.location.href = destinationUrl;
    });

    $(document).on('click', '.calendar_notif', function (e) {
            var url = $(this).attr('href');
            e.preventDefault();
            var title = $(this).attr('data-title');

            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-md');
                $("#commonModal").modal('show');
                $.get(url, {}, function (data) {
                    $('#commonModal .modal-body').html(data);
                });
                return false;
            }else{
                console.log("url is incorrect")
            }
        });

    async function storeNotificationRead(notificationId){
        const routeUrl = "<?php echo e(route('notification.mark.user.read', tenant('tenant_id'))); ?>"+"/"+notificationId
        return $.ajax({
            url: routeUrl,
            method: "POST"
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/ILINXEngage/resources/views/components/layouts/partials/navbar.blade.php ENDPATH**/ ?>