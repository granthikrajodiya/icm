<div class="row justify-content-between align-items-center px-4 mb-4">
    @if(!empty($subfolder) && $subfolder != false)
        <div class="col">
            <a href="javascript:void(0)" onclick="getFileList();" class="align-items-center">
                <i class="fa fa-arrow-left"></i><span class="ml-4">{{$subfolder}}</span>
            </a>
        </div>
    @endif
    @if($privilege == 'all')
    <div class="align-items-center ml-4 col text-right ">
        <button type="button" class="btn btn-sm btn-primary rounded-pill" data-size="lg" data-title="{{ __('Add New Files') }}" id="new_files" data-folder="{{!empty($subfolder) && $subfolder != false ? $subfolder : false}}" data-url="{{ route('newFile.create', [tenant('tenant_id'), ':product_id', 'file', ':subfolder']) }}">{{__('Add files...')}}</button>
    </div>
    @elseif($privilege == 'notGranted')
        <div class="align-items-center ml-4 col text-right ">
            <button type="button" class="btn btn-sm btn-primary rounded-pill" id="grant_access">{{__('Grant Access')}}</button>
        </div>
    @elseif($privilege == 'granted')
        <div class="align-items-center ml-4 col text-right ">
            <button type="button" class="btn btn-sm btn-primary rounded-pill" id="remove_access">{{__('Remove Access')}}</button>
        </div>
    @endif
</div>
<div class="table-responsive">
    <table class="table align-items-center">
        <thead>
        <tr>
            <th scope="col">{{__('FILE')}}</th>
            <th scope="col">{{__('SIZE')}}</th>
            <th scope="col">{{__('DATE')}}</th>
            <th scope="col" class="text-right" width="100"></th>
        </tr>
        </thead>
        <tbody>
            @if($access == true)
                @if(count($filelist)>0)
                    @foreach($filelist as $file)
                        <tr>
                            <th scope="row">
                            <div class="media align-items-center">
                                <div>
                                <div class="avatar-parent-child">
                                    <img alt="Image placeholder" src="{{$file->icon}}" class="avatar rounded" @if($file->exe == 'folder')onclick="getFileList('{{$file->name}}');"@endif>
                                </div>
                                </div>
                                <div class="media-body ml-4">
                                <a href="javascript:void(0)" class="name h6 mb-0 text-sm" @if($file->exe == 'folder')onclick="getFileList('{{$file->name}}');" @endif>{{$file->name}}</a>
                                </div>
                            </div>
                            </th>
                            <td>{{$file->size}}</td>
                            <td>{{$file->date}}</td>

                            <td class="text-right" width="100">
                                <div class="media align-items-center">
                                    @if($privilege == 'all' && Auth::user()->account_type == App\Models\User::INTERNAL_TENANT_ADMIN)
                                    <div class="col">
                                        @if(!empty($subfolder) && $subfolder != false)
                                            <a href="#" class="action-item text-danger px-2" data-confirm="{{__('Are You Sure?')}}|{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="destroyFiles('{{str_replace('\\', '/', $file->path)}}','{{$subfolder}}');">
                                            <i class="fas fa-trash-alt"></i>
                                            </a>
                                        @else
                                            <a href="#" class="action-item text-danger px-2" data-confirm="{{__('Are You Sure?')}}|{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="destroyFiles('{{str_replace('\\', '/', $file->path)}}');">
                                            <i class="fas fa-trash-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                    @endif
                                    @if($privilege == 'user' || Auth::user()->account_type == App\Models\User::INTERNAL_TENANT_ADMIN)
                                        <div class="col">
                                            @if($file->exe != 'folder')
                                                @if(!empty($subfolder) && $subfolder != false)
                                                        <a href="{{route('fileList.download',[tenant('tenant_id'),$file->name,$product_id,$file->exe,rawurlencode($subfolder)])}}" class="action-item text-primary px-2 download_files">
                                                        <i class="fas fa-cloud-download-alt"></i>
                                                    </a>
                                                @else
                                                    <a href="{{route('fileList.download',[tenant('tenant_id'),$file->name,$product_id,$file->exe])}}" class="action-item text-primary px-2 download_files">
                                                        <i class="fas fa-cloud-download-alt"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    @endif

                                </div>

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">
                            <div class="row pt-3 mh-250 min-h-250 overflow-auto align-items-center">
                                <div class="col-12 text-center">
                                    <h5 class="text-muted">{{__('Files not available.')}}</h5>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endif
            @else
                <tr>
                    <td colspan="4">
                        <div class="row pt-3 mh-250 min-h-250 overflow-auto align-items-center">
                            <div class="col-12 text-center">
                                <h5 class="text-muted">{{__('No Access')}}</h5>
                            </div>
                        </div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $( document ).ready(function() {
        loadConfirm();
    });
    $('#grant_access').on('click',function (e) {

        var url = "{{route('fileList.access',tenant('tenant_id'))}}";

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

        var url = "{{route('fileList.access.remove',tenant('tenant_id'))}}";

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

    @if(!empty($subfolder) && $subfolder != false)
        $('.product-dropdown').hide();
    @else
        $('.product-dropdown').show();
    @endif

    function destroyFiles(path,folder = ''){
        var url = "{{route('file.destroy',[tenant('tenant_id')])}}";
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
