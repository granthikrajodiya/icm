<div class="row align-items-center">
    <div class="col">
        <ul class="nav nav-tabs nav-bordered mb-3">
            <li class="nav-item">
                <a href="#home_navigation" data-toggle="tab" aria-expanded="true" class="nav-link active">
                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                    <span class="d-lg-block"><?php echo e(__('Home Page Layout')); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#layout_navigation" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                    <span class="d-lg-block"><?php echo e(__('Navigation')); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#security" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                    <span class="d-lg-block"><?php echo e(__('Security')); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#properties" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                    <span class="d-lg-block"><?php echo e(__('Properties')); ?></span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="tab-content">
            <div class="tab-pane active show" id="home_navigation">
                <div class="row">
                    <div class="col-12 text-right pb-2">
                        <div class="actions">
                            <a class="action-item add_page_layout pointer" id="add_layout"
                               data-url="<?php echo e(route('layout.create',tenant('tenant_id'),)); ?>" data-ajax-popup2="true"
                               data-size="md" data-title="<?php echo e(__('Create New Home Page Card')); ?>">
                                <i class="fas fa-plus"></i>
                                <span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                            </a>
                        </div>
                    </div>
                </div>

                <?php if($layouts['top']->count() > 0 || $layouts['middle']->count() > 0 || $layouts['bottom']->count() > 0): ?>
                    <?php if($layouts['top']->count() > 0): ?>
                        <div class="row sortable_layout">
                            <?php $__currentLoopData = $layouts['top']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top_layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="<?php echo e($top_layout->returnClass()); ?> p-1 layout_div"
                                     data-id="<?php echo e($top_layout->id); ?>">
                                    <div class="card">
                                        <div class="card-body pt-0 px-3">
                                            <div class="row">
                                                <div class="col-6 text-left py-2">
                                                    <i class="fas fa-expand-arrows-alt cursor-grabbing"></i>
                                                </div>
                                                <div class="col-6 text-right px-0">
                                                    <div class="dropdown action-item">
                                                        <a class="action-item pointer" role="button"
                                                           data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item pointer edit_page_layout"
                                                               data-source="<?php echo e($top_layout->data_source); ?>"
                                                               data-url="<?php echo e(route('layout.edit', ['tenant' => tenant('tenant_id') , 'layout' => $top_layout->id])); ?>"
                                                               data-ajax-popup2="true" data-size="md"
                                                               data-title="<?php echo e(__('Edit Card')); ?>"><?php echo e(__('Edit')); ?></a>
                                                            <a class="dropdown-item pointer"
                                                               data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                               data-confirm-yes="deleteChildLayoutNavigation('<?php echo e(route('layout.destroy',[tenant('tenant_id'),$top_layout->id])); ?>');"><?php echo e(__('Delete')); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 overflow-hidden text-truncate">
                                                    <small class="cursor-grabbing"><b><?php echo e($top_layout->title); ?></b></small><br>
                                                    <small><?php echo e(__('Max Item : ').$top_layout->max_item); ?></small> <br>
                                                    <small><?php echo e(__('Source : ').$top_layout->data_source); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6><?php echo e(__('No Top Layout Found.')); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($layouts['middle']->count() > 0): ?>
                        <div class="row">
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($layouts['middle']->count() > 0): ?>
                        <div class="row sortable_layout">
                            <?php $__currentLoopData = $layouts['middle']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $middle_layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="<?php echo e($middle_layout->returnClass()); ?> col-3 p-1 layout_div" data-id="<?php echo e($middle_layout->id); ?>" >
                                    <div class="card">
                                        <div class="card-body pt-0 px-3">
                                            <div class="row">
                                                <div class="col-6 text-left py-2">
                                                    <i class="fas fa-expand-arrows-alt cursor-grabbing"></i>
                                                </div>
                                                <div class="col-6 text-right px-0">
                                                    <div class="dropdown action-item">
                                                        <a class="action-item pointer" role="button"
                                                           data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item pointer edit_page_layout"
                                                               data-source="<?php echo e($middle_layout->data_source); ?>"
                                                               data-url="<?php echo e(route('layout.edit',[tenant('tenant_id'),$middle_layout->id])); ?>"
                                                               data-ajax-popup2="true" data-size="md"
                                                               data-title="<?php echo e(__('Edit Card')); ?>"><?php echo e(__('Edit')); ?></a>
                                                            <a class="dropdown-item pointer"
                                                               data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                               data-confirm-yes="deleteChildLayoutNavigation('<?php echo e(route('layout.destroy',[tenant('tenant_id'),$middle_layout->id])); ?>');"><?php echo e(__('Delete')); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 overflow-hidden text-truncate">
                                                    <small
                                                            class="cursor-grabbing"><b><?php echo e($middle_layout->title); ?></b></small><br>
                                                    <small><?php echo e(__('Max Item : ').$middle_layout->max_item); ?></small> <br>
                                                    <small><?php echo e(__('Source : ').$middle_layout->data_source); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6><?php echo e(__('No Middle Layout Found.')); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($layouts['bottom']->count() > 0): ?>
                        <div class="row">
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($layouts['bottom']->count() > 0): ?>
                        <div class="row sortable_layout">
                            <?php $__currentLoopData = $layouts['bottom']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bottom_layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="<?php echo e($bottom_layout->returnClass()); ?> p-1 layout_div" data-id="<?php echo e($bottom_layout->id); ?>">
                                    <div class="card">
                                        <div class="card-body pt-0 px-3">
                                            <div class="row">
                                                <div class="col-6 text-left py-2">
                                                    <i class="fas fa-expand-arrows-alt cursor-grabbing"></i>
                                                </div>
                                                <div class="col-6 text-right px-0">
                                                    <div class="dropdown action-item">
                                                        <a class="action-item pointer" role="button"
                                                           data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item pointer edit_page_layout"
                                                               data-source="<?php echo e($bottom_layout->data_source); ?>"
                                                               data-url="<?php echo e(route('layout.edit',[tenant('tenant_id'),$bottom_layout->id])); ?>"
                                                               data-ajax-popup2="true" data-size="md"
                                                               data-title="<?php echo e(__('Edit Card')); ?>"><?php echo e(__('Edit')); ?></a>
                                                            <a class="dropdown-item pointer"
                                                               data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                               data-confirm-yes="deleteChildLayoutNavigation('<?php echo e(route('layout.destroy',[tenant('tenant_id'),$bottom_layout->id])); ?>');"><?php echo e(__('Delete')); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 overflow-hidden text-truncate">
                                                    <small
                                                            class="cursor-grabbing"><b><?php echo e($bottom_layout->title); ?></b></small><br>
                                                    <small><?php echo e(__('Max Item : ').$bottom_layout->max_item); ?></small> <br>
                                                    <small><?php echo e(__('Source : ').$bottom_layout->data_source); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6><?php echo e(__('No Bottom Layout Found.')); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6><?php echo e(__('No data found.')); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="tab-pane" id="layout_navigation">
                <div class="row">
                    <div class="col-12 text-right pb-2">
                        <div class="actions">
                            <a class="action-item add_page_navigation pointer"
                               data-url="<?php echo e(route('navigation.create',tenant('tenant_id'))); ?>" data-ajax-popup2="true"
                               data-size="md" data-title="<?php echo e(__('Create New Navigation Element')); ?>">
                                <i class="fas fa-plus"></i>
                                <span class="d-sm-inline-block"><?php echo e(__('Add')); ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(__('Title')); ?></th>
                                    <th><?php echo e(__('Nav Panel')); ?></th>
                                    <th><?php echo e(__('Top Menus')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody class="sortable_navigation">
                                <?php if($navigations->count() > 0): ?>
                                    <?php $__currentLoopData = $navigations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navigation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr data-id="<?php echo e($navigation->id); ?>" class="navigation_div">
                                            <td class="w-25 cursor-grabbing"><?php echo e($navigation->title); ?></td>
                                            <td class="w-25"><i
                                                        class="fas fa-<?php echo e(($navigation->show_nav_menu == 1) ? 'check' : ''); ?> text-success"></i>
                                            </td>
                                            <td class="w-25"><i
                                                        class="fas fa-<?php echo e(($navigation->show_top_menu == 1) ? 'check' : ''); ?> text-success"></i>
                                            </td>
                                            <td class="w-25">
                                                <div class="actions">
                                                    <i class="fas fa-expand-arrows-alt cursor-grabbing px-2"></i>
                                                    <a class="action-item pointer px-2 edit_navigation"
                                                       data-source="<?php echo e($navigation->data_source); ?>"
                                                       data-url="<?php echo e(route('navigation.edit',[tenant('tenant_id'),$navigation])); ?>"
                                                       data-ajax-popup2="true" data-size="md"
                                                       data-title="<?php echo e(__('Edit Navigation')); ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="action-item pointer text-danger px-2"
                                                       data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                       data-confirm-yes="deleteChildLayoutNavigation('<?php echo e(route('navigation.destroy',[tenant('tenant_id'),$navigation->id])); ?>',true);">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <th scope="col" colspan="4"><h6
                                                    class="text-center"><?php echo e(__('No Navigation elements defined.')); ?></h6>
                                        </th>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="security">
                <div class="row">
                    <div class="col-12 pl-5">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="all_user_groups" value="all_user_groups"
                                   <?php echo e(!isset($selectedSecurityGroups)  ? 'checked' : ''); ?> name="user_groups_type"
                                   class="custom-control-input">
                            <label class="custom-control-label"
                                   for="all_user_groups"><?php echo e(__('All user groups can access this layout.')); ?></label>
                        </div>
                    </div>
                    <div class="col-12 pl-5">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="selected_user_groups" value="selected_user_groups"
                                   <?php echo e(isset($selectedSecurityGroups)  ? 'checked' : ''); ?> name="user_groups_type"
                                   class="custom-control-input">
                            <label class="custom-control-label"
                                   for="selected_user_groups"><?php echo e(__('Only users within the selected groups can access this layout')); ?></label>
                        </div>
                        <div id='layout-security-loader' class="min-h-250 d-none">
                            <img src="<?php echo e(asset('assets/img/loading.gif')); ?>" height="50px" width="50px" class="loading"
                                 alt="">
                        </div>
                        <div class="pl-5 py-2" id="security_group_div">

                        </div>
                        <div class="text-right pt-3">
                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['sm' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Update')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','sm' => true,'secondary' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-dismiss' => 'modal']); ?><?php echo e(__('Close')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="properties">
                <div class="row">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'name' => 'title','containerClass' => 'col-8','value' => $layout->title ?? '','id' => 'layout_navigation_title','maxlength' => 100]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'title','container-class' => 'col-8','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layout->title ?? ''),'id' => 'layout_navigation_title','maxlength' => 100]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'user_group','containerClass' => 'col-4','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user_group','container-class' => 'col-4','required' => true]); ?>
                        <?php $__currentLoopData = $userGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value); ?>" <?php if($value == $layoutDefinition->user_group): ?> selected <?php endif; ?>>
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

                <div class="col-12 pb-5">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.radio','data' => ['id' => 'customRadio13','name' => 'navigation_layout','value' => ''.\App\Models\LayoutDefinition::NAVIGATION_LAYOUT_GRID.'','label' => 'Navigation Grid','checked' => $layoutDefinition->navigation_layout == \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_GRID  ?? '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.radio'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'customRadio13','name' => 'navigation_layout','value' => ''.\App\Models\LayoutDefinition::NAVIGATION_LAYOUT_GRID.'','label' => 'Navigation Grid','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layoutDefinition->navigation_layout == \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_GRID  ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.radio','data' => ['id' => 'customRadio14','name' => 'navigation_layout','value' => ''.\App\Models\LayoutDefinition::NAVIGATION_LAYOUT_LIST.'','label' => 'Navigation List','checked' => $layoutDefinition->navigation_layout == \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_LIST  ?? '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.radio'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'customRadio14','name' => 'navigation_layout','value' => ''.\App\Models\LayoutDefinition::NAVIGATION_LAYOUT_LIST.'','label' => 'Navigation List','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layoutDefinition->navigation_layout == \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_LIST  ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>

                <div class="col-12 pb-3">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.radio','data' => ['id' => 'customRadio3','name' => 'fixed_layout','value' => '0','label' => 'Dynamic Home Page Layout','checked' => $layoutDefinition->fixed_layout == 0 ?? '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.radio'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'customRadio3','name' => 'fixed_layout','value' => '0','label' => 'Dynamic Home Page Layout','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layoutDefinition->fixed_layout == 0 ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.radio','data' => ['id' => 'customRadio4','name' => 'fixed_layout','value' => '1','label' => 'Fixed Home Page Layout','checked' => $layoutDefinition->fixed_layout == 1 ?? '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.radio'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'customRadio4','name' => 'fixed_layout','value' => '1','label' => 'Fixed Home Page Layout','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layoutDefinition->fixed_layout == 1 ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>

                <div class="row">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['type' => 'number','name' => 'top_card_height','id' => 'top_card_height','default' => ''.e(env('FIXED_MIN_TOP_CARD_HEIGHT')).'','value' => ''.e($layoutDefinition->top_card_height ?? env('FIXED_MIN_TOP_CARD_HEIGHT')).'','label' => ''.e('Top Card Height (px)').'','containerClass' => 'col-4','disabled' => $layoutDefinition->fixed_layout == 0 ?? '','min' => ''.e(env('FIXED_MIN_TOP_CARD_HEIGHT')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'top_card_height','id' => 'top_card_height','default' => ''.e(env('FIXED_MIN_TOP_CARD_HEIGHT')).'','value' => ''.e($layoutDefinition->top_card_height ?? env('FIXED_MIN_TOP_CARD_HEIGHT')).'','label' => ''.e('Top Card Height (px)').'','container-class' => 'col-4','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layoutDefinition->fixed_layout == 0 ?? ''),'min' => ''.e(env('FIXED_MIN_TOP_CARD_HEIGHT')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['type' => 'number','name' => 'middle_card_height','id' => 'middle_card_height','default' => ''.e(env('FIXED_MIN_MIDDLE_CARD_HEIGHT')).'','value' => ''.e($layoutDefinition->middle_card_height  ?? env('FIXED_MIN_MIDDLE_CARD_HEIGHT')).'','label' => ''.e('Middle Card Height (px)').'','containerClass' => 'col-4','disabled' => $layoutDefinition->fixed_layout == 0 ?? '','min' => ''.e(env('FIXED_MIN_MIDDLE_CARD_HEIGHT')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'middle_card_height','id' => 'middle_card_height','default' => ''.e(env('FIXED_MIN_MIDDLE_CARD_HEIGHT')).'','value' => ''.e($layoutDefinition->middle_card_height  ?? env('FIXED_MIN_MIDDLE_CARD_HEIGHT')).'','label' => ''.e('Middle Card Height (px)').'','container-class' => 'col-4','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layoutDefinition->fixed_layout == 0 ?? ''),'min' => ''.e(env('FIXED_MIN_MIDDLE_CARD_HEIGHT')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['type' => 'number','name' => 'bottom_card_height','id' => 'bottom_card_height','default' => ''.e(env('FIXED_MIN_BOTTOM_CARD_HEIGHT')).'','min' => ''.e(env('FIXED_MIN_BOTTOM_CARD_HEIGHT')).'','value' => ''.e($layoutDefinition->bottom_card_height ??  env('FIXED_MIN_BOTTOM_CARD_HEIGHT')).'','label' => ''.e('Bottom Card Height (px)').'','containerClass' => 'col-4','disabled' => $layoutDefinition->fixed_layout == 0 ?? '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'bottom_card_height','id' => 'bottom_card_height','default' => ''.e(env('FIXED_MIN_BOTTOM_CARD_HEIGHT')).'','min' => ''.e(env('FIXED_MIN_BOTTOM_CARD_HEIGHT')).'','value' => ''.e($layoutDefinition->bottom_card_height ??  env('FIXED_MIN_BOTTOM_CARD_HEIGHT')).'','label' => ''.e('Bottom Card Height (px)').'','container-class' => 'col-4','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layoutDefinition->fixed_layout == 0 ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>

                <div class="text-right pt-3">
                    <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'submit','sm' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'layout_selector']); ?><?php echo e(__('Update')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','sm' => true,'secondary' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-dismiss' => 'modal']); ?><?php echo e(__('Close')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('change', 'input[name="user_groups_type"]', function () {
        const userGroup = $('#user_group').val();
        if ($(this).val() == "selected_user_groups") {
            return SecurityGroups(userGroup, "<?php echo e($id); ?>");
        }

        $('#security_group_div').empty().hide();
    });
    $(document).ready(function () {
        const userGroup = $('input[name="user_groups_type"]:checked').val();
        if (userGroup == "selected_user_groups") {
            SecurityGroups(1, "<?php echo e($id); ?>");
        }
    })
</script>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/ILINXEngage/resources/views/layout_navigation/load_layout.blade.php ENDPATH**/ ?>