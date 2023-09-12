<x-layouts.app
    title="{{$table}}"
>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header actions-toolbar border-0">
                <div class="actions-search" id="actions-search">
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control form-control-flush" id="input_keyword" placeholder="{{ __('Type keyword..') }}">
                        <div class="input-group-append">
                            <a href="#" class="input-group-text bg-transparent" data-action="search-close" data-target="#actions-search"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center">
                    <div class="col">
                        <h6 class="d-inline-block mb-0"><i class="fas fa-tasks"></i> <span id="menu_title">{{ __('Available Tasks') }}</span> : {{ $table }} </h6>
                        <span class="d-block text-sm font-italic">{{ $arrBatchData['cntBatch'].__(' tasks') }} </span>
                    </div>
                    <div class="col text-right">
                        <div class="actions">
                            <a href="#" class="action-item mr-3" data-action="search-open" data-target="#actions-search"><i class="fas fa-search"></i></a>
                            <div class="dropdown">
                                <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('batch.detail',[tenant('tenant_id'), $table]) }}" class="dropdown-item">{{ __('List View') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" id="grid_data">
                    @foreach($dataMenu->IndexValues as $key => $indexValue)
                        @if($indexValue->DataType == '_table' && $indexValue->IndexName == $table)
                            @foreach($indexValue->TableValue->RowValues as $k => $v)
                                @php
                                    $columnArray = $v->ColumnValues;
                                    $icon = Utility::GetTableRowColumnValue($columnArray,'Icon');
                                    $icon = !empty($icon) ? $icon : 'fas fa-tasks';
                                    $icon .= ' fa-2x';
                                    $dynamicField = Utility::GetBatchTableRowDynamicIndexes($columnArray);
                                @endphp
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid_record">
                                    <div class="card hover-shadow-lg">
                                        <div class="card-header border-0 pb-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div></div>
                                                <div class="text-right">
                                                    <div class="actions">
                                                        <div class="dropdown action-item">
                                                            <a href="#" class="action-item" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="{{ route('batch.form.detail',[tenant('tenant_id'), $table, Utility::GetTableRowColumnValue($columnArray,'Title')]) }}" class="dropdown-item">{{__('Open')}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <a href="{{ route('batch.form.detail',[tenant('tenant_id'), $table, Utility::GetTableRowColumnValue($columnArray,'Title')]) }}" class="hover-translate-y-n3">
                                                <i class="{{ $icon }}"></i>
                                            </a>
                                            <h5 class="h6 mt-4"><a href="{{ route('batch.form.detail',[tenant('tenant_id'), $table, Utility::GetTableRowColumnValue($columnArray,'Title')]) }}">{{ Utility::GetTableRowColumnValue($columnArray,'Title') }}</a></h5>
                                            <p class="mb-0">{{ !empty(Utility::GetTableRowColumnValue($columnArray,'Subtitle')) ? Utility::GetTableRowColumnValue($columnArray,'Subtitle') : '' }}</p>
                                            <p class="text text-xs">{{ !empty(Utility::GetTableRowColumnValue($columnArray,'Excerpt')) ? Utility::GetTableRowColumnValue($columnArray,'Excerpt') : '' }}</p>
                                            <span class="clearfix"></span>
                                            <span class="badge badge-pill {{ Utility::GetTableRowColumnValue($columnArray,'badge-class') }}">{{ Utility::GetTableRowColumnValue($columnArray,'Status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $(document).ready(function () {
            $("#input_keyword").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#grid_data .grid_record").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endpush

</x-layouts.app>
