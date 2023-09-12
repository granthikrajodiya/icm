<?php if (isset($component)) { $__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a = $component; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Layouts\App::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(Utility::getValByName('')).'']); ?>
    <?php $__env->startPush('css'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/libs/dropzone/dropzone.min.css')); ?>" type="text/css" />
    <?php $__env->stopPush(); ?>


	<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header actions-toolbar border-0">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="d-inline-block mb-0"><i class="fas fa-cloud-download-alt"></i> <span
                                    id="menu_title"></span></h6>
                        </div>
                        <div class="col text-right">
                            <div class="actions">
                                <div class="dropdown product-dropdown" data-toggle="dropdown">
                                    <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item" data-url="<?php echo e(route('newRelease.create', tenant('tenant_id'))); ?>" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('New Release')); ?>"><?php echo e(__('New Release and Product')); ?></a>
                                        <a href="#" data-url="<?php echo e(route('newProduct.create', tenant('tenant_id'))); ?>" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('New Product')); ?>" class="dropdown-item"><?php echo e(__('New Product')); ?></a>
                                        <a href="#" data-size="md" data-title="<?php echo e(__('New Folder')); ?>" data-url="<?php echo e(route('newFile.create', [tenant('tenant_id'), ':product_id', 'folder'])); ?>" class="dropdown-item" id="new_folder"><?php echo e(__('New Folder')); ?></a>
                                        <a href="#" class="dropdown-item" id="edit_release_product" data-size="md" data-title="<?php echo e(__('Edit Release and Product')); ?>" data-url="<?php echo e(route('release-product.edit', [tenant('tenant_id'), ':product_id'])); ?>"><?php echo e(__('Edit Release and Product')); ?></a>
                                        <a href="#" class="dropdown-item" data-size="lg" data-title="<?php echo e(__('Add New Files')); ?>" data-url="<?php echo e(route('newFile.create', [tenant('tenant_id'), ':product_id', 'file'])); ?>" id="add_new_files"><?php echo e(__('Add files...')); ?></a>
                                        <a href="<?php echo e(route('fileaccess.reports', tenant('tenant_id'))); ?>" class="dropdown-item" onclick="window.location.href = '<?php echo e(route('fileaccess.reports', tenant('tenant_id'))); ?>'"><?php echo e(__('Reports...')); ?></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="row justify-content-between align-items-center">
                        <div class="align-items-center d-inline-flex col-12 mb-4">
                            <span class="h6 mb-0 mr-3"><?php echo e(__('Tenant')); ?></span>
                            <select name="tenant" id="tenant" class="form-control">
                                <option value="0"><?php echo e(__('All privileged tenants')); ?></option>
                                <?php $__currentLoopData = $tenant_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($val->tenant_id); ?>"><?php echo e($val->company_name); ?> (<?php echo e($val->tenant_id); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="align-items-center d-inline-flex col">
                            <span class="h6 mb-0 mr-2">Release</span>
                            <select name="release" id="release" class="form-control">
                                <?php $__currentLoopData = $release_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_key => $r_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($r_val); ?>"><?php echo e($r_val); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="align-items-center ml-4 d-inline-flex col">
                            <span class="h6 mb-0 mr-2"><?php echo e(__('Product')); ?></span>
                            <select name="product" id="product" class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
                <div id="fileAccessList">

                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('script'); ?>
        <script src="<?php echo e(asset('assets/libs/dropzone/dropzone.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/dlc_custom.js')); ?>"></script>
        <script type="text/javascript">

            $('#tenant').on('change',function (e) {
                getFileList();
            });

            $('#product').on('change',function (e) {
                getFileList();
            });

            $( document ).ready(function() {
                <?php if(!empty(Session::get('release'))): ?>
                    $("#release").val("<?php echo e(Session::get('release')); ?>").trigger("change");
                <?php else: ?>
                    $('#release').trigger('change');
                <?php endif; ?>

                <?php if(!empty(Session::get('tenant'))): ?>
                    $("#tenant").val("<?php echo e(Session::get('tenant')); ?>");
                <?php endif; ?>
            })

            $('#release').on('change',function (e) {

                var url = "<?php echo e(route('product.get',tenant('tenant_id'))); ?>";

                var data = {product_version: $(this).val()};

                postAjax(url, data, false, function(response){

                    var html = '';
                    response.forEach((val) => {
                        html += `<option value="${val.id}">${val.product_name}</option>`;
                    });
                    $('#product').html(html);
                    <?php if(!empty(Session::get('product'))): ?>
                        $("#product").val("<?php echo e(Session::get('product')); ?>").trigger("change");
                    <?php else: ?>
                        $('#product').trigger('change');
                    <?php endif; ?>

                    <?php if(!empty(Session::get('folder'))): ?>
                        getFileList("<?php echo e(Session::get('folder')); ?>");
                    <?php else: ?>
                        getFileList();
                    <?php endif; ?>

                });
            });

            function getFileList(isSubfolder = false) {

                var url = "<?php echo e(route('fileList.get',tenant('tenant_id'))); ?>";

                var data = {product_id: $('#product').val(), tenant_id: $('#tenant').val(), subfolder: isSubfolder};

                postAjax(url, data, false, function(response){
                    $('#fileAccessList').html('');
                    if(response.is_success){
                        $('#fileAccessList').html(response.data);
                    }
                });
            }

            $('#new_folder').on('click',function(e){
                var product_id = $('#product').val();
                var url = $(this).data('url');
                url = url.replace(':product_id', product_id);
                var title = $(this).data('title');
                var size = $(this).data('size');
                openCommonLoader(title,size,url);
            });

            $('#edit_release_product').on('click',function(e){
                var product_id = $('#product').val();
                var url = $(this).data('url');
                url = url.replace(':product_id', product_id);
                var title = $(this).data('title');
                var size = $(this).data('size');
                openCommonLoader(title,size,url);
            });

            $('#add_new_files').on('click',function(e){
                var product_id = $('#product').val();
                var subfolder = $(this).data('folder');
                var url = $(this).data('url');
                url = url.replace(':product_id', product_id);
                var title = $(this).data('title');
                var size = $(this).data('size');
                openCommonLoader(title,size,url);
            });
        </script>

    <?php $__env->stopPush(); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a)): ?>
<?php $component = $__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a; ?>
<?php unset($__componentOriginalc73518e4e557af3c08494b658146df84390e8f3a); ?>
<?php endif; ?>

<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/ILINXEngage/packages/engage/downloadcenter/src/resources/views/TenantFileAccess/Admin/index.blade.php ENDPATH**/ ?>