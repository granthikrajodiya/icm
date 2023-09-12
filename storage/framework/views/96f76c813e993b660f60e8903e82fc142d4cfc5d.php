<?php if (isset($component)) { $__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a = $component; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Layouts\App::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Site Settings')).'']); ?>
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card">
                <div class="list-group list-group-flush" id="tabs">
                    <?php if(user()->account_type == 1): ?>
                        <div data-href="#tabs-site-setting" class="list-group-item list-group-list text-primary">
                            <div class="media">
                                <i class="fas fa-cog pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        <?php echo e(__('Site Settings')); ?>

                                    </a>
                                    <p class="mb-0 text-sm"><?php echo e(__('Basic application configuration settings')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div data-href="#tabs-tenant-layout" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-building pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        <?php echo e(__('Tenants')); ?>

                                    </a>
                                    <p class="mb-0 text-sm"><?php echo e(__('Manage your tenants')); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(user()->account_type == 4): ?>
                        <div data-href="#tabs-site-setting-external-user" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-cog pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        <?php echo e(__('Site Settings')); ?>

                                    </a>
                                    <p class="mb-0 text-sm"><?php echo e(__('Basic application configuration settings')); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(user()->account_type == 1 || user()->account_type == 4): ?>
                        <div data-href="#tabs-user-layout" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-users pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1"><?php echo e(__('Users')); ?></a>
                                    <p class="mb-0 text-sm"><?php echo e(__('Manage user accounts')); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(user()->account_type == 1): ?>
                        <div data-href="#tabs-layout-navigation-layout" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-th pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        <?php echo e(__('Layout & Navigation Definitions')); ?>

                                    </a>
                                    <p class="mb-0 text-sm">
                                        <?php echo e(__('Define Home page layouts and Navigation elements for your users')); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div data-href="#tabs-permission-layout" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-user-lock pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)"
                                        class="stretched-link h6 mb-1"><?php echo e(__('Permissions & Features')); ?></a>
                                    <p class="mb-0 text-sm"><?php echo e(__('Manage group access for internal host users')); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div data-href="#tabs-mail-setting" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-envelope pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)"
                                        class="stretched-link h6 mb-1"><?php echo e(__('Mailer Settings')); ?></a>
                                    <p class="mb-0 text-sm"><?php echo e(__('Details about your mail setting information')); ?></p>
                                </div>
                            </div>
                        </div>
                            
                        <div data-href="#tabs-customPage-setting" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-edit pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        <?php echo e(__('Custom Pages')); ?>

                                    </a>
                                    <p class="mb-0 text-sm">
                                        <?php echo e(__('Create and manage custom content for card and pages')); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div data-href="#tabs-help-center" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-info-circle pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        <?php echo e(__('Help Center Page')); ?>

                                    </a>
                                    <p class="mb-0 text-sm"><?php echo e(__('Details about your Help Center Page setting')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div data-href="#tabs-faq" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-question pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        <?php echo e(__('FAQ Settings')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php if(in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms)): ?>
                            <div data-href="#tabs-news-feed" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-newspaper pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            <?php echo e(__('News Feeds')); ?>

                                        </a>
                                        <p class="mb-0 text-sm"><?php echo e(__('News and announcements')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if(in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms)): ?>
                            <div data-href="#tabs-customPage-setting" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-edit pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            <?php echo e(__('Custom Pages')); ?>

                                        </a>
                                        <p class="mb-0 text-sm">
                                            <?php echo e(__('Create and manage custom content for card and pages')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(in_array('FAQ_ALL_CONTENT', $userPerms)): ?>
                            <div data-href="#tabs-help-center" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-info-circle pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            <?php echo e(__('Help Center Page')); ?>

                                        </a>
                                        <p class="mb-0 text-sm"><?php echo e(__('Details about your Help Center Page setting')); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div data-href="#tabs-faq" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-question pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            <?php echo e(__('FAQ Settings')); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms) || tenant()->manage_news_posts): ?>
                            <div data-href="#tabs-news-feed" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-newspaper pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            <?php echo e(__('News Feeds')); ?>

                                        </a>
                                        <p class="mb-0 text-sm"><?php echo e(__('News and announcements')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    
                    <?php
                        $packageConfigurations = [];
                        $packageLayout = config('package-layout');
                        if ($packageLayout) {
                            foreach ($packageLayout as $pk => $v) {
                                if (isset($v['configuration']) && !empty($v['configuration'])) {
                                    $packageConfigurations[$pk] = $v['configuration'];
                                }
                            }
                        }
                    ?>
                        <?php if($packageConfigurations): ?>
                            <div class="config-menu-has-child">
                                <div class="media parent-menu">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a class="h6 mb-1" href="javascript:void(0)">
                                            <?php echo e(__('Package Configurations')); ?>

                                        </a>
                                        <p class="mb-0 text-sm"><?php echo e(__('Package Configurations')); ?></p>
                                    </div>
                                </div>
                                <div class="config-menu-children">
                                    <?php $__currentLoopData = $packageConfigurations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pk => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $packageConfigurationTemplate = $pk . '::' . $v['template'];
                                        ?>
                                        <?php if(\View::exists($packageConfigurationTemplate)): ?>
                                            <div data-href="#<?php echo e((isset($v['tab_id']) && !empty($v['tab_id'])) ? $pk . '_' . $v['tab_id']: ''); ?>" class="list-group-item list-group-list config">
                                                <div class="media">
                                                    
                                                    <div class="media-body ml-5">
                                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                                            <?php echo e((isset($v['title']) && !empty($v['title'])) ? $v['title']: ''); ?>

                                                        </a>
                                                        <p class="mb-0 text-sm"><?php echo e((isset($v['description']) && !empty($v['description'])) ? $v['description']: ''); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            

            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('settings.poweredby.destroy', [
                                                            tenant('tenant_id')
                                                        ]),'delete' => true,'id' => 'delete-poweredby']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('settings.poweredby.destroy', [
                                                            tenant('tenant_id')
                                                        ])),'delete' => true,'id' => 'delete-poweredby']); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('settings.smalllogo.destroy', [
                                                            tenant('tenant_id')
                                                        ]),'delete' => true,'id' => 'delete-smalllogo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('settings.smalllogo.destroy', [
                                                            tenant('tenant_id')
                                                        ])),'delete' => true,'id' => 'delete-smalllogo']); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

            <?php if(user()->account_type == 1): ?>
                <div id="tabs-site-setting" class="tabs-card">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0"><?php echo e(__('Basic Setting')); ?></h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('settings.store', tenant('tenant_id')),'id' => 'update_setting','upload' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('settings.store', tenant('tenant_id'))),'id' => 'update_setting','upload' => true]); ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'full_logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'full_logo']); ?><?php echo e(__('Logo')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <input type="file" name="full_logo" id="full_logo"
                                                class="custom-input-file" />
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'full_logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'full_logo']); ?>
                                                <i class="fa fa-upload"></i>
                                                <span><?php echo e(__('Choose a file…')); ?></span>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5">
                                        <img alt="logo" src="<?php echo e(tenant()?->logo_path); ?>" class="img_setting" />
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'small_logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'small_logo']); ?><?php echo e(__('Small Logo')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <input type="file" name="small_logo" accept="image/*"
                                                   id="small_logo" class="custom-input-file" />
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'small_logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'small_logo']); ?>
                                                <i class="fa fa-upload"></i>
                                                <span><?php echo e(__('Choose a file…')); ?></span>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 pt-4 mt-1">
                                        <?php if(!is_null(tenant('small_logo'))): ?>
                                            <div class="text-left">
                                                <button type="button" class="action-item text-danger px-2"
                                                        data-dismiss="modal"
                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="document.getElementById('delete-smalllogo').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-xs-11 col-sm-11 col-md-5 col-lg-5 pt-5">
                                        <img src="<?php echo e(!is_null(tenant('small_logo')) ? asset(\Storage::url(tenant('small_logo'))) : ''); ?>"
                                             class="img_setting" />
                                    </div>
                                    
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'poweredby_logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'poweredby_logo']); ?><?php echo e(__('PoweredBy  Logo')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <input type="file" name="poweredby_logo" accept="image/*"
                                                   id="poweredby_logo" class="custom-input-file" />
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'poweredby_logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'poweredby_logo']); ?>
                                                <i class="fa fa-upload"></i>
                                                <span><?php echo e(__('Choose a file…')); ?></span>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 pt-4 mt-1">
                                        <?php if(!is_null(tenant('poweredby_logo'))): ?>
                                            <div class="text-left">
                                                <button type="button" class="action-item text-danger px-2"
                                                        data-dismiss="modal"
                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="document.getElementById('delete-poweredby').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-xs-11 col-sm-11 col-md-5 col-lg-5 pt-5">
                                        <?php if(!is_null(tenant('poweredby_logo'))): ?>
                                        <img src="<?php echo e(!is_null(tenant('poweredby_logo')) ? asset(\Storage::url(tenant('poweredby_logo'))) : ''); ?>"
                                             class="img_setting" />
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'favicon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'favicon']); ?><?php echo e(__('Favicon')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <input type="file" name="favicon" id="favicon"
                                                class="custom-input-file" />
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'favicon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'favicon']); ?>
                                                <i class="fa fa-upload"></i>
                                                <span><?php echo e(__('Choose a file…')); ?></span>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5">
                                        <img alt="favicon" src="<?php echo e(tenant()?->fav_icon_path); ?>"
                                            class="img_setting" />

                                    </div>
                                    <div class="col-12">
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.toggle-group','data' => ['wrap' => false,'name' => 'banner']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.toggle-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wrap' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'name' => 'banner']); ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.toggle','data' => ['sm' => true,'name' => 'banner_type','id' => 'banner_type1','label' => 'Image','value' => 'image','current' => Utility::getValByName('banner_type')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sm' => true,'name' => 'banner_type','id' => 'banner_type1','label' => 'Image','value' => 'image','current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('banner_type'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.toggle','data' => ['sm' => true,'name' => 'banner_type','id' => 'banner_type2','label' => 'Color','value' => 'color','current' => Utility::getValByName('banner_type')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sm' => true,'name' => 'banner_type','id' => 'banner_type2','label' => 'Color','value' => 'color','current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('banner_type'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    </div>
                                    <div
                                        class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3 banner_img <?php echo e(Utility::getValByName('banner_type') != 'image' ? 'd-none' : ''); ?>">
                                        <div class="form-group">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'banner']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'banner']); ?><?php echo e(__('Banner Image')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <input type="file" name="banner" id="banner"
                                                class="custom-input-file" />
                                            <label for="banner">
                                                <i class="fa fa-upload"></i>
                                                <span><?php echo e(__('Choose a file…')); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div
                                        class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5 banner_img <?php echo e(Utility::getValByName('banner_type') != 'image' ? 'd-none' : ''); ?>">
                                        <img alt="banner" src="<?php echo e(tenant()?->banner_path); ?>" class="img_banner" />

                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'header_text','label' => 'Title Text','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Header Title Text')).'','value' => Utility::getValByName('header_text')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'header_text','label' => 'Title Text','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Header Title Text')).'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('header_text'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'footer_text','label' => 'Footer Text','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Text')).'','value' => Utility::getValByName('footer_text')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'footer_text','label' => 'Footer Text','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Text')).'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('footer_text'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <hr />
                                <div class="row">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'name' => 'footer_link_1','label' => 'Footer Link Title 1','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link Title 1')).'','value' => Utility::getValByName('footer_link_1')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'footer_link_1','label' => 'Footer Link Title 1','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link Title 1')).'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('footer_link_1'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'name' => 'footer_value_1','label' => 'Footer Link href 1','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link 1')).'','value' => Utility::getValByName('footer_value_1')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'footer_value_1','label' => 'Footer Link href 1','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link 1')).'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('footer_value_1'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <div class="row">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'name' => 'footer_link_2','label' => 'Footer Link Title 2','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link Title 2')).'','value' => Utility::getValByName('footer_link_2')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'footer_link_2','label' => 'Footer Link Title 2','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link Title 2')).'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('footer_link_2'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'name' => 'footer_value_2','label' => 'Footer Link href 2','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link 2')).'','value' => Utility::getValByName('footer_value_2')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'footer_value_2','label' => 'Footer Link href 2','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link 2')).'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('footer_value_2'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <div class="row">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'name' => 'footer_link_3','label' => 'Footer Link Title 3','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link Title 3')).'','value' => Utility::getValByName('footer_link_3')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'footer_link_3','label' => 'Footer Link Title 3','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link Title 3')).'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('footer_link_3'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'name' => 'footer_value_3','label' => 'Footer Link href 3','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link 3')).'','value' => Utility::getValByName('footer_value_3')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'footer_value_3','label' => 'Footer Link href 3','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','placeholder' => ''.e(__('Enter Footer Link 3')).'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('footer_value_3'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'name' => 'terms_conditions','label' => 'Terms and condition link','containerClass' => 'col-12','placeholder' => ''.e(__('Enter Terms and condition link')).'','value' => Utility::getValByName('terms_conditions')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'terms_conditions','label' => 'Terms and condition link','container-class' => 'col-12','placeholder' => ''.e(__('Enter Terms and condition link')).'','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('terms_conditions'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 py-2 my-3">
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.checkbox','data' => ['name' => 'show_activities','id' => 'show_activities','label' => 'Show Activities','checked' => Utility::getValByName('show_activities') == '1' ? true : false,'value' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'show_activities','id' => 'show_activities','label' => 'Show Activities','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('show_activities') == '1' ? true : false),'value' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    </div>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['type' => 'time','required' => true,'name' => 'day_start','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','value' => Utility::getValByName('day_start')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'time','required' => true,'name' => 'day_start','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('day_start'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'default_theme','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'default_theme','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6']); ?>
                                        <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value); ?>"
                                                <?php if(Utility::getValByName('default_theme') == $value): ?> selected <?php endif; ?>>
                                                <?php echo e($label); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'date_format','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'date_format','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6']); ?>
                                        <?php $__currentLoopData = $arrDate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value); ?>"
                                                <?php if(Utility::getValByName('date_format') == $value): ?> selected <?php endif; ?>>
                                                <?php echo e($label); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                                    <?php if(user()->account_type == 1): ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <hr>

                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.toggle-group','data' => ['name' => 'sidebar_editor','label' => 'Sidebar']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.toggle-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sidebar_editor','label' => 'Sidebar']); ?>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.toggle','data' => ['name' => 'sidebar_editor_style','id' => 'sidebar_editor_style1','label' => 'Background Color','value' => 'bg_color','current' => Utility::getValByName('sidebar_editor_style')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sidebar_editor_style','id' => 'sidebar_editor_style1','label' => 'Background Color','value' => 'bg_color','current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('sidebar_editor_style'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.toggle','data' => ['name' => 'sidebar_editor_style','id' => 'sidebar_editor_style2','label' => 'Gradient Color','value' => 'bg_gradient','current' => Utility::getValByName('sidebar_editor_style')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sidebar_editor_style','id' => 'sidebar_editor_style2','label' => 'Gradient Color','value' => 'bg_gradient','current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('sidebar_editor_style'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.toggle','data' => ['name' => 'sidebar_editor_style','id' => 'sidebar_editor_style3','label' => 'Transparent','value' => 'transparent','current' => Utility::getValByName('sidebar_editor_style')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sidebar_editor_style','id' => 'sidebar_editor_style3','label' => 'Transparent','value' => 'transparent','current' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('sidebar_editor_style'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                                            <br><br>

                                            <div
                                                class="sidebar_bg_color <?php echo e(Utility::getValByName('sidebar_editor_style') != 'bg_color' ? 'd-none' : ''); ?>

                                                        col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['type' => 'color','name' => 'sidebar_editor_bg','label' => 'Color','value' => Utility::getValByName('sidebar_editor_bg')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'color','name' => 'sidebar_editor_bg','label' => 'Color','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Utility::getValByName('sidebar_editor_bg'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </div>
                                            <div
                                                class="sidebar_bg_gradiant <?php echo e(Utility::getValByName('sidebar_editor_style') != 'bg_gradient' ? 'd-none' : ''); ?>">
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'bg_gradient','label' => 'Color']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'bg_gradient','label' => 'Color']); ?>
                                                    <?php $__currentLoopData = $arrGradient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($value); ?>"
                                                            <?php if(Utility::getValByName('bg_gradient') == $value): ?> selected <?php endif; ?>>
                                                            <?php echo e($label); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.textarea','data' => ['name' => 'sidebar_editor','wrap' => false,'labeless' => true,'class' => 'summernote-simple-sidebar clearfix']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sidebar_editor','wrap' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'labeless' => true,'class' => 'summernote-simple-sidebar clearfix']); ?>
                                                    <?php echo e(Utility::getValByName('sidebar_editor')); ?>

                                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="text-right">
                                    <input type="hidden" name="from" value="site_setting" />
                                    <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'submit','sm' => true,'primary' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Save changes')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                                </div>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    </div>
                </div>
                <div id="tabs-tenant-layout" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header actions-toolbar border-0">
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Tenants')); ?></h6>
                                </div>
                                <div class="col text-right">
                                    <div class="actions">
                                        <a href="#"
                                            data-url="<?php echo e(route('tenant.create', tenant('tenant_id'))); ?>"
                                            data-size="xl" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Create Tenant')); ?>" class="action-item">
                                            <i class="fas fa-plus"></i>
                                            <span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 px-1 pb-3">
                            <div class="table-responsive" id="">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Tenant ID')); ?></th>
                                            <th><?php echo e(__('Primary Contact')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($tenants->count() > 0): ?>
                                            <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($tenant->company_name); ?></td>
                                                    <td><?php echo e($tenant->tenant_id); ?></td>
                                                    <td><?php echo e(isset($tenant->user->name) && !is_null($tenant->user->name) ? $tenant->user->name : '-'); ?>

                                                    </td>
                                                    <td><?php echo e(\App\Models\Tenant::$status[$tenant->account_status]); ?>

                                                    </td>
                                                    <td>
                                                        <div class="actions">
                                                            <a href="#" class="action-item px-2"
                                                                data-url="<?php echo e(route('tenant.edit', [
                                                                    'tenant' => tenant('tenant_id'),
                                                                    'selectedTenant' => $tenant->tenant_id,
                                                                ])); ?>"
                                                                data-ajax-popup="true" data-size="lg"
                                                                data-title="<?php echo e(__('Edit Tenant')); ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            
                                                        </div>
                                                        
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <th scope="col" colspan="5">
                                                    <h6 class="text-center"><?php echo e(__('No Tenants Found.')); ?></h6>
                                                </th>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(user()->account_type == 4): ?>
                <div id="tabs-site-setting-external-user" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0"><?php echo e(__('Basic Setting')); ?></h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('settings.store', tenant('tenant_id')),'id' => 'update_setting','upload' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('settings.store', tenant('tenant_id'))),'id' => 'update_setting','upload' => true]); ?>
                                <div class="row">
                                    
                                    <?php if(tenant('branding_level') == 'all'): ?>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'full_logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'full_logo']); ?><?php echo e(__('Logo')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                <input type="file" name="full_logo" id="full_logo"
                                                    class="custom-input-file" />
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'full_logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'full_logo']); ?>
                                                    <i class="fa fa-upload"></i>
                                                    <span><?php echo e(__('Choose a file…')); ?></span>
                                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5">
                                            <img src="<?php echo e(!is_null(tenant('logo')) ? asset(\Storage::url(tenant('logo'))) : ''); ?>"
                                                class="img_setting" />
                                        </div>
                                    <?php endif; ?>
                                    

                                    <?php if(tenant('branding_level') == 'min' || tenant('branding_level') == 'all'): ?>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'small_logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'small_logo']); ?><?php echo e(__('Small Logo')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                <input type="file" name="small_logo" accept="image/*"
                                                    id="small_logo" class="custom-input-file" />
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'small_logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'small_logo']); ?>
                                                    <i class="fa fa-upload"></i>
                                                    <span><?php echo e(__('Choose a file…')); ?></span>
                                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </div>
                                        </div>

                                        <?php if(!is_null(tenant('small_logo'))): ?>
                                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 pt-4 mt-1">
                                                <?php if(File::exists(storage_path('/app/public/'.tenant('small_logo')))): ?>
                                                    <div class="text-right">
                                                        <button type="button" class="action-item text-danger px-2"
                                                                data-dismiss="modal"
                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                data-confirm-yes="document.getElementById('delete-smalllogo').submit();">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-xs-11 col-sm-11 col-md-5 col-lg-5 pt-5">
                                                <img src="<?php echo e(!is_null(tenant('small_logo')) ? asset(\Storage::url(tenant('small_logo'))) : ''); ?>"
                                                    class="img_setting" />
                                            </div>
                                        <?php endif; ?>

                                        
                                        
                                        

                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5">
                                            <img src="<?php echo e(!is_null(tenant('poweredby_logo')) ? asset(\Storage::url(tenant('poweredby_logo'))) : ''); ?>"
                                                 class="img_setting" />
                                        </div>
                                        
                                    <?php endif; ?>

                                    <?php if(tenant('branding_level') == 'all'): ?>
                                        <div class="col-12">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'banner_type']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'banner_type']); ?><?php echo e(__('Banner')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <br>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label
                                                    class="btn btn-sm btn-primary <?php echo e(tenant('banner_type') == 'image' ? 'active' : ''); ?>">
                                                    <input type="radio" name="banner_type" value="image"
                                                        class="banner_style" autocomplete="off"
                                                        <?php echo e(tenant('banner_type') == 'image' ? 'checked' : ''); ?>>
                                                    <?php echo e(__('Image')); ?>

                                                </label>
                                                <label
                                                    class="btn btn-sm btn-primary <?php echo e(tenant('banner_type') == 'color' ? 'active' : ''); ?>">
                                                    <input type="radio" name="banner_type" value="color"
                                                        class="banner_style" autocomplete="off"
                                                        <?php echo e(tenant('banner_type') == 'color' ? 'checked' : ''); ?>>
                                                    <?php echo e(__('Color')); ?>

                                                </label>
                                            </div>
                                        </div>

                                        <div
                                            class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3 banner_img <?php echo e(tenant('banner_type') == 'image' ? '' : 'd-none'); ?>">
                                            <div class="form-group">
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.label','data' => ['for' => 'banner_type']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'banner_type']); ?><?php echo e(__('Banner Image')); ?>

                                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                <input type="file" name="banner" id="banner"
                                                    class="custom-input-file" />
                                                <label for="banner">
                                                    <i class="fa fa-upload"></i>
                                                    <span><?php echo e(__('Choose a file…')); ?></span>
                                                </label>
                                                <small><i><?php echo e(tenant('banner')); ?></i></small>
                                            </div>
                                        </div>
                                        <div
                                            class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5 banner_img <?php echo e(tenant('banner_type') == 'image' ? '' : 'd-none'); ?>">
                                            <img src="<?php echo e(!is_null(tenant('banner')) ? asset(\Storage::url(tenant('banner'))) : ''); ?>"
                                                class="img_setting" />
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if(tenant('branding_level') == 'all'): ?>
                                    <div class="row mt-4">
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'header_text','id' => 'header_text','label' => 'Title Text','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','value' => ''.e(tenant('header_text')).'','placeholder' => 'Enter Header Title Text']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'header_text','id' => 'header_text','label' => 'Title Text','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','value' => ''.e(tenant('header_text')).'','placeholder' => 'Enter Header Title Text']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'default_theme','label' => 'Default Theme','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'default_theme','label' => 'Default Theme','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6']); ?>
                                            <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>"
                                                    <?php echo e(tenant('default_theme') == $value ? 'selected' : ''); ?>>
                                                    <?php echo e($label); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="row">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'date_format','label' => 'Date Format','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'date_format','label' => 'Date Format','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6']); ?>
                                        <?php $__currentLoopData = $arrDate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value); ?>"
                                                <?php echo e(tenant('date_format') == $value ? 'selected' : ''); ?>>
                                                <?php echo e($label); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['type' => 'time','name' => 'day_start','id' => 'day_start','label' => 'Day Start','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','value' => ''.e(tenant('day_start')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'time','name' => 'day_start','id' => 'day_start','label' => 'Day Start','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','value' => ''.e(tenant('day_start')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                                    <?php if(tenant('branding_level') == 'all'): ?>
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.checkbox','data' => ['name' => 'show_activities','id' => 'show_activities','label' => 'Show Activities','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6 py-2 my-3','checked' => tenant('show_activities') == '1' ? true : false,'value' => 'on']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'show_activities','id' => 'show_activities','label' => 'Show Activities','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6 py-2 my-3','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(tenant('show_activities') == '1' ? true : false),'value' => 'on']); ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php endif; ?>

                                </div>
                                <div class="text-right">
                                    <input type="hidden" name="from" value="external_admin_site_setting">
                                    <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'submit','sm' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Save changes')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                                </div>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(user()->account_type == 1 || user()->account_type == 4): ?>
                <div id="tabs-user-layout"
                    class="tabs-card <?php echo e(user()->account_type == 1 || user()->account_type == 4 ? 'd-none' : ''); ?>">
                    <div class="card">
                        <div class="card-header actions-toolbar border-0">
                            <div class="actions-search" id="actions-user-search">
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i
                                                class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-flush" id="user_keyword"
                                        placeholder="<?php echo e(__('Type keyword..')); ?>">
                                    <div class="input-group-append">
                                        <a href="#" class="input-group-text bg-transparent"
                                            data-action="search-close" data-target="#actions-user-search"><i
                                                class="fas fa-times"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Users')); ?></h6>
                                </div>
                                <div class="col text-right">
                                    <div class="actions">
                                        <a href="#" class="action-item mr-2" data-action="search-open"
                                            data-target="#actions-user-search"><i class="fas fa-search"></i></a>
                                        <div class="dropdown mr-2">
                                            <a href="#" class="action-item" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-filter"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" id="user_sort">
                                                <a class="dropdown-item active" href="#"
                                                    data-val="created_at-desc">
                                                    <i class="fas fa-sort-amount-down"></i><?php echo e(__('Newest')); ?>

                                                </a>
                                                <a class="dropdown-item" href="#" data-val="name-asc">
                                                    <i class="fas fa-sort-alpha-down"></i><?php echo e(__('From A-Z')); ?>

                                                </a>
                                                <a class="dropdown-item" href="#" data-val="name-desc">
                                                    <i class="fas fa-sort-alpha-up"></i><?php echo e(__('From Z-A')); ?>

                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown mr-2">
                                            <a href="#" class="action-item" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" id="refresh_userlist">
                                                    <?php echo e(__('Refresh')); ?>

                                                </a>
                                            </div>
                                        </div>
                                        <?php if(user()->account_type == 4): ?>
                                            <a href="#" class="action-item"
                                                data-url="<?php echo e(route('user.create', tenant('tenant_id'))); ?>"
                                                data-ajax-popup="true" data-size="lg"
                                                data-title="<?php echo e(__('Add User')); ?>">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 px-1 pb-3">
                            <?php if(user()->account_type == 1): ?>
                                <div class="row px-3">
                                    <div class="col-2 my-auto">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="user_tenant"><?php echo e(__('Tenant')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-5 my-auto">
                                        <div class="form-group">
                                            <select name="user_tenant" id="user_tenant" class="form-control">
                                                <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($tent->tenant_id); ?>">
                                                        <?php echo e($tent->company_name . ' (' . $tent->tenant_id . ')'); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div id='userlist-loader' class="min-h-500">
                                <img src="<?php echo e(asset('assets/img/loading.gif')); ?>" height="50px" width="50px"
                                    class="loading" alt="">
                            </div>
                            <div class="table-responsive" id="userlist-content" style="display: none">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Email')); ?></th>
                                            <?php if(user()->account_type == 4): ?>
                                                <th><?php echo e(__('Primary')); ?></th>
                                            <?php endif; ?>
                                            <th><?php echo e(__('Account Type')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="user_list">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(user()->account_type == 1): ?>
                <div id="tabs-layout-navigation-layout" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header actions-toolbar border-0">
                            <div class="actions-search" id="actions-layout-navigation-search">
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i
                                                class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-flush"
                                        id="layout_navigation_keyword" placeholder="<?php echo e(__('Type keyword..')); ?>">
                                    <div class="input-group-append">
                                        <a href="#" class="input-group-text bg-transparent"
                                            data-action="search-close"
                                            data-target="#actions-layout-navigation-search"><i
                                                class="fas fa-times"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Layouts')); ?></h6>
                                </div>
                                <div class="col text-right">
                                    <div class="actions">
                                        <a href="#" class="action-item mr-2" data-action="search-open"
                                            data-target="#actions-layout-navigation-search"><i
                                                class="fas fa-search"></i></a>
                                        <a href="#"
                                            data-url="<?php echo e(route('layout.navigation.create', tenant('tenant_id'))); ?>"
                                            id="layoutNavigationCreate" data-size="lg" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Create Layout')); ?>" class="action-item">
                                            <i class="fas fa-plus"></i>
                                            <span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0 px-1 pb-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Internal')); ?></th>
                                            <th><?php echo e(__('External')); ?></th>
                                            <th><?php echo e(__('Public')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="layout_navigation_table">
                                        <?php if($layoutDefinitions['all']->count() > 0): ?>
                                            <?php $__currentLoopData = $layoutDefinitions['all']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $definition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($definition->title); ?></td>
                                                    <td>
                                                        <?php if($definition->user_group == 1): ?>
                                                            <i class="fas fa-check text-success"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($definition->user_group == 2): ?>
                                                            <i class="fas fa-check text-success"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($definition->user_group == 3): ?>
                                                            <i class="fas fa-check text-success"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="actions">
                                                            <a href="#" class="action-item px-2"
                                                                id="layoutNavigationEdit"
                                                                data-id="<?php echo e($definition->id); ?>"
                                                                data-url="<?php echo e(route('layout.navigation.edit', [tenant('tenant_id'), $definition->id])); ?>"
                                                                data-ajax-popup="true" data-size="lg"
                                                                data-title="<?php echo e(__('Edit Layout : ') . $definition->title); ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <?php if(user()->layout_definition != $definition->id): ?>
                                                                <a href="#" class="action-item text-danger px-2"
                                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-layout-navigation-<?php echo e($definition->id); ?>').submit();">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('layout.navigation.delete', [
                                                            tenant('tenant_id'),
                                                            $definition->id,
                                                        ]),'delete' => true,'id' => 'delete-layout-navigation-'.e($definition->id).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('layout.navigation.delete', [
                                                            tenant('tenant_id'),
                                                            $definition->id,
                                                        ])),'delete' => true,'id' => 'delete-layout-navigation-'.e($definition->id).'']); ?>
                                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <th scope="col" colspan="5">
                                                    <h6 class="text-center"><?php echo e(__('No Data Found.')); ?></h6>
                                                </th>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-permission-layout" class="tabs-card <?php echo e(user()->account_type == 1 ? 'd-none' : ''); ?>">
                    <div class="card">
                        <div class="card-header ">
                            <div class="row justify-content-between align-items-center">
                                <h5 class="h6 mb-0"><?php echo e(__('Permissions & Features')); ?></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('moduleAssignment.store.permissions', tenant('tenant_id')),'id' => 'form_module_assignment','method' => 'POST']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('moduleAssignment.store.permissions', tenant('tenant_id'))),'id' => 'form_module_assignment','method' => 'POST']); ?>
                                <div class="row">
                                    <?php if(count($securityGroup) > 0): ?>
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'group_name','label' => 'Group','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','id' => 'group_name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'group_name','label' => 'Group','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','id' => 'group_name']); ?>
                                            <?php $__currentLoopData = $securityGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($label); ?>">
                                                    <?php echo e($label); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php else: ?>
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'group_name','label' => 'Group','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','id' => 'group_name','disabled' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'group_name','label' => 'Group','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','id' => 'group_name','disabled' => 'true']); ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="row">

                                    <?php if(count($securityGroup) > 0): ?>
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'module_name','label' => 'Module','id' => 'module_select_layout','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'module_name','label' => 'Module','id' => 'module_select_layout','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6']); ?>
                                            <?php $__currentLoopData = $modulePermsDefs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $modules): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>">
                                                    <?php echo e($key); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php else: ?>
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'module_name','label' => 'Module','id' => 'module_select_layout','containerClass' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','disabled' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'module_name','label' => 'Module','id' => 'module_select_layout','container-class' => 'col-xs-12 col-sm-12 col-md-6 col-lg-6','disabled' => 'true']); ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php endif; ?>

                                </div>

                                <?php $__currentLoopData = $modulePermsDefs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $modules): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->first): ?>
                                        <div class="row selectors" id="permission-selector-<?php echo e($modules['code']); ?>">
                                            <?php $__currentLoopData = $modules['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $defs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 py-1 my-1">

                                                    <div class="custom-control custom-switch">
                                                        <?php if(count($securityGroup) > 0): ?>
                                                            <input type="checkbox" name="permission_values"
                                                                id="<?php echo e($modules['code'] . '_' . $defs->permission_key); ?>"
                                                                class="custom-control-input"
                                                                data-level="<?php echo e($defs->permission_level); ?>"
                                                                value="<?php echo e($defs->permission_key); ?>">

                                                            <label class="custom-control-label form-control-label"
                                                                for="<?php echo e($modules['code'] . '_' . $defs->permission_key); ?>">
                                                                <?php echo e($defs->permission_description); ?>

                                                            </label>
                                                        <?php else: ?>
                                                            <input type="checkbox" name="permission_values"
                                                                id="<?php echo e($modules['code'] . '_' . $defs->permission_key); ?>"
                                                                class="custom-control-input"
                                                                data-level="<?php echo e($defs->permission_level); ?>"
                                                                value="<?php echo e($defs->permission_key); ?>" disabled="true">

                                                            <label class="custom-control-label form-control-label"
                                                                for="<?php echo e($modules['code'] . '_' . $defs->permission_key); ?>">
                                                                <?php echo e($defs->permission_description); ?>

                                                            </label>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="row selectors d-none"
                                            id="permission-selector-<?php echo e($modules['code']); ?>">
                                            <?php $__currentLoopData = $modules['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $defs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 py-1 my-1">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="permission_values"
                                                            id="<?php echo e($modules['code'] . '_' . $defs->permission_key); ?>"
                                                            class="custom-control-input"
                                                            data-level="<?php echo e($defs->permission_level); ?>"
                                                            value="<?php echo e($defs->permission_key); ?>">

                                                        <label class="custom-control-label form-control-label"
                                                            for="<?php echo e($modules['code'] . '_' . $defs->permission_key); ?>">
                                                            <?php echo e($defs->permission_description); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <div class="float-left mt-3">
                                        <span class=" text-sm font-italic"> Permissions apply only to host users</span>
                                    </div>
                                    <div class="float-right  mt-2">
                                        <input type="hidden" name="unchecked_permissions" value=""
                                            id="unchecked_permissions">
                                        <input type="hidden" name="checked_permissions" value=""
                                            id="checked_permissions">
                                        <input type="hidden" name="module_assignments" value=""
                                            id="module_assignments">

                                        <?php if(count($securityGroup) > 0): ?>
                                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','sm' => true,'primary' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submit_permission']); ?>
                                                <?php echo e(__('Save changes')); ?>

                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                                        <?php else: ?>
                                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','sm' => true,'primary' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submit_permission','disabled' => 'true']); ?>
                                                <?php echo e(__('Save changes')); ?>

                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>

                    </div>
                </div>

                

                <div id="tabs-label-message" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-body pt-1">
                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#labels" data-toggle="tab" aria-expanded="false"
                                        class="nav-link active">
                                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block"><?php echo e(__('Labels')); ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#messages" data-toggle="tab" aria-expanded="true" class="nav-link">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block"><?php echo e(__('Messages')); ?></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="labels">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('settings.store', tenant('tenant_id')),'id' => 'update_labels']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('settings.store', tenant('tenant_id'))),'id' => 'update_labels']); ?>
                                        <div class="row">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'document_menu','label' => 'Document Menu','containerClass' => 'col-md-12','value' => ''.e(Utility::getValByName('document_menu')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'document_menu','label' => 'Document Menu','container-class' => 'col-md-12','value' => ''.e(Utility::getValByName('document_menu')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'folder_menu','label' => 'Folder Menu','containerClass' => 'col-md-12','value' => ''.e(Utility::getValByName('folder_menu')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'folder_menu','label' => 'Folder Menu','container-class' => 'col-md-12','value' => ''.e(Utility::getValByName('folder_menu')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'task_menu','label' => 'Task Menu','containerClass' => 'col-md-12','value' => ''.e(Utility::getValByName('task_menu')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'task_menu','label' => 'Task Menu','container-class' => 'col-md-12','value' => ''.e(Utility::getValByName('task_menu')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'activities_menu','label' => 'Activities Menu','containerClass' => 'col-md-12','value' => ''.e(Utility::getValByName('activities_menu')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'activities_menu','label' => 'Activities Menu','container-class' => 'col-md-12','value' => ''.e(Utility::getValByName('activities_menu')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'help_menu','label' => 'Help Menu','containerClass' => 'col-md-12','value' => ''.e(Utility::getValByName('help_menu')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'help_menu','label' => 'Help Menu','container-class' => 'col-md-12','value' => ''.e(Utility::getValByName('help_menu')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'salutation','label' => 'Salutation','containerClass' => 'col-md-12','value' => ''.e(Utility::getValByName('salutation')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'salutation','label' => 'Salutation','container-class' => 'col-md-12','value' => ''.e(Utility::getValByName('salutation')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'single_task_work_item','label' => 'Single task/work item','containerClass' => 'col-md-6','value' => ''.e(Utility::getValByName('single_task_work_item')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'single_task_work_item','label' => 'Single task/work item','container-class' => 'col-md-6','value' => ''.e(Utility::getValByName('single_task_work_item')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'plural_task_work_item','label' => 'Plural task/work item','containerClass' => 'col-md-6','value' => ''.e(Utility::getValByName('plural_task_work_item')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'plural_task_work_item','label' => 'Plural task/work item','container-class' => 'col-md-6','value' => ''.e(Utility::getValByName('plural_task_work_item')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </div>
                                        <div class="text-right">
                                            <input type="hidden" name="from" value="label_message">
                                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'submit','sm' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Save changes')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                                        </div>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <div class="tab-pane show" id="messages">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('message.store.data', [tenant('tenant_id'), 'en'])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('message.store.data', [tenant('tenant_id'), 'en']))]); ?>

                                        <?php $__currentLoopData = $arrMessage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileName => $fileValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h3><?php echo e(ucfirst($fileName)); ?></h3>
                                                </div>
                                                <?php $__currentLoopData = $fileValue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(is_array($value)): ?>
                                                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(is_array($value2)): ?>
                                                                <?php $__currentLoopData = $value2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label3 => $value3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(is_array($value3)): ?>
                                                                        <?php $__currentLoopData = $value3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label4 => $value4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if(is_array($value4)): ?>
                                                                                <?php $__currentLoopData = $value4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label5 => $value5): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['containerClass' => 'col-lg-12','class' => 'mb-3','name' => 'message['.e($fileName).']['.e($label).']['.e($label2).']['.e($label3).']['.e($label4).']['.e($label5).']','label' => ''.e($fileName).'.'.e($label).'.'.e($label2).'.'.e($label3).'.'.e($label4).'.'.e($label5).'','value' => ''.e($value5).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['container-class' => 'col-lg-12','class' => 'mb-3','name' => 'message['.e($fileName).']['.e($label).']['.e($label2).']['.e($label3).']['.e($label4).']['.e($label5).']','label' => ''.e($fileName).'.'.e($label).'.'.e($label2).'.'.e($label3).'.'.e($label4).'.'.e($label5).'','value' => ''.e($value5).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php else: ?>
                                                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['containerClass' => 'col-lg-12','class' => 'mb-3','name' => 'message['.e($fileName).']['.e($label).']['.e($label2).']['.e($label3).']['.e($label4).']','label' => ''.e($fileName).'.'.e($label).'.'.e($label2).'.'.e($label3).'.'.e($label4).'','value' => ''.e($value4).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['container-class' => 'col-lg-12','class' => 'mb-3','name' => 'message['.e($fileName).']['.e($label).']['.e($label2).']['.e($label3).']['.e($label4).']','label' => ''.e($fileName).'.'.e($label).'.'.e($label2).'.'.e($label3).'.'.e($label4).'','value' => ''.e($value4).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php else: ?>
                                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['containerClass' => 'col-lg-12','class' => 'mb-3','name' => 'message['.e($fileName).']['.e($label).']['.e($label2).']['.e($label3).']','label' => ''.e($fileName).'.'.e($label).'.'.e($label2).'.'.e($label3).'','value' => ''.e($value3).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['container-class' => 'col-lg-12','class' => 'mb-3','name' => 'message['.e($fileName).']['.e($label).']['.e($label2).']['.e($label3).']','label' => ''.e($fileName).'.'.e($label).'.'.e($label2).'.'.e($label3).'','value' => ''.e($value3).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['containerClass' => 'col-lg-12','class' => 'mb-3','name' => 'message['.e($fileName).']['.e($label).']['.e($label2).']','label' => ''.e($fileName).'.'.e($label).'.'.e($label2).'','value' => ''.e($value2).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['container-class' => 'col-lg-12','class' => 'mb-3','name' => 'message['.e($fileName).']['.e($label).']['.e($label2).']','label' => ''.e($fileName).'.'.e($label).'.'.e($label2).'','value' => ''.e($value2).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['containerClass' => 'col-lg-12','class' => 'mb-3','name' => 'message['.e($fileName).']['.e($label).']','label' => ''.e($fileName).'.'.e($label).'','value' => ''.e($value).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['container-class' => 'col-lg-12','class' => 'mb-3','name' => 'message['.e($fileName).']['.e($label).']','label' => ''.e($fileName).'.'.e($label).'','value' => ''.e($value).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <hr>
                                        <div class="text-right">
                                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['sm' => true,'pill' => true,'type' => 'submit'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Save')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                                        </div>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-mail-setting" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0"><?php echo e(__('Mailer Settings')); ?></h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('settings.store', tenant('tenant_id')),'id' => 'update_setting']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('settings.store', tenant('tenant_id'))),'id' => 'update_setting']); ?>
                                <div class="row">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'mail_driver','containerClass' => 'col-md-6','label' => 'Mail Driver','value' => ''.e($mail->mail_driver ?? '').'','required' => true,'placeholder' => ''.e(__('Mail Driver')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mail_driver','container-class' => 'col-md-6','label' => 'Mail Driver','value' => ''.e($mail->mail_driver ?? '').'','required' => true,'placeholder' => ''.e(__('Mail Driver')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'mail_host','containerClass' => 'col-md-6','label' => 'Mail Host','value' => ''.e($mail->mail_host ?? '').'','required' => true,'placeholder' => ''.e(__('Mail Host')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mail_host','container-class' => 'col-md-6','label' => 'Mail Host','value' => ''.e($mail->mail_host ?? '').'','required' => true,'placeholder' => ''.e(__('Mail Host')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'mail_port','containerClass' => 'col-md-6','label' => 'Mail Port','value' => ''.e($mail->mail_port ?? '').'','required' => true,'placeholder' => ''.e(__('Mail Port')).'','min' => '0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mail_port','container-class' => 'col-md-6','label' => 'Mail Port','value' => ''.e($mail->mail_port ?? '').'','required' => true,'placeholder' => ''.e(__('Mail Port')).'','min' => '0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'mail_username','containerClass' => 'col-md-6','label' => 'Mail Username','value' => ''.e($mail->mail_username ?? '').'','required' => true,'placeholder' => ''.e(__('Mail Username')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mail_username','container-class' => 'col-md-6','label' => 'Mail Username','value' => ''.e($mail->mail_username ?? '').'','required' => true,'placeholder' => ''.e(__('Mail Username')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'type' => 'password','name' => 'mail_password','containerClass' => 'col-md-6','label' => 'Mail Password','value' => ''.e($mail->mail_password ?? '').'','placeholder' => ''.e(__('Mail Password')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'type' => 'password','name' => 'mail_password','container-class' => 'col-md-6','label' => 'Mail Password','value' => ''.e($mail->mail_password ?? '').'','placeholder' => ''.e(__('Mail Password')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'mail_encryption','containerClass' => 'col-md-6','label' => 'Mail Encryption','value' => ''.e($mail->mail_encryption ?? '').'','required' => true,'placeholder' => ''.e(__('Mail Encryption')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mail_encryption','container-class' => 'col-md-6','label' => 'Mail Encryption','value' => ''.e($mail->mail_encryption ?? '').'','required' => true,'placeholder' => ''.e(__('Mail Encryption')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'mail_from_address','containerClass' => 'col-md-6','label' => 'Mail From Address','value' => ''.e($mail->mail_from_address ?? '').'','required' => true,'placeholder' => ''.e(__('Mail From Address')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mail_from_address','container-class' => 'col-md-6','label' => 'Mail From Address','value' => ''.e($mail->mail_from_address ?? '').'','required' => true,'placeholder' => ''.e(__('Mail From Address')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['name' => 'mail_from_name','containerClass' => 'col-md-6','label' => 'Mail From Name','value' => ''.e($mail->mail_from_name ?? '').'','required' => true,'placeholder' => ''.e(__('Mail From Name')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mail_from_name','container-class' => 'col-md-6','label' => 'Mail From Name','value' => ''.e($mail->mail_from_name ?? '').'','required' => true,'placeholder' => ''.e(__('Mail From Name')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-left">
                                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','sm' => true,'warning' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'send_email','data-title' => ''.e(__('Send Test Mail')).'','data-url' => ''.e(route('test.email', tenant('tenant_id'))).'']); ?>
                                                <?php echo e(__('Send Test Mail')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <input type="hidden" name="from" value="mail">
                                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'submit','sm' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Save changes')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    </div>
                </div>


                
                <div id="tabs-customPage-setting" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header actions-toolbar border-0">
                            <div class="actions-search" id="actions-custom-page-search">
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i
                                                class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-flush"
                                        id="customPage_keyword" placeholder="<?php echo e(__('Type keyword..')); ?>">
                                    <div class="input-group-append">
                                        <a href="#" class="input-group-text bg-transparent"
                                            data-action="search-close" data-target="#actions-custom-page-search"><i
                                                class="fas fa-times"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Custom Pages')); ?></h6>
                                </div>
                                <div class="col text-right">
                                    <div class="actions">
                                        <a href="#" class="action-item mr-2" data-action="search-open"
                                            data-target="#actions-custom-page-search"><i
                                                class="fas fa-search"></i></a>

                                        <?php if(in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms)): ?>
                                            <a href="#"
                                                data-url="<?php echo e(route('CustomPages.create', tenant('tenant_id'))); ?>"
                                                id="customPageCreate" data-size="lg" data-ajax-popup="true"
                                                data-title="<?php echo e(__('New Custom Page')); ?>" class="action-item">
                                                <i class="fas fa-plus"></i>
                                                <span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0 px-1 pb-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <?php if(in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms) || user()->account_type == 1): ?>
                                                <th><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody id="custom_pages_table">
                                        <?php if(count($customPage) > 0): ?>
                                            <?php $__currentLoopData = $customPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($pageVal->title); ?></td>
                                                    <?php if(in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms)): ?>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#"
                                                                    class="action-item px-2 customPageEdit"
                                                                    data-id="<?php echo e($pageVal->id); ?>"
                                                                    data-url="<?php echo e(route('CustomPages.edit', [tenant('tenant_id'), $pageVal->id])); ?>"
                                                                    data-ajax-popup="true" data-size="lg"
                                                                    data-title="<?php echo e(__('Edit Custom Page')); ?>"
                                                                    id="<?php echo e($pageVal->id); ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <?php if(user()->account_type == 1): ?>
                                                                    <a href="#"
                                                                        class="action-item text-danger px-2"
                                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                        data-confirm-yes="document.getElementById('delete-CustomPages-<?php echo e($pageVal->id); ?>').submit();">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if(user()->account_type == 1): ?>
                                                                <?php echo Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['CustomPages.destroy', [tenant('tenant_id'), $pageVal->id]],
                                                                    'id' => 'delete-CustomPages-' . $pageVal->id,
                                                                ]); ?>

                                                                <?php echo Form::close(); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <th scope="col" colspan="5">
                                                    <h6 class="text-center"><?php echo e(__('No Data Found.')); ?></h6>
                                                </th>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tabs-help-center" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0"><?php echo e(__('Help Center Settings')); ?></h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('settings.store', tenant('tenant_id')),'id' => 'update_setting','enctype' => 'multipart/form-data']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('settings.store', tenant('tenant_id'))),'id' => 'update_setting','enctype' => 'multipart/form-data']); ?>
                                <div class="row">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.textarea','data' => ['name' => 'help_center_text','class' => 'summernote-simple','containerClass' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'help_center_text','class' => 'summernote-simple','container-class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12']); ?>
                                        <?php echo e(\Utility::getValByName('help_center_text')); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="text-right">
                                            <input type="hidden" name="from" value="help_center">
                                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'submit','sm' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Save changes')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    </div>
                </div>
                <div id="tabs-faq" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('FAQ Settings')); ?></h6>
                                </div>
                                <div class="col-auto">
                                    <div class="actions">
                                        <a href="#" class="action-item"
                                            data-url="<?php echo e(route('faq.create', tenant('tenant_id'))); ?>"
                                            data-ajax-popup="true" data-size="lg"
                                            data-title="<?php echo e(__('Add FAQ')); ?>">
                                            <i class="fas fa-plus"></i>
                                            <span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th class="w-25"><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($faqs->count() > 0): ?>
                                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($faq->title); ?></td>
                                                    <td>
                                                        <div class="actions">
                                                            <a href="#" class="action-item px-2"
                                                                data-url="<?php echo e(route('faq.edit', [tenant('tenant_id'), $faq])); ?>"
                                                                data-ajax-popup="true" data-size="lg"
                                                                data-title="<?php echo e(__('Edit FAQ')); ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="#" class="action-item text-danger px-2"
                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                data-confirm-yes="document.getElementById('delete-faq-<?php echo e($faq->id); ?>').submit();">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                        <?php echo Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['faq.destroy', [tenant('tenant_id'), $faq->id]],
                                                            'id' => 'delete-faq-' . $faq->id,
                                                        ]); ?>

                                                        <?php echo Form::close(); ?>

                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <th scope="col" colspan="2">
                                                    <h6 class="text-center"><?php echo e(__('No FAQ Found.')); ?></h6>
                                                </th>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <?php if(in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms)): ?>
                    <div id="tabs-news-feed" class="tabs-card d-none">
                        <div class="card">
                            <div class="card-header actions-toolbar border-0">
                                <div class="actions-search" id="actions-news-search">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent"><i
                                                    class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-flush" id="customPage_keyword"
                                               placeholder="<?php echo e(__('Type keyword..')); ?>">
                                        <div class="input-group-append">
                                            <a href="#" class="input-group-text bg-transparent" data-action="search-close"
                                               data-target="#actions-news-search"><i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0"><?php echo e(__('Posts')); ?></h6>
                                    </div>
                                    <div class="col text-right">
                                        <div class="actions">
                                            <a href="#" class="action-item mr-2" data-action="search-open"
                                               data-target="#actions-news-search"><i class="fas fa-search"></i></a>
                                            <a href="#" data-url="<?php echo e(route('newsfeed.create', tenant('tenant_id'))); ?>"
                                               id="newsCreate" data-size="lg" data-ajax-popup="true"
                                               data-title="<?php echo e(__('Create New Post')); ?>" class="action-item">
                                                <i class="fas fa-plus"></i>
                                                <span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body pt-0 px-1 pb-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th><?php echo e(__('Title')); ?></th>
                                                <th><?php echo e(__('Published')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="news_feed_table">
                                            <?php if(count($newsfeeds) > 0): ?>
                                                <?php $__currentLoopData = $newsfeeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($post->title); ?></td>
                                                        <td><?php echo e(Utility::isDate($post->updated_at)); ?></td>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#" class="action-item px-2 "
                                                                   data-url="<?php echo e(route('newsfeed.edit', [tenant('tenant_id'), $post])); ?>"
                                                                   data-ajax-popup="true" data-size="lg"
                                                                   data-title="<?php echo e(__('Edit Post')); ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="#" class="action-item text-danger px-2"
                                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-news-<?php echo e($post->id); ?>').submit();">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                            <?php echo Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['newsfeed.destroy',[tenant('tenant_id'),$post->id]],
                                                                'id'=>'delete-news-'.$post->id
                                                            ]); ?>

                                                            <?php echo Form::close(); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <th scope="col" colspan="5">
                                                        <h6 class="text-center"><?php echo e(__('No Data Found.')); ?></h6>
                                                    </th>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <?php if(in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms)): ?>
                    <div id="tabs-customPage-setting" class="tabs-card d-none">
                        <div class="card">
                            <div class="card-header actions-toolbar border-0">
                                <div class="actions-search" id="actions-custom-page-search">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent"><i
                                                    class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-flush"
                                            id="customPage_keyword" placeholder="<?php echo e(__('Type keyword..')); ?>">
                                        <div class="input-group-append">
                                            <a href="#" class="input-group-text bg-transparent"
                                                data-action="search-close" data-target="#actions-custom-page-search"><i
                                                    class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0"><?php echo e(__('Custom Pages')); ?></h6>
                                    </div>
                                    <div class="col text-right">
                                        <div class="actions">
                                            <a href="#" class="action-item mr-2" data-action="search-open"
                                                data-target="#actions-custom-page-search"><i
                                                    class="fas fa-search"></i></a>
                                            <a href="#"
                                                data-url="<?php echo e(route('CustomPages.create', tenant('tenant_id'))); ?>"
                                                id="customPageCreate" data-size="lg" data-ajax-popup="true"
                                                data-title="<?php echo e(__('New Custom Page')); ?>" class="action-item">
                                                <i class="fas fa-plus"></i>
                                                <span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body pt-0 px-1 pb-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th><?php echo e(__('Title')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="custom_pages_table">
                                            <?php if(count($customPage) > 0): ?>
                                                <?php $__currentLoopData = $customPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($pageVal->title); ?></td>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#"
                                                                    class="action-item px-2 customPageEdit"
                                                                    data-id="<?php echo e($pageVal->id); ?>"
                                                                    data-url="<?php echo e(route('CustomPages.edit', [tenant('tenant_id'), $pageVal->id])); ?>"
                                                                    data-ajax-popup="true" data-size="lg"
                                                                    data-title="<?php echo e(__('Edit Custom Page')); ?>"
                                                                    id="<?php echo e($pageVal->id); ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <?php if(user()->account_type == 1): ?>
                                                                    <a href="#"
                                                                        class="action-item text-danger px-2"
                                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                        data-confirm-yes="document.getElementById('delete-CustomPages-<?php echo e($pageVal->id); ?>').submit();">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if(user()->account_type == 1): ?>
                                                                <?php echo Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['CustomPages.destroy', [tenant('tenant_id'), $pageVal->id]],
                                                                    'id' => 'delete-CustomPages-' . $pageVal->id,
                                                                ]); ?>

                                                                <?php echo Form::close(); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <th scope="col" colspan="5">
                                                        <h6 class="text-center"><?php echo e(__('No Data Found.')); ?></h6>
                                                    </th>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(in_array('FAQ_ALL_CONTENT', $userPerms)): ?>
                    <div id="tabs-help-center" class="tabs-card d-none">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="h6 mb-0"><?php echo e(__('Help Center Settings')); ?></h5>
                            </div>
                            <div class="card-body">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['action' => route('settings.store', tenant('tenant_id')),'id' => 'update_setting','enctype' => 'multipart/form-data']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('settings.store', tenant('tenant_id'))),'id' => 'update_setting','enctype' => 'multipart/form-data']); ?>
                                    <div class="row">
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.textarea','data' => ['name' => 'help_center_text','class' => 'summernote-simple','containerClass' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'help_center_text','class' => 'summernote-simple','container-class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12']); ?>
                                            <?php echo e(\Utility::getValByName('help_center_text')); ?>

                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="text-right">
                                                <input type="hidden" name="from" value="help_center">
                                                <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'submit','sm' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Save changes')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-faq" class="tabs-card d-none">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0"><?php echo e(__('FAQ Settings')); ?></h6>
                                    </div>
                                        <div class="col-auto">
                                            <div class="actions">
                                                <a href="#" class="action-item"
                                                    data-url="<?php echo e(route('faq.create', tenant('tenant_id'))); ?>"
                                                    data-ajax-popup="true" data-size="lg"
                                                    data-title="<?php echo e(__('Add FAQ')); ?>">
                                                    <i class="fas fa-plus"></i>
                                                    <span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                                                </a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th><?php echo e(__('Title')); ?></th>
                                                <th class="w-25"><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($faqs->count() > 0): ?>
                                                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($faq->title); ?></td>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#" class="action-item px-2"
                                                                    data-url="<?php echo e(route('faq.edit', [tenant('tenant_id'), $faq])); ?>"
                                                                    data-ajax-popup="true" data-size="lg"
                                                                    data-title="<?php echo e(__('Edit FAQ')); ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="#" class="action-item text-danger px-2"
                                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-faq-<?php echo e($faq->id); ?>').submit();">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                            <?php echo Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['faq.destroy', [tenant('tenant_id'), $faq->id]],
                                                                'id' => 'delete-faq-' . $faq->id,
                                                            ]); ?>

                                                            <?php echo Form::close(); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <th scope="col" colspan="2">
                                                        <h6 class="text-center"><?php echo e(__('No FAQ Found.')); ?></h6>
                                                    </th>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms) || tenant()->manage_news_posts): ?>
                    <div id="tabs-news-feed" class="tabs-card d-none">
                        <div class="card">
                            <div class="card-header actions-toolbar border-0">
                                <div class="actions-search" id="actions-news-search">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent"><i
                                                    class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-flush" id="customPage_keyword"
                                               placeholder="<?php echo e(__('Type keyword..')); ?>">
                                        <div class="input-group-append">
                                            <a href="#" class="input-group-text bg-transparent" data-action="search-close"
                                               data-target="#actions-news-search"><i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0"><?php echo e(__('Posts')); ?></h6>
                                    </div>
                                    <div class="col text-right">
                                        <div class="actions">
                                            <a href="#" class="action-item mr-2" data-action="search-open"
                                               data-target="#actions-news-search"><i class="fas fa-search"></i></a>
                                            <a href="#" data-url="<?php echo e(route('newsfeed.create', tenant('tenant_id'))); ?>"
                                               id="newsCreate" data-size="lg" data-ajax-popup="true"
                                               data-title="<?php echo e(__('Create New Post')); ?>" class="action-item">
                                                <i class="fas fa-plus"></i>
                                                <span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body pt-0 px-1 pb-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th><?php echo e(__('Title')); ?></th>
                                                <th><?php echo e(__('Published')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="news_feed_table">
                                            <?php if(count($newsfeeds) > 0): ?>
                                                <?php $__currentLoopData = $newsfeeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($post->title); ?></td>
                                                        <td><?php echo e(Utility::isDate($post->updated_at)); ?></td>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#" class="action-item px-2 "
                                                                   data-url="<?php echo e(route('newsfeed.edit', [tenant('tenant_id'), $post])); ?>"
                                                                   data-ajax-popup="true" data-size="lg"
                                                                   data-title="<?php echo e(__('Edit Post')); ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="#" class="action-item text-danger px-2"
                                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-news-<?php echo e($post->id); ?>').submit();">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                            <?php echo Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['newsfeed.destroy',[tenant('tenant_id'),$post->id]],
                                                                'id'=>'delete-news-'.$post->id
                                                            ]); ?>

                                                            <?php echo Form::close(); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <th scope="col" colspan="5">
                                                        <h6 class="text-center"><?php echo e(__('No Data Found.')); ?></h6>
                                                    </th>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            
            <?php if($packageConfigurations): ?>
                <?php $__currentLoopData = $packageConfigurations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pk => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $packageConfigurationTemplate = $pk . '::' . $v['template'];
                    ?>
                    <?php if(\View::exists($packageConfigurationTemplate)): ?>
                        <div id="<?php echo e((isset($v['tab_id']) && !empty($v['tab_id'])) ? $pk . '_' . $v['tab_id']: ''); ?>" class="tabs-card d-none">
                            <?php echo $__env->make($packageConfigurationTemplate, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
    <?php $__env->startPush('css'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/libs/bootstrap-iconpicker/css/bootstrap-iconpicker.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/libs/summernote/summernote-bs4.css')); ?>">
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('theme-script'); ?>
        <script src="<?php echo e(asset('assets/libs/summernote/summernote-bs4.js')); ?>"></script>
        <script type="text/javascript"
            src="<?php echo e(asset('assets/libs/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/form-step.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('script'); ?>
        <script src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>
        <script>
            // For Sidebar Tabs
            var sort = 'created_at-desc';

            var color_table_json = [];
            var color_data = "";
            var module_perms = <?php echo json_encode($modulePermsDefs, 15, 512) ?>;
            var module_assignments = <?php echo json_encode($permsAssignment, 15, 512) ?>;
            var checked_permissions = [];
            var unchecked_permissions = [];
            var fixed_min_top_height = <?php echo env('FIXED_MIN_TOP_CARD_HEIGHT'); ?>;
            var fixed_min_middle_height = <?php echo env('FIXED_MIN_MIDDLE_CARD_HEIGHT'); ?>;
            var fixed_min_bottom_height = <?php echo env('FIXED_MIN_BOTTOM_CARD_HEIGHT'); ?>;
            //console.log("module assignment", module_assignments);
            // console.log("module_perms", module_perms);
            // console.log("security group",  <?php echo json_encode($securityGroup, 15, 512) ?> );
            //console.log("userGroups",  <?php echo json_encode($userGroups, 15, 512) ?> );
            // console.log("userPerms",  <?php echo json_encode($userPerms, 15, 512) ?> );

            $(document).ready(function() {
                var tab = 'tabs-site-setting';
                if (<?php echo json_encode($permsAssignment, 15, 512) ?>.length > 0) {
                    checked_permissions = <?php echo json_encode($permsAssignment, 15, 512) ?>;
                }

                checkPermissions();

                <?php if(user()->account_type == 4): ?>
                    tab = 'site-setting-external-user'
                <?php endif; ?>

                <?php if($tab = Session::get('tab-status')): ?>
                    var tab = '<?php echo e($tab); ?>';
                <?php endif; ?>

                var nav_tab = '';

                <?php if($nav_tab = Session::get('nav-status')): ?>
                    var nav_tab = '<?php echo e($nav_tab); ?>';
                <?php endif; ?>

                <?php if(user()->account_type != 1): ?>
                    <?php if(in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms) &&  (in_array('FAQ_ALL_CONTENT', $userPerms)) ): ?>
                        <?php if($tab == 'faq'): ?>
                            tab = 'faq';
                        <?php elseif( $tab == 'help-center'): ?>
                            tab = 'help-center'
                        <?php else: ?>
                            tab = 'customPage-setting'
                        <?php endif; ?>

                    <?php elseif(in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms)): ?>
                        tab = 'customPage-setting'
                    <?php elseif(in_array('FAQ_ALL_CONTENT', $userPerms) && $tab !== 'faq'): ?>
                        tab = 'help-center'
                    <?php elseif(in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms) && $tab !== 'news-feed'): ?>
                        tab = 'news-feed'
                    <?php endif; ?>
                <?php endif; ?>

                //set value if there is one
                <?php if(Session::get('tab-status')): ?>
                    var tab = '<?php echo e($tab); ?>';
                <?php endif; ?>

                setTimeout(function() {
                    $("#tabs .list-group-list[data-href='#tabs-" + tab + "']").trigger("click");
                    if (nav_tab != '') {
                        $(".nav-item .nav-link[href='#" + nav_tab + "_navigation']").trigger("click");
                    }
                }, 10);

                <?php if(Session::has('success') && Session::has('id') && !empty(Session::get('id'))): ?>
                    show_toastr('Success', '<?php echo e(Session::get('success')); ?>', 'success');
                    $("#tabs-integrations").find("#<?php echo e(Session::get('id')); ?>").trigger("click");
                    <?php echo e(Session::forget('success')); ?>

                    <?php echo e(Session::forget('id')); ?>

                <?php endif; ?>

                $('.list-group-list').on('click', function() {
                    var href = $(this).attr('data-href');
                    $('.tabs-card').addClass('d-none');
                    $(href).removeClass('d-none');
                    $('#tabs .list-group-list').removeClass('text-primary');
                    $(this).addClass('text-primary');
                });
                // User Filter Data
                ajaxFilterUserList($('#user_tenant').val(), 'created_at-desc');
                if ($(".summernote-simple-sidebar").length) {
                    setTimeout(function() {
                        $(".summernote-simple-sidebar").summernote({
                            dialogsInBody: !0,
                            minHeight: 200,
                            toolbar: [
                                ['style', ['style', 'strikethrough']],
                                ["font", ["bold", "italic", "underline", "clear"]],
                                ['fontname', ['fontname']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ["para", ["ul", "ol", "paragraph"]],
                                ['insert', ['hr', 'link', 'picture']],
                                ['height', ['height']],
                                ['view', ['codeview']],
                            ]
                        });
                    }, 100);
                }

            });

            function checkPermissions() {
                var selected_group = $('select[name="group_name"]').val();
                var selected_module = $('select[name="module_name"]').val();
                $('input[name=permission_values]:checkbox').each(function() {
                    $(this).prop("checked", false);
                });

                Object.entries(module_assignments).forEach((assignment) => {
                    if (assignment[1].group_name == selected_group &&
                        assignment[1].module_name == selected_module) {
                        var checkboxId = module_perms[selected_module]['code'] + "_" + assignment[1].permission_key;
                        $('#' + checkboxId).prop("checked", true);
                    }
                })

            }

            <?php if(user()->account_type == 1): ?>
                // For Test Email Send
                $(document).on("click", '.send_email', function(e) {
                    e.preventDefault();
                    var title = $(this).attr('data-title');
                    var size = 'md';
                    var url = $(this).attr('data-url');
                    if (typeof url != 'undefined') {
                        $("#commonModal .modal-title").html(title);
                        $("#commonModal .modal-dialog").addClass('modal-' + size);
                        $("#commonModal").modal('show');
                        $.post(url, {
                            mail_driver: $("#mail_driver").val(),
                            mail_host: $("#mail_host").val(),
                            mail_port: $("#mail_port").val(),
                            mail_username: $("#mail_username").val(),
                            mail_password: $("#mail_password").val(),
                            mail_encryption: $("#mail_encryption").val(),
                            mail_from_address: $("#mail_from_address").val(),
                        }, function(data) {
                            $('#commonModal .modal-body').html(data);
                        });
                    }
                });
                $(document).on('submit', '#test_email', function(e) {
                    e.preventDefault();
                    $("#email_sanding").show();
                    var post = $(this).serialize();
                    var url = $(this).attr('action');
                    $.ajax({
                        type: "post",
                        url: url,
                        data: post,
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (data.is_success) {
                                $('#email').val('');
                                show_toastr('Success', data.message, 'success');
                            } else {
                                show_toastr('Error', data.message, 'error');
                            }
                            $("#email_sanding").hide();
                        }
                    });
                });
                // End Test Email
                // For Card Content Type Change
                $(document).on('change', '#content_type', function() {
                    getSource($(this).val());
                    renderColorTable();
                });
                var getLayoutSource = null;

                function getSource(content_type, source = '') {
                    if (content_type != '' && content_type != undefined) {
                        $('#data_source').empty();
                        getLayoutSource = $.ajax({
                            type: "POST",
                            url: '<?php echo e(route('layout.getsource', tenant('tenant_id'))); ?>',
                            data: {
                                content_type: content_type
                            },
                            cache: false,
                            beforeSend: function() {
                                if (getLayoutSource != null) {
                                    getLayoutSource.abort();
                                } else {
                                    $("#loader").show();
                                    $('#data-content').hide();
                                }
                            },
                            success: function(response, status, xhr) {
                                if (!xhr.responseJSON) {
                                    location.reload();
                                    return false;
                                }
                                if (response.is_success) {
                                    if (content_type == 'Content view' || content_type == 'Workflow view') {
                                        $('.eform_div').removeClass('d-none');
                                    } else if (!$('.eform_div').hasClass('d-none')) {
                                        $('.eform_div').addClass('d-none');
                                    }
                                    if (content_type == 'Line Chart') {
                                        $('.chart-dimensions').removeClass('d-none');
                                    } else if(!$('.chart-dimensions').hasClass('d-none')) {
                                        $('.chart-dimensions').addClass('d-none');
                                    }

                                    if (content_type == 'Horizontal bar Chart' || content_type ==
                                        'Vertical bar Chart' || content_type == 'Pie Chart') {
                                        $('.color-select-table').removeClass('d-none');
                                        $('.chart-dimensions').removeClass('d-none');
                                        $("#adv_config").val(JSON.stringify(
                                            color_table_json)); //empties out the color table json if not charts
                                    } else if (!$('.color-select-table').hasClass('d-none')) {
                                        $("#adv_config").val("");
                                        $('.color-select-table').addClass('d-none');
                                        $('.chart-dimensions').addClass('d-none');
                                    }

                                    if (content_type == 'Custom HTML') {
                                        $('.url_div').removeClass('d-none');
                                        $('.source_div').addClass('d-none');
                                    } else {
                                        if (!$('.url_div').hasClass('d-none')) {
                                            $('.source_div').removeClass('d-none');
                                            $('.url_div').addClass('d-none');
                                        }
                                        $('#data_source').empty();
                                        $.each(response.data, function(key, data) {
                                            var selected = ''
                                            if (source != '' && source != undefined && source == data) {
                                                selected = 'selected';
                                            }else if (content_type == 'Single Form' && (source != '' && source != undefined && source == key)) {
                                                selected = 'selected'; // single form is key = ID , value = Navigation Data Source Name
                                            }
                                            if (content_type == 'Integration' || content_type ==
                                                'Custom Page') {
                                                $("#data_source").append('<option value="' + data + '" ' +
                                                    selected + '>' + key + '</option>');
                                            } else if (content_type == 'Single Form' || content_type == 'Single Dashboard') {
                                                $("#data_source").append('<option value="' + key + '" ' +
                                                    selected + '>' + data + '</option>');
                                            } else {
                                                $("#data_source").append('<option value="' + data + '" ' +
                                                    selected + '>' + data + '</option>');
                                            }
                                        });
                                    }
                                } else {
                                    $('#data_source').empty();
                                    show_toastr('Error', response.message, 'error');
                                }
                            },
                            complete: function(data) {
                                // Hide image container
                                $("#loader").hide();
                                $('#data-content').show();
                                // Enabling list mode toggle button if Content View/Workflow view
                                let list_mode_toggle = $('#content_type').val();
                                if (list_mode_toggle === "Content view" || list_mode_toggle === "Workflow view") {
                                    $("#list_mode_toggle").css('display', 'block');
                                } else {
                                    $("#list_mode_toggle").css('display', 'none');
                                    $("#max_column_input").css('display', 'none');
                                }
                            }
                        });
                    } else {
                        show_toastr('Error', '<?php echo e(__('Content Type Not Found.')); ?>', 'error');
                        setTimeout(function() {
                            $("#commonModal").modal('toggle');
                        }, 300);
                    }
                }

                function renderColorTable(color_table = color_table_json) {
                    var color_url = $(".add-color-pointer").attr('data-url');
                    //for color table temporary
                    if (color_table.length != 0) {
                        $("#color-table-body").empty();
                        var td_html = ""
                        for (let [index, color_data] of color_table.entries()) {
                            td_html += ` <tr><td>
                                <span class="color-dot" style="background-color:${color_data.color} "></span>
                            </td>
                            <td >
                                ${color_data.value}
                            </td>
                            <td>
                                <div class="actions float-right">
                                    <a href="#" class="action-item color-data-edit" data-color="${color_data.color}" data-value="${color_data.value}" data-id="${color_data.id}" data-size="md" data-title="Edit Color Values"  data-url="${color_url}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="action-item text-danger color-data-delete" data-color="${color_data.color}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td></tr>`;
                        }
                        $("#color-table-body").append(td_html);
                        $("#adv_config").val(JSON.stringify(color_table_json));
                    } else {
                        $("#color-table-body").empty();
                        $("#adv_config").val("");
                    }
                } //renderColorTable
            <?php endif; ?>

            // User Filter With List
            var currentRequest = null;

            $('#user_tenant').on('change', function() {
                ajaxFilterUserList($(this).val(), sort, $('#user_keyword').val());
            });

            $(document).on('keyup', '#user_keyword', function() {
                ajaxFilterUserList($('#user_tenant').val(), sort, $(this).val());
            });

            // when change sorting order
            $('#refresh_userlist').on('click', function(e) {
                currentRequest = null;
                ajaxFilterUserList($('#user_tenant').val(), sort, $('#user_keyword').val());
            });

            $('#user_sort').on('click', 'a', function(e) {
                e.stopPropagation();
                sort = $(this).attr('data-val');
                ajaxFilterUserList($('#user_tenant').val(), sort, $('#user_keyword').val());
                $('#user_sort a').removeClass('active');
                $(this).addClass('active');
            });

            function ajaxFilterUserList(tenant_id, user_sort, keyword = '') {
                var mainEle = $('#user_list');
                var data = {
                    tenant_id: tenant_id,
                    sort: user_sort,
                    keyword: keyword,
                }
                currentRequest = $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('users.list', tenant('tenant_id'))); ?>',
                    data: data,
                    beforeSend: function() {
                        if (currentRequest != null) {
                            currentRequest.abort();
                        } else {
                            $("#userlist-loader").show();
                            $('#userlist-content').hide();
                        }
                    },
                    success: function(data, status, xhr) {
                        if (!xhr.responseJSON) {
                            location.reload();
                            return false;
                        }
                        mainEle.html(data.html);
                    },
                    complete: function(data) {
                        if (currentRequest != null) {
                            $("#userlist-loader").hide();
                            $('#userlist-content').show();
                        }
                    }
                });
            }

            // end
            <?php if(user()->account_type == 1): ?>
                $(document).on('change', 'input[name="sidebar_editor_style"]', function() {
                    var type = $('input[name="sidebar_editor_style"]:checked').val();
                    if (type == 'bg_color') {
                        $('.sidebar_bg_color').removeClass('d-none');
                        $('.sidebar_bg_gradiant').addClass('d-none');
                    } else if (type == 'bg_gradient') {
                        $('.sidebar_bg_color').addClass('d-none');
                        $('.sidebar_bg_gradiant').removeClass('d-none');
                    } else {
                        $('.sidebar_bg_color').addClass('d-none');
                        $('.sidebar_bg_gradiant').addClass('d-none');
                    }
                });

                $(document).on('change', 'input[name="banner_type"]', function() {
                    var bannerType = $('input[name="banner_type"]:checked').val();
                    if (bannerType == 'image') {
                        $('.banner_img').removeClass('d-none');
                    } else {
                        $('.banner_img').addClass('d-none');
                    }
                });

                // permissions check group name change
                $(document).on("change", '#group_name', function(e) {
                    checkPermissions();
                });


                // permissions setting at module change
                $(document).on("change", '#module_select_layout', function(e) {
                    var selected_module = $('select[name="module_name"]').val();

                    Object.entries(module_perms).forEach((module_name) => {
                        if (module_name[0] == selected_module) {
                            $('.selectors').addClass('d-none');
                            $('#permission-selector-' + module_name[1]['code']).removeClass('d-none');
                        }
                    })

                    checkPermissions();
                });


                // permission checkbox checker
                $(document).on("change", 'input[name=permission_values]', function(e) {
                    var type = "";
                    if ($(this).is(':checked')) {
                        console.log("Checkbox is checked..")
                        type = "checked";
                    } else {
                        console.log("Checkbox is not checked..")
                        type = "unchecked";
                    }
                    var perms_key = $(this).val();
                    var perms_level = $(this).attr('data-level');
                    populatePermissionChecker(perms_level, perms_key, type);
                });

                function populatePermissionChecker(perms_level, perms_key, type) {
                    var group_name = $('#group_name').val();
                    var module_name = $('#module_select_layout').val();
                    var obj = {
                        'group_name': group_name,
                        'module_name': module_name,
                        'permission_key': perms_key,
                        'permission_value': perms_level,
                    }

                    //check condition
                    if (type == "checked") {

                        //checks if it exists in uncheck
                        var uncheckPermsFilter = unchecked_permissions.filter(function(uncheck, idx) {
                            return !(uncheck.group_name == obj.group_name &&
                                uncheck.module_name == obj.module_name &&
                                uncheck.permission_key == obj.permission_key &&
                                uncheck.permission_value == obj.permission_value)
                        })

                        //if  its unchecked, it should  be removed or updated
                        if (uncheckPermsFilter.length > 0) {
                            unchecked_permissions = uncheckPermsFilter;
                        } else {
                            //only value in it
                            unchecked_permissions = [];
                        }


                        var otherPerms = [];
                        Object.entries(<?php echo json_encode($modulePermsDefs, 15, 512) ?>).forEach((perms) => {
                            //checking if there are other permissions assigned
                            //store only if more than 1
                            if (perms[0] == module_name && perms[1].results.length >= 1) {
                                otherPerms = perms[1];
                            }
                        });
                        //console.log("otherPerms", otherPerms)
                        if (otherPerms.length > 0) {
                            var permResults = otherPerms['results'];

                            if (permResults.length > 1) {

                                //sort by permission level
                                sortedPerms = permResults.sort((a, b) => a.permission_level - b.permission_level);

                                //get the index of the selected value
                                var foundIndex = sortedPerms.findIndex(el => el.permission_level == perms_level);

                                var slicedArray = sortedPerms.splice(foundIndex, sortedPerms.length);

                                slicedArray.forEach((p) => {
                                    if (p.permission_level != perms_level) {
                                        //checking anything under a certain permission hierarchy
                                        checked_permissions.push({
                                            'group_name': group_name,
                                            'module_name': p.module_name,
                                            'permission_key': p.permission_key,
                                            'permission_value': p.permission_level,
                                        });
                                        var checkboxId = otherPerms.code + "_" + p.permission_key;

                                        $('#' + checkboxId).prop("checked", true);
                                    }
                                });
                            }
                        }

                        checked_permissions.push(obj);

                    } else if (type == "unchecked") {

                        var checkfilteredArray = checked_permissions.filter(function(perm, idx) {
                            return !(perm.group_name == obj.group_name &&
                                perm.module_name == obj.module_name &&
                                perm.permission_key == obj.permission_key &&
                                perm.permission_value == obj.permission_value)
                        })

                        var modulesAssignmentsCheck = []

                        //check if it exists in DB
                        if (module_assignments.length > 0) {

                            modulesAssignmentsCheck = module_assignments.filter(function(perm, idx) {
                                return (perm.group_name == obj.group_name &&
                                    perm.module_name == obj.module_name &&
                                    perm.permission_key == obj.permission_key &&
                                    perm.permission_value == obj.permission_value)
                            })
                        }

                        //if it exists in checked permissions, update array
                        if (checkfilteredArray.length > 0) {
                            checked_permissions = checkfilteredArray;
                        } else if (checkfilteredArray.length == 0) {
                            checked_permissions = [];
                        }

                        //only push if its already exist in DB
                        if (modulesAssignmentsCheck.length > 0) {
                            unchecked_permissions.push(obj);
                        }

                    } //end if

                }

                // layout type checker
                $(document).on("change", 'input[name=fixed_layout]', function(e) {
                    var layout_chosen = $(this).val();

                    //fixed layout
                    if (layout_chosen == 1) {
                        $('#top_card_height').attr('disabled', false);
                        $('#middle_card_height').attr('disabled', false);
                        $('#bottom_card_height').attr('disabled', false);
                    } else {
                        //dynamic layout
                        $('#top_card_height').attr('disabled', true);
                        $('#middle_card_height').attr('disabled', true);
                        $('#bottom_card_height').attr('disabled', true);
                    }

                });

                //layout
                $(document).on('click', '.layout_selector', function(e) {
                    e.preventDefault();
                    var fixed_layout =  $("input[type='radio'][name='fixed_layout']:checked").val();
                    var title = $("#layout_navigation_title").val();
                    //console.log('fixed_layout', fixed_layout)

                    if(title){
                        if (fixed_layout > 0){
                            var top_card = $("#top_card_height").val();
                            var middle_card = $("#middle_card_height").val();
                            var bottom_card = $("#bottom_card_height").val();

                            if (top_card < 1){
                                show_toastr("Error", "Top card height is required for fixed layout.", "error");
                            }else if(middle_card < 1){
                                show_toastr("Error", "Middle card height is required for fixed layout.", "error");
                            }else if(bottom_card < 1){
                                show_toastr("Error", "Bottom card height is required for fixed layout.", "error");
                            }else if(top_card < fixed_min_top_height){
                                show_toastr("Error", "Minimum Top height is "+ fixed_min_top_height +"px.", "error");
                            }else if(middle_card < fixed_min_middle_height){
                                show_toastr("Error", "Minimum Middle height is "+ fixed_min_middle_height +"px.", "error");
                            }else if(bottom_card < fixed_min_bottom_height){
                                show_toastr("Error", "Minimum Bottom height is "+ fixed_min_bottom_height +"px.", "error");
                            }else{
                                $('#frm_navigation_store').submit();
                            }
                        }else{
                            $('#frm_navigation_store').submit();
                        }
                    }else{
                        show_toastr("Error", "Layout Title is required.", "error");
                    }
                });

                // Layout & Navigation Search
                $(document).on('keyup', '#layout_navigation_keyword', function() {
                    var value = $(this).val().toLowerCase();
                    $("#layout_navigation_table tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                // End

                // Custom Page Search
                $(document).on('keyup', '#customPage_keyword', function() {
                    var value = $(this).val().toLowerCase();
                    $("#custom_pages_table tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                // End

                var layoutNavigationId = 0;
                $('#layoutCreate, #layoutNavigationEdit').on('click', function() {
                    var attr = $(this).attr('data-id');
                    if (typeof attr !== typeof undefined && attr !== false) {
                        layoutNavigationId = attr;
                        loadLayoutNavigationView(layoutNavigationId);
                    } else {
                        layoutNavigationId = 0;
                        loadLayoutNavigationView(layoutNavigationId);
                    }
                });

                // Submit Layout
                var submitLayout = null;
                $(document).on('click', '#submit_layout', function(e) {
                    e.preventDefault();
                    var layout_data = $('#form_layout').serializeArray();
                    var height = 0;
                    var width = 0;
                    // for list mode and max column
                    let list_mode_toggle = $('#list_mode').is(':checked');
                    var list_mode = list_mode_toggle ? "on" : "off";
                    var max_column = $("#max_column").val();

                    //get the height and width
                    layout_data.forEach(function (object) {
                        if(object.name == "chart_height"){
                            height = parseInt(object.value);
                        }
                        if (object.name == "chart_width") {
                            width = parseInt(object.value);
                        }
                    });

                    layout_data.push({
                        name: 'layout_definition_id',
                        value: layoutNavigationId
                    });

                    var chart_dimensions = [{
                        'height': height ,
                        'width': width,
                    }];

                    var list_mode_settings = [{
                        'list_mode': list_mode,
                        'max_column': max_column
                    }]

                    //remake the adv config for the chart dimensions
                    layout_data.forEach(function (object) {
                        if(object.name == "adv_config"){
                            var color_table = object.value;
                            object.value = JSON.stringify({
                                'color_table' : color_table,
                                'chart_dimensions' : chart_dimensions,
                                'list_mode_settings' : list_mode_settings
                            });
                        }
                    });

                    submitLayout = $.ajax({
                        type: "POST",
                        url: $('#form_layout').attr('action'),
                        data: layout_data,
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (submitLayout != null) {
                                submitLayout.abort();
                            }
                            if (data.is_success == true) {
                                show_toastr('Success', data.message, 'success');
                            } else if (data.is_success == false) {
                                show_toastr('Error', data.message, 'error');
                            }
                        },
                        complete: function(data) {
                            var resp = data.responseJSON;
                            if (resp.is_success == true) {
                                if (submitLayout != null) {
                                    $('#commonModal2').modal('toggle');
                                    loadLayoutNavigationView(layoutNavigationId);
                                }
                            }
                        }
                    });
                });
                // End Submit Layout

                // Submit Navigation
                var submitNavigation = null;
                $(document).on('click', '#submit_navigation', function() {
                    var navigation_data = $('#form_navigation').serializeArray();
                    navigation_data.push({
                        name: 'layout_definition_id',
                        value: layoutNavigationId
                    });
                    submitNavigation = $.ajax({
                        type: "POST",
                        url: $('#form_navigation').attr('action'),
                        data: navigation_data,
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (submitNavigation != null) {
                                submitNavigation.abort();
                            }
                            if (data.is_success == true) {
                                show_toastr('Success', data.message, 'success');
                            } else if (data.is_success == false) {
                                show_toastr('Error', data.message, 'error');
                            }
                        },
                        complete: function(data) {
                            var resp = data.responseJSON;
                            if (resp.is_success != undefined && resp.is_success == true) {
                                if (submitNavigation != null) {
                                    $('#commonModal2').modal('toggle');
                                    loadLayoutNavigationView(layoutNavigationId, true);
                                }
                            }
                        }
                    });
                });
                // End Submit Navigation

                // Common Function for delete
                function deleteChildLayoutNavigation(url, is_true) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data:{
                            _method:"DELETE"
                        },
                        dataType: 'JSON',
                        cache: false,
                        success: function(response, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (!response.is_success) {
                                show_toastr('Error', response.message, 'error');
                            } else {
                                $('[id^=fire-modal]').modal('hide');
                                show_toastr('Success', response.message, 'success');
                            }
                        },
                        error: function(requestObject, error, errorThrown) {
                            console.log("error", error);
                            alert(errorThrown);
                        },
                        complete: function() {
                            loadLayoutNavigationView(layoutNavigationId, is_true);
                        }
                    });
                }

                // Common Function for GetView
                var loadNavigationLayout = null;

                function loadLayoutNavigationView(id = 0, layout = false) {
                    setTimeout(function() {
                        var userGroup = $('#user_group').val();
                        loadNavigationLayout = $.ajax({
                            type: "POST",
                            url: '<?php echo e(route('navigation_load.view', tenant('tenant_id'))); ?>',
                            data: {
                                userGroup: userGroup,
                                id: id
                            },
                            cache: false,
                            beforeSend: function() {
                                if (loadNavigationLayout != null) {
                                    loadNavigationLayout.abort();
                                } else {
                                    $("#layout-navigation-loader").removeClass('d-none');
                                    $('#layout-navigation-content').addClass('d-none');
                                }
                            },
                            success: function(response, status, xhr) {
                                if (!xhr.responseJSON) {
                                    location.reload();
                                    return false;
                                }
                                if (!response.is_success) {
                                    show_toastr('Error', response.message, 'error');
                                } else {
                                    $('#load_navigation_view').empty();
                                    $('#load_navigation_view').html(response.html);
                                    $('[id^=fire-modal]').remove();
                                    loadConfirm();
                                    setTimeout(function() {
                                        if (layout == true) {
                                            $("#load_navigation_view .nav-item .nav-link[href='#layout_navigation']")
                                                .trigger("click");
                                        }
                                    }, 150);
                                }
                            },
                            error: function(requestObject, error, errorThrown) {
                                alert(errorThrown);
                            },
                            complete: function() {
                                if (loadNavigationLayout != null) {
                                    $("#layout-navigation-loader").addClass('d-none');
                                    $('#layout-navigation-content').removeClass('d-none');
                                    loadSortable();
                                }
                            }
                        });
                    }, 200);
                }

                // Jquery That work in modal
                $('body').on('click', '.add_page_layout, .add_page_navigation', function() {
                    $('#commonModal2').on('shown.bs.modal', e => {
                        getSource($('#content_type').val());
                        color_data = $('#adv_config').val();
                        if (color_data !== "" && color_data !== undefined) {
                            color_table_json = JSON.parse(color_data);
                            renderColorTable(color_table_json);
                        }
                    });

                });

                let source
                $('body').on('click', '.edit_page_layout, .edit_navigation', function() {
                    source = $(this).attr('data-source');
                    $('#commonModal2').on('shown.bs.modal', e => {
                        getSource($('#content_type').val(), source);
                        color_data = $('#adv_config').val();
                        if (color_data !== "" && color_data !== undefined) {
                            color_table_json = JSON.parse(color_data);
                            renderColorTable(color_table_json);
                        }

                    });
                });

                // adding color to the color table
                $(document).on('click', '.add-color-pointer', function(e) {
                    //url that renders the UI
                    var url = $(this).attr('data-url');
                    e.preventDefault();
                    var title = $(this).attr('data-title');
                    if (typeof url != 'undefined') {
                        $("#commonModal3 .modal-title").html(title);
                        $("#commonModal3 .modal-dialog").addClass('modal-md');
                        $("#commonModal3").modal('show');
                        $.get(url, {}, function(data) {
                            $('#commonModal3 .modal-body').html(data);
                        });
                        return false;
                    } else {
                        show_toastr('Error', "Url is incorrect", 'error');
                    }
                });

                // editing a table row from color table
                $(document).on('click', 'a.color-data-edit', function(e) {
                    var url = $(this).attr('data-url');
                    var color = $(this).attr('data-color');
                    var value = $(this).attr('data-value');
                    var title = $(this).attr('data-title');
                    var color_id = $(this).attr('data-id');
                    e.preventDefault();
                    if (typeof url != 'undefined') {
                        $("#commonModal3 .modal-title").html(title);
                        $("#commonModal3 .modal-dialog").addClass('modal-md');
                        $("#commonModal3").modal('show');
                        $.get(url, {}, function(data) {
                            $('#commonModal3 .modal-body').html(data);
                        }).then((val) => {
                            $('#commonModal3 .modal-body #colorpicker').val(color);
                            $('#commonModal3 .modal-body #hexcolor').val(color);
                            $('#commonModal3 .modal-body #data_value').val(value);
                            $('#commonModal3 .modal-body #color_id').val(color_id);
                        });

                        return false;
                    } else {
                        show_toastr('Error', "Url is incorrect", 'error');
                    }

                });

                // removing a table row from color table
                $(document).on('click', 'a.color-data-delete', function(e) {
                    var color = $(this).attr('data-color');
                    console.log("delete color:", color);
                    color_table_json = color_table_json.filter(function(item) {
                        return item.color !== color;
                    });
                    //resetting the ids after removing them
                    if (color_table_json.length > 0) {
                        color_table_json = resetColorIds(color_table_json);
                    } else {
                        color_table_json = [];
                    }
                    //rerendering the table
                    renderColorTable(color_table_json);
                });


                $(document).on('click', '#submit_color_select', function(e) {
                    var hex_value = $('#commonModal3 .modal-body #hexcolor').val();
                    var data_value = $('#commonModal3 .modal-body #data_value').val();
                    var color_id = $('#commonModal3 .modal-body #color_id').val();
                    var reg = /^#([0-9a-f]{3}){1,2}$/i; //hexcode test

                    if (reg.test(hex_value) && data_value.length != 0) {
                        if (color_id && color_id > 0) {
                            $("#commonModal3").modal('hide');
                            color_table_json = color_table_json.map(obj => {
                                if (obj.id == color_id) {
                                    return {
                                        ...obj,
                                        "value": data_value,
                                        "color": hex_value
                                    };
                                }
                                return obj;
                            });
                            renderColorTable(color_table_json);
                        } else {
                            $("#commonModal3").modal('hide');
                            color_table_json.push({
                                "id": color_table_json.length + 1,
                                "value": data_value,
                                "color": hex_value
                            });
                            renderColorTable(color_table_json);
                        }
                    } else {
                        show_toastr('Error', "Data or Color values is incorrect or missing", 'error');
                    }
                });

                function resetColorIds(colorloop = color_table_json) {
                    colorloop = colorloop.map((obj, index) => {
                        return {
                            ...obj,
                            "id": index + 1,
                        };
                    });
                    return colorloop;
                }

                // function for Color picker
                $(document).on('input', '#colorpicker', function(e) {
                    $('#hexcolor').val(this.value);
                });
                $(document).on('input', '#hexcolor', function(e) {
                    $('#colorpicker').val(this.value);
                });

                // Function That Ajax and Update Layout Order
                function layoutOrder(ids) {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo e(route('layout.order', tenant('tenant_id'))); ?>',
                        data: {
                            ids: ids
                        },
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (!data.is_success) {
                                show_toastr('Error', data.message, 'error');
                            }
                        },
                        error: function(requestObject, error, errorThrown) {
                            alert(errorThrown);
                        },
                    });
                }

                // Function That Call Ajax and Update Navigation Order
                function navigationOrder(ids) {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo e(route('navigation.order', tenant('tenant_id'))); ?>',
                        data: {
                            ids: ids
                        },
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (!data.is_success) {
                                show_toastr('Error', data.message, 'error');
                            }
                        },
                        error: function(requestObject, error, errorThrown) {
                            alert(errorThrown);
                        },
                    });
                }

                $(document).on('click', '#create_tenant', function() {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo e(route('validate.tenant', tenant('tenant_id'))); ?>',
                        data: $('#frm_tenant').serialize(),
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            $('.modal .form-control').removeClass('is-invalid');
                            $('.modal .invalid-feedback').removeClass('d-block')
                            $('.modal .invalid-feedback').addClass('d-none');
                            if (data.is_success == true) {
                                $('#frm_tenant').submit();
                            } else {
                                $.each(data.errors, function(k, v) {
                                    $('#' + k).addClass('is-invalid');
                                    $('#' + k + '-invalid').html('');
                                    $('#' + k + '-invalid').removeClass('d-none');
                                    $('#' + k + '-invalid').addClass('d-block');
                                    $('#' + k + '-invalid').html(v);
                                });
                            }
                        }
                    });
                });
            <?php endif; ?>

            $(document).on('click', '#create_user', function() {
                $.ajax({
                    type: "POST",
                    url: '<?php echo e(route('validate.user', tenant('tenant_id'))); ?>',
                    data: $('#frm_create_user').serialize(),
                    cache: false,
                    success: function(data, status, xhr) {
                        if (!xhr.responseJSON) {
                            location.reload();
                            return false;
                        }
                        $('.modal .form-control').removeClass('is-invalid');
                        $('.modal .invalid-feedback').removeClass('d-block')
                        $('.modal .invalid-feedback').addClass('d-none');
                        if (data.is_success == true) {
                            $('#frm_create_user').submit();
                        } else {
                            $.each(data.errors, function(k, v) {
                                $('#' + k).addClass('is-invalid');
                                $('#' + k + '-invalid').html('');
                                $('#' + k + '-invalid').removeClass('d-none');
                                $('#' + k + '-invalid').addClass('d-block');
                                $('#' + k + '-invalid').html(v);
                            });
                        }
                    }
                });
            });

            <?php if(user()->account_type == 4): ?>
                $(document).on('change', 'input[name="banner_type"]', function() {
                    var bannerType = $('input[name="banner_type"]:checked').val();
                    if (bannerType == 'image') {
                        $('.banner_img').removeClass('d-none');
                    } else {
                        $('.banner_img').addClass('d-none');
                    }
                });
            <?php endif; ?>
            $(document).on('click', '#submit_permission', function(e) {
                e.preventDefault();
                var url = '<?php echo e(route('moduleAssignment.store.permissions', tenant('tenant_id'))); ?>';

                if (unchecked_permissions.length > 0 || checked_permissions.length > 0) {
                    // $('#checked_permissions').val(JSON.stringify(checked_permissions));
                    // $('#unchecked_permissions').val(JSON.stringify(unchecked_permissions));
                    // $('#module_assignments').val(JSON.stringify(module_assignments));
                    // $('#form_module_assignment').submit();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            checked_permissions: JSON.stringify(checked_permissions),
                            unchecked_permissions: JSON.stringify(unchecked_permissions),
                            module_assignments: JSON.stringify(module_assignments)
                        },
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (data.is_success){
                                module_assignments = data.permsAssignment;
                                show_toastr("Success", data.message, "success");
                            }else{
                                show_toastr("Error", data.message, "error");
                            }
                        }
                    });

                } else {
                    show_toastr("Error", "No changes in permissions has been set", "error");
                }

            });


            $(document).on('click', '#btn_edit_user', function(e) {
                e.preventDefault();

                var selected_user_id = $('#selected_user_id').val();
                var url = '<?php echo e(route('validate.user.edit', [tenant('tenant_id'), ' + selected_user_id + '])); ?>';

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#update_profile').serialize(),
                    cache: false,
                    success: function(data, status, xhr) {
                        if (!xhr.responseJSON) {
                            location.reload();
                            return false;
                        }
                        $('.modal .form-control').removeClass('is-invalid');
                        $('.modal .invalid-feedback').removeClass('d-block')
                        $('.modal .invalid-feedback').addClass('d-none');
                        if (data.is_success == true && data.validated == true) {
                            $('#update_profile').submit();
                            console.log('message', data.message)

                        } else if (data.is_success == false && data.validated == false) {
                            $.each(data.errors, function(k, v) {
                                $('#' + k).addClass('is-invalid');
                                $('#' + k + '-invalid').html('');
                                $('#' + k + '-invalid').removeClass('d-none');
                                $('#' + k + '-invalid').addClass('d-block');
                                $('#' + k + '-invalid').html(v);
                            });
                        } else if (data.is_success == false && data.validated == true) {
                            show_toastr('Error', data.message, 'error');
                        }

                    }
                });

            });


            var getSecurityGroups = null;

            function SecurityGroups(data, id = 0) {
                if (data != '' && data != undefined) {
                    getSecurityGroups = $.ajax({
                        type: "GET",
                        url: '<?php echo e(route('securitygroup', tenant('tenant_id'))); ?>',
                        data: {
                            id: id
                        },
                        cache: false,
                        beforeSend: function() {
                            if (getSecurityGroups != null) {
                                getSecurityGroups.abort();
                            } else {
                                $("#layout-security-loader").removeClass('d-none');
                                $('#security_group_div').hide();
                            }
                        },
                        success: function(response, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (response != null || response != '') {
                                $("#security_group_div").html('');
                                $("#security_group_div").css('height', "250px");
                                $("#security_group_div").css('overflow', "auto");
                                $.each(response, function(k, v) {
                                    var group_data = `
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="security_group[]" id="${v.GroupName}" value="${v.GroupName}" ${v.is_select == true ? 'checked' : ''}>
                                            <label class="custom-control-label form-control-label text-muted" for="${v.GroupName}">${v.GroupName}</label>
                                        </div>
                                    `;
                                    $("#security_group_div").append(group_data);
                                });
                            } else {
                                show_toastr('Error', '<?php echo e(__('Security groups not found.')); ?>', 'error');
                            }
                        },
                        complete: function(data) {
                            if (getSecurityGroups != null) {
                                $('#layout-security-loader').addClass('d-none');
                                $('#security_group_div').show();
                            }
                        }
                    });
                } else {
                    show_toastr('Error', '<?php echo e(__('Security groups not found.')); ?>', 'error');
                    setTimeout(function() {
                        $("#commonModal").modal('toggle');
                    }, 300);
                }
            }


            //for Newsfeeds
            function populateTenantsNewsfeeds(tenants, selected_tenants){
                var group_data  = '';
                $.each(tenants, function(k, v) {
                    group_data += `
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="selected_tenants[]" id="${v.tenant_id}" value="${v.tenant_id}" ${ selected_tenants.indexOf(v.tenant_id) != -1 ? 'checked' : ''}>
                            <label class="custom-control-label form-control-label text-muted" for="${v.tenant_id}">${v.company_name}</label>
                        </div>
                    `;

                });

                $('#tenant_news_div').html(group_data).show();

            }

            // REST Integration
            $('#integrationCreate,.integrationEdit').on('click', function() {
                var IntegrationId = 0;
                var attr = $(this).attr('data-id');
                var type = 'first';
                if (typeof attr !== typeof undefined && attr !== false) {
                    IntegrationId = attr;
                }
                loadConfigurationView(IntegrationId, type);
            });
            // Common Function for GetView for REST Integration Configuration
            var loadConfiguration = null;

            function loadConfigurationView(id = 0, type = '') {
                setTimeout(function() {
                    loadConfiguration = $.ajax({
                        type: "POST",
                        url: '<?php echo e(route('configuration_load.view', tenant('tenant_id'))); ?>',
                        data: {
                            id: id,
                            request_type: type
                        },
                        cache: false,
                        beforeSend: function() {
                            if (loadConfiguration != null) {
                                loadConfiguration.abort();
                            } else {
                                $("#configuration-loader").removeClass('d-none');
                                $('#configuration-content').addClass('d-none');
                            }
                        },
                        success: function(response, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (!response.is_success) {
                                show_toastr('Error', response.message, 'error');
                            } else {
                                if (type == 'first') {
                                    $('#load_auth_config').empty();
                                    $('#load_auth_config').html(response.html);
                                } else if (type == 'second') {
                                    $('#load_searchlist_config').empty();
                                    $('#load_searchlist_config').html(response.html);
                                } else if (type == 'third') {
                                    $('#load_sub_config').empty();
                                    $('#load_sub_config').html(response.html);
                                }
                                $('[id^=fire-modal]').remove();
                                loadConfirm();
                            }
                        },
                        error: function(requestObject, error, errorThrown) {
                            alert(errorThrown);
                        },
                        complete: function() {
                            if (loadConfiguration != null) {
                                $("#configuration-loader").addClass('d-none');
                                $('#configuration-content').removeClass('d-none');
                            }
                        }
                    });
                }, 200);
            }
        </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a)): ?>
<?php $component = $__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a; ?>
<?php unset($__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/ILINXEngage/resources/views/users/setting.blade.php ENDPATH**/ ?>