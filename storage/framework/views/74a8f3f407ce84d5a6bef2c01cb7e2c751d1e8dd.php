    <div class="row align-items-center">
        <div class="col">
            <ul class="nav nav-tabs nav-bordered mb-3">
                <li class="nav-item">
                    <a href="#properties" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                        <span class="d-lg-block"><?php echo e(__('Properties')); ?></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#designer" data-toggle="tab" aria-expanded="true" class="nav-link">
                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                        <span class="d-lg-block"><?php echo e(__('Designer')); ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#presentation" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                        <span class="d-lg-block"><?php echo e(__('Presentation')); ?></span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="tab-content">
                <div class="tab-pane active show" id="properties">

                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['id' => 'propertiesSaveFormData','action' => route('qapp.properties',[tenant('tenant_id'), $qapp->id]),'enctype' => 'multipart/form-data']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'propertiesSaveFormData','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('qapp.properties',[tenant('tenant_id'), $qapp->id])),'enctype' => 'multipart/form-data']); ?>
                        <div class="row">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'name' => 'name','value' => $qapp->name,'containerClass' => 'col-xs-12 col-sm-12 col-md-4 col-lg-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($qapp->name),'container-class' => 'col-xs-12 col-sm-12 col-md-4 col-lg-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.text','data' => ['required' => true,'name' => 'description','value' => $qapp->description,'containerClass' => 'col-xs-12 col-sm-12 col-md-8 col-lg-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'name' => 'description','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($qapp->description),'container-class' => 'col-xs-12 col-sm-12 col-md-8 col-lg-8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                            <div class="col-md-12 my-3">
                                <div class="d-flex align-items-center col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.checkbox','data' => ['name' => 'online','id' => 'online','label' => 'App is online','default' => 'false','value' => '1','checked' => $qapp->online == 1 ? true : false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'online','id' => 'online','label' => 'App is online','default' => 'false','value' => '1','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($qapp->online == 1 ? true : false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-12 my-3">
                                <p class="mb-2"><?php echo e(__('Quick App data options')); ?></p>
                                <input type="checkbox" name="allow_upload" value="1" class="mr-2" <?php echo e($qapp->allow_upload == 1 ? 'checked' : ""); ?>> <?php echo e(__('Allow users to upload data (Excel, CSV)')); ?> <br>
                                <input type="checkbox" name="allow_download" value="1" class="mr-2" <?php echo e($qapp->allow_download == 1 ? 'checked' : ""); ?>> <?php echo e(__('Allow users to download data')); ?> <br>
                                <input type="checkbox" name="allow_print" value="1" class="mr-2" <?php echo e($qapp->allow_print == 1 ? 'checked' : ""); ?>> <?php echo e(__('Allow users to print data')); ?>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label for=""><?php echo e(__('Content Store repository for attachments')); ?></label>
                                <select name="ics_appname" class="form-control" id="">
                                    <?php $__currentLoopData = $repositories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repositorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($repositorie->RepositoryID); ?>" <?php echo e($qapp->ics_appname ==  $repositorie->RepositoryID ? 'selected' : ""); ?>><?php echo e($repositorie->RepositoryName); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="text-right pt-3">
                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','sm' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'propertiesSaveForm']); ?><?php echo e(__('Create')); ?> <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes(['data-dismiss' => 'modal']); ?><?php echo e(__('Cancel')); ?> <?php echo $__env->renderComponent(); ?>
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

                <div class="tab-pane" id="designer">

                    <div id="designerForm">
                        <div id="build-wrap"></div>
                        <div class="text-right pt-3">
                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','sm' => true,'primary' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'previewForm']); ?><?php echo e(__('Preview')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','sm' => true,'primary' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'designerSaveForm']); ?><?php echo e(__('Save')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                        </div>
                    </div>

                    <div class="d-none" id="previewDesignerForm">
                        <div id="preview_form"></div>
                        <div class="text-right pt-3">
                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','sm' => true,'primary' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'backToDesigner']); ?><?php echo e(__('Back to designer')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                        </div>
                    </div>


                </div>

                <div class="tab-pane" id="presentation">

                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form','data' => ['id' => 'presentationSaveFormData','action' => route('qapp.presentation',[tenant('tenant_id'), 1]),'enctype' => 'multipart/form-data']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'presentationSaveFormData','action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('qapp.presentation',[tenant('tenant_id'), 1])),'enctype' => 'multipart/form-data']); ?>
                        <div class="row">

                            <div class="col-md-12">
                                <p><?php echo e(__('How would you like to display your Quick App data?')); ?></p>
                            </div>

                            <div class="ml-3">
                                <div class="col-md-12 mb-3">
                                    <p class="mb-2"><?php echo e(__('Home Page Cards')); ?></p>
                                    <div>
                                        <input type="radio" name="card_mode" value="1" class="mr-3" <?php echo e($qapp->card_mode == 1 ? 'checked' : ""); ?>> Simple list
                                    </div>
                                    <div>
                                        <input type="radio" name="card_mode" value="2" class="mr-3" <?php echo e($qapp->card_mode == 2 ? 'checked' : ""); ?>> Advanced list
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <p class="mb-2"><?php echo e(__('Navigations')); ?></p>
                                    <div>
                                        <input type="radio" name="navigation_mode" value="1" class="mr-3" <?php echo e($qapp->navigation_mode == 1 ? 'checked' : ""); ?>> Advanced list
                                    </div>
                                    <div>
                                        <input type="radio" name="navigation_mode" value="2" class="mr-3" <?php echo e($qapp->navigation_mode == 2 ? 'checked' : ""); ?>> Cards and grid
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="text-right pt-3">
                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','sm' => true,'pill' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'presentationSaveForm']); ?><?php echo e(__('Create')); ?> <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes(['data-dismiss' => 'modal']); ?><?php echo e(__('Cancel')); ?> <?php echo $__env->renderComponent(); ?>
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



