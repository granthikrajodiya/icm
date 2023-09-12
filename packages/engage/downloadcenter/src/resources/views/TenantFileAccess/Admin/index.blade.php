<x-layouts.app title="{{ Utility::getValByName('') }}">
    @push('css')
        <link rel="stylesheet" href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" type="text/css" />
    @endpush


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
                                        <a href="#" class="dropdown-item" data-url="{{ route('newRelease.create', tenant('tenant_id')) }}" data-ajax-popup="true" data-size="md" data-title="{{ __('New Release') }}">{{__('New Release and Product')}}</a>
                                        <a href="#" data-url="{{ route('newProduct.create', tenant('tenant_id')) }}" data-ajax-popup="true" data-size="md" data-title="{{ __('New Product') }}" class="dropdown-item">{{__('New Product')}}</a>
                                        <a href="#" data-size="md" data-title="{{ __('New Folder') }}" data-url="{{ route('newFile.create', [tenant('tenant_id'), ':product_id', 'folder']) }}" class="dropdown-item" id="new_folder">{{__('New Folder')}}</a>
                                        <a href="#" class="dropdown-item" id="edit_release_product" data-size="md" data-title="{{ __('Edit Release and Product') }}" data-url="{{ route('release-product.edit', [tenant('tenant_id'), ':product_id']) }}">{{__('Edit Release and Product')}}</a>
                                        <a href="#" class="dropdown-item" data-size="lg" data-title="{{ __('Add New Files') }}" data-url="{{ route('newFile.create', [tenant('tenant_id'), ':product_id', 'file']) }}" id="add_new_files">{{__('Add files...')}}</a>
                                        <a href="{{route('fileaccess.reports', tenant('tenant_id'))}}" class="dropdown-item" onclick="window.location.href = '{{route('fileaccess.reports', tenant('tenant_id'))}}'">{{__('Reports...')}}</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="row justify-content-between align-items-center">
                        <div class="align-items-center d-inline-flex col-12 mb-4">
                            <span class="h6 mb-0 mr-3">{{__('Tenant')}}</span>
                            <select name="tenant" id="tenant" class="form-control">
                                <option value="0">{{__('All privileged tenants')}}</option>
                                @foreach($tenant_list as $key => $val)
                                    <option value="{{$val->tenant_id}}">{{$val->company_name}} ({{$val->tenant_id}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="align-items-center d-inline-flex col">
                            <span class="h6 mb-0 mr-2">Release</span>
                            <select name="release" id="release" class="form-control">
                                @foreach($release_list as $r_key => $r_val)
                                    <option value="{{$r_val}}">{{$r_val}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="align-items-center ml-4 d-inline-flex col">
                            <span class="h6 mb-0 mr-2">{{__('Product')}}</span>
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

    @push('script')
        <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
        <script src="{{asset('assets/js/dlc_custom.js')}}"></script>
        <script type="text/javascript">

            $('#tenant').on('change',function (e) {
                getFileList();
            });

            $('#product').on('change',function (e) {
                getFileList();
            });

            $( document ).ready(function() {
                @if(!empty(Session::get('release')))
                    $("#release").val("{{Session::get('release')}}").trigger("change");
                @else
                    $('#release').trigger('change');
                @endif

                @if(!empty(Session::get('tenant')))
                    $("#tenant").val("{{Session::get('tenant')}}");
                @endif
            })

            $('#release').on('change',function (e) {

                var url = "{{route('product.get',tenant('tenant_id'))}}";

                var data = {product_version: $(this).val()};

                postAjax(url, data, false, function(response){

                    var html = '';
                    response.forEach((val) => {
                        html += `<option value="${val.id}">${val.product_name}</option>`;
                    });
                    $('#product').html(html);
                    @if(!empty(Session::get('product')))
                        $("#product").val("{{Session::get('product')}}").trigger("change");
                    @else
                        $('#product').trigger('change');
                    @endif

                    @if(!empty(Session::get('folder')))
                        getFileList("{{Session::get('folder')}}");
                    @else
                        getFileList();
                    @endif

                });
            });

            function getFileList(isSubfolder = false) {

                var url = "{{route('fileList.get',tenant('tenant_id'))}}";

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

    @endpush

</x-layouts.app>

