@php
$taskName = Crypt::decryptString($encodeTaskName);
@endphp
<x-layouts.app title="{{ $taskName . '-' . Utility::getValByName('task_menu') }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h6 class="d-inline-block mb-0">
                                <i class="fas fa-tasks"></i>
                                <a href="{{ route('tasks.index', tenant('tenant_id')) }}">
                                    <span id="menu_title">{{ Utility::getValByName('task_menu') }}</span>
                                </a>
                                @if (Session::get('navigation_title') != $taskName): {{ $taskName }}@endif
                            </h6>
                        </div>
                        <div class="col text-right">
                            @if (count($getViewDefinition) > 0)
                                <a href="javascript:void(0)" class="btn btn-primary btn-xs rounded-pill text-white"
                                    id="filter">
                                    {{ __('Filters...') }}
                                </a>
                            @endif
                            @if (!empty($viewId) && $eform_url != '')
                                <a href="{{ route('eforms.view', [tenant('tenant_id'), $viewId]) }}"
                                    class="btn btn-primary btn-xs rounded-pill">
                                    <i class="fas fa-plus"></i>
                                </a>
                            @endif
                            {{-- <div class="col text-right" id="add_view">

                            </div> --}}
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    @if (count($getViewDefinition) > 0)

                        {{ Form::open(['url' => '#', 'name' => 'filter_data', 'id' => 'filter_data', 'autocomplete' => 'off']) }}

                        <div class="row justify-content-between align-items-center mt-4 mb-4" id="filterDiv"
                            style="display:none;">
                            @foreach ($getViewDefinition as $filterKey => $filterVal)
                                @php
                                    if ($filterVal->FieldType == 3) {
                                        $filterVal->SearchOperator = 5;
                                    }
                                    $input_name = $filterVal->DisplayName . '[input]';
                                    $json_field = $filterVal->DisplayName . '[json]';
                                    $field_json = json_encode($filterVal);
                                    $required = $filterVal->Required == true ? 'required' : '';
                                    $asterisk = $filterVal->Required == true ? '*' : '';
                                    $Readonly = $filterVal->Readonly == true ? 'readonly' : '';
                                    $maxlength = '';
                                    if ($filterVal->MaxFieldLength > 0) {
                                        $maxlength = 'maxlength=' . $filterVal->MaxFieldLength;
                                    }

                                    if (count($searchDatumsLastTaskFilter) > 0) {
                                        $found_key = array_search($filterVal->DisplayName, array_column($searchDatumsLastTaskFilter, 'field_name'));
                                        $last_filter_val = $searchDatumsLastTaskFilter[$found_key];
                                        $last_field_val = $last_filter_val->input;

                                        $filterVal->DefaultValue = !empty($last_field_val) ? $last_field_val : $filterVal->DefaultValue;
                                    }
                                @endphp
                                @if (!$filterVal->Hidden)
                                    @if (!in_array($filterVal->FieldType, [0, 1, 3, 5, 6]))
                                        <div class="col-md-4">
                                            {{ Form::label($filterVal->DisplayName, $filterVal->DisplayName, ['class' => 'form-control-label']) }}
                                            <span class="text-danger h5">{{ $asterisk }}</span>
                                            {{ Form::text($input_name, $filterVal->DefaultValue, ['class' => 'form-control ' . $Readonly, $required, $Readonly, $maxlength]) }}
                                            {{ Form::hidden($json_field, $field_json) }}
                                        </div>
                                    @elseif($filterVal->FieldType == 5)
                                        <div class="col-md-4">
                                            {{ Form::label($filterVal->DisplayName, $filterVal->DisplayName, ['class' => 'form-control-label']) }}
                                            <span class="text-danger h5">{{ $asterisk }}</span>
                                            <select class="form-control filter-select"
                                                name="{{$input_name}}"
                                                id="boolean_select"
                                                value="{{ $filterVal->DefaultValue }}"
                                                {{ $Readonly == true ? "readonly" : '' }}
                                                {{ $required=="required" ? 'required' : '' }}
                                            >
                                                <option value="" @if($filterVal->DefaultValue == '') selected @endif></option>
                                                <option value="true" @if($filterVal->DefaultValue == true) selected @endif>Yes</option>
                                                <option value="false" @if($filterVal->DefaultValue == false) selected @endif>No</option>
                                            </select>

                                            {{ Form::hidden($json_field, $field_json) }}
                                        </div>
                                    @elseif($filterVal->FieldType == 0 || $filterVal->FieldType == 1)
                                        <div class="col-md-4">
                                            {{ Form::label($filterVal->DisplayName, $filterVal->DisplayName, ['class' => 'form-control-label']) }}
                                            <span class="text-danger h5">{{ $asterisk }}</span>
                                            {{ Form::number($input_name, $filterVal->DefaultValue, ['class' => 'form-control ' . $Readonly, 'min' => 0, 'step' => $filterVal->FieldType == 1 ? '0.01' : '0', $required, $Readonly, $maxlength]) }}
                                            {{ Form::hidden($json_field, $field_json) }}
                                        </div>
                                    @elseif($filterVal->FieldType == 3)
                                        <div class="col-md-4">
                                            {{ Form::label($filterVal->DisplayName, $filterVal->DisplayName, ['class' => 'form-control-label']) }}
                                            <span class="text-danger h5">{{ $asterisk }}</span>
                                            {{ Form::hidden($json_field, $field_json) }}
                                            @php
                                                $date_default_val = '';
                                                if ($filterVal->DefaultValue != '' && $filterVal->DefaultValue != null) {
                                                    $date_default_val = json_encode(explode('|', $filterVal->DefaultValue));
                                                }
                                            @endphp
                                            <div class="form-control datefilter">
                                                <i class="fa fa-calendar"></i>
                                                <input type="text" class="daterange"
                                                    data-name="{{ $input_name }}"
                                                    data-defaultval="{{ $date_default_val }}">
                                            </div>
                                            {{ Form::hidden($input_name, $filterVal->DefaultValue) }}
                                        </div>
                                    @elseif($filterVal->FieldType == 6)
                                        <div class="col-md-4">
                                            {{ Form::label($filterVal->DisplayName, $filterVal->DisplayName, ['class' => 'form-control-label']) }}
                                            <span class="text-danger h5">{{ $asterisk }}</span>
                                            {{ Form::select($input_name, $filterVal->PickListFieldValues, $filterVal->DefaultValue, ['class' => 'form-control filter-select-' . $Readonly, $required, $Readonly == 'readonly' ? 'disabled' : '', $maxlength]) }}
                                            {{ Form::hidden($json_field, $field_json) }}

                                            @if ($Readonly == 'readonly')
                                                {{ Form::hidden($input_name, $filterVal->DefaultValue, ['class' => 'form-control ' . $Readonly]) }}
                                            @endif
                                        </div>
                                    @endif
                                @else
                                    {{ Form::hidden($json_field, $field_json) }}
                                    {{ Form::hidden($input_name, $filterVal->DefaultValue, ['class' => 'form-control ' . $Readonly]) }}
                                @endif
                            @endforeach
                            <div class="col text-right mt-4">
                                <button type="reset" class="btn btn-primary btn-xs rounded-pill text-white" id="reset">
                                    {{ __('Clear') }}
                                </button>
                                <button type="submit" class="btn btn-primary btn-xs rounded-pill text-white">
                                    {{ __('Go') }}
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    @endif
                    <div id="detail_page">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script type="text/javascript">

            $(document).ready(function() {
                @if (count($searchDatumsLastTaskFilter) > 0)
                    $("#filter").trigger('click');
                    $("#filter_data").trigger('submit');
                @elseif($isRequired == false)
                    loadDetailsPageView();
                @else
                    $("#filter").trigger('click');
                @endif
            });

            $("#filter").click(function() {
                $("#filterDiv").toggle("slide", function() {});
            });

            var search = true;

            @if (count($getViewDefinition) > 0)
                search = false;
            @endif

            var loadDetailsPage = null;

            function loadDataTable() {
                $(".dataTable").DataTable({
                    "aaSorting": [],
                    language: tableLangData,
                    searching: search,
                });

                var spanSorting = '<span class="arrow-hack sort">&nbsp;&nbsp;&nbsp;</span>';
                var spanAsc = '<span class="arrow-hack asc">&nbsp;&nbsp;&nbsp;</span>';
                var spanDesc = '<span class="arrow-hack desc">&nbsp;&nbsp;&nbsp;</span>';

                // START
                // Add this each function for each thead to display the sorting icon
                $(".dataTable thead th").each(function(i, th) {
                    $(th).find('.arrow-hack').remove();
                    var html = $(th).html(),
                        cls = $(th).attr('class');

                    $(th).html(html+spanSorting);

                    if (cls.includes('sorting_disabled')) {
                        $(th).html(html);
                    }
                })
                // END

                $(".dataTable").on('click', 'th', function() {
                    $(".dataTable thead th").each(function(i, th) {
                        $(th).find('.arrow-hack').remove();
                        var html = $(th).html(),
                            cls = $(th).attr('class');

                        if(cls.includes('sorting_asc')){
                            $(th).html(html+spanAsc);
                        }else if(cls.includes('sorting_desc')){
                            $(th).html(html+spanDesc);
                        }else if(cls.includes('sorting_disabled')){
                            $(th).html(html);
                        }else{
                            $(th).html(html+spanSorting);
                        }
                    });
                });

                // $(".dataTable th").first().click().click();

                // if(response.is_ICS_AppName != false){
                //     var url = '{{route('folder.repo.get',[tenant('tenant_id'), ':name'])}}';
                //     url = url.replace(':name', response.is_ICS_AppName);
                //     $('#add_view').html(`<a href="#"
                //        data-url="${url}" data-size="lg" id="AddContentModal"
                //        data-title="{{ __('Add New Document') }}" class="action-item">
                //         <i class="fas fa-plus"></i>
                //         <span class="d-sm-inline-block">{{ __('Add') }}</span>
                //     </a>`);
                // }
            }

            function loadDetailsPageView(requestData = {}) {
                loadDetailsPage = $.ajax({
                    type: "POST",
                    url: '{{ route('tasks.taskDetail', [tenant('tenant_id'), $encodeTaskName]) }}',
                    data: requestData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        if (loadDetailsPage != null) {
                            loadDetailsPage.abort();
                        }

                        $(".dataTable").DataTable().destroy(true);

                        $("#loader").removeClass('d-none');
                    },
                    success: function(response) {
                        if (!response.is_success) {
                            show_toastr('Error', response.message, 'error');
                        } else {

                            $('#detail_page').empty().html(response.html);
                            loadDataTable();
                        }
                    },
                    error: function(requestObject, error, errorThrown) {
                        alert(errorThrown);
                    },
                    complete: function() {

                        $("#loader").addClass('d-none');
                    }
                });
            }

            $('#filter_data').on('submit', function(e) {
                e.preventDefault();

                loadDetailsPageView(new FormData(this));
            });

            $('#filter_data').on('reset', function() {

                ClearSearchFilter();

                @if ($isRequired == false)
                    loadDetailsPageView();
                @else
                    $('#detail_page').empty();
                    loadDataTable();
                @endif
            });

            $('.readonly').on('keydown', function() {
                $(this).attr('readonly', true);
            })

            $('.filter-select-readonly').on('focus', function() {
                $(this).attr('disabled', true);
            })

            function ClearSearchFilter() {

                $.ajax({
                    type: "POST",
                    url: '{{ route('tasks.SearchDatums.clear', [tenant('tenant_id')]) }}',
                    beforeSend: function() {
                        $('#detail_page').empty();
                        loadDataTable();

                        $('.daterange').each(function(index) {
                            $(this).val('');
                            var input = $(this).data('name');
                            $(`input[name="${input}"]`).val('');
                        });
                        $("#loader").removeClass('d-none');
                    },
                    success: function(response) {

                    },
                    error: function(requestObject, error, errorThrown) {
                        alert(errorThrown);
                    },
                    complete: function() {

                        $("#loader").addClass('d-none');
                    }
                });
            }
        </script>

        <script type="text/javascript">
            var start = moment().subtract(0, 'days');
            var end = moment();

            function cb(start, end, element) {

                if (element.data('defaultval') == "" || element.data('defaultval') == null || element.data('defaultval') ==
                    'undefined') {
                    startDate = start;
                    endDate = end;
                    element.val('');
                } else {
                    obj = element.data('defaultval');
                    if (obj.length == 2) {
                        startDate = moment(new Date(obj[0]));
                        endDate = moment(new Date(obj[1]));
                    } else {
                        startDate = moment(new Date(obj[0]));
                        endDate = moment(new Date(obj[0]));
                    }
                    element.val(startDate.format('MMMM D, YYYY') + ' - ' + endDate.format('MMMM D, YYYY'));
                    var input = element.data('name');
                    $(`input[name="${input}"]`).val(startDate.format('YYYY-MM-DD') + '|' + endDate.format('YYYY-MM-DD'));
                }
            }

            var daterange = $('.daterange').daterangepicker({
                showDropdowns: true,
                minYear: 1901,
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                        'month')]
                },
                locale: {
                    cancelLabel: "{{ __('Clear') }}",
                    format: 'MMMM D, YYYY'
                },
            }, function(startDate, endDate, label) {
                var input = daterange.data('name');
                $(`input[name="${input}"]`).val(startDate.format('YYYY-MM-DD') + '|' + endDate.format('YYYY-MM-DD'));
            });

            $('.daterange').each(function(index) {
                cb(start, end, $(this));
            });

            $('.daterange').on('apply.daterangepicker', function(ev, picker) {
                var input = $(this).data('name');
                $(`input[name="${input}"]`).val(picker.startDate.format('YYYY-MM-DD') + '|' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

            $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                var input = $(this).data('name');
                $(`input[name="${input}"]`).val('');
            });
        </script>
    @endpush('script')
</x-layouts.app>