<script>
    $( document ).ready(function() {
        const fbTemplate = document.getElementById('build-wrap');
        var formData = '<?php echo e($qapp->form_json); ?>';
            if(formData){
                var formData = JSON.parse(formData.replace(/&quot;/g,'"'));
            }else{
                var formData = "";
            }
        var options = {
            disabledActionButtons: ['data','save','clear'],
            dataType: 'json',
            formData: formData
        };
        var formBuilder = $(fbTemplate).formBuilder(options);

        $("#previewForm").click(function(){
            var formData = formBuilder.actions.getData();
            formRenderOpts = {
                dataType: 'xml',
                formData: formData
            };
            var renderedForm = $('<div>');
            renderedForm.formRender(formRenderOpts);
            $('#preview_form').html(renderedForm.html());
            $('#designerForm').addClass('d-none');
            $('#previewDesignerForm').removeClass('d-none');
        });

        $("#backToDesigner").click(function(){
            $('#previewDesignerForm').addClass('d-none');
            $('#designerForm').removeClass('d-none');
        });

        $("#designerSaveForm").click(function(){
            var formData = formBuilder.actions.getData();
            var qappId = '<?php echo e($qapp->id); ?>';
            $.ajax({
                type: "POST",
                url: '<?php echo e(route('qapp.designer', tenant('tenant_id'))); ?>',
                dataType: 'json',
                data: {
                    json: JSON.stringify(formData),
                    qappId: qappId,
                },
                success: function (data) {
                    show_toastr('Success', data.message, 'success');
                }
            });
        });

        $("#propertiesSaveForm").click(function(){
            var formData = $('#propertiesSaveFormData').serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo e(route('qapp.properties', [tenant('tenant_id'), $qapp->id])); ?>',
                dataType: 'json',
                data: formData,
                success: function (data) {
                    show_toastr('Success', data.message, 'success');
                }
            });
        });

        $("#presentationSaveForm").click(function(){
            var formData = $('#presentationSaveFormData').serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo e(route('qapp.presentation', [tenant('tenant_id'), $qapp->id])); ?>',
                dataType: 'json',
                data: formData,
                success: function (data) {
                    show_toastr('Success', data.message, 'success');
                }
            });
        });
    });
</script>




<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/code /packages/engage/ilinxengage_qapp/src/resources/views/edit.blade.php ENDPATH**/ ?>