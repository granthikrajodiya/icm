<?php $__env->startPush('css'); ?>


<?php $__env->stopPush(); ?>
<?php $__env->startPush('theme-script'); ?>
    <script src="<?php echo e(asset('assets/js/chart.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<div class="row">
    <?php /** @var \App\Models\Layout $top */ ?>
    <?php $__currentLoopData = $layouts['top']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(str_contains($top->content_type, '[package_layout]')): ?>
            <?php
                $cartTemplate = '';
                $packageLayout = config('package-layout');
                if ($packageLayout) {
                    $contentTypeArr = explode('.', $top->content_type);
                    if (isset($packageLayout[$contentTypeArr[1]]) && !empty($packageLayout[$contentTypeArr[1]])) {
                        $templateName = $packageLayout[$contentTypeArr[1]][$contentTypeArr[2]]['template'];
                        $cartTemplate = $contentTypeArr[1] . '::' . $templateName;
                    }
                }
            ?>
            <?php if($cartTemplate): ?>
                <?php if(\View::exists($cartTemplate)): ?>
                    <?php echo $__env->make($cartTemplate, [
                        'title' => $top->title,
                         'class' => $top->returnClass(),
                         'plural_item' => $top->plural_item,
                         'single_item' => $top->single_item,
                         'max_item' => $top->max_item,
                         'data_source' => $top->data_source,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($top->content_type == 'Documents'): ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($top->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($top->getResult())); ?> <?php echo e((count($top->getResult()) == 0 || count($top->getResult()) > 1) ? $top->plural_item : $top->single_item); ?></span>
                            </div>
                            <span class="badge badge-xs badge-success"><?php echo e(Utility::newCount($top->getResult())); ?></span>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php $__empty_1 = true; $__currentLoopData = $top->getResult(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc_response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($top->max_item >= $loop->iteration): ?>
                                <?php
                                    $doc_icon = Utility::GetDocProp($doc_response,'Icon');
                                    $doc_icon = !empty($doc_icon) ? $doc_icon : 'fa fa-file-text-o';
                                ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="<?php echo e($doc_icon); ?>" aria-hidden="true"></i>
                                            </div>
                                            <div class="col ml-n2">
                                                <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                    <h6 class="text-sm mb-0">
                                                        <a href="<?php echo e(route('docs.view',[tenant('tenant_id'),$doc_response->DocID])); ?>"><?php echo e(Utility::isDate(Utility::GetDocProp($doc_response,'Title'))); ?></a>
                                                    </h6>
                                                <?php endif; ?>
                                                <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                    <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate(Utility::GetDocProp($doc_response,'Subtitle'))); ?></p>
                                                <?php endif; ?>
                                                <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                    <span
                                                        class="card-text text-xs"><?php echo e(Utility::isDate(Utility::GetDocProp($doc_response,'Excerpt'))); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-12 text-right">
                                                <span
                                                    class="badge badge-xs <?php echo e(Utility::GetDocProp($doc_response,'badge-class')); ?>"><?php echo e(Utility::GetDocProp($doc_response,'Status')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php break; ?>;
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('No Available ') . $top->plural_item); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('docs.index',[tenant('tenant_id'),$top->data_source])); ?>"
                           class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($top->content_type == 'Child Workflows'): ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($top->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($top->getResult())); ?> <?php echo e((count($top->getResult()) == 0 || count($top->getResult()) > 1) ? $top->plural_item : $top->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php $__empty_1 = true; $__currentLoopData = $top->getResult(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($top->max_item >= $loop->iteration): ?>
                                <?php
                                    $columnArray = $row->ColumnValues;
                                    $icon = Utility::GetTableRowColumnValue($columnArray,'Icon');
                                    $icon = !empty($icon) ? $icon : 'fa fa-file-text-o';
                                ?>
                                <?php if(!empty(Utility::GetTableRowColumnValue($columnArray,'Title'))): ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="<?php echo e($icon); ?>" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">
                                                    <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                        <h6 class="text-sm mb-0">
                                                            <a href="<?php echo e(route('batch.form.detail',[tenant('tenant_id'),$top->content_type,Utility::GetTableRowColumnValue($columnArray,'Title')])); ?>"><?php echo e(Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Title'))); ?></a>
                                                        </h6>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                        <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Subtitle'))); ?></p>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                        <span
                                                            class="card-text text-xs"><?php echo e(Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Excerpt'))); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-12 text-right">
                                                    <span
                                                        class="badge badge-xs <?php echo e(Utility::GetTableRowColumnValue($columnArray,'badge-class')); ?>"><?php echo e(Utility::GetTableRowColumnValue($columnArray,'Status')); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php break; ?>;
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('No Available ') . $top->plural_item); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('batch.detail',[tenant('tenant_id'),$top->data_source])); ?>"
                           class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($top->content_type == 'Workflow view'): ?>
            <?php
                $workflow_views = $top->getResult();
                $adv_config = json_decode($top->adv_config);
            ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($top->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($workflow_views['details'])); ?> <?php echo e((count($workflow_views['details']) == 0 || count($workflow_views['details']) > 1) ? $top->plural_item : $top->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on"): ?>
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        <?php for($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++): ?>
                                            <th class="pointer text-dark">
                                                <?php echo e((isset($workflow_views['titles'][$i]) ? Str::title($workflow_views['titles'][$i]) : '')); ?>

                                            </th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    <?php if($workflow_views['is_success'] == true): ?>
                                        <?php $__empty_1 = true; $__currentLoopData = $workflow_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workflow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php if($top->max_item >= $loop->iteration): ?>
                                                <?php
                                                    if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                                    {
                                                        $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($top->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                    else
                                                    {
                                                        $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($top->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                ?>
                                                <tr>
                                                    <?php
                                                        $first_column = true;
                                                    ?>
                                                    <?php for($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++): ?>
                                                        <td>
                                                            <?php if($first_column): ?>
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '')); ?></a>
                                                                <?php echo e($first_column = false); ?>

                                                            <?php else: ?>
                                                                <?php echo e((!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '')); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endfor; ?>
                                                </tr>
                                            <?php else: ?>
                                                <?php break; ?>;
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                <?php echo e(__('No Available ') . $top->plural_item); ?>

                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('An error occurred retrieving the list of ') . $top->plural_item . '. ' . __('Please contact your system administrator and reference error: ')); ?>

                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    
                    <?php else: ?>
                        <div class="card-wrapper p-3">
                            <?php if($workflow_views['is_success'] == true): ?>
                                <?php $__empty_1 = true; $__currentLoopData = $workflow_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workflow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php if($top->max_item >= $loop->iteration): ?>
                                        <?php
                                            if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                            {
                                                $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($top->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                            else
                                            {
                                                $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($top->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                        ?>
                                        <div class="card mb-2 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col ml-n2">
                                                        <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                            <h6 class="text-sm mb-0">
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty($workflow[$workflow_views['titles'][2]]) ? Utility::isDate($workflow[$workflow_views['titles'][2]]) : '')); ?></a>
                                                            </h6>
                                                        <?php endif; ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                            <?php if(isset($workflow[$workflow_views['titles'][3]]) && !empty($workflow[$workflow_views['titles'][3]])): ?>
                                                                <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate($workflow[$workflow_views['titles'][3]])); ?></p>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                            <?php if(isset($workflow[$workflow_views['titles'][4]]) && !empty($workflow[$workflow_views['titles'][4]])): ?>
                                                                <span
                                                                    class="card-text text-xs"><?php echo e(Utility::isDate($workflow[$workflow_views['titles'][4]])); ?></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php if(in_array('Status',$workflow_views['titles']) == true): ?>
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4 <?php echo e((!in_array($workflow['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : ''); ?>"
                                                                <?php if(in_array($workflow['Status'],array_keys(config('statuscolor')))): ?> style="background-color: <?php echo e(config('statuscolor.'.$workflow['Status'])); ?>"<?php endif; ?>
                                                                >
                                                                <?php echo e($workflow['Status']); ?>

                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(in_array('Progress',$workflow_views['titles']) == true): ?>
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            <span class="completion mr-2"><small><?php echo e($workflow['Progress']); ?>%</small></span>
                                                            <?php
                                                                $progressColor = "";

                                                                if ($workflow['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($workflow['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($workflow['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $topWidth = $top->returnClass();

                                                                if ($topWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            ?>
                                                            <div>
                                                                <div class="progress progress-xs" style="width: <?php echo e($progressBarWidth); ?>">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($workflow['Progress']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($workflow['Progress']); ?>%; background-color: <?php echo e($progressColor); ?>;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php break; ?>;
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('No Available ') . $top->plural_item); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    <?php echo e(__('An error occurred retrieving').' '.$top->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-footer py-2 row footer-row">
                        <?php if(!empty($top->eform_url)): ?>
                            <div class="col text-left">
                                <a href="<?php echo e(route('eforms.view',[tenant('tenant_id'),$top->id])); ?>"
                                   class="text-sm text-primary font-weight-bold"><?php echo e(__('New..')); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="col <?php echo e((!empty($top->eform_url)) ? 'text-right' : 'text-center'); ?>">
                            <a href="<?php echo e(route('tasks.index',[tenant('tenant_id')])); ?>"
                               class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($top->content_type == 'Content view'): ?>
            <?php
                $content_views = $top->getResult();
                $adv_config = json_decode($top->adv_config);
            ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($top->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($content_views['details'])); ?> <?php echo e((count($content_views['details']) == 0 || count($content_views['details']) > 1) ? $top->plural_item : $top->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on"): ?>
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        <?php for($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++): ?>
                                            <th class="pointer text-dark">
                                                <?php echo e((isset($content_views['titles'][$i]) ? Str::title($content_views['titles'][$i]) : '')); ?>

                                            </th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    <?php if($content_views['is_success'] == true): ?>
                                        <?php $__empty_1 = true; $__currentLoopData = $content_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php if($top->max_item >= $loop->iteration): ?>
                                                <?php if(isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID'])): ?>
                                                    <?php
                                                        $appName = $content_view['ICS_AppName'];
                                                        $docId = $content_view['ICS_DocumentID'];
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $top->data_source.'~'.array_values($content_view)[0];
                                                        $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                                    ?>
                                                <?php else: ?>
                                                    <?php
                                                        $appName = '';
                                                        $docId = '';
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $top->data_source.'~'.array_values($content_view)[0];
                                                        $url = 'javascript:void(0)';
                                                    ?>
                                                <?php endif; ?>
                                                
                                                <tr>
                                                    <?php
                                                        $first_column = true;
                                                    ?>
                                                    <?php for($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++): ?>
                                                        <td>
                                                            <?php if($first_column): ?>
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '')); ?></a>
                                                                <?php echo e($first_column = false); ?>

                                                            <?php else: ?>
                                                                <?php echo e((!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '')); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endfor; ?>
                                                </tr>
                                            <?php else: ?>
                                                <?php break; ?>;
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                <?php echo e(__('No Available ') . $top->plural_item); ?>

                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('An error occurred retrieving the list of ') . $top->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']); ?>

                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    
                    <?php else: ?>
                        <div class="card-wrapper p-3">
                            <?php if($content_views['is_success'] == true): ?>
                                <?php $__empty_1 = true; $__currentLoopData = $content_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php if($top->max_item >= $loop->iteration): ?>
                                        <?php if(isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID'])): ?>
                                            <?php
                                                $appName = $content_view['ICS_AppName'];
                                                $docId = $content_view['ICS_DocumentID'];
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $top->data_source.'~'.array_values($content_view)[0];
                                                $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                            ?>
                                        <?php else: ?>
                                            <?php
                                                $appName = '';
                                                $docId = '';
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $top->data_source.'~'.array_values($content_view)[0];
                                                $url = 'javascript:void(0)';
                                            ?>
                                        <?php endif; ?>

                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-file" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col ml-n2">
                                                        <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                            <h6 class="text-sm mb-0">
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty($content_view[$content_views['titles'][0]]) ? Utility::isDate($content_view[$content_views['titles'][0]]) : '')); ?></a>
                                                            </h6>
                                                        <?php endif; ?>
                                                        <?php if(count($content_views['titles']) >= 3): ?>
                                                            <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                                <p class="card-text small text-muted mb-0"><?php echo e((!empty($content_view[$content_views['titles'][1]]) ? Utility::isDate($content_view[$content_views['titles'][1]]) : '')); ?></p>
                                                            <?php endif; ?>
                                                            <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                                <span
                                                                    class="card-text text-xs"><?php echo e((!empty($content_view[$content_views['titles'][2]]) ? Utility::isDate($content_view[$content_views['titles'][2]]) : '')); ?></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php if(array_key_exists('Status', $content_view) == true): ?>
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4 <?php echo e((!in_array($content_view['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : ''); ?>"
                                                                <?php if(in_array($content_view['Status'],array_keys(config('statuscolor')))): ?> style="background-color: <?php echo e(config('statuscolor.'.$content_view['Status'])); ?>"<?php endif; ?>
                                                                >
                                                                <?php echo e($content_view['Status']); ?>

                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(array_key_exists('Progress', $content_view) == true): ?>
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            <?php
                                                                $progressValue = $content_view['Progress'] == NULL ? "0" : $content_view['Progress'];

                                                                $progressColor = "";

                                                                if ($content_view['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($content_view['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($content_view['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $topWidth = $top->returnClass();

                                                                if ($topWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            ?>
                                                            <span class="completion mr-2"><small><?php echo e($progressValue); ?>%</small></span>
                                                            <div>
                                                                <div class="progress progress-xs" style="width: <?php echo e($progressBarWidth); ?>">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($content_view['Progress']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($content_view['Progress']); ?>%; background-color: <?php echo e($progressColor); ?>;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php break; ?>;
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('No Available ') . $top->plural_item); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving the list of ') . $top->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-footer py-2 row footer-row">
                        <?php if(!empty($top->eform_url)): ?>
                            <div class="col text-left">
                                <a href="<?php echo e(route('eforms.view',[tenant('tenant_id'),$top->id])); ?>"
                                   class="text-sm text-primary font-weight-bold"><?php echo e(__('New..')); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="col <?php echo e((!empty($top->eform_url)) ? 'text-right' : 'text-center'); ?>">
                            <a href="<?php echo e(route('folder.index',[tenant('tenant_id')])); ?>"
                            class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($top->content_type == 'Notifications'): ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Notifications')); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php if(user()->getUnreadNotification()->count() > 0): ?>
                            <?php $__currentLoopData = user()->getUnreadNotification(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($top->max_item >= $loop->iteration): ?>
                                    <div class="list-group-item list-group-item-action">
                                        
                                            
                                        <?php if($notification->created_at > user()->last_login_at  && $notification->created_at > user()->notifications_read): ?>
                                            <small
                                                class="float-right badge badge-sm badge-success"><?php echo e(__('New')); ?></small>
                                        <?php endif; ?>
                                        <div class="d-flex">
                                            <div>
                                                <i class="fas <?php echo e((!empty($notification->type)) ? $notification->type : 'fa-cogs'); ?> mr-3"></i>
                                            </div>
                                            <div>
                                                <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                    <div class="text-sm lh-150"><?php echo e(mb_strimwidth($notification->text, 0, 100, "...")); ?></div>
                                                <?php endif; ?>
                                                <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                    <small
                                                        class="d-block text-muted"><?php echo e(Utility::getDateFormatted($notification->created_at,true)); ?></small>
                                                <?php endif; ?>
                                                <?php if(!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type)): ?>

                                                    <?php if($notification->link_type == 'calendar'): ?>
                                                        <a class="calendar_notif"
                                                        href="<?php echo \App\Models\UserNotification::getLink($notification->id); ?>"
                                                        data-title="<?php echo \App\Models\Calendar::getCalendarName($notification->link_url); ?>">
                                                            <small
                                                                class="float-left badge badge-sm <?php echo e($notification->link_color); ?> text-white"
                                                                data-type='<?php echo e($notification->link_type); ?>'
                                                            >
                                                                <?php echo e($notification->link_title); ?>

                                                            </small>
                                                        </a>
                                                    <?php else: ?>
                                                        <a
                                                        href="<?php echo \App\Models\UserNotification::getLink($notification->id); ?>"
                                                        data-title="<?php echo $notification->link_title; ?>"
                                                        class="from_notification"
                                                        >
                                                            <small class="float-left badge badge-sm <?php echo e($notification->link_color); ?> text-white" >
                                                                <?php echo e($notification->link_title); ?>

                                                            </small>
                                                        </a>
                                                    <?php endif; ?>

                                                    <div class="clearfix"></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php break; ?>;
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="text-center">
                                    <div class="text-sm lh-150 font-weight-bold"><?php echo e(__('No New Notifications')); ?></div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('notification.index',tenant('tenant_id'))); ?>"
                           class="text-sm text-primary font-weight-bold"><?php echo e(__('See all notifications')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($top->content_type == 'Calendar'): ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <?php
                    $calendar_id = uniqid().$top->id;
                ?>
                <div class="card widget-calendar">
                    <div class="card-header">
                        <div class="text-sm text-muted mb-1 layout-calendar-year"></div>
                        <a href="<?php echo e(route('calendar.index',tenant('tenant_id'))); ?>">
                            <div class="h5 mb-0 layout-calendar-day text-primary"></div>
                        </a>
                    </div>
                    <div data-toggle="<?php echo e($calendar_id); ?>-calendar"></div>
                </div>
                <?php $__env->startPush('script'); ?>
                    <script>
                        $('[data-toggle="<?php echo e($calendar_id); ?>-calendar"]').fullCalendar({
                            contentHeight: "auto",
                            displayEventTime: false,
                            theme: !1,
                            displayEventTime: false,
                            buttonIcons: {prev: " fas fa-angle-left", next: " fas fa-angle-right"},
                            header: {right: "next", center: "title, ", left: "prev"},
                            editable: !0,
                            events: <?php echo json_encode($arrData); ?>,
                            eventClick: function (e, t) {
                                var title = e.title;
                                var url = e.url;

                                if (typeof url != 'undefined') {
                                    $("#commonModal .modal-title").html(title);
                                    $("#commonModal .modal-dialog").addClass('modal-md');
                                    $("#commonModal .modal-dialog").addClass('ow-break-word');
                                    $("#commonModal .modal-title").addClass('ow-anywhere');
                                    $("#commonModal").modal('show');
                                    $.get(url, {}, function (data) {
                                        $('#commonModal .modal-body').html(data);
                                    });
                                    return false;
                                }
                            }
                        });
                        var mYear = moment().format("YYYY"), mDay = moment().format("dddd, MMM D");
                        $(".layout-calendar-year").html(mYear), $(".layout-calendar-day").html(mDay);
                    </script>
                <?php $__env->stopPush(); ?>
            </div>
        <?php elseif($top->content_type == 'System message'): ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-body">
                        <?php if(user()->account_type == 4): ?>
                            <?php echo Utility::getValByName('welcome_message_ext'); ?>

                        <?php else: ?>
                            <?php echo Utility::getValByName('welcome_message_int'); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php elseif($top->content_type == 'KPI Card'): ?>
            <?php
                $topKpiData = $top->getResult();
            ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e($topKpiData['title']); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="kpi_card_title"><?php echo e(ucfirst($topKpiData['data'][0])); ?></p>
                        <div class="text-center">
                            <h1 class="font-weight-700 kpi_card_value"><?php echo e($topKpiData['data'][1]); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($top->content_type == 'Pie Chart' || $top->content_type == 'Line Chart' || $top->content_type == 'Vertical bar Chart' || $top->content_type == 'Horizontal bar Chart'): ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <?php
                    $fullChartData = $top->getResult();
                    $id = uniqid().$top->id;

                ?>

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e($top->title); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if($fullChartData['is_success']): ?>
                            <div class="chartWrapper" id="chartwrap-<?php echo e($id); ?>" >
                                <div id="chartarea-<?php echo e($id); ?>">
                                    <canvas id="<?php echo e($id); ?>" ></canvas>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving').' '.$top->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($fullChartData['is_success']): ?>
                <?php $__env->startPush('script'); ?>
                    <script>
                        var ctx = document.getElementById('<?php echo e($id); ?>').getContext('2d');
                        var chartHeight = <?php echo json_encode($fullChartData['height']); ?>;
                        var chartWidth = <?php echo json_encode($fullChartData['width']); ?>;

                        var chartwrap = $("#chartwrap-<?php echo e($id); ?>");
                        var chartarea = $("#chartarea-<?php echo e($id); ?>");

                        var currWidth = parseInt(chartwrap.width());

                        if(chartWidth > 0){
                            chartarea.css('width', chartWidth + "px");
                        }

                        if(chartHeight > 0){
                            chartarea.css('height', chartHeight + "px");
                        }

                        var fullChart = new Chart(ctx, {
                            type: <?php echo json_encode($fullChartData['type']); ?>,
                            data: {
                                labels: <?php echo json_encode($fullChartData['labels']); ?>,
                                datasets: [<?php echo json_encode($fullChartData['data']); ?>],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                <?php if($fullChartData['type'] != 'doughnut'): ?>
                                tooltips: {
                                    mode: 'label',
                                    callbacks: {
                                        label: function (tooltipItem, data) {
                                            // if (tooltipItem.value != '1' && tooltipItem.value != '0') {
                                            if (tooltipItem.value > 1) {
                                                return ' ' + Number(tooltipItem.value).toLocaleString() + " <?php echo e($fullChartData['plural']); ?>";
                                            } else {
                                                return ' ' + Number(tooltipItem.value).toLocaleString() + " <?php echo e($fullChartData['single']); ?>";
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(value, index, values) {
												return '       ' + value.toLocaleString();
											}
                                        }
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(value, index, values) {
												return '       ' + value.toLocaleString();
											}
                                        }
                                    }]
                                },
                                legend: {display: false}
                                <?php else: ?>
                                legend: {
                                    display: true,
                                    position: 'right',
                                    labels: {
                                        fontColor: '#333',
                                        usePointStyle: true,
                                    }
                                },
                                tooltips: {
                                    callbacks: {
                                        title: function (tooltipItem, data) {
                                            return data['labels'][tooltipItem[0]['index']];
                                        },
                                        label: function (tooltipItem, data) {
                                            if (data['datasets'][0]['data'][tooltipItem['index']] > 1) {
                                                return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " <?php echo e($fullChartData['plural']); ?>";
                                            } else {
                                                return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " <?php echo e($fullChartData['single']); ?>";
                                            }
                                        },
                                    },
                                }
                                <?php endif; ?>
                            },
                        });
                    </script>
                <?php $__env->stopPush(); ?>
                <?php endif; ?>
            </div>
        <?php elseif($top->content_type == 'Custom HTML'): ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e($top->title); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <iframe id="dynamicHtmlTopFrame"  src="<?php echo $top->data_source; ?>" frameborder="0" style="height:200px;width: 100%;" data-src="<?php echo $top->data_source; ?>" data-title="<?php echo $top->title; ?>"  allowfullscreen></iframe>
                    </div>
                </div>
            </div>

        <?php elseif($top->content_type == 'Integration'): ?>
            <?php
                $Integrations = $top->getResult();
            ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($top->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($Integrations['details'])); ?> <?php echo e((count($Integrations['details']) == 0 || count($Integrations['details']) > 1) ? $top->plural_item : $top->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php if($Integrations['is_success'] == true): ?>
                            <?php $__empty_1 = true; $__currentLoopData = $Integrations['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $integration_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($top->max_item >= $loop->iteration): ?>

                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">

                                                <div class="col-auto">
                                                    <i class="fas fa-file" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">


                                                    <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                        <?php if(isset($integration_val[$Integrations['titles'][0]]) && !empty($integration_val[$Integrations['titles'][0]])): ?>
                                                            <?php if($Integrations['details_type'] == 1): ?>
                                                                <?php
                                                                    $basic_details_keys = array_intersect(array_keys($integration_val), $Integrations['basic_details']);
                                                                    foreach($basic_details_keys as $k1 => $v1){
                                                                        $basic_details_array[$v1] = $integration_val[$v1];
                                                                    }
                                                                ?>
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)"
                                                                       class="open-basic-details"
                                                                       data-details="<?php echo e(json_encode($basic_details_array)); ?>"
                                                                       data-url="<?php echo e(route('integration.basic.detail',tenant('tenant_id'))); ?>"
                                                                       data-size="md"
                                                                       data-title="<?php echo e(__('Basic Details')); ?>"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][0]])); ?></a>
                                                                </h6>
                                                            <?php elseif($Integrations['details_type'] == 2): ?>
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)" class="open_doc"
                                                                       data-id="get-integration-details<?php echo e($key); ?>"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][0]])); ?></a>
                                                                </h6>
                                                                <?php echo Form::open(['method' => 'POST', 'route' => ['integration.detail',[tenant('tenant_id'), "rest" => $Integrations['id']]],'id'=>'get-integration-details'.$key]); ?>

                                                                <?php echo e(Form::hidden('url',\Crypt::encrypt($integration_val['url']), ['class' => 'form-control'])); ?>

                                                                <?php echo Form::close(); ?>

                                                            <?php else: ?>
                                                                <h6 class="text-sm mb-0"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][0]])); ?></h6>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if(count($Integrations['titles']) >= 3): ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                            <?php if(isset($integration_val[$Integrations['titles'][1]]) && !empty($integration_val[$Integrations['titles'][1]])): ?>
                                                                <p class="card-text small text-muted mb-0"><?php echo e((!empty($integration_val[$Integrations['titles'][1]]) ? Utility::isDate($integration_val[$Integrations['titles'][1]]) : '')); ?></p>
                                                            <?php endif; ?>

                                                        <?php endif; ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                            <?php if(isset($integration_val[$Integrations['titles'][2]]) && !empty($integration_val[$Integrations['titles'][2]])): ?>
                                                                <span
                                                                    class="card-text text-xs"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][2]])); ?></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php else: ?>
                                    <?php break; ?>;
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    <?php echo e(__('No Available ') . $top->plural_item); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving').' '.$top->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 row">

                        <div class="col <?php echo e((!empty($top->eform_url)) ? 'text-right' : 'text-center'); ?>">
                            <a href="<?php echo e(route('integration.list',[tenant('tenant_id'),$Integrations['name'],$Integrations['id']])); ?>"
                               class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif($top->content_type == 'Court Case'): ?>
            <?php
                $case_views = $top->getResult();
            ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($top->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($case_views['details'])); ?> <?php echo e((count($case_views['details']) == 0 || count($case_views['details']) > 1) ? $top->plural_item : $top->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php if($case_views['is_success'] == true): ?>
                            <?php $__empty_1 = true; $__currentLoopData = $case_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($top->max_item >= $loop->iteration): ?>
                                    <?php
                                        $url = route('courtcase.detail',[tenant('tenant_id'),$top->data_source,$case['ActiveBatchID'] ?? ""]);
                                    ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">
                                                    <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                        <h6 class="text-sm mb-0">
                                                            <a href="<?php echo e($url); ?>"><?php echo e((!empty($case[$case_views['titles'][2]]) ? Utility::isDate($case[$case_views['titles'][2]]) : '')); ?></a>
                                                        </h6>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                        <?php if(isset($case[$case_views['titles'][3]]) && !empty($case[$case_views['titles'][3]])): ?>
                                                            <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate($case[$case_views['titles'][3]])); ?></p>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                        <?php if(isset($case[$case_views['titles'][4]]) && !empty($case[$case_views['titles'][4]])): ?>
                                                            <span
                                                                class="card-text text-xs"><?php echo e(Utility::isDate($case[$case_views['titles'][4]])); ?></span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if(in_array('Status',$case_views['titles']) == true): ?>
                                                    <div class="col-12 text-right">
                                                        <span
                                                            class="badge badge-xs text-white <?php echo e((!in_array($case['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : ''); ?>"
                                                            <?php if(in_array($case['Status'],array_keys(config('statuscolor')))): ?> style="background-color: <?php echo e(config('statuscolor.'.$case['Status'])); ?>"<?php endif; ?>><?php echo e($case['Status']); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php break; ?>;
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    <?php echo e(__('No Available ') . $top->plural_item); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving').' '.$top->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('courtcase.list',[tenant('tenant_id'),$top->data_source,$top->id])); ?>"
                           class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($top->content_type == 'Custom Page'): ?>
            <?php
                $custom_page = $top->getResult();
                $style = "";
                if($top->max_item > 0) $style = "max-height: ".(100*$top->max_item)."px; overflow: auto;"
            ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">
                <div class="card">
                    <?php if(!is_null($custom_page)): ?>
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="h5 mb-0"><?php echo e($custom_page->title); ?><span
                                            class="badge badge-success badge-xs"></span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="<?php echo e($style); ?>">
                            <?php echo $custom_page->detail; ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php elseif($top->content_type == 'News Feed'): ?>
            <?php
                $postList = $top->getResult();
                $dateformat = Utility::getValByName('date_format');
            ?>
            <div class="<?php echo e($top->returnClass()); ?> col-auto">

                <div class="card overflow-auto h-580">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($top->title); ?></h5>
                                <span class="d-block text-sm font-italic"><?php echo e(count($top->getResult())); ?> <?php echo e((count($top->getResult()) == 0 || count($top->getResult()) > 1) ? $top->plural_item : $top->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper overflow-auto h-580">
                        <?php $__currentLoopData = $postList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card-body border-bottom">
                                <?php
                                if ($post->image) {
                                    if($post->image_placement == "center"){
                                        $imageClass = "12";
                                        $contentClass = "12";
                                        $textAlign = 'text-right';
                                    }elseif($post->image_placement == "right"){
                                        $imageClass = "4 order-lg-2";
                                        $contentClass = "8 order-lg-1";
                                        $textAlign = '';
                                    }else{
                                        $imageClass = "4";
                                        $contentClass = "8";
                                        $textAlign = '';
                                    }
                                } else {
                                    $contentClass = "12";
                                    $textAlign = '';
                                }
                                ?>
                                <div class="row">
                                    <?php if($post->image): ?>
                                        <div class="col-<?php echo e($imageClass); ?>">
                                            <div class="">
                                                <div class=" overflow-hidden <?php echo e($post->image_placement == 'center' ? 'h-200' : 'max-h-200'); ?>">
                                                    <a href="<?php echo e(route('newsfeed.show',[tenant('tenant_id'),$post->id])); ?>" class="d-block animate-this">
                                                        <img alt="Image placeholder" src="<?php echo e(asset(Storage::url($post->image))); ?>" class="post_image">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-<?php echo e($contentClass); ?>">
                                        <div class="row">
                                            <div class="col-12 <?php echo e($textAlign); ?> <?php echo e($post->image_placement == 'center' ? 'mt-4' : ''); ?>">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div class="overflow-hidden">
                                                        <h5 class="h5 mb-0 overflow-hidden text-truncate"><a href="<?php echo e(route('newsfeed.show',[tenant('tenant_id'),$post->id])); ?>" class="post_title"><?php echo $post->title; ?></a></h5>
                                                    </div>
                                                </div>
                                                <span class="post_subtitle"><?php echo e($post->user->name); ?> - <?php echo e(Utility::getDateFormatted($post->created_at,false,$dateformat)); ?></span>
                                            </div>

                                            <div class="shortened_txt col-12 card-text mt-2 mb-2 text-muted post_body <?php echo e($post->excerpt_length > 0 ? 'overflow-hidden' : 'overflow-auto'); ?>" id="shortened_txt_<?php echo e($post->id); ?>" >
                                                <?php echo $post->detail; ?>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 text-right <?php echo e($post->image_placement == 'right' ? 'order-lg-3' : ''); ?>">
                                        <a href="<?php echo e(route('newsfeed.show',[tenant('tenant_id'),$post->id])); ?>">
                                            <span class="text-primary"><?php echo e(__('Read more...')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('newsfeed.list',[tenant('tenant_id')])); ?>">
                            <span class="text-primary"><?php echo e(__('See all...')); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="clearfix"></div>


<div class="row">

    <?php $__currentLoopData = $layouts['middle']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $middle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(str_contains($middle->content_type, '[package_layout]')): ?>
            <?php
                $cartTemplate = '';
                $packageLayout = config('package-layout');
                if ($packageLayout) {
                    $contentTypeArr = explode('.', $middle->content_type);
                    if (isset($packageLayout[$contentTypeArr[1]]) && !empty($packageLayout[$contentTypeArr[1]])) {
                        $templateName = $packageLayout[$contentTypeArr[1]][$contentTypeArr[2]]['template'];
                        $cartTemplate = $contentTypeArr[1] . '::' . $templateName;
                    }
                }
            ?>
            <?php if($cartTemplate): ?>
                <?php echo $__env->make($cartTemplate, [
                'title' => $middle->title,
                 'class' => $middle->returnClass(),
                 'plural_item' => $middle->plural_item,
                 'single_item' => $middle->single_item,
                 'max_item' => $middle->max_item,
                 'data_source' => $middle->data_source,
                 ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($middle->content_type == 'Documents'): ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($middle->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($middle->getResult())); ?> <?php echo e((count($middle->getResult()) == 0 || count($middle->getResult()) > 1) ? $middle->plural_item : $middle->single_item); ?></span>
                            </div>
                            <span class="badge badge-xs badge-success"><?php echo e(Utility::newCount($middle->getResult())); ?></span>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php $__empty_1 = true; $__currentLoopData = $middle->getResult(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc_response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($middle->max_item >= $loop->iteration): ?>
                                <?php
                                    $doc_icon = Utility::GetDocProp($doc_response,'Icon');
                                    $doc_icon = !empty($doc_icon) ? $doc_icon : 'fa fa-file-text-o';
                                ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="<?php echo e($doc_icon); ?>" aria-hidden="true"></i>
                                            </div>
                                            <div class="col ml-n2">
                                                <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                    <h6 class="text-sm mb-0">
                                                        <a href="<?php echo e(route('docs.view',[tenant('tenant_id'),$doc_response->DocID])); ?>"><?php echo e(Utility::isDate(Utility::GetDocProp($doc_response,'Title'))); ?></a>
                                                    </h6>
                                                <?php endif; ?>
                                                <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                    <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate(Utility::GetDocProp($doc_response,'Subtitle'))); ?></p>
                                                <?php endif; ?>
                                                <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                    <span
                                                        class="card-text text-xs"><?php echo e(Utility::isDate(Utility::GetDocProp($doc_response,'Excerpt'))); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-12 text-right">
                                                <span
                                                    class="badge badge-xs <?php echo e(Utility::GetDocProp($doc_response,'badge-class')); ?>"><?php echo e(Utility::GetDocProp($doc_response,'Status')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php break; ?>;
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('No Available ') . $middle->plural_item); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('docs.index',[tenant('tenant_id'),$middle->data_source])); ?>"
                        class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($middle->content_type == 'Child Workflows'): ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($middle->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($middle->getResult())); ?> <?php echo e((count($middle->getResult()) == 0 || count($middle->getResult()) > 1) ? $middle->plural_item : $middle->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php $__empty_1 = true; $__currentLoopData = $middle->getResult(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($middle->max_item >= $loop->iteration): ?>
                                <?php
                                    $columnArray = $row->ColumnValues;
                                    $icon = Utility::GetTableRowColumnValue($columnArray,'Icon');
                                    $icon = !empty($icon) ? $icon : 'fa fa-file-text-o';
                                ?>
                                <?php if(!empty(Utility::GetTableRowColumnValue($columnArray,'Title'))): ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="<?php echo e($icon); ?>" aria-hidden="true"></i></div>
                                                <div class="col ml-n2">
                                                    <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                        <h6 class="text-sm mb-0">
                                                            <a href="<?php echo e(route('batch.form.detail',[tenant('tenant_id'),$middle->content_type,Utility::GetTableRowColumnValue($columnArray,'Title')])); ?>"><?php echo e(Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Title'))); ?></a>
                                                        </h6>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                        <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Subtitle'))); ?></p>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                        <span
                                                            class="card-text text-xs"><?php echo e(Utility::GetTableRowColumnValue($columnArray,'Excerpt')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-12 text-right">
                                                    <span
                                                        class="badge badge-xs <?php echo e(Utility::GetTableRowColumnValue($columnArray,'badge-class')); ?>"><?php echo e(Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Status'))); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php break; ?>;
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('No Available ') . $middle->plural_item); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('batch.detail',[tenant('tenant_id'),$middle->data_source])); ?>"
                        class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($middle->content_type == 'Workflow view'): ?>
            <?php
                $workflow_views = $middle->getResult();
                $adv_config = json_decode($middle->adv_config);
            ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($middle->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($workflow_views['details'])); ?> <?php echo e((count($workflow_views['details']) == 0 || count($workflow_views['details']) > 1) ? $middle->plural_item : $middle->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on"): ?>
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        <?php for($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++): ?>
                                            <th class="pointer text-dark">
                                                <?php echo e((isset($workflow_views['titles'][$i]) ? Str::title($workflow_views['titles'][$i]) : '')); ?>

                                            </th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    <?php if($workflow_views['is_success'] == true): ?>
                                        <?php $__empty_1 = true; $__currentLoopData = $workflow_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workflow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php if($middle->max_item >= $loop->iteration): ?>
                                                <?php
                                                    if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                                    {
                                                        $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($middle->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                    else
                                                    {
                                                        $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($middle->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                ?>
                                                <tr>
                                                    <?php
                                                        $first_column = true;
                                                    ?>
                                                    <?php for($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++): ?>
                                                        <td>
                                                            <?php if($first_column): ?>
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '')); ?></a>
                                                                <?php echo e($first_column = false); ?>

                                                            <?php else: ?>
                                                                <?php echo e((!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '')); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endfor; ?>
                                                </tr>
                                            <?php else: ?>
                                                <?php break; ?>;
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                <?php echo e(__('No Available ') . $middle->plural_item); ?>

                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('An error occurred retrieving').' '.$middle->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    
                    <?php else: ?>
                        <div class="card-wrapper p-3">
                            <?php if($workflow_views['is_success'] == true): ?>
                                <?php $__empty_1 = true; $__currentLoopData = $workflow_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workflow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php if($middle->max_item >= $loop->iteration): ?>
                                        <?php
                                            if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                            {
                                                $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($middle->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                            else
                                            {
                                                $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($middle->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                        ?>
                                        <div class="card mb-2 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i></div>
                                                    <div class="col ml-n2">
                                                        <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                            <h6 class="text-sm mb-0">
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty($workflow[$workflow_views['titles'][2]]) ? Utility::isDate($workflow[$workflow_views['titles'][2]]) : '')); ?></a>
                                                            </h6>
                                                        <?php endif; ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                            <?php if(isset($workflow[$workflow_views['titles'][3]]) && !empty($workflow[$workflow_views['titles'][3]])): ?>
                                                                <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate($workflow[$workflow_views['titles'][3]])); ?></p>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                            <?php if(isset($workflow[$workflow_views['titles'][4]]) && !empty($workflow[$workflow_views['titles'][4]])): ?>
                                                                <span
                                                                    class="card-text text-xs"><?php echo e(Utility::isDate($workflow[$workflow_views['titles'][4]])); ?></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php if(in_array('Status',$workflow_views['titles']) == true): ?>
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4
                                                                <?php echo e((!in_array($workflow['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : ''); ?>"
                                                                <?php if(in_array($workflow['Status'],array_keys(config('statuscolor')))): ?> style="background-color: <?php echo e(config('statuscolor.'.$workflow['Status'])); ?>"<?php endif; ?>>
                                                                <?php echo e($workflow['Status']); ?>

                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(in_array('Progress',$workflow_views['titles']) == true): ?>
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            <span class="completion mr-2"><small><?php echo e($workflow['Progress']); ?>%</small></span>
                                                            <?php
                                                                $progressColor = "";

                                                                if ($workflow['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($workflow['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($workflow['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $middleWidth = $middle->returnClass();

                                                                if ($middleWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            ?>
                                                            <div>
                                                                <div class="progress progress-xs" style="width: <?php echo e($progressBarWidth); ?>">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($workflow['Progress']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($workflow['Progress']); ?>%; background-color: <?php echo e($progressColor); ?>;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php break; ?>;
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('No Available ') . $middle->plural_item); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    <?php echo e(__('An error occurred retrieving').' '.$middle->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-footer py-2 row footer-row">
                        <?php if(!empty($middle->eform_url)): ?>
                            <div class="col text-left">
                                <a href="<?php echo e(route('eforms.view',[tenant('tenant_id'),$middle->id])); ?>"
                                class="text-sm text-primary font-weight-bold"><?php echo e(__('New..')); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="col <?php echo e((!empty($middle->eform_url)) ? 'text-right' : 'text-center'); ?>">
                            <a href="<?php echo e(route('tasks.index',[tenant('tenant_id')])); ?>"
                            class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($middle->content_type == 'Content view'): ?>
            <?php
                $content_views = $middle->getResult();
                $adv_config = json_decode($middle->adv_config);
            ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($middle->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($content_views['details'])); ?> <?php echo e((count($content_views['details']) == 0 || count($content_views['details']) > 1) ? $middle->plural_item : $middle->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on"): ?>
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        <?php for($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++): ?>
                                            <th class="pointer text-dark">
                                                <?php echo e((isset($content_views['titles'][$i]) ? Str::title($content_views['titles'][$i]) : '')); ?>

                                            </th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    <?php if($content_views['is_success'] == true): ?>
                                        <?php $__empty_1 = true; $__currentLoopData = $content_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php if($middle->max_item >= $loop->iteration): ?>
                                                <?php if(isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID'])): ?>
                                                    <?php
                                                        $appName = $content_view['ICS_AppName'];
                                                        $docId = $content_view['ICS_DocumentID'];
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $middle->data_source.'~'.array_values($content_view)[0];
                                                        $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                                    ?>
                                                <?php else: ?>
                                                    <?php
                                                        $appName = '';
                                                        $docId = '';
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $middle->data_source.'~'.array_values($content_view)[0];
                                                        $url = 'javascript:void(0)';
                                                    ?>
                                                <?php endif; ?>
                                                
                                                <tr>
                                                    <?php
                                                        $first_column = true;
                                                    ?>
                                                    <?php for($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++): ?>
                                                        <td>
                                                            <?php if($first_column): ?>
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '')); ?></a>
                                                                <?php echo e($first_column = false); ?>

                                                            <?php else: ?>
                                                                <?php echo e((!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '')); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endfor; ?>
                                                </tr>
                                            <?php else: ?>
                                                <?php break; ?>;
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                <?php echo e(__('No Available ') . $middle->plural_item); ?>

                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('An error occurred retrieving the list of ') . $middle->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']); ?>

                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    
                    <?php else: ?>
                        <div class="card-wrapper p-3">
                            <?php if($content_views['is_success'] == true): ?>
                                <?php $__empty_1 = true; $__currentLoopData = $content_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php if($middle->max_item >= $loop->iteration): ?>
                                        <?php if(isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID'])): ?>
                                            <?php
                                                $appName = $content_view['ICS_AppName'];
                                                $docId = $content_view['ICS_DocumentID'];
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $middle->data_source.'~'.array_values($content_view)[0];
                                                $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                            ?>
                                        <?php else: ?>
                                            <?php
                                                $appName = '';
                                                $docId = '';
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $middle->data_source.'~'.array_values($content_view)[0];
                                                $url = 'javascript:void(0)';
                                            ?>
                                        <?php endif; ?>
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-file" aria-hidden="true"></i></div>
                                                    <div class="col ml-n2">
                                                        <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                            <h6 class="text-sm mb-0">
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty($content_view[$content_views['titles'][0]]) ? Utility::isDate($content_view[$content_views['titles'][0]]) : '')); ?></a>
                                                            </h6>
                                                        <?php endif; ?>
                                                        <?php if(count($content_views['titles']) >= 3): ?>
                                                            <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                                <p class="card-text small text-muted mb-0"><?php echo e((!empty($content_view[$content_views['titles'][1]]) ? Utility::isDate($content_view[$content_views['titles'][1]]) : '')); ?></p>
                                                            <?php endif; ?>
                                                            <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                                <span
                                                                    class="card-text text-xs"><?php echo e((!empty($content_view[$content_views['titles'][2]]) ? Utility::isDate($content_view[$content_views['titles'][2]]) : '')); ?></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php if(array_key_exists('Status', $content_view) == true): ?>
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4 <?php echo e((!in_array($content_view['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : ''); ?>"
                                                                <?php if(in_array($content_view['Status'],array_keys(config('statuscolor')))): ?> style="background-color: <?php echo e(config('statuscolor.'.$content_view['Status'])); ?>"<?php endif; ?>
                                                                >
                                                                <?php echo e($content_view['Status']); ?>

                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(array_key_exists('Progress', $content_view) == true): ?>
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            <?php
                                                                $progressValue = $content_view['Progress'] == NULL ? "0" : $content_view['Progress'];

                                                                $progressColor = "";

                                                                if ($content_view['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($content_view['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($content_view['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $middleWidth = $middle->returnClass();

                                                                if ($middleWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            ?>
                                                            <span class="completion mr-2"><small><?php echo e($progressValue); ?>%</small></span>
                                                            <div>
                                                                <div class="progress progress-xs" style="width: <?php echo e($progressBarWidth); ?>">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($content_view['Progress']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($content_view['Progress']); ?>%; background-color: <?php echo e($progressColor); ?>;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php break; ?>;
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('No Available ') . $middle->plural_item); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    <?php echo e(__('An error occurred retrieving the list of ') . $middle->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-footer py-2 row footer-row">
                        <?php if(!empty($middle->eform_url)): ?>
                            <div class="col text-left">
                                <a href="<?php echo e(route('eforms.view',[tenant('tenant_id'),$middle->id])); ?>"
                                   class="text-sm text-primary font-weight-bold"><?php echo e(__('New..')); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="col <?php echo e((!empty($middle->eform_url)) ? 'text-right' : 'text-center'); ?>">
                            <a href="<?php echo e(route('folder.index',[tenant('tenant_id')])); ?>"
                            class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($middle->content_type == 'Notifications'): ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Notifications')); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php if(user()->getUnreadNotification()->count() > 0): ?>
                            <?php $__currentLoopData = user()->getUnreadNotification(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($middle->max_item >= $loop->iteration): ?>
                                    <div class="list-group-item list-group-item-action" >
                                        
                                        <?php if($notification->created_at > user()->last_login_at && $notification->created_at > user()->notifications_read): ?>
                                            <small class="float-right badge badge-sm badge-success"><?php echo e(__('New')); ?></small>
                                        <?php endif; ?>
                                        <div class="d-flex">
                                            <div>
                                                <i class="fas <?php echo e((!empty($notification->type)) ? $notification->type : 'fa-cogs'); ?> mr-3"></i>
                                            </div>
                                            <div>
                                                <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                    <div class="text-sm lh-150"><?php echo e(mb_strimwidth($notification->text, 0, 100, "...")); ?></div>
                                                <?php endif; ?>
                                                <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                    <small
                                                        class="d-block text-muted"><?php echo e(Utility::getDateFormatted($notification->created_at,true)); ?></small>
                                                <?php endif; ?>
                                                <?php if(!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type)): ?>

                                                    <?php if($notification->link_type == 'calendar'): ?>
                                                        <a class="calendar_notif"
                                                        href="<?php echo \App\Models\UserNotification::getLink($notification->id); ?>"
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
                                                        class="from_notification">
                                                            <small class="float-left badge badge-sm <?php echo e($notification->link_color); ?> text-white" ><?php echo e($notification->link_title); ?></small>
                                                        </a>
                                                    <?php endif; ?>



                                                    <div class="clearfix"></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php break; ?>;
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="text-center">
                                    <div class="text-sm lh-150 font-weight-bold"><?php echo e(__('No New Notifications')); ?></div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('notification.index',tenant('tenant_id'))); ?>"
                        class="text-sm text-primary font-weight-bold"><?php echo e(__('See all notifications')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($middle->content_type == 'Calendar'): ?>
            <?php
                $calendar_id = uniqid().$middle->id;
            ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card widget-calendar">
                    <div class="card-header">
                        <div class="text-sm text-muted mb-1 layout-calendar-year"></div>
                        <a href="<?php echo e(route('calendar.index',tenant('tenant_id'))); ?>">
                            <div class="h5 mb-0 layout-calendar-day text-primary"></div>
                        </a>
                    </div>
                    <div data-toggle="<?php echo e($calendar_id); ?>-calendar"></div>
                </div>
            </div>
            <?php $__env->startPush('script'); ?>
                <script>
                    $('[data-toggle="<?php echo e($calendar_id); ?>-calendar"]').fullCalendar({
                        contentHeight: "auto",
                        displayEventTime: false,
                        theme: !1,
                        buttonIcons: {prev: " fas fa-angle-left", next: " fas fa-angle-right"},
                        header: {right: "next", center: "title, ", left: "prev"},
                        editable: !0,
                        events: <?php echo json_encode($arrData); ?>,
                        eventClick: function (e, t) {
                            var title = e.title;
                            var url = e.url;

                            if (typeof url != 'undefined') {
                                $("#commonModal .modal-title").html(title);
                                $("#commonModal .modal-dialog").addClass('modal-md');
                                $("#commonModal .modal-dialog").addClass('ow-break-word');
                                $("#commonModal .modal-title").addClass('ow-anywhere');
                                $("#commonModal").modal('show');
                                $.get(url, {}, function (data) {
                                    $('#commonModal .modal-body').html(data);
                                });
                                return false;
                            }
                        }
                    });
                    var mYear = moment().format("YYYY"), mDay = moment().format("dddd, MMM D");
                    $(".layout-calendar-year").html(mYear), $(".layout-calendar-day").html(mDay);
                </script>
            <?php $__env->stopPush(); ?>
        <?php elseif($middle->content_type == 'System message'): ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-body">
                        <?php if(user()->account_type == 4): ?>
                            <?php echo Utility::getValByName('welcome_message_ext'); ?>

                        <?php else: ?>
                            <?php echo Utility::getValByName('welcome_message_int'); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php elseif($middle->content_type == 'KPI Card'): ?>
            <?php
                $kpiData = $middle->getResult();
            ?>
             <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e($kpiData['title']); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="kpi_card_title"><?php echo e(ucfirst($kpiData['data'][0])); ?></p>
                        <div class="text-center">
                            <h1 class="font-weight-700 kpi_card_value"><?php echo e($kpiData['data'][1]); ?></h1>
                        </div>
                    </div>
                </div>
             </div>
        <?php elseif($middle->content_type == 'Pie Chart' || $middle->content_type == 'Line Chart' || $middle->content_type == 'Vertical bar Chart' || $middle->content_type == 'Horizontal bar Chart'): ?>
            <?php
                $chartData ='';
                $chartData = $middle->getResult();
                $id = uniqid().$middle->id;
            ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e($middle->title); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if($chartData['is_success']): ?>
                            <div class="chartWrapper" id="chartwrap-<?php echo e($id); ?>" >
                                <div id="chartarea-<?php echo e($id); ?>">
                                    <canvas id="<?php echo e($id); ?>" ></canvas>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving').' '); ?> <i><b><?php echo e($middle->title.'. '); ?></b></i> <?php echo e(__('Please contact your system administrator for assistance.')); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($chartData['is_success']): ?>
                    <?php $__env->startPush('script'); ?>
                    <script>
                        var ctx = document.getElementById('<?php echo e($id); ?>').getContext('2d');

                        var chartHeight = <?php echo json_encode($chartData['height']); ?>;
                        var chartWidth = <?php echo json_encode($chartData['width']); ?>;

                        var chartwrap = $("#chartwrap-<?php echo e($id); ?>");
                        var chartarea = $("#chartarea-<?php echo e($id); ?>");

                        var currWidth = parseInt(chartwrap.width());

                        if(chartWidth > 0){
                            chartarea.css('width', chartWidth + "px");
                        }

                        if(chartHeight > 0){
                            chartarea.css('height', chartHeight + "px");
                        }

                        var chart = new Chart(ctx, {
                            type: <?php echo json_encode($chartData['type']); ?>,
                            data: {
                                labels: <?php echo json_encode($chartData['labels']); ?>,
                                datasets: [<?php echo json_encode($chartData['data']); ?>],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                <?php if($chartData['type'] != 'doughnut'): ?>
                                tooltips: {
                                    mode: 'label',
                                    callbacks: {
                                        label: function (tooltipItem, data) {
                                            // if (tooltipItem.value != '1' && tooltipItem.value != '0') {
                                            if (tooltipItem.value > 1) {
                                                return ' ' + Number(tooltipItem.value).toLocaleString() + " <?php echo e($chartData['plural']); ?>";
                                            } else {
                                                return ' ' + Number(tooltipItem.value).toLocaleString() + " <?php echo e($chartData['single']); ?>";
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(value, index, values) {
												return '       ' + value.toLocaleString();
											}
                                        }
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(value, index, values) {
												return '       ' + value.toLocaleString();
											}
                                        }
                                    }]
                                },
                                legend: {display: false}
                                <?php else: ?>
                                legend: {
                                    display: true,
                                    position: 'right',
                                    labels: {
                                        fontColor: '#333',
                                        usePointStyle: true,
                                    }
                                },
                                tooltips: {
                                    callbacks: {
                                        title: function (tooltipItem, data) {
                                            return data['labels'][tooltipItem[0]['index']];
                                        },
                                        label: function (tooltipItem, data) {
                                            if (data['datasets'][0]['data'][tooltipItem['index']] > 1) {
                                                return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " <?php echo e($chartData['plural']); ?>";
                                            } else {
                                                return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " <?php echo e($chartData['single']); ?>";
                                            }
                                        },
                                    },
                                }
                                <?php endif; ?>
                            },
                        });
                    </script>
                <?php $__env->stopPush(); ?>
                <?php endif; ?>
            </div>
        <?php elseif($middle->content_type == 'Custom HTML'): ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e($middle->title); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <iframe id="dynamicHtmlMiddleFrame" src="<?php echo $middle->data_source; ?>" frameborder="0" style="height:200px;width: 100%;" data-src="<?php echo $middle->data_source; ?>"  data-title="<?php echo $middle->title; ?>"  allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        <?php elseif($middle->content_type == 'Integration'): ?>
            <?php
                $Integrations = $middle->getResult();
            ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($middle->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($Integrations['details'])); ?> <?php echo e((count($Integrations['details']) == 0 || count($Integrations['details']) > 1) ? $middle->plural_item : $middle->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php if($Integrations['is_success'] == true): ?>
                            <?php $__empty_1 = true; $__currentLoopData = $Integrations['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $integration_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($middle->max_item >= $loop->iteration): ?>

                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="fas fa-file" aria-hidden="true"></i></div>
                                                <div class="col ml-n2">

                                                    <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                        <?php if(isset($integration_val[$Integrations['titles'][0]]) && !empty($integration_val[$Integrations['titles'][0]])): ?>
                                                            <?php if($Integrations['details_type'] == 1): ?>
                                                                <?php
                                                                    $basic_details_keys = array_intersect(array_keys($integration_val), $Integrations['basic_details']);
                                                                    foreach($basic_details_keys as $k1 => $v1){
                                                                        $basic_details_array[$v1] = $integration_val[$v1];
                                                                    }
                                                                ?>
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)" class="open-basic-details"
                                                                    data-details="<?php echo e(json_encode($basic_details_array)); ?>"
                                                                    data-url="<?php echo e(route('integration.basic.detail',tenant('tenant_id'))); ?>"
                                                                    data-size="md"
                                                                    data-title="<?php echo e(__('Basic Details')); ?>"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][0]])); ?></a>
                                                                </h6>
                                                            <?php elseif($Integrations['details_type'] == 2): ?>
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)" class="open_doc"
                                                                    data-id="get-integration-details<?php echo e($key); ?>"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][0]])); ?></a>
                                                                </h6>
                                                                <?php echo Form::open(['method' => 'POST', 'route' => ['integration.detail',[tenant('tenant_id'), "rest" => $Integrations['id']]],'id'=>'get-integration-details'.$key]); ?>

                                                                <?php echo e(Form::hidden('url',\Crypt::encrypt($integration_val['url']), ['class' => 'form-control'])); ?>

                                                                <?php echo Form::close(); ?>

                                                            <?php else: ?>
                                                                <h6 class="text-sm mb-0"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][0]])); ?></h6>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if(count($Integrations['titles']) >= 3): ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                            <?php if(isset($integration_val[$Integrations['titles'][1]]) && !empty($integration_val[$Integrations['titles'][1]])): ?>
                                                                <p class="card-text small text-muted mb-0"><?php echo e((!empty($integration_val[$Integrations['titles'][1]]) ? Utility::isDate($integration_val[$Integrations['titles'][1]]) : '')); ?></p>
                                                            <?php endif; ?>

                                                        <?php endif; ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                            <?php if(isset($integration_val[$Integrations['titles'][2]]) && !empty($integration_val[$Integrations['titles'][2]])): ?>
                                                                <span
                                                                    class="card-text text-xs"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][2]])); ?></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php break; ?>;
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    <?php echo e(__('No Available ') . $middle->plural_item); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving').' '.$middle->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 row">

                        <div class="col <?php echo e((!empty($middle->eform_url)) ? 'text-right' : 'text-center'); ?>">
                            <a href="<?php echo e(route('integration.list',[tenant('tenant_id'),$Integrations['name'],$Integrations['id']])); ?>"
                            class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($middle->content_type == 'Court Case'): ?>
            <?php
                $case_views = $middle->getResult();
            ?>

            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($middle->title); ?><span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($case_views['details'])); ?> <?php echo e((count($case_views['details']) == 0 || count($case_views['details']) > 1) ? $middle->plural_item : $middle->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php if($case_views['is_success'] == true): ?>
                            <?php $__empty_1 = true; $__currentLoopData = $case_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($middle->max_item >= $loop->iteration): ?>
                                    <?php
                                        $url = route('courtcase.detail',[tenant('tenant_id'),$middle->data_source,$case['ActiveBatchID'] ?? ""]);
                                    ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i></div>
                                                <div class="col ml-n2">
                                                    <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                        <h6 class="text-sm mb-0">
                                                            <a href="<?php echo e($url); ?>"><?php echo e((!empty($case[$case_views['titles'][2]]) ? Utility::isDate($case[$case_views['titles'][2]]) : '')); ?></a>
                                                        </h6>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                        <?php if(isset($case[$case_views['titles'][3]]) && !empty($case[$case_views['titles'][3]])): ?>
                                                            <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate($case[$case_views['titles'][3]])); ?></p>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                        <?php if(isset($case[$case_views['titles'][4]]) && !empty($case[$case_views['titles'][4]])): ?>
                                                            <span
                                                                class="card-text text-xs"><?php echo e(Utility::isDate($case[$case_views['titles'][4]])); ?></span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if(in_array('Status',$case_views['titles']) == true): ?>
                                                    <div class="col-12 text-right">
                                                        <span
                                                            class="badge badge-xs text-white <?php echo e((!in_array($case['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : ''); ?>"
                                                            <?php if(in_array($case['Status'],array_keys(config('statuscolor')))): ?> style="background-color: <?php echo e(config('statuscolor.'.$case['Status'])); ?>"<?php endif; ?>><?php echo e($case['Status']); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php break; ?>;
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    <?php echo e(__('No Available ') . $middle->plural_item); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving').' '.$middle->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('courtcase.list',[tenant('tenant_id'),$middle->data_source,$middle->id])); ?>"
                        class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($middle->content_type == 'Custom Page'): ?>
            <?php
                $custom_page = $middle->getResult();
                $style = "";
                if($middle->max_item > 0) $style = "max-height: ".(100*$middle->max_item)."px; overflow: auto;"
            ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card">
                    <?php if(!is_null($custom_page)): ?>
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="h5 mb-0"><?php echo e($custom_page->title); ?><span
                                            class="badge badge-success badge-xs"></span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="<?php echo e($style); ?>">
                            <?php echo $custom_page->detail; ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php elseif($middle->content_type == 'News Feed'): ?>
            <?php
                $postList = $middle->getResult();
                $dateformat = Utility::getValByName('date_format');
            ?>
            <div class="<?php echo e($middle->returnClass()); ?> col-auto">
                <div class="card overflow-auto h-580">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($middle->title); ?></h5>
                                <span class="d-block text-sm font-italic"><?php echo e(count($middle->getResult())); ?> <?php echo e((count($middle->getResult()) == 0 || count($middle->getResult()) > 1) ? $middle->plural_item : $middle->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper overflow-auto h-580">
                        <?php $__currentLoopData = $postList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card-body border-bottom">

                                <?php
                                if ($post->image) {
                                    if($post->image_placement == "center"){
                                        $imageClass = "12";
                                        $contentClass = "12";
                                        $textAlign = 'text-right';
                                    }elseif($post->image_placement == "right"){
                                        $imageClass = "4 order-lg-2";
                                        $contentClass = "8 order-lg-1";
                                        $textAlign = '';
                                    }else{
                                        $imageClass = "4";
                                        $contentClass = "8";
                                        $textAlign = '';
                                    }
                                } else {
                                    $contentClass = "12";
                                    $textAlign = '';
                                }
                                ?>
                                <div class="row">
                                    <?php if($post->image): ?>
                                        <div class="col-<?php echo e($imageClass); ?>">
                                            <div class="">
                                                <div class=" overflow-hidden <?php echo e($post->image_placement == 'center' ? 'h-200' : 'max-h-200'); ?>">
                                                    <a href="<?php echo e(route('newsfeed.show',[tenant('tenant_id'),$post->id])); ?>" class="d-block animate-this">
                                                        <img alt="Image placeholder" src="<?php echo e(asset(Storage::url($post->image))); ?>" class="post_image">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-<?php echo e($contentClass); ?>">
                                        <div class="row">

                                            <div class="col-12 <?php echo e($textAlign); ?> <?php echo e($post->image_placement == 'center' ? 'mt-4' : ''); ?>">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div class="overflow-hidden">
                                                        <h5 class="h5 mb-0 overflow-hidden text-truncate"><a href="<?php echo e(route('newsfeed.show',[tenant('tenant_id'),$post->id])); ?>" class="post_title"><?php echo $post->title; ?></a></h5>
                                                    </div>
                                                </div>
                                                <span class="post_subtitle"><?php echo e($post->user->name); ?> - <?php echo e(Utility::getDateFormatted($post->created_at,false,$dateformat)); ?></span>
                                            </div>

                                            <div class="shortened_txt col-12 card-text mt-2 mb-2 text-muted post_body <?php echo e($post->excerpt_length > 0 ? 'overflow-hidden' : 'overflow-auto'); ?>" id="shortened_txt_<?php echo e($post->id); ?>" >
                                                <?php echo $post->detail; ?>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 text-right <?php echo e($post->image_placement == 'right' ? 'order-lg-3' : ''); ?>">
                                        <a href="<?php echo e(route('newsfeed.show',[tenant('tenant_id'),$post->id])); ?>">
                                            <span class="text-primary"><?php echo e(__('Read more...')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('newsfeed.list',[tenant('tenant_id')])); ?>">
                            <span class="text-primary"><?php echo e(__('See all...')); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="clearfix"></div>


<div class="row">
    <?php $__currentLoopData = $layouts['bottom']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bottom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(str_contains($bottom->content_type, '[package_layout]')): ?>
            <?php
                $cartTemplate = '';
                $packageLayout = config('package-layout');
                if ($packageLayout) {
                    $contentTypeArr = explode('.', $bottom->content_type);
                    if (isset($packageLayout[$contentTypeArr[1]]) && !empty($packageLayout[$contentTypeArr[1]])) {
                        $templateName = $packageLayout[$contentTypeArr[1]][$contentTypeArr[2]]['template'];
                        $cartTemplate = $contentTypeArr[1] . '::' . $templateName;
                    }
                }
            ?>
            <?php if($cartTemplate): ?>
                <?php echo $__env->make($cartTemplate, [
                'title' => $bottom->title,
                 'class' => $bottom->returnClass(),
                 'plural_item' => $bottom->plural_item,
                 'single_item' => $bottom->single_item,
                 'max_item' => $bottom->max_item,
                 'data_source' => $bottom->data_source,
                 ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($bottom->content_type == 'Documents'): ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($bottom->title); ?><span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($bottom->getResult())); ?> <?php echo e((count($bottom->getResult()) == 0 || count($bottom->getResult()) > 1) ? $bottom->plural_item : $bottom->single_item); ?></span>
                            </div>
                            <span
                                class="badge badge-xs badge-success"><?php echo e(Utility::newCount($bottom->getResult())); ?></span>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php $__empty_1 = true; $__currentLoopData = $bottom->getResult(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc_response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($bottom->max_item >= $loop->iteration): ?>
                                <?php
                                    $doc_icon = Utility::GetDocProp($doc_response,'Icon');
                                    $doc_icon = !empty($doc_icon) ? $doc_icon : 'fa fa-file-text-o';
                                ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="<?php echo e($doc_icon); ?>" aria-hidden="true"></i>
                                            </div>
                                            <div class="col ml-n2">
                                                <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                    <h6 class="text-sm mb-0">
                                                        <a href="<?php echo e(route('docs.view',[tenant('tenant_id'),$doc_response->DocID])); ?>"><?php echo e(Utility::isDate(Utility::GetDocProp($doc_response,'Title'))); ?></a>
                                                    </h6>
                                                <?php endif; ?>
                                                <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                    <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate(Utility::GetDocProp($doc_response,'Subtitle'))); ?></p>
                                                <?php endif; ?>
                                                <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                    <span
                                                        class="card-text text-xs"><?php echo e(Utility::isDate(Utility::GetDocProp($doc_response,'Excerpt'))); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-12 text-right">
                                                <span
                                                    class="badge badge-xs <?php echo e(Utility::GetDocProp($doc_response,'badge-class')); ?>"><?php echo e(Utility::GetDocProp($doc_response,'Status')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php break; ?>;
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('No Available ') . $bottom->plural_item); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('docs.index',[tenant('tenant_id'),$bottom->data_source])); ?>"
                           class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'Child Workflows'): ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($bottom->title); ?><span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($bottom->getResult())); ?> <?php echo e((count($bottom->getResult()) == 0 || count($bottom->getResult()) > 1) ? $bottom->plural_item : $bottom->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php $__empty_1 = true; $__currentLoopData = $bottom->getResult(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($bottom->max_item >= $loop->iteration): ?>
                                <?php
                                    $columnArray = $row->ColumnValues;
                                    $icon = Utility::GetTableRowColumnValue($columnArray,'Icon');
                                    $icon = !empty($icon) ? $icon : 'fa fa-file-text-o';
                                ?>
                                <?php if(!empty(Utility::GetTableRowColumnValue($columnArray,'Title'))): ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="<?php echo e($icon); ?>" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">
                                                    <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                        <h6 class="text-sm mb-0">
                                                            <a href="<?php echo e(route('batch.form.detail',[tenant('tenant_id'),$bottom->content_type,Utility::GetTableRowColumnValue($columnArray,'Title')])); ?>"><?php echo e(Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Title'))); ?></a>
                                                        </h6>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                        <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Subtitle'))); ?></p>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                        <span
                                                            class="card-text text-xs"><?php echo e(Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Excerpt'))); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-12 text-right">
                                                    <span
                                                        class="badge badge-xs <?php echo e(Utility::GetTableRowColumnValue($columnArray,'badge-class')); ?>"><?php echo e(Utility::GetTableRowColumnValue($columnArray,'Status')); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php break; ?>;
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('No Available ') . $bottom->plural_item); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('batch.detail',[tenant('tenant_id'),$bottom->data_source])); ?>"
                           class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'Workflow view'): ?>
            <?php
                $workflow_views = $bottom->getResult();
                $adv_config = json_decode($bottom->adv_config);
            ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($bottom->title); ?><span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($workflow_views['details'])); ?> <?php echo e((count($workflow_views['details']) == 0 || count($workflow_views['details']) > 1) ? $bottom->plural_item : $bottom->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on"): ?>
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        <?php for($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++): ?>
                                            <th class="pointer text-dark">
                                                <?php echo e((isset($workflow_views['titles'][$i]) ? Str::title($workflow_views['titles'][$i]) : '')); ?>

                                            </th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    <?php if($workflow_views['is_success'] == true): ?>
                                        <?php $__empty_1 = true; $__currentLoopData = $workflow_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workflow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php if($bottom->max_item >= $loop->iteration): ?>
                                                <?php
                                                    if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                                    {
                                                        $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($bottom->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                    else
                                                    {
                                                        $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($bottom->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                ?>
                                                <tr>
                                                    <?php
                                                        $first_column = true;
                                                    ?>
                                                    <?php for($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++): ?>
                                                        <td>
                                                            <?php if($first_column): ?>
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '')); ?></a>
                                                                <?php echo e($first_column = false); ?>

                                                            <?php else: ?>
                                                                <?php echo e((!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '')); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endfor; ?>
                                                </tr>
                                            <?php else: ?>
                                                <?php break; ?>;
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                <?php echo e(__('No Available ') . $bottom->plural_item); ?>

                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('An error occurred retrieving the list of ') . $bottom->plural_item . '. ' . __('Please contact your system administrator and reference error: ')); ?>

                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    
                    <?php else: ?>
                        <div class="card-wrapper p-3">
                            <?php if($workflow_views['is_success'] == true): ?>
                                <?php $__empty_1 = true; $__currentLoopData = $workflow_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workflow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php if($bottom->max_item >= $loop->iteration): ?>
                                        <?php
                                            if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                            {
                                                $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($bottom->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                            else
                                            {
                                                $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($bottom->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                        ?>
                                        <div class="card mb-2 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col ml-n2">
                                                        <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                            <h6 class="text-sm mb-0">
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty($workflow[$workflow_views['titles'][2]]) ? Utility::isDate($workflow[$workflow_views['titles'][2]]) : '')); ?></a>
                                                            </h6>
                                                        <?php endif; ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                            <?php if(isset($workflow[$workflow_views['titles'][3]]) && !empty($workflow[$workflow_views['titles'][3]])): ?>
                                                                <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate($workflow[$workflow_views['titles'][3]])); ?></p>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                            <?php if(isset($workflow[$workflow_views['titles'][4]]) && !empty($workflow[$workflow_views['titles'][4]])): ?>
                                                                <span
                                                                    class="card-text text-xs"><?php echo e(Utility::isDate($workflow[$workflow_views['titles'][4]])); ?></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php if(in_array('Status',$workflow_views['titles']) == true): ?>
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4 <?php echo e((!in_array($workflow['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : ''); ?>"
                                                                <?php if(in_array($workflow['Status'],array_keys(config('statuscolor')))): ?> style="background-color: <?php echo e(config('statuscolor.'.$workflow['Status'])); ?>"<?php endif; ?>><?php echo e($workflow['Status']); ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(in_array('Progress',$workflow_views['titles']) == true): ?>
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            <span class="completion mr-2"><small><?php echo e($workflow['Progress']); ?>%</small></span>
                                                            <?php
                                                                $progressColor = "";

                                                                if ($workflow['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($workflow['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($workflow['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $bottomWidth = $bottom->returnClass();

                                                                if ($bottomWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            ?>
                                                            <div>
                                                                <div class="progress progress-xs" style="width: <?php echo e($progressBarWidth); ?>">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($workflow['Progress']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($workflow['Progress']); ?>%; background-color: <?php echo e($progressColor); ?>;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php break; ?>;
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('No Available ') . $bottom->plural_item); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    <?php echo e(__('An error occurred retrieving').' '.$bottom->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-footer py-2 row footer-row">
                        <?php if(!empty($bottom->eform_url)): ?>
                            <div class="col text-left">
                                <a href="<?php echo e(route('eforms.view',[tenant('tenant_id'),$bottom->id])); ?>"
                                   class="text-sm text-primary font-weight-bold"><?php echo e(__('New..')); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="col <?php echo e((!empty($bottom->eform_url)) ? 'text-right' : 'text-center'); ?>">
                            <a href="<?php echo e(route('tasks.index',[tenant('tenant_id')])); ?>"
                               class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'Content view'): ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <?php
                    $content_views = $bottom->getResult();
                    $adv_config = json_decode($bottom->adv_config);
                ?>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($bottom->title); ?><span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($content_views['details'])); ?> <?php echo e((count($content_views['details']) == 0 || count($content_views['details']) > 1) ? $bottom->plural_item : $bottom->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on"): ?>
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        <?php for($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++): ?>
                                            <th class="pointer text-dark">
                                                <?php echo e((isset($content_views['titles'][$i]) ? Str::title($content_views['titles'][$i]) : '')); ?>

                                            </th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    <?php if($content_views['is_success'] == true): ?>
                                        <?php $__empty_1 = true; $__currentLoopData = $content_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php if($bottom->max_item >= $loop->iteration): ?>
                                                <?php if(isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID'])): ?>
                                                    <?php
                                                        $appName = $content_view['ICS_AppName'];
                                                        $docId = $content_view['ICS_DocumentID'];
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $bottom->data_source.'~'.array_values($content_view)[0];
                                                        $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                                    ?>
                                                <?php else: ?>
                                                    <?php
                                                        $appName = '';
                                                        $docId = '';
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $bottom->data_source.'~'.array_values($content_view)[0];
                                                        $url = 'javascript:void(0)';
                                                    ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <?php
                                                        $first_column = true;
                                                    ?>
                                                    <?php for($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++): ?>
                                                        <td>
                                                            <?php if($first_column): ?>
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '')); ?></a>
                                                                <?php echo e($first_column = false); ?>

                                                            <?php else: ?>
                                                                <?php echo e((!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '')); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endfor; ?>
                                                </tr>
                                            <?php else: ?>
                                                <?php break; ?>;
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                <?php echo e(__('No Available ') . $bottom->plural_item); ?>

                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('An error occurred retrieving the list of ') . $bottom->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']); ?>

                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    
                    <?php else: ?>
                        <div class="card-wrapper p-3">
                            <?php if($content_views['is_success'] == true): ?>
                                <?php $__empty_1 = true; $__currentLoopData = $content_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php if($bottom->max_item >= $loop->iteration): ?>
                                        <?php if(isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID'])): ?>
                                            <?php
                                                $appName = $content_view['ICS_AppName'];
                                                $docId = $content_view['ICS_DocumentID'];
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $bottom->data_source.'~'.array_values($content_view)[0];
                                                $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                            ?>
                                        <?php else: ?>
                                            <?php
                                                $appName = '';
                                                $docId = '';
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $bottom->data_source.'~'.array_values($content_view)[0];
                                                $url = 'javascript:void(0)';
                                            ?>
                                        <?php endif; ?>


                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-file" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col ml-n2">
                                                        <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                            <h6 class="text-sm mb-0">
                                                                <a href="<?php echo e($url); ?>"><?php echo e((!empty($content_view[$content_views['titles'][0]]) ? Utility::isDate($content_view[$content_views['titles'][0]]) : '')); ?></a>
                                                            </h6>
                                                        <?php endif; ?>
                                                        <?php if(count($content_views['titles']) >= 3): ?>
                                                            <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                                <p class="card-text small text-muted mb-0"><?php echo e((!empty($content_view[$content_views['titles'][1]]) ? Utility::isDate($content_view[$content_views['titles'][1]]) : '')); ?></p>
                                                            <?php endif; ?>
                                                            <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                                <span
                                                                    class="card-text text-xs"><?php echo e((!empty($content_view[$content_views['titles'][2]]) ? Utility::isDate($content_view[$content_views['titles'][2]]) : '')); ?></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php if(array_key_exists('Status', $content_view) == true): ?>
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4 <?php echo e((!in_array($content_view['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : ''); ?>"
                                                                <?php if(in_array($content_view['Status'],array_keys(config('statuscolor')))): ?> style="background-color: <?php echo e(config('statuscolor.'.$content_view['Status'])); ?>"<?php endif; ?>
                                                                >
                                                                <?php echo e($content_view['Status']); ?>

                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(array_key_exists('Progress', $content_view) == true): ?>
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            <?php
                                                                $progressValue = $content_view['Progress'] == NULL ? "0" : $content_view['Progress'];

                                                                $progressColor = "";

                                                                if ($content_view['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($content_view['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($content_view['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $bottomWidth = $bottom->returnClass();

                                                                if ($bottomWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            ?>
                                                            <span class="completion mr-2"><small><?php echo e($progressValue); ?>%</small></span>
                                                            <div>
                                                                <div class="progress progress-xs" style="width: <?php echo e($progressBarWidth); ?>">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($content_view['Progress']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($content_view['Progress']); ?>%; background-color: <?php echo e($progressColor); ?>;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php break; ?>;
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        <?php echo e(__('No Available ') . $bottom->plural_item); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving the list of ') . $bottom->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-footer py-2 row footer-row">
                        <?php if(!empty($bottom->eform_url)): ?>
                            <div class="col text-left">
                                <a href="<?php echo e(route('eforms.view',[tenant('tenant_id'),$bottom->id])); ?>"
                                   class="text-sm text-primary font-weight-bold"><?php echo e(__('New..')); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="col <?php echo e((!empty($bottom->eform_url)) ? 'text-right' : 'text-center'); ?>">
                            <a href="<?php echo e(route('folder.index',[tenant('tenant_id')])); ?>"
                               class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'Notifications'): ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Notifications')); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php if(user()->getUnreadNotification()->count() > 0): ?>
                            <?php $__currentLoopData = user()->getUnreadNotification(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($bottom->max_item >= $loop->iteration): ?>
                                    <div class="list-group-item list-group-item-action ">
                                    
                                        <?php if($notification->created_at > user()->last_login_at && $notification->created_at > user()->notifications_read): ?>
                                            <small class="float-right badge badge-sm badge-success"><?php echo e(__('New')); ?></small>
                                        <?php endif; ?>
                                        <div class="d-flex">
                                            <div>
                                                <i class="fas <?php echo e((!empty($notification->type)) ? $notification->type : 'fa-cogs'); ?> mr-3"></i>
                                            </div>
                                            <div>
                                                <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                     <div class="text-sm lh-150"><?php echo e(mb_strimwidth($notification->text, 0, 100, "...")); ?></div>
                                                <?php endif; ?>
                                                <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                    <small
                                                        class="d-block text-muted"><?php echo e(Utility::getDateFormatted($notification->created_at,true)); ?></small>
                                                <?php endif; ?>
                                                <?php if(!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type)): ?>

                                                    <?php if($notification->link_type == 'calendar'): ?>
                                                        <a class=" calendar_notif" href="<?php echo \App\Models\UserNotification::getLink($notification->id); ?>"
                                                        data-title="<?php echo \App\Models\Calendar::getCalendarName($notification->link_url); ?>">
                                                            <small class="float-left badge badge-sm <?php echo e($notification->link_color); ?> text-white"
                                                                data-type='<?php echo e($notification->link_type); ?>'>
                                                                <?php echo e($notification->link_title); ?>

                                                            </small>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo \App\Models\UserNotification::getLink($notification->id); ?>"
                                                        class="from_notification"
                                                        data-title="<?php echo $notification->link_title; ?>"
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
                                    </a>
                                </div>
                                <?php else: ?>
                                    <?php break; ?>;
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="text-center">
                                    <div class="text-sm lh-150 font-weight-bold"><?php echo e(__('No New Notifications')); ?></div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('notification.index',tenant('tenant_id'))); ?>"
                        class="text-sm text-primary font-weight-bold"><?php echo e(__('See all notifications')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'Calendar'): ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <?php
                    $calendar_id = uniqid().$bottom->id;
                ?>
                <div class="card widget-calendar">
                    <div class="card-header">
                        <div class="text-sm text-muted mb-1 layout-calendar-year"></div>
                        <a href="<?php echo e(route('calendar.index',tenant('tenant_id'))); ?>">
                            <div class="h5 mb-0 layout-calendar-day text-primary"></div>
                        </a>
                    </div>
                    <div data-toggle="<?php echo e($calendar_id); ?>-calendar"></div>
                </div>
                <?php $__env->startPush('script'); ?>
                    <script>
                        $('[data-toggle="<?php echo e($calendar_id); ?>-calendar"]').fullCalendar({
                            contentHeight: "auto",
                            displayEventTime: false,
                            theme: !1,
                            buttonIcons: {prev: " fas fa-angle-left", next: " fas fa-angle-right"},
                            header: {right: "next", center: "title, ", left: "prev"},
                            editable: !0,
                            events: <?php echo json_encode($arrData); ?>,
                            eventClick: function (e, t) {
                                var title = e.title;
                                var url = e.url;

                                if (typeof url != 'undefined') {
                                    $("#commonModal .modal-title").html(title);
                                    $("#commonModal .modal-dialog").addClass('modal-md');
                                    $("#commonModal .modal-dialog").addClass('ow-break-word');
                                    $("#commonModal .modal-title").addClass('ow-anywhere');
                                    $("#commonModal").modal('show');
                                    $.get(url, {}, function (data) {
                                        $('#commonModal .modal-body').html(data);
                                    });
                                    return false;
                                }
                            }
                        });
                        var mYear = moment().format("YYYY"), mDay = moment().format("dddd, MMM D");
                        $(".layout-calendar-year").html(mYear), $(".layout-calendar-day").html(mDay);
                    </script>
                <?php $__env->stopPush(); ?>
            </div>
        <?php elseif($bottom->content_type == 'System message'): ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-body">
                        <?php if(user()->account_type == 4): ?>
                            <?php echo Utility::getValByName('welcome_message_ext'); ?>

                        <?php else: ?>
                            <?php echo Utility::getValByName('welcome_message_int'); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'KPI Card'): ?>
            <?php
                $bottomKpiData = $bottom->getResult();
            ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e($bottomKpiData['title']); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="kpi_card_title"><?php echo e(ucfirst($bottomKpiData['data'][0])); ?></p>
                        <div class="text-center">
                            <h1 class="font-weight-700 kpi_card_value"><?php echo e($bottomKpiData['data'][1]); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'Pie Chart' || $bottom->content_type == 'Line Chart' || $bottom->content_type == 'Vertical bar Chart' || $bottom->content_type == 'Horizontal bar Chart'): ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <?php
                    $fullChartData = $bottom->getResult();
                    $id = uniqid().$bottom->id;
                ?>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e($bottom->title); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if($fullChartData['is_success']): ?>
                            <div class="chartWrapper" id="chartwrap-<?php echo e($id); ?>" >
                                <div id="chartarea-<?php echo e($id); ?>">
                                    <canvas id="<?php echo e($id); ?>" ></canvas>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving').' '.$top->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($fullChartData['is_success']): ?>
                    <?php $__env->startPush('script'); ?>
                        <script>
                            var ctx = document.getElementById('<?php echo e($id); ?>').getContext('2d');

                            var chartHeight = <?php echo json_encode($fullChartData['height']); ?>;
                            var chartWidth = <?php echo json_encode($fullChartData['width']); ?>;

                            var chartwrap = $("#chartwrap-<?php echo e($id); ?>");
                            var chartarea = $("#chartarea-<?php echo e($id); ?>");

                            var currWidth = parseInt(chartwrap.width());

                            if(chartWidth > 0){
                                chartarea.css('width', chartWidth + "px");
                            }

                            if(chartHeight > 0){
                                chartarea.css('height', chartHeight + "px");
                            }

                            var fullChart = new Chart(ctx, {
                                type: <?php echo json_encode($fullChartData['type']); ?>,
                                data: {
                                    labels: <?php echo json_encode($fullChartData['labels']); ?>,
                                    datasets: [<?php echo json_encode($fullChartData['data']); ?>],
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    <?php if($fullChartData['type'] != 'doughnut'): ?>
                                    tooltips: {
                                        mode: 'label',
                                        callbacks: {
                                            label: function (tooltipItem, data) {
                                                // if (tooltipItem.value != '1' && tooltipItem.value != '0') {
                                                if (tooltipItem.value > 1) {
                                                    return ' ' + Number(tooltipItem.value).toLocaleString() + " <?php echo e($fullChartData['plural']); ?>";
                                                } else {
                                                    return ' ' + Number(tooltipItem.value).toLocaleString() + " <?php echo e($fullChartData['single']); ?>";
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true,
												userCallback: function(value, index, values) {
													return '       ' + value.toLocaleString();
												}
                                            }
                                        }],
                                        xAxes: [{
                                            ticks: {
                                                beginAtZero: true,
												userCallback: function(value, index, values) {
													return '       ' + value.toLocaleString();
												}
                                            }
                                        }]
                                    },
                                    legend: {display: false}
                                    <?php else: ?>
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            fontColor: '#333',
                                            usePointStyle: true,
                                        }
                                    },
                                    tooltips: {
                                        callbacks: {
                                            title: function (tooltipItem, data) {
                                                return data['labels'][tooltipItem[0]['index']];
                                            },
                                            label: function (tooltipItem, data) {
                                                if (data['datasets'][0]['data'][tooltipItem['index']] > 1) {
                                                    return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " <?php echo e($fullChartData['plural']); ?>";
                                                } else {
                                                    return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " <?php echo e($fullChartData['single']); ?>";
                                                }
                                            },
                                        },
                                    }
                                    <?php endif; ?>
                                },
                            });
                        </script>
                    <?php $__env->stopPush(); ?>
                <?php endif; ?>
            </div>
        <?php elseif($bottom->content_type == 'Custom HTML'): ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e($bottom->title); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <iframe id="dynamicHtmlBottomFrame" src="<?php echo $bottom->data_source; ?>" frameborder="0" style="height:200px;width: 100%;" data-src="<?php echo $bottom->data_source; ?>" data-title="<?php echo $bottom->title; ?>" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'Integration'): ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <?php
                    $Integrations = $bottom->getResult();
                ?>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($bottom->title); ?><span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($Integrations['details'])); ?> <?php echo e((count($Integrations['details']) == 0 || count($Integrations['details']) > 1) ? $bottom->plural_item : $bottom->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php if($Integrations['is_success'] == true): ?>
                            <?php $__empty_1 = true; $__currentLoopData = $Integrations['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $integration_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($bottom->max_item >= $loop->iteration): ?>

                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="fas fa-file" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">

                                                    <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                        <?php if(isset($integration_val[$Integrations['titles'][0]]) && !empty($integration_val[$Integrations['titles'][0]])): ?>
                                                            <?php if($Integrations['details_type'] == 1): ?>
                                                                <?php
                                                                    $basic_details_keys = array_intersect(array_keys($integration_val), $Integrations['basic_details']);
                                                                    foreach($basic_details_keys as $k1 => $v1){
                                                                        $basic_details_array[$v1] = $integration_val[$v1];
                                                                    }
                                                                ?>
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)"
                                                                       class="open-basic-details"
                                                                       data-details="<?php echo e(json_encode($basic_details_array)); ?>"
                                                                       data-url="<?php echo e(route('integration.basic.detail',tenant('tenant_id'))); ?>"
                                                                       data-size="md"
                                                                       data-title="<?php echo e(__('Basic Details')); ?>"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][0]])); ?></a>
                                                                </h6>
                                                            <?php elseif($Integrations['details_type'] == 2): ?>
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)" class="open_doc"
                                                                       data-id="get-integration-details<?php echo e($key); ?>"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][0]])); ?></a>
                                                                </h6>
                                                                <?php echo Form::open(['method' => 'POST', 'route' => ['integration.detail',[tenant('tenant_id'), "rest" => $Integrations['id']]],'id'=>'get-integration-details'.$key]); ?>

                                                                <?php echo e(Form::hidden('url',\Crypt::encrypt($integration_val['url']), ['class' => 'form-control'])); ?>

                                                                <?php echo Form::close(); ?>

                                                            <?php else: ?>
                                                                <h6 class="text-sm mb-0"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][0]])); ?></h6>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if(count($Integrations['titles']) >= 3): ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                            <?php if(isset($integration_val[$Integrations['titles'][1]]) && !empty($integration_val[$Integrations['titles'][1]])): ?>
                                                                <p class="card-text small text-muted mb-0"><?php echo e((!empty($integration_val[$Integrations['titles'][1]]) ? Utility::isDate($integration_val[$Integrations['titles'][1]]) : '')); ?></p>
                                                            <?php endif; ?>

                                                        <?php endif; ?>
                                                        <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                            <?php if(isset($integration_val[$Integrations['titles'][2]]) && !empty($integration_val[$Integrations['titles'][2]])): ?>
                                                                <span
                                                                    class="card-text text-xs"><?php echo e(Utility::isDate($integration_val[$Integrations['titles'][2]])); ?></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php break; ?>;
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    <?php echo e(__('No Available ') . $bottom->plural_item); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving').' '.$bottom->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 row">

                        <div class="col <?php echo e((!empty($bottom->eform_url)) ? 'text-right' : 'text-center'); ?>">
                            <a href="<?php echo e(route('integration.list',[tenant('tenant_id'),$Integrations['name'],$Integrations['id']])); ?>"
                               class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'Court Case'): ?>
            <?php
                $case_views = $bottom->getResult();
            ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0"><?php echo e($bottom->title); ?><span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic"><?php echo e(count($case_views['details'])); ?> <?php echo e((count($case_views['details']) == 0 || count($case_views['details']) > 1) ? $bottom->plural_item : $bottom->single_item); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <?php if($case_views['is_success'] == true): ?>
                            <?php $__empty_1 = true; $__currentLoopData = $case_views['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($bottom->max_item >= $loop->iteration): ?>
                                    <?php
                                        $url = route('courtcase.detail',[tenant('tenant_id'),$bottom->data_source,$case['ActiveBatchID'] ?? ""]);
                                    ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">
                                                    <?php if(env('CARD_FIELDS_STACK') >= 1): ?>
                                                        <h6 class="text-sm mb-0">
                                                            <a href="<?php echo e($url); ?>"><?php echo e((!empty($case[$case_views['titles'][2]]) ? Utility::isDate($case[$case_views['titles'][2]]) : '')); ?></a>
                                                        </h6>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 2): ?>
                                                        <?php if(isset($case[$case_views['titles'][3]]) && !empty($case[$case_views['titles'][3]])): ?>
                                                            <p class="card-text small text-muted mb-0"><?php echo e(Utility::isDate($case[$case_views['titles'][3]])); ?></p>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if(env('CARD_FIELDS_STACK') >= 3): ?>
                                                        <?php if(isset($case[$case_views['titles'][4]]) && !empty($case[$case_views['titles'][4]])): ?>
                                                            <span
                                                                class="card-text text-xs"><?php echo e(Utility::isDate($case[$case_views['titles'][4]])); ?></span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if(in_array('Status',$case_views['titles']) == true): ?>
                                                    <div class="col-12 text-right">
                                                        <span
                                                            class="badge badge-xs text-white <?php echo e((!in_array($case['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : ''); ?>"
                                                            <?php if(in_array($case['Status'],array_keys(config('statuscolor')))): ?> style="background-color: <?php echo e(config('statuscolor.'.$case['Status'])); ?>"<?php endif; ?>><?php echo e($case['Status']); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php break; ?>;
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    <?php echo e(__('No Available ') . $bottom->plural_item); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                <?php echo e(__('An error occurred retrieving').' '.$bottom->plural_item.'. '.__('Please contact your system administrator for assistance.')); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="<?php echo e(route('courtcase.list',[tenant('tenant_id'),$bottom->data_source,$bottom->id])); ?>"
                           class="text-sm text-primary font-weight-bold"><?php echo e(__('See all..')); ?></a>
                    </div>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'Custom Page'): ?>
            <?php
                $custom_page = $bottom->getResult();
                $style = "";
                if($bottom->max_item > 0) $style = "max-height: ".(100*$bottom->max_item)."px; overflow: auto;"
            ?>
            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <div class="card">
                    <?php if(!is_null($custom_page)): ?>
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="h5 mb-0"><?php echo e($custom_page->title); ?><span
                                                class="badge badge-success badge-xs"></span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="<?php echo e($style); ?>">
                            <?php echo $custom_page->detail; ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php elseif($bottom->content_type == 'News Feed'): ?>
            <?php
                $postList = $bottom->getResult();
                $dateformat = Utility::getValByName('date_format');
            ?>

            <div class="<?php echo e($bottom->returnClass()); ?> col-auto">
                <div class="card overflow-auto h-580">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="h5 mb-0"><?php echo e($bottom->title); ?></h5>
                                    <span class="d-block text-sm font-italic"><?php echo e(count($bottom->getResult())); ?> <?php echo e((count($bottom->getResult()) == 0 || count($bottom->getResult()) > 1) ? $bottom->plural_item : $bottom->single_item); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-wrapper overflow-auto h-580">
                            <?php $__currentLoopData = $postList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card-body border-bottom">
                                    <?php
                                        if ($post->image) {
                                            if($post->image_placement == "center"){
                                                $imageClass = "12";
                                                $contentClass = "12";
                                                $textAlign = 'text-right';
                                            }elseif($post->image_placement == "right"){
                                                $imageClass = "4 order-lg-2";
                                                $contentClass = "8 order-lg-1";
                                                $textAlign = '';
                                            }else{
                                                $imageClass = "4";
                                                $contentClass = "8";
                                                $textAlign = '';
                                            }
                                        } else {
                                            $contentClass = "12";
                                            $textAlign = '';
                                        }
                                    ?>
                                    <div class="row">
                                        <?php if($post->image): ?>
                                            <div class="col-<?php echo e($imageClass); ?>">
                                                <div class="">
                                                    <div class=" overflow-hidden <?php echo e($post->image_placement == 'center' ? 'h-200' : 'max-h-200'); ?>">
                                                        <a href="<?php echo e(route('newsfeed.show',[tenant('tenant_id'),$post->id])); ?>" class="d-block animate-this">
                                                            <img alt="Image placeholder" src="<?php echo e(asset(Storage::url($post->image))); ?>" class="post_image">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-<?php echo e($contentClass); ?>">
                                            <div class="row">
                                                <div class="col-12 <?php echo e($textAlign); ?> <?php echo e($post->image_placement == 'center' ? 'mt-4' : ''); ?>">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <div class="overflow-hidden">
                                                            <h5 class="h5 mb-0 overflow-hidden text-truncate"><a href="<?php echo e(route('newsfeed.show',[tenant('tenant_id'),$post->id])); ?>" class="post_title"><?php echo $post->title; ?></a></h5>
                                                        </div>
                                                    </div>
                                                    <span class="post_subtitle"><?php echo e($post->user->name); ?> - <?php echo e(Utility::getDateFormatted($post->created_at,false,$dateformat)); ?></span>
                                                </div>

                                                <div class="shortened_txt col-12 card-text mt-2 mb-2 text-muted post_body <?php echo e($post->excerpt_length > 0 ? 'overflow-hidden' : 'overflow-auto'); ?>" id="shortened_txt_<?php echo e($post->id); ?>" >
                                                    <?php echo $post->detail; ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 text-right <?php echo e($post->image_placement == 'right' ? 'order-lg-3' : ''); ?>">
                                            <a href="<?php echo e(route('newsfeed.show',[tenant('tenant_id'),$post->id])); ?>">
                                                <span class="text-primary"><?php echo e(__('Read more...')); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="card-footer py-2 text-center">
                            <a href="<?php echo e(route('newsfeed.list',[tenant('tenant_id')])); ?>">
                                <span class="text-primary"><?php echo e(__('See all...')); ?></span>
                            </a>
                        </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/libs/truncate-fit-container-height/lc_text_shortener.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript">

        //console.log("usr", <?php echo json_encode($usrData, 15, 512) ?>);

        //custom HTML for top
        if(document.getElementById('dynamicHtmlTopFrame')) {
            PassFormInfo('dynamicHtmlTopFrame');
        };

        //custom HTML for middle
        if(document.getElementById('dynamicHtmlMiddleFrame')){
            PassFormInfo('dynamicHtmlMiddleFrame');
        };

         //custom HTML for bottom
        if(document.getElementById('dynamicHtmlBottomFrame')){
            PassFormInfo('dynamicHtmlBottomFrame');
        };

        function PassFormInfo(id) {
            // The format of this message is required. Do not modify.
            let frame = document.getElementById(id);
            let title = $('#'+id).data('title');
            var message = {
                action: "[init-external-page]",
                info: {
                    userName: '<?php echo $usrData->Username; ?>',
                    fullName: '<?php echo $usrData->FullName; ?>',
                    emailAddress: '<?php echo $usrData->EmailAddress; ?>',
                    tenantId: '<?php echo $usrData->TenantId; ?>',
                    userId: '<?php echo $usrData->UserID; ?>',
                    securityToken: '<?php echo $usrData->SecurityToken; ?>',
                    title : title
                }
            };

            // Post the message to all Custom HTML iframes on the page
			var elms = document.querySelectorAll("[id='" + id + "']");
			for(var i = 0; i < elms.length; i++) {
                elms[i].contentWindow.postMessage(message, '*');
            }
        }


        $('.open_doc').on('click', function () {
            var form_id = $(this).data('id');
            $(`#${form_id}`).trigger("submit");
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

        <?php if(!empty($postList) && count($postList)): ?>
            $(document).ready(function(e) {
                <?php $__currentLoopData = $postList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($post->excerpt_length > 0): ?>
                        $(`#shortened_txt_<?php echo e($post->id); ?>`).lc_txt_shortener('...', <?php echo e($post->excerpt_length); ?>, '');
                        var text = $(`#shortened_txt_<?php echo e($post->id); ?>`).find('.lcts_end_txt').closest("p").text();
                        var replace = new RegExp('...' + '$');
                var str = text.replace(replace, '');
                        str = str.trimEnd();
                        $(`#shortened_txt_<?php echo e($post->id); ?>`).find('.lcts_end_txt').closest("p").html(str+'...');
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            });

        <?php endif; ?>
    </script>

<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/code /resources/views/admin/dynamic_layout.blade.php ENDPATH**/ ?>