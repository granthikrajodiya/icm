<div>
    <?php if(\Session::get('navigation_layout') == \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_LIST ): ?>

        <div class="nav-application navigation-list clearfix">
            <a href="#" data-link="<?php echo e(route('home',tenant('tenant_id'))); ?>"
                class="btn-list text-sm <?php echo e(Session::get('navigation_title') == 'home' ? 'active' : ''); ?> main_title"
                data-title="home" id="home_menu"
            >
                <div class="row">
                    <div class="col-auto"><i class="fas fa-home" aria-hidden="true"></i>
                    </div>
                    <div class="col ml-n2 nav-text">
                        <?php echo e(__('Home')); ?>

                    </div>
                </div>
            </a>

            <?php $__currentLoopData = \App\Models\Navigation::navigationResult('side'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sideBar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($sideBar['contentType'] == 'Custom HTML' && $sideBar['advConfig']  == '1'): ?>
                    <a href="<?php echo e($sideBar['datasource']); ?>" class="btn-list text-sm <?php echo e(Session::get('navigation_title') == $sideBar['title'] ? 'active' : ''); ?> " target="_blank" data-title="<?php echo e($sideBar['title']); ?>" >
                <?php else: ?>
                    <a href="#" data-link="<?php echo e($sideBar['link']); ?>"
                    class="btn-list text-sm <?php echo e(Session::get('navigation_title') == $sideBar['title'] ? 'active' : ''); ?> main_title"
                    data-title="<?php echo e($sideBar['title']); ?>" >
                <?php endif; ?>

                        <div class="row ">
                            <div class="col-auto"><i class="<?php echo e($sideBar['icon']); ?>" aria-hidden="true"></i>
                            </div>
                            <div class="col ml-n2 nav-text">
                                <?php echo e($sideBar['title']); ?>

                            </div>
                        </div>
                    </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="nav-application clearfix">
            <a href="#" data-link="<?php echo e(route('home',tenant('tenant_id'))); ?>"
            class="btn btn-square text-sm <?php echo e(Session::get('navigation_title') == 'home' ? 'active' : ''); ?> main_title"
            data-title="home" id="home_menu"
            >
                <span class="btn-inner--icon d-block"><i class="fas fa-home fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2"><?php echo e(__('Home')); ?></span>
            </a>

            <?php $__currentLoopData = \App\Models\Navigation::navigationResult('side'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sideBar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($sideBar['contentType'] == 'Custom HTML' && $sideBar['advConfig']  == '1'): ?>
                    <a href="<?php echo e($sideBar['datasource']); ?>" class="btn btn-square text-sm <?php echo e(Session::get('navigation_title') == $sideBar['title'] ? 'active' : ''); ?> " target="_blank" data-title="<?php echo e($sideBar['title']); ?>" >
                <?php else: ?>
                    <a href="#" data-link="<?php echo e($sideBar['link']); ?>"
                    class="btn btn-square text-sm <?php echo e(Session::get('navigation_title') == $sideBar['title'] ? 'active' : ''); ?> main_title"
                    data-title="<?php echo e($sideBar['title']); ?>"
                    >
                <?php endif; ?>

                    <span class="btn-inner--icon d-block"><i class="<?php echo e($sideBar['icon']); ?> fa-2x"></i></span>
                    <span class="btn-inner--icon d-block pt-2"><?php echo e($sideBar['title']); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>

<?php if(!empty(Utility::getValByName('sidebar_editor'))): ?>
    <div class="row">
        <div class="col-12 pp-1 <?php if(Utility::getValByName('sidebar_editor_style') == 'bg_gradient'): ?> <?php echo e(Utility::getValByName('bg_gradient')); ?> <?php endif; ?>"
            <?php if(Utility::getValByName('sidebar_editor_style') == 'bg_color'): ?> style="background-color: <?php echo e(Utility::getValByName('sidebar_editor_bg')); ?>" <?php endif; ?>
        >
            <?php echo Utility::getValByName('sidebar_editor'); ?>

        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/code /resources/views/components/layouts/partials/sidebar.blade.php ENDPATH**/ ?>