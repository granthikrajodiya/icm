<x-layouts.app title="{{ Utility::getValByName('') }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header actions-toolbar border-0">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="d-inline-block mb-0"><i class="fas fa-cloud-download-alt"></i> <span
                                    id="menu_title"></span></h6>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="row justify-content-between align-items-center">
                        <div class="align-items-center d-inline-flex col">
                            <span class="h6 mb-0 mr-2">Release</span>
                            <select name="release" id="release" class="form-control">
                                @foreach($release_list as $r_key => $r_val)
                                    <option value="{{$r_val}}">{{$r_val}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="align-items-center ml-4 d-inline-flex col">
                            <span class="h6 mb-0 mr-2">Product</span>
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
        <script type="text/javascript">
            
            $( document ).ready(function() {
                $('#release').trigger('change');
            })

            $('#product').on('change',function (e) {
                getFileList();
            });

            $('#release').on('change',function (e) {

                var url = "{{route('product.get',tenant('tenant_id'))}}";

                var data = {product_version: $(this).val()};

                postAjax(url, data, false, function(response){
                    
                    var html = '';
                    response.forEach((val) => {
                        html += `<option value="${val.product_id}">${val.product_name}</option>`;
                    });
                    $('#product').html(html);
                    getFileList();
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
        </script>
    @endpush

</x-layouts.app>

