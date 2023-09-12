<x-layouts.app
    title="{{ $table }}"
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
                                    <a href="{{ route('batch.grid.detail',[tenant('tenant_id'),$table]) }}" class="dropdown-item">{{ __('Grid View') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="list">
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Excerpt') }}</th>
                        <th>{{ __('Status') }}</th>
                        @foreach($arrBatchData['arrFields'] as $f)
                            <th>{{ $f }}</th>
                        @endforeach
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="list" id="tbl_record">
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
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <a href="{{ route('batch.form.detail',[tenant('tenant_id'), $table, Utility::GetTableRowColumnValue($columnArray,'Title')]) }}">
                                                <i class="{{ $icon }}"></i>
                                            </a>
                                            <div class="media-body ml-4">
                                                <a href="{{ route('batch.form.detail',[tenant('tenant_id'), $table, Utility::GetTableRowColumnValue($columnArray,'Title')]) }}" class="name mb-0 h6 text-sm">{{ Utility::GetTableRowColumnValue($columnArray,'Title') }}</a><br>
                                                <p class="mb-0">{{ !empty(Utility::GetTableRowColumnValue($columnArray,'Subtitle')) ? Utility::GetTableRowColumnValue($columnArray,'Subtitle') : '' }}</p>
                                            </div>
                                        </div>
                                    </th>
                                    <td>{{ !empty(Utility::GetTableRowColumnValue($columnArray,'Excerpt')) ? Utility::GetTableRowColumnValue($columnArray,'Excerpt') : '' }}</td>
                                    <td>
                                        <span class="badge {{ Utility::GetTableRowColumnValue($columnArray,'badge-class') }} rounded-pill">{{ Utility::GetTableRowColumnValue($columnArray,'Status') }}</span>
                                    </td>
                                    @if(count($dynamicField) > 0)
                                        @foreach($dynamicField as $field)
                                            <td title="{{ substr($field->Name,4) }}">{{ $field->Value }}</td>
                                        @endforeach
                                    @endif
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('batch.form.detail',[tenant('tenant_id'), $table, Utility::GetTableRowColumnValue($columnArray,'Title')]) }}" class="dropdown-item">{{__('Open')}}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function () {
                $("#input_keyword").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#tbl_record tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    @endpush
</x-layouts.app>

