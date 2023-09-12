<x-layouts.app title="{{__('ILINX Product Downloads')}} - {{__('Reports')}}" header="{{__('ILINX Product Downloads')}} - {{__('Reports')}}">
    @push('css')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/printjs-crabbly/css/print.min.css')}}">
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header actions-toolbar border-0">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="d-inline-block mb-0"><i class="fa-solid fa-file-contract"></i> <span>{{__('ILINX Product Downloads')}} - {{__('Reports')}}</span></h6>
                        </div>
                        <div class="col text-right">

                            <a href="javascript:void(0)" class="back-page">
                                <i class="fas fa-times"></i>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#product_navigation" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">{{ __('By Product')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tenant_navigation" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">{{ __('By Tenant')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#download_history_navigation" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">{{ __('Download History')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="product_navigation">
                                    <form action="#" id="filter_product">
                                        <div class="row justify-content-between align-items-center mb-4">

                                            <div class="align-items-center d-inline-flex col-10">
                                                <span class="h6 mb-0 mr-2">{{__('Release')}}</span>

                                                <select name="release" id="release" class="form-control mr-4">
                                                    @foreach($release_list as $r_key => $r_val)
                                                        <option value="{{$r_val}}">{{$r_val}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="h6 mb-0 mr-2">{{__('Product')}}</span>
                                                <select name="product" id="product" class="form-control mr-2">
                                                </select>
                                                <input type="hidden" name="type" value="product">
                                            </div>

                                            <div class="col-2 text-right">
                                                <button type="button" class="btn btn-sm btn-success rounded-pill" onclick="filterdata('filter_product','product_navigation');">{{ __('Go') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="col-12 filter-content">

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tenant_navigation">
                                    <form action="#" id="filter_tenant">
                                        <div class="row justify-content-between align-items-center mb-4">
                                            <div class="align-items-center d-inline-flex col-10">
                                                <span class="h6 mb-0 mr-2">{{__('Tenant')}}</span>
                                                <select name="tenant" id="tenant" class="form-control mr-4">
                                                    @foreach($tenant_list as $t_key => $t_val)
                                                        <option value="{{$t_val->tenant_id}}">{{$t_val->company_name}} ({{$t_val->tenant_id}})</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="type" value="tenant">
                                            </div>
                                            <div class="col-2 text-right">
                                                <button type="button" class="btn btn-sm btn-success rounded-pill" onclick="filterdata('filter_tenant','tenant_navigation');">{{ __('Go') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="col-12 filter-content">

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="download_history_navigation">
                                    <form action="#" id="filter_date">
                                        <div class="row justify-content-between align-items-center mb-4">
                                            <div class="align-items-center d-inline-flex col-10">
                                                <span class="h6 mb-0 mr-2">{{__('Date')}}</span>
                                                <input type="text" name="daterange" class="form-control mr-4">
                                                <input type="hidden" name="type" value="date">
                                            </div>
                                            <div class="col-2 text-right">
                                                <button type="button" class="btn btn-sm btn-success rounded-pill" onclick="filterdata('filter_date','download_history_navigation');">{{ __('Go') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="col-12 filter-content">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="filterList">

                </div>
            </div>
        </div>
    </div>

    @push('script')

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script src="{{asset('assets/libs/printjs-crabbly/js/print.min.js')}}"></script>
        <script type="text/javascript">
            $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                /*console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));*/
            });

            $('#release').trigger('change');
            });

            $('#release').on('change',function (e) {

                var url = "{{route('product.get',tenant('tenant_id'))}}";

                var data = {product_version: $(this).val()};

                postAjax(url, data, false, function(response){

                    var html = '';
                    response.forEach((val) => {
                        html += `<option value="${val.id}">${val.product_name}</option>`;
                    });
                    $('#product').html(html);
                    $('#product').trigger('change');
                });
            });

            function filterdata(element,div) {

                var url = "{{route('fileaccess.reports.filter',tenant('tenant_id'))}}";
                var form = document.getElementById(element);
                var data = new FormData(form);

                postAjax(url, data, true, function(response){
                    if(response.is_success){
                        $(`#${div}`).find('.filter-content').html(response.data);
                        $(`#${div}`).find('.filtertable').DataTable().destroy();
                        $(`#${div}`).find('.filtertable').DataTable({
                            language: tableLangData,
                        });
                    }
                });
            }
        </script>
    @endpush

</x-layouts.app>

