<div class="row justify-content-between align-items-center px-4 mb-4">
    <?php if(!empty($subfolder) && $subfolder != false): ?>
        <div class="col">
            <a href="javascript:void(0)" onclick="getFileList();" class="align-items-center">
                <i class="fa fa-arrow-left"></i><span class="ml-4"><?php echo e($subfolder); ?></span>
            </a>
        </div>
    <?php endif; ?>
    <?php if($privilege == 'all'): ?>
    <div class="align-items-center ml-4 col text-right ">
        <button type="button" class="btn btn-sm btn-primary rounded-pill" data-size="lg" data-title="<?php echo e(__('Add New Files')); ?>" id="new_files" data-folder="<?php echo e(!empty($subfolder) && $subfolder != false ? $subfolder : false); ?>" data-url="<?php echo e(route('newFile.create', [tenant('tenant_id'), ':product_id', 'file', ':subfolder'])); ?>"><?php echo e(__('Add files...')); ?></button>
    </div>
    <?php elseif($privilege == 'notGranted'): ?>
        <div class="align-items-center ml-4 col text-right ">
            <button type="button" class="btn btn-sm btn-primary rounded-pill" id="grant_access"><?php echo e(__('Grant Access')); ?></button>
        </div>
    <?php elseif($privilege == 'granted'): ?>
        <div class="align-items-center ml-4 col text-right ">
            <button type="button" class="btn btn-sm btn-primary rounded-pill" id="remove_access"><?php echo e(__('Remove Access')); ?></button>
        </div>
    <?php endif; ?>
</div>
<div class="table-responsive">
    <table class="table align-items-center">
        <thead>
        <tr>
            <th scope="col"><?php echo e(__('FILE')); ?></th>
            <th scope="col"><?php echo e(__('SIZE')); ?></th>
            <th scope="col"><?php echo e(__('DATE')); ?></th>
            <th scope="col" class="text-right" width="100"></th>
        </tr>
        </thead>
        <tbody>
            <?php if($access == true): ?>
                <?php if(count($filelist)>0): ?>
                    <?php $__currentLoopData = $filelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row">
                            <div class="media align-items-center">
                                <div>
                                <div class="avatar-parent-child">
                                    <img alt="Image placeholder" src="<?php echo e($file->icon); ?>" class="avatar rounded" <?php if($file->exe == 'folder'): ?>onclick="getFileList('<?php echo e($file->name); ?>');"<?php endif; ?>>
                                </div>
                                </div>
                                <div class="media-body ml-4">
                                <a href="javascript:void(0)" class="name h6 mb-0 text-sm" <?php if($file->exe == 'folder'): ?>onclick="getFileList('<?php echo e($file->name); ?>');" <?php endif; ?>><?php echo e($file->name); ?></a>
                                </div>
                            </div>
                            </th>
                            <td><?php echo e($file->size); ?></td>
                            <td><?php echo e($file->date); ?></td>

                            <td class="text-right" width="100">
                                <div class="media align-items-center">
                                    <?php if($privilege == 'all' && Auth::user()->account_type == App\Models\User::INTERNAL_TENANT_ADMIN): ?>
                                    <div class="col">
                                        <?php if(!empty($subfolder) && $subfolder != false): ?>
                                            <a href="#" class="action-item text-danger px-2" data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="destroyFiles('<?php echo e(str_replace('\\', '/', $file->path)); ?>','<?php echo e($subfolder); ?>');">
                                            <i class="fas fa-trash-alt"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="#" class="action-item text-danger px-2" data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="destroyFiles('<?php echo e(str_replace('\\', '/', $file->path)); ?>');">
                                            <i class="fas fa-trash-alt"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($privilege == 'user' || Auth::user()->account_type == App\Models\User::INTERNAL_TENANT_ADMIN): ?>
                                        <div class="col">
                                            <?php if($file->exe != 'folder'): ?>
                                                <?php if(!empty($subfolder) && $subfolder != false): ?>
                                                        <a href="<?php echo e(route('fileList.download',[tenant('tenant_id'),$file->name,$product_id,$file->exe,rawurlencode($subfolder)])); ?>" class="action-item text-primary px-2 download_files">
                                                        <i class="fas fa-cloud-download-alt"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('fileList.download',[tenant('tenant_id'),$file->name,$product_id,$file->exe])); ?>" class="action-item text-primary px-2 download_files">
                                                        <i class="fas fa-cloud-download-alt"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">
                            <div class="row pt-3 mh-250 min-h-250 overflow-auto align-items-center">
                                <div class="col-12 text-center">
                                    <h5 class="text-muted"><?php echo e(__('Files not available.')); ?></h5>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">
                        <div class="row pt-3 mh-250 min-h-250 overflow-auto align-items-center">
                            <div class="col-12 text-center">
                                <h5 class="text-muted"><?php echo e(__('No Access')); ?></h5>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $( document ).ready(function() {
        loadConfirm();
    });
    $('#grant_access').on('click',function (e) {

        var url = "<?php echo e(route('fileList.access',tenant('tenant_id'))); ?>";

        var data = {product_id: $('#product').val(), tenant_id: $('#tenant').val()};

        postAjax(url, data, false, function(response){
            if (response.is_success == true) {
                show_toastr('Success', response.message, 'success');
                getFileList();
            } else if (response.is_success == false) {
                show_toastr('Error', response.message, 'error');
            }
        });
    });

    $('#remove_access').on('click',function (e) {

        var url = "<?php echo e(route('fileList.access.remove',tenant('tenant_id'))); ?>";

        var data = {product_id: $('#product').val(), tenant_id: $('#tenant').val()};

        postAjax(url, data, false, function(response){
            if (response.is_success == true) {
                show_toastr('Success', response.message, 'success');
                getFileList();
            } else if (response.is_success == false) {
                show_toastr('Error', response.message, 'error');
            }
        });
    });

    $('#new_files').on('click',function(e){
        var product_id = $('#product').val();
        var subfolder = $(this).data('folder');
       
        var url = $(this).data('url');
        url = url.replace(':product_id', product_id);        
        url = url.replace(':subfolder', subfolder);        

        var title = $(this).data('title');
        var size = $(this).data('size');
        openCommonLoader(title,size,url);
    });

    <?php if(!empty($subfolder) && $subfolder != false): ?>
        $('.product-dropdown').hide();
    <?php else: ?>
        $('.product-dropdown').show();
    <?php endif; ?>

    function destroyFiles(path,folder = ''){
        var url = "<?php echo e(route('file.destroy',[tenant('tenant_id')])); ?>";
        var data = {filepath: path};
        postAjax(url, data, false, function(response){
            if (response.is_success == true) {
                show_toastr('Success', response.message, 'success');
                if(folder != ''){
                    getFileList(folder);
                }else{
                    getFileList();
                }
            } else if (response.is_success == false) {
                show_toastr('Error', response.message, 'error');
            }
            $('[id^=fire-modal]').modal('hide');
        });
    }
</script>
<?php /**PATH /var/www/html/ICM/ILINXEngage (6-26-2023)/ILINXEngage/packages/engage/downloadcenter/src/resources/views/TenantFileAccess/Admin/file_list.blade.php ENDPATH**/ ?>