@push('css')


@endpush
@push('theme-script')
    <script src="{{ asset('assets/js/chart.js') }}"></script>
@endpush
{{--Top Layout--}}
<div class="row">
    @php /** @var \App\Models\Layout $top */ @endphp
    @foreach ($layouts['top'] as $top)
        @if (str_contains($top->content_type, '[package_layout]'))
            @php
                $cartTemplate = '';
                $packageLayout = config('package-layout');
                if ($packageLayout) {
                    $contentTypeArr = explode('.', $top->content_type);
                    if (isset($packageLayout[$contentTypeArr[1]]) && !empty($packageLayout[$contentTypeArr[1]])) {
                        $templateName = $packageLayout[$contentTypeArr[1]][$contentTypeArr[2]]['template'];
                        $cartTemplate = $contentTypeArr[1] . '::' . $templateName;
                    }
                }
            @endphp
            @if ($cartTemplate)
                @if(\View::exists($cartTemplate))
                    @include($cartTemplate, [
                        'title' => $top->title,
                         'class' => $top->returnClass(),
                         'plural_item' => $top->plural_item,
                         'single_item' => $top->single_item,
                         'max_item' => $top->max_item,
                         'data_source' => $top->data_source,
                    ])
                @endif
            @endif
        @endif
        @if ($top->content_type == 'Documents')
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $top->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($top->getResult()) }} {{ (count($top->getResult()) == 0 || count($top->getResult()) > 1) ? $top->plural_item : $top->single_item }}</span>
                            </div>
                            <span class="badge badge-xs badge-success">{{ Utility::newCount($top->getResult()) }}</span>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @forelse($top->getResult() as $doc_response)
                            @if ($top->max_item >= $loop->iteration)
                                @php
                                    $doc_icon = Utility::GetDocProp($doc_response,'Icon');
                                    $doc_icon = !empty($doc_icon) ? $doc_icon : 'fa fa-file-text-o';
                                @endphp
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="{{ $doc_icon }}" aria-hidden="true"></i>
                                            </div>
                                            <div class="col ml-n2">
                                                @if (env('CARD_FIELDS_STACK') >= 1)
                                                    <h6 class="text-sm mb-0">
                                                        <a href="{{ route('docs.view',[tenant('tenant_id'),$doc_response->DocID]) }}">{{ Utility::isDate(Utility::GetDocProp($doc_response,'Title')) }}</a>
                                                    </h6>
                                                @endif
                                                @if (env('CARD_FIELDS_STACK') >= 2)
                                                    <p class="card-text small text-muted mb-0">{{ Utility::isDate(Utility::GetDocProp($doc_response,'Subtitle')) }}</p>
                                                @endif
                                                @if (env('CARD_FIELDS_STACK') >= 3)
                                                    <span
                                                        class="card-text text-xs">{{ Utility::isDate(Utility::GetDocProp($doc_response,'Excerpt')) }}</span>
                                                @endif
                                            </div>
                                            <div class="col-12 text-right">
                                                <span
                                                    class="badge badge-xs {{ Utility::GetDocProp($doc_response,'badge-class') }}">{{ Utility::GetDocProp($doc_response,'Status') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @break;
                            @endif
                        @empty
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('No Available ') . $top->plural_item}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('docs.index',[tenant('tenant_id'),$top->data_source]) }}"
                           class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                    </div>
                </div>
            </div>
        @elseif($top->content_type == 'Child Workflows')
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $top->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($top->getResult()) }} {{ (count($top->getResult()) == 0 || count($top->getResult()) > 1) ? $top->plural_item : $top->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @forelse($top->getResult() as $row)
                            @if ($top->max_item >= $loop->iteration)
                                @php
                                    $columnArray = $row->ColumnValues;
                                    $icon = Utility::GetTableRowColumnValue($columnArray,'Icon');
                                    $icon = !empty($icon) ? $icon : 'fa fa-file-text-o';
                                @endphp
                                @if (!empty(Utility::GetTableRowColumnValue($columnArray,'Title')))
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="{{ $icon }}" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">
                                                    @if (env('CARD_FIELDS_STACK') >= 1)
                                                        <h6 class="text-sm mb-0">
                                                            <a href="{{ route('batch.form.detail',[tenant('tenant_id'),$top->content_type,Utility::GetTableRowColumnValue($columnArray,'Title')]) }}">{{ Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Title')) }}</a>
                                                        </h6>
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 2)
                                                        <p class="card-text small text-muted mb-0">{{ Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Subtitle')) }}</p>
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 3)
                                                        <span
                                                            class="card-text text-xs">{{ Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Excerpt')) }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-12 text-right">
                                                    <span
                                                        class="badge badge-xs {{ Utility::GetTableRowColumnValue($columnArray,'badge-class') }}">{{ Utility::GetTableRowColumnValue($columnArray,'Status') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                @break;
                            @endif
                        @empty
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('No Available ') . $top->plural_item}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('batch.detail',[tenant('tenant_id'),$top->data_source]) }}"
                           class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                    </div>
                </div>
            </div>
        @elseif($top->content_type == 'Workflow view')
            @php
                $workflow_views = $top->getResult();
                $adv_config = json_decode($top->adv_config);
            @endphp
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $top->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($workflow_views['details']) }} {{ (count($workflow_views['details']) == 0 || count($workflow_views['details']) > 1) ? $top->plural_item : $top->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- List mode --}}
                    @if (isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on")
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        @for ($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++)
                                            <th class="pointer text-dark">
                                                {{ (isset($workflow_views['titles'][$i]) ? Str::title($workflow_views['titles'][$i]) : '') }}
                                            </th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    @if ($workflow_views['is_success'] == true)
                                        @forelse($workflow_views['details'] as $workflow)
                                            @if ($top->max_item >= $loop->iteration)
                                                @php
                                                    if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                                    {
                                                        $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($top->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                    else
                                                    {
                                                        $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($top->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                @endphp
                                                <tr>
                                                    @php
                                                        $first_column = true;
                                                    @endphp
                                                    @for ($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++)
                                                        <td>
                                                            @if ($first_column)
                                                                <a href="{{$url}}">{{ (!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '') }}</a>
                                                                {{ $first_column = false; }}
                                                            @else
                                                                {{ (!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '') }}
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @else
                                                @break;
                                            @endif
                                        @empty
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                {{__('No Available ') . $top->plural_item}}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    @else
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        {{__('An error occurred retrieving the list of ') . $top->plural_item . '. ' . __('Please contact your system administrator and reference error: ')}}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    {{-- Not list mode --}}
                    @else
                        <div class="card-wrapper p-3">
                            @if ($workflow_views['is_success'] == true)
                                @forelse($workflow_views['details'] as $workflow)
                                    @if ($top->max_item >= $loop->iteration)
                                        @php
                                            if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                            {
                                                $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($top->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                            else
                                            {
                                                $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($top->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                        @endphp
                                        <div class="card mb-2 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col ml-n2">
                                                        @if (env('CARD_FIELDS_STACK') >= 1)
                                                            <h6 class="text-sm mb-0">
                                                                <a href="{{$url}}">{{(!empty($workflow[$workflow_views['titles'][2]]) ? Utility::isDate($workflow[$workflow_views['titles'][2]]) : '')}}</a>
                                                            </h6>
                                                        @endif
                                                        @if (env('CARD_FIELDS_STACK') >= 2)
                                                            @if (isset($workflow[$workflow_views['titles'][3]]) && !empty($workflow[$workflow_views['titles'][3]]))
                                                                <p class="card-text small text-muted mb-0">{{ Utility::isDate($workflow[$workflow_views['titles'][3]]) }}</p>
                                                            @endif
                                                        @endif
                                                        @if (env('CARD_FIELDS_STACK') >= 3)
                                                            @if (isset($workflow[$workflow_views['titles'][4]]) && !empty($workflow[$workflow_views['titles'][4]]))
                                                                <span
                                                                    class="card-text text-xs">{{ Utility::isDate($workflow[$workflow_views['titles'][4]]) }}</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if (in_array('Status',$workflow_views['titles']) == true)
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4 {{(!in_array($workflow['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                                                @if (in_array($workflow['Status'],array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$workflow['Status'])}}"@endif
                                                                >
                                                                {{ $workflow['Status'] }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if (in_array('Progress',$workflow_views['titles']) == true)
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            <span class="completion mr-2"><small>{{ $workflow['Progress'] }}%</small></span>
                                                            @php
                                                                $progressColor = "";

                                                                if ($workflow['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($workflow['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($workflow['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $topWidth = $top->returnClass();

                                                                if ($topWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            @endphp
                                                            <div>
                                                                <div class="progress progress-xs" style="width: {{ $progressBarWidth }}">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $workflow['Progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $workflow['Progress'] }}%; background-color: {{ $progressColor }};"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @break;
                                    @endif
                                @empty
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        {{__('No Available ') . $top->plural_item}}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            @else
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    {{__('An error occurred retrieving').' '.$top->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="card-footer py-2 row footer-row">
                        @if (!empty($top->eform_url))
                            <div class="col text-left">
                                <a href="{{route('eforms.view',[tenant('tenant_id'),$top->id])}}"
                                   class="text-sm text-primary font-weight-bold">{{__('New..')}}</a>
                            </div>
                        @endif
                        <div class="col {{(!empty($top->eform_url)) ? 'text-right' : 'text-center'}}">
                            <a href="{{ route('tasks.index',[tenant('tenant_id')]) }}"
                               class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($top->content_type == 'Content view')
            @php
                $content_views = $top->getResult();
                $adv_config = json_decode($top->adv_config);
            @endphp
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $top->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($content_views['details']) }} {{ (count($content_views['details']) == 0 || count($content_views['details']) > 1) ? $top->plural_item : $top->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- List mode --}}
                    @if (isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on")
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        @for ($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++)
                                            <th class="pointer text-dark">
                                                {{ (isset($content_views['titles'][$i]) ? Str::title($content_views['titles'][$i]) : '') }}
                                            </th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    @if ($content_views['is_success'] == true)
                                        @forelse($content_views['details'] as $content_view)
                                            @if ($top->max_item >= $loop->iteration)
                                                @if (isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID']))
                                                    @php
                                                        $appName = $content_view['ICS_AppName'];
                                                        $docId = $content_view['ICS_DocumentID'];
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $top->data_source.'~'.array_values($content_view)[0];
                                                        $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                                    @endphp
                                                @else
                                                    @php
                                                        $appName = '';
                                                        $docId = '';
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $top->data_source.'~'.array_values($content_view)[0];
                                                        $url = 'javascript:void(0)';
                                                    @endphp
                                                @endif
                                                {{-- body here --}}
                                                <tr>
                                                    @php
                                                        $first_column = true;
                                                    @endphp
                                                    @for ($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++)
                                                        <td>
                                                            @if ($first_column)
                                                                <a href="{{$url}}">{{ (!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '') }}</a>
                                                                {{ $first_column = false; }}
                                                            @else
                                                                {{ (!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '') }}
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @else
                                                @break;
                                            @endif
                                        @empty
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                {{__('No Available ') . $top->plural_item}}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    @else
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        {{__('An error occurred retrieving the list of ') . $top->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']}}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    {{-- Not list mode --}}
                    @else
                        <div class="card-wrapper p-3">
                            @if ($content_views['is_success'] == true)
                                @forelse($content_views['details'] as $content_view)
                                    @if ($top->max_item >= $loop->iteration)
                                        @if (isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID']))
                                            @php
                                                $appName = $content_view['ICS_AppName'];
                                                $docId = $content_view['ICS_DocumentID'];
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $top->data_source.'~'.array_values($content_view)[0];
                                                $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                            @endphp
                                        @else
                                            @php
                                                $appName = '';
                                                $docId = '';
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $top->data_source.'~'.array_values($content_view)[0];
                                                $url = 'javascript:void(0)';
                                            @endphp
                                        @endif

                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-file" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col ml-n2">
                                                        @if (env('CARD_FIELDS_STACK') >= 1)
                                                            <h6 class="text-sm mb-0">
                                                                <a href="{{$url}}">{{(!empty($content_view[$content_views['titles'][0]]) ? Utility::isDate($content_view[$content_views['titles'][0]]) : '')}}</a>
                                                            </h6>
                                                        @endif
                                                        @if (count($content_views['titles']) >= 3)
                                                            @if (env('CARD_FIELDS_STACK') >= 2)
                                                                <p class="card-text small text-muted mb-0">{{(!empty($content_view[$content_views['titles'][1]]) ? Utility::isDate($content_view[$content_views['titles'][1]]) : '')}}</p>
                                                            @endif
                                                            @if (env('CARD_FIELDS_STACK') >= 3)
                                                                <span
                                                                    class="card-text text-xs">{{(!empty($content_view[$content_views['titles'][2]]) ? Utility::isDate($content_view[$content_views['titles'][2]]) : '')}}</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if (array_key_exists('Status', $content_view) == true)
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4 {{(!in_array($content_view['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                                                @if (in_array($content_view['Status'],array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$content_view['Status'])}}"@endif
                                                                >
                                                                {{ $content_view['Status'] }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if (array_key_exists('Progress', $content_view) == true)
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            @php
                                                                $progressValue = $content_view['Progress'] == NULL ? "0" : $content_view['Progress'];

                                                                $progressColor = "";

                                                                if ($content_view['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($content_view['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($content_view['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $topWidth = $top->returnClass();

                                                                if ($topWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            @endphp
                                                            <span class="completion mr-2"><small>{{ $progressValue }}%</small></span>
                                                            <div>
                                                                <div class="progress progress-xs" style="width: {{ $progressBarWidth }}">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $content_view['Progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $content_view['Progress'] }}%; background-color: {{ $progressColor }};"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @break;
                                    @endif
                                @empty
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        {{__('No Available ') . $top->plural_item}}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            @else
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving the list of ') . $top->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="card-footer py-2 row footer-row">
                        @if (!empty($top->eform_url))
                            <div class="col text-left">
                                <a href="{{route('eforms.view',[tenant('tenant_id'),$top->id])}}"
                                   class="text-sm text-primary font-weight-bold">{{__('New..')}}</a>
                            </div>
                        @endif
                        <div class="col {{(!empty($top->eform_url)) ? 'text-right' : 'text-center'}}">
                            <a href="{{ route('folder.index',[tenant('tenant_id')]) }}"
                            class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($top->content_type == 'Notifications')
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{__('Notifications')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        @if (user()->getUnreadNotification()->count() > 0)
                            @foreach (user()->getUnreadNotification() as $notification)
                                @if ($top->max_item >= $loop->iteration)
                                    <div class="list-group-item list-group-item-action">
                                        {{-- @if ($notification->created_at > user()->notifications_read && $notification->created_at <= user()->last_login_at) --}}
                                            {{-- <small
                                                class="float-right badge badge-sm badge-info">{{__('Unread')}}</small> --}}
                                        @if($notification->created_at > user()->last_login_at  && $notification->created_at > user()->notifications_read)
                                            <small
                                                class="float-right badge badge-sm badge-success">{{__('New')}}</small>
                                        @endif
                                        <div class="d-flex">
                                            <div>
                                                <i class="fas {{ (!empty($notification->type)) ? $notification->type : 'fa-cogs' }} mr-3"></i>
                                            </div>
                                            <div>
                                                @if (env('CARD_FIELDS_STACK') >= 1)
                                                    <div class="text-sm lh-150">{{ mb_strimwidth($notification->text, 0, 100, "...") }}</div>
                                                @endif
                                                @if (env('CARD_FIELDS_STACK') >= 2)
                                                    <small
                                                        class="d-block text-muted">{{ Utility::getDateFormatted($notification->created_at,true) }}</small>
                                                @endif
                                                @if (!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type))

                                                    @if ($notification->link_type == 'calendar')
                                                        <a class="calendar_notif"
                                                        href="{!! \App\Models\UserNotification::getLink($notification->id) !!}"
                                                        data-title="{!! \App\Models\Calendar::getCalendarName($notification->link_url)  !!}">
                                                            <small
                                                                class="float-left badge badge-sm {{ $notification->link_color }} text-white"
                                                                data-type='{{$notification->link_type}}'
                                                            >
                                                                {{ $notification->link_title }}
                                                            </small>
                                                        </a>
                                                    @else
                                                        <a
                                                        href="{!! \App\Models\UserNotification::getLink($notification->id) !!}"
                                                        data-title="{!! $notification->link_title !!}"
                                                        class="from_notification"
                                                        >
                                                            <small class="float-left badge badge-sm {{ $notification->link_color }} text-white" >
                                                                {{ $notification->link_title }}
                                                            </small>
                                                        </a>
                                                    @endif

                                                    <div class="clearfix"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @break;
                                @endif
                            @endforeach
                        @else
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="text-center">
                                    <div class="text-sm lh-150 font-weight-bold">{{__('No New Notifications')}}</div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('notification.index',tenant('tenant_id')) }}"
                           class="text-sm text-primary font-weight-bold">{{__('See all notifications')}}</a>
                    </div>
                </div>
            </div>
        @elseif($top->content_type == 'Calendar')
            <div class="{{$top->returnClass()}} col-auto">
                @php
                    $calendar_id = uniqid().$top->id;
                @endphp
                <div class="card widget-calendar">
                    <div class="card-header">
                        <div class="text-sm text-muted mb-1 layout-calendar-year"></div>
                        <a href="{{ route('calendar.index',tenant('tenant_id')) }}">
                            <div class="h5 mb-0 layout-calendar-day text-primary"></div>
                        </a>
                    </div>
                    <div data-toggle="{{$calendar_id}}-calendar"></div>
                </div>
                @push('script')
                    <script>
                        $('[data-toggle="{{$calendar_id}}-calendar"]').fullCalendar({
                            contentHeight: "auto",
                            displayEventTime: false,
                            theme: !1,
                            displayEventTime: false,
                            buttonIcons: {prev: " fas fa-angle-left", next: " fas fa-angle-right"},
                            header: {right: "next", center: "title, ", left: "prev"},
                            editable: !0,
                            events: {!! json_encode($arrData) !!},
                            eventClick: function (e, t) {
                                var title = e.title;
                                var url = e.url;

                                if (typeof url != 'undefined') {
                                    $("#commonModal .modal-title").html(title);
                                    $("#commonModal .modal-dialog").addClass('modal-md');
                                    $("#commonModal .modal-dialog").addClass('ow-break-word');
                                    $("#commonModal .modal-title").addClass('ow-anywhere');
                                    $("#commonModal").modal('show');
                                    $.get(url, {}, function (data) {
                                        $('#commonModal .modal-body').html(data);
                                    });
                                    return false;
                                }
                            }
                        });
                        var mYear = moment().format("YYYY"), mDay = moment().format("dddd, MMM D");
                        $(".layout-calendar-year").html(mYear), $(".layout-calendar-day").html(mDay);
                    </script>
                @endpush
            </div>
        @elseif($top->content_type == 'System message')
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-body">
                        @if (user()->account_type == 4)
                            {!! Utility::getValByName('welcome_message_ext') !!}
                        @else
                            {!! Utility::getValByName('welcome_message_int') !!}
                        @endif
                    </div>
                </div>
            </div>
        @elseif($top->content_type == 'KPI Card')
            @php
                $topKpiData = $top->getResult();
            @endphp
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{$topKpiData['title']}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="kpi_card_title">{{ucfirst($topKpiData['data'][0])}}</p>
                        <div class="text-center">
                            <h1 class="font-weight-700 kpi_card_value">{{$topKpiData['data'][1]}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($top->content_type == 'Pie Chart' || $top->content_type == 'Line Chart' || $top->content_type == 'Vertical bar Chart' || $top->content_type == 'Horizontal bar Chart')
            <div class="{{$top->returnClass()}} col-auto">
                @php
                    $fullChartData = $top->getResult();
                    $id = uniqid().$top->id;

                @endphp

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ $top->title }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($fullChartData['is_success'])
                            <div class="chartWrapper" id="chartwrap-{{$id}}" >
                                <div id="chartarea-{{$id}}">
                                    <canvas id="{{$id}}" ></canvas>
                                </div>
                            </div>
                        @else
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving').' '.$top->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if($fullChartData['is_success'])
                @push('script')
                    <script>
                        var ctx = document.getElementById('{{$id}}').getContext('2d');
                        var chartHeight = {!! json_encode($fullChartData['height']) !!};
                        var chartWidth = {!! json_encode($fullChartData['width']) !!};

                        var chartwrap = $("#chartwrap-{{$id}}");
                        var chartarea = $("#chartarea-{{$id}}");

                        var currWidth = parseInt(chartwrap.width());

                        if(chartWidth > 0){
                            chartarea.css('width', chartWidth + "px");
                        }

                        if(chartHeight > 0){
                            chartarea.css('height', chartHeight + "px");
                        }

                        var fullChart = new Chart(ctx, {
                            type: {!! json_encode($fullChartData['type']) !!},
                            data: {
                                labels: {!! json_encode($fullChartData['labels']) !!},
                                datasets: [{!! json_encode($fullChartData['data']) !!}],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                @if ($fullChartData['type'] != 'doughnut')
                                tooltips: {
                                    mode: 'label',
                                    callbacks: {
                                        label: function (tooltipItem, data) {
                                            // if (tooltipItem.value != '1' && tooltipItem.value != '0') {
                                            if (tooltipItem.value > 1) {
                                                return ' ' + Number(tooltipItem.value).toLocaleString() + " {{$fullChartData['plural']}}";
                                            } else {
                                                return ' ' + Number(tooltipItem.value).toLocaleString() + " {{$fullChartData['single']}}";
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(value, index, values) {
												return '       ' + value.toLocaleString();
											}
                                        }
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(value, index, values) {
												return '       ' + value.toLocaleString();
											}
                                        }
                                    }]
                                },
                                legend: {display: false}
                                @else
                                legend: {
                                    display: true,
                                    position: 'right',
                                    labels: {
                                        fontColor: '#333',
                                        usePointStyle: true,
                                    }
                                },
                                tooltips: {
                                    callbacks: {
                                        title: function (tooltipItem, data) {
                                            return data['labels'][tooltipItem[0]['index']];
                                        },
                                        label: function (tooltipItem, data) {
                                            if (data['datasets'][0]['data'][tooltipItem['index']] > 1) {
                                                return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " {{$fullChartData['plural']}}";
                                            } else {
                                                return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " {{$fullChartData['single']}}";
                                            }
                                        },
                                    },
                                }
                                @endif
                            },
                        });
                    </script>
                @endpush
                @endif
            </div>
        @elseif($top->content_type == 'Custom HTML')
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ $top->title }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <iframe id="dynamicHtmlTopFrame"  src="{!! $top->data_source !!}" frameborder="0" style="height:200px;width: 100%;" data-src="{!! $top->data_source !!}" data-title="{!! $top->title !!}"  allowfullscreen></iframe>
                    </div>
                </div>
            </div>

        @elseif($top->content_type == 'Integration')
            @php
                $Integrations = $top->getResult();
            @endphp
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $top->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($Integrations['details']) }} {{ (count($Integrations['details']) == 0 || count($Integrations['details']) > 1) ? $top->plural_item : $top->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @if ($Integrations['is_success'] == true)
                            @forelse($Integrations['details'] as $key => $integration_val)
                                @if ($top->max_item >= $loop->iteration)

                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">

                                                <div class="col-auto">
                                                    <i class="fas fa-file" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">


                                                    @if (env('CARD_FIELDS_STACK') >= 1)
                                                        @if (isset($integration_val[$Integrations['titles'][0]]) && !empty($integration_val[$Integrations['titles'][0]]))
                                                            @if ($Integrations['details_type'] == 1)
                                                                @php
                                                                    $basic_details_keys = array_intersect(array_keys($integration_val), $Integrations['basic_details']);
                                                                    foreach($basic_details_keys as $k1 => $v1){
                                                                        $basic_details_array[$v1] = $integration_val[$v1];
                                                                    }
                                                                @endphp
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)"
                                                                       class="open-basic-details"
                                                                       data-details="{{json_encode($basic_details_array)}}"
                                                                       data-url="{{ route('integration.basic.detail',tenant('tenant_id')) }}"
                                                                       data-size="md"
                                                                       data-title="{{__('Basic Details')}}">{{Utility::isDate($integration_val[$Integrations['titles'][0]]) }}</a>
                                                                </h6>
                                                            @elseif($Integrations['details_type'] == 2)
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)" class="open_doc"
                                                                       data-id="get-integration-details{{$key}}">{{Utility::isDate($integration_val[$Integrations['titles'][0]]) }}</a>
                                                                </h6>
                                                                {!! Form::open(['method' => 'POST', 'route' => ['integration.detail',[tenant('tenant_id'), "rest" => $Integrations['id']]],'id'=>'get-integration-details'.$key]) !!}
                                                                {{ Form::hidden('url',\Crypt::encrypt($integration_val['url']), ['class' => 'form-control']) }}
                                                                {!! Form::close() !!}
                                                            @else
                                                                <h6 class="text-sm mb-0">{{ Utility::isDate($integration_val[$Integrations['titles'][0]]) }}</h6>
                                                            @endif
                                                        @endif
                                                    @endif
                                                    @if (count($Integrations['titles']) >= 3)
                                                        @if (env('CARD_FIELDS_STACK') >= 2)
                                                            @if (isset($integration_val[$Integrations['titles'][1]]) && !empty($integration_val[$Integrations['titles'][1]]))
                                                                <p class="card-text small text-muted mb-0">{{(!empty($integration_val[$Integrations['titles'][1]]) ? Utility::isDate($integration_val[$Integrations['titles'][1]]) : '')}}</p>
                                                            @endif

                                                        @endif
                                                        @if (env('CARD_FIELDS_STACK') >= 3)
                                                            @if (isset($integration_val[$Integrations['titles'][2]]) && !empty($integration_val[$Integrations['titles'][2]]))
                                                                <span
                                                                    class="card-text text-xs">{{ Utility::isDate($integration_val[$Integrations['titles'][2]]) }}</span>
                                                            @endif
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    @break;
                                @endif
                            @empty
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    {{__('No Available ') . $top->plural_item}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        @else
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving').' '.$top->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer py-2 row">

                        <div class="col {{(!empty($top->eform_url)) ? 'text-right' : 'text-center'}}">
                            <a href="{{ route('integration.list',[tenant('tenant_id'),$Integrations['name'],$Integrations['id']]) }}"
                               class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($top->content_type == 'Court Case')
            @php
                $case_views = $top->getResult();
            @endphp
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $top->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($case_views['details']) }} {{ (count($case_views['details']) == 0 || count($case_views['details']) > 1) ? $top->plural_item : $top->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @if ($case_views['is_success'] == true)
                            @forelse($case_views['details'] as $case)
                                @if ($top->max_item >= $loop->iteration)
                                    @php
                                        $url = route('courtcase.detail',[tenant('tenant_id'),$top->data_source,$case['ActiveBatchID'] ?? ""]);
                                    @endphp
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">
                                                    @if (env('CARD_FIELDS_STACK') >= 1)
                                                        <h6 class="text-sm mb-0">
                                                            <a href="{{$url}}">{{(!empty($case[$case_views['titles'][2]]) ? Utility::isDate($case[$case_views['titles'][2]]) : '')}}</a>
                                                        </h6>
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 2)
                                                        @if (isset($case[$case_views['titles'][3]]) && !empty($case[$case_views['titles'][3]]))
                                                            <p class="card-text small text-muted mb-0">{{ Utility::isDate($case[$case_views['titles'][3]]) }}</p>
                                                        @endif
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 3)
                                                        @if (isset($case[$case_views['titles'][4]]) && !empty($case[$case_views['titles'][4]]))
                                                            <span
                                                                class="card-text text-xs">{{ Utility::isDate($case[$case_views['titles'][4]]) }}</span>
                                                        @endif
                                                    @endif
                                                </div>
                                                @if (in_array('Status',$case_views['titles']) == true)
                                                    <div class="col-12 text-right">
                                                        <span
                                                            class="badge badge-xs text-white {{(!in_array($case['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                                            @if (in_array($case['Status'],array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$case['Status'])}}"@endif>{{ $case['Status'] }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @break;
                                @endif
                            @empty
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    {{__('No Available ') . $top->plural_item}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        @else
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving').' '.$top->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('courtcase.list',[tenant('tenant_id'),$top->data_source,$top->id]) }}"
                           class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                    </div>
                </div>
            </div>
        @elseif($top->content_type == 'Custom Page')
            @php
                $custom_page = $top->getResult();
                $style = "";
                if($top->max_item > 0) $style = "max-height: ".(100*$top->max_item)."px; overflow: auto;"
            @endphp
            <div class="{{$top->returnClass()}} col-auto">
                <div class="card">
                    @if (!is_null($custom_page))
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="h5 mb-0">{{ $custom_page->title }}<span
                                            class="badge badge-success badge-xs"></span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="{{ $style }}">
                            {!! $custom_page->detail !!}
                        </div>
                    @endif
                </div>
            </div>
        @elseif($top->content_type == 'News Feed')
            @php
                $postList = $top->getResult();
                $dateformat = Utility::getValByName('date_format');
            @endphp
            <div class="{{$top->returnClass()}} col-auto">

                <div class="card overflow-auto h-580">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $top->title }}</h5>
                                <span class="d-block text-sm font-italic">{{ count($top->getResult()) }} {{ (count($top->getResult()) == 0 || count($top->getResult()) > 1) ? $top->plural_item : $top->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper overflow-auto h-580">
                        @foreach($postList as $key => $post)
                            <div class="card-body border-bottom">
                                @php
                                if ($post->image) {
                                    if($post->image_placement == "center"){
                                        $imageClass = "12";
                                        $contentClass = "12";
                                        $textAlign = 'text-right';
                                    }elseif($post->image_placement == "right"){
                                        $imageClass = "4 order-lg-2";
                                        $contentClass = "8 order-lg-1";
                                        $textAlign = '';
                                    }else{
                                        $imageClass = "4";
                                        $contentClass = "8";
                                        $textAlign = '';
                                    }
                                } else {
                                    $contentClass = "12";
                                    $textAlign = '';
                                }
                                @endphp
                                <div class="row">
                                    @if($post->image)
                                        <div class="col-{{$imageClass}}">
                                            <div class="">
                                                <div class=" overflow-hidden {{$post->image_placement == 'center' ? 'h-200' : 'max-h-200'}}">
                                                    <a href="{{ route('newsfeed.show',[tenant('tenant_id'),$post->id]) }}" class="d-block animate-this">
                                                        <img alt="Image placeholder" src="{{asset(Storage::url($post->image))}}" class="post_image">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-{{$contentClass}}">
                                        <div class="row">
                                            <div class="col-12 {{$textAlign}} {{$post->image_placement == 'center' ? 'mt-4' : ''}}">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div class="overflow-hidden">
                                                        <h5 class="h5 mb-0 overflow-hidden text-truncate"><a href="{{ route('newsfeed.show',[tenant('tenant_id'),$post->id]) }}" class="post_title">{!! $post->title !!}</a></h5>
                                                    </div>
                                                </div>
                                                <span class="post_subtitle">{{$post->user->name}} - {{Utility::getDateFormatted($post->created_at,false,$dateformat)}}</span>
                                            </div>

                                            <div class="shortened_txt col-12 card-text mt-2 mb-2 text-muted post_body {{$post->excerpt_length > 0 ? 'overflow-hidden' : 'overflow-auto'}}" id="shortened_txt_{{$post->id}}" >
                                                {!! $post->detail !!}
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 text-right {{$post->image_placement == 'right' ? 'order-lg-3' : ''}}">
                                        <a href="{{ route('newsfeed.show',[tenant('tenant_id'),$post->id]) }}">
                                            <span class="text-primary">{{__('Read more...')}}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('newsfeed.list',[tenant('tenant_id')]) }}">
                            <span class="text-primary">{{__('See all...')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
{{--End Top Layout--}}

<div class="clearfix"></div>

{{--Middle Layout--}}
<div class="row">
{{-- <div class="card-columns card-columns-3 dynamic_column"> --}}
    @foreach ($layouts['middle'] as $middle)
        @if (str_contains($middle->content_type, '[package_layout]'))
            @php
                $cartTemplate = '';
                $packageLayout = config('package-layout');
                if ($packageLayout) {
                    $contentTypeArr = explode('.', $middle->content_type);
                    if (isset($packageLayout[$contentTypeArr[1]]) && !empty($packageLayout[$contentTypeArr[1]])) {
                        $templateName = $packageLayout[$contentTypeArr[1]][$contentTypeArr[2]]['template'];
                        $cartTemplate = $contentTypeArr[1] . '::' . $templateName;
                    }
                }
            @endphp
            @if ($cartTemplate)
                @include($cartTemplate, [
                'title' => $middle->title,
                 'class' => $middle->returnClass(),
                 'plural_item' => $middle->plural_item,
                 'single_item' => $middle->single_item,
                 'max_item' => $middle->max_item,
                 'data_source' => $middle->data_source,
                 ])
            @endif
        @endif
        @if ($middle->content_type == 'Documents')
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $middle->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($middle->getResult()) }} {{ (count($middle->getResult()) == 0 || count($middle->getResult()) > 1) ? $middle->plural_item : $middle->single_item }}</span>
                            </div>
                            <span class="badge badge-xs badge-success">{{ Utility::newCount($middle->getResult()) }}</span>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @forelse($middle->getResult() as $doc_response)
                            @if ($middle->max_item >= $loop->iteration)
                                @php
                                    $doc_icon = Utility::GetDocProp($doc_response,'Icon');
                                    $doc_icon = !empty($doc_icon) ? $doc_icon : 'fa fa-file-text-o';
                                @endphp
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="{{ $doc_icon }}" aria-hidden="true"></i>
                                            </div>
                                            <div class="col ml-n2">
                                                @if (env('CARD_FIELDS_STACK') >= 1)
                                                    <h6 class="text-sm mb-0">
                                                        <a href="{{ route('docs.view',[tenant('tenant_id'),$doc_response->DocID]) }}">{{ Utility::isDate(Utility::GetDocProp($doc_response,'Title')) }}</a>
                                                    </h6>
                                                @endif
                                                @if (env('CARD_FIELDS_STACK') >= 2)
                                                    <p class="card-text small text-muted mb-0">{{ Utility::isDate(Utility::GetDocProp($doc_response,'Subtitle')) }}</p>
                                                @endif
                                                @if (env('CARD_FIELDS_STACK') >= 3)
                                                    <span
                                                        class="card-text text-xs">{{ Utility::isDate(Utility::GetDocProp($doc_response,'Excerpt')) }}</span>
                                                @endif
                                            </div>
                                            <div class="col-12 text-right">
                                                <span
                                                    class="badge badge-xs {{ Utility::GetDocProp($doc_response,'badge-class') }}">{{ Utility::GetDocProp($doc_response,'Status') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @break;
                            @endif
                        @empty
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('No Available ') . $middle->plural_item}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('docs.index',[tenant('tenant_id'),$middle->data_source]) }}"
                        class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                    </div>
                </div>
            </div>
        @elseif($middle->content_type == 'Child Workflows')
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $middle->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($middle->getResult()) }} {{ (count($middle->getResult()) == 0 || count($middle->getResult()) > 1) ? $middle->plural_item : $middle->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @forelse($middle->getResult() as $row)
                            @if ($middle->max_item >= $loop->iteration)
                                @php
                                    $columnArray = $row->ColumnValues;
                                    $icon = Utility::GetTableRowColumnValue($columnArray,'Icon');
                                    $icon = !empty($icon) ? $icon : 'fa fa-file-text-o';
                                @endphp
                                @if (!empty(Utility::GetTableRowColumnValue($columnArray,'Title')))
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="{{ $icon }}" aria-hidden="true"></i></div>
                                                <div class="col ml-n2">
                                                    @if (env('CARD_FIELDS_STACK') >= 1)
                                                        <h6 class="text-sm mb-0">
                                                            <a href="{{ route('batch.form.detail',[tenant('tenant_id'),$middle->content_type,Utility::GetTableRowColumnValue($columnArray,'Title')]) }}">{{ Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Title')) }}</a>
                                                        </h6>
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 2)
                                                        <p class="card-text small text-muted mb-0">{{ Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Subtitle')) }}</p>
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 3)
                                                        <span
                                                            class="card-text text-xs">{{ Utility::GetTableRowColumnValue($columnArray,'Excerpt') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-12 text-right">
                                                    <span
                                                        class="badge badge-xs {{ Utility::GetTableRowColumnValue($columnArray,'badge-class') }}">{{ Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Status')) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                @break;
                            @endif
                        @empty
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('No Available ') . $middle->plural_item}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('batch.detail',[tenant('tenant_id'),$middle->data_source]) }}"
                        class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                    </div>
                </div>
            </div>
        @elseif($middle->content_type == 'Workflow view')
            @php
                $workflow_views = $middle->getResult();
                $adv_config = json_decode($middle->adv_config);
            @endphp
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $middle->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($workflow_views['details']) }} {{ (count($workflow_views['details']) == 0 || count($workflow_views['details']) > 1) ? $middle->plural_item : $middle->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- List mode --}}
                    @if (isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on")
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        @for ($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++)
                                            <th class="pointer text-dark">
                                                {{ (isset($workflow_views['titles'][$i]) ? Str::title($workflow_views['titles'][$i]) : '') }}
                                            </th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    @if ($workflow_views['is_success'] == true)
                                        @forelse($workflow_views['details'] as $workflow)
                                            @if ($middle->max_item >= $loop->iteration)
                                                @php
                                                    if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                                    {
                                                        $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($middle->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                    else
                                                    {
                                                        $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($middle->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                @endphp
                                                <tr>
                                                    @php
                                                        $first_column = true;
                                                    @endphp
                                                    @for ($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++)
                                                        <td>
                                                            @if ($first_column)
                                                                <a href="{{$url}}">{{ (!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '') }}</a>
                                                                {{ $first_column = false; }}
                                                            @else
                                                                {{ (!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '') }}
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @else
                                                @break;
                                            @endif
                                        @empty
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                {{__('No Available ') . $middle->plural_item}}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    @else
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        {{__('An error occurred retrieving').' '.$middle->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    {{-- Not list mode --}}
                    @else
                        <div class="card-wrapper p-3">
                            @if ($workflow_views['is_success'] == true)
                                @forelse($workflow_views['details'] as $workflow)
                                    @if ($middle->max_item >= $loop->iteration)
                                        @php
                                            if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                            {
                                                $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($middle->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                            else
                                            {
                                                $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($middle->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                        @endphp
                                        <div class="card mb-2 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i></div>
                                                    <div class="col ml-n2">
                                                        @if (env('CARD_FIELDS_STACK') >= 1)
                                                            <h6 class="text-sm mb-0">
                                                                <a href="{{$url}}">{{(!empty($workflow[$workflow_views['titles'][2]]) ? Utility::isDate($workflow[$workflow_views['titles'][2]]) : '')}}</a>
                                                            </h6>
                                                        @endif
                                                        @if (env('CARD_FIELDS_STACK') >= 2)
                                                            @if (isset($workflow[$workflow_views['titles'][3]]) && !empty($workflow[$workflow_views['titles'][3]]))
                                                                <p class="card-text small text-muted mb-0">{{ Utility::isDate($workflow[$workflow_views['titles'][3]]) }}</p>
                                                            @endif
                                                        @endif
                                                        @if (env('CARD_FIELDS_STACK') >= 3)
                                                            @if (isset($workflow[$workflow_views['titles'][4]]) && !empty($workflow[$workflow_views['titles'][4]]))
                                                                <span
                                                                    class="card-text text-xs">{{ Utility::isDate($workflow[$workflow_views['titles'][4]]) }}</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if (in_array('Status',$workflow_views['titles']) == true)
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4
                                                                {{(!in_array($workflow['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                                                @if (in_array($workflow['Status'],array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$workflow['Status'])}}"@endif>
                                                                {{ $workflow['Status'] }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if (in_array('Progress',$workflow_views['titles']) == true)
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            <span class="completion mr-2"><small>{{ $workflow['Progress'] }}%</small></span>
                                                            @php
                                                                $progressColor = "";

                                                                if ($workflow['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($workflow['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($workflow['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $middleWidth = $middle->returnClass();

                                                                if ($middleWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            @endphp
                                                            <div>
                                                                <div class="progress progress-xs" style="width: {{ $progressBarWidth }}">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $workflow['Progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $workflow['Progress'] }}%; background-color: {{ $progressColor }};"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @break;
                                    @endif
                                @empty
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        {{__('No Available ') . $middle->plural_item}}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            @else
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    {{__('An error occurred retrieving').' '.$middle->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="card-footer py-2 row footer-row">
                        @if (!empty($middle->eform_url))
                            <div class="col text-left">
                                <a href="{{route('eforms.view',[tenant('tenant_id'),$middle->id])}}"
                                class="text-sm text-primary font-weight-bold">{{__('New..')}}</a>
                            </div>
                        @endif
                        <div class="col {{(!empty($middle->eform_url)) ? 'text-right' : 'text-center'}}">
                            <a href="{{ route('tasks.index',[tenant('tenant_id')]) }}"
                            class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($middle->content_type == 'Content view')
            @php
                $content_views = $middle->getResult();
                $adv_config = json_decode($middle->adv_config);
            @endphp
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $middle->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($content_views['details']) }} {{ (count($content_views['details']) == 0 || count($content_views['details']) > 1) ? $middle->plural_item : $middle->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- List mode --}}
                    @if (isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on")
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        @for ($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++)
                                            <th class="pointer text-dark">
                                                {{ (isset($content_views['titles'][$i]) ? Str::title($content_views['titles'][$i]) : '') }}
                                            </th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    @if ($content_views['is_success'] == true)
                                        @forelse($content_views['details'] as $content_view)
                                            @if ($middle->max_item >= $loop->iteration)
                                                @if (isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID']))
                                                    @php
                                                        $appName = $content_view['ICS_AppName'];
                                                        $docId = $content_view['ICS_DocumentID'];
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $middle->data_source.'~'.array_values($content_view)[0];
                                                        $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                                    @endphp
                                                @else
                                                    @php
                                                        $appName = '';
                                                        $docId = '';
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $middle->data_source.'~'.array_values($content_view)[0];
                                                        $url = 'javascript:void(0)';
                                                    @endphp
                                                @endif
                                                {{-- body here --}}
                                                <tr>
                                                    @php
                                                        $first_column = true;
                                                    @endphp
                                                    @for ($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++)
                                                        <td>
                                                            @if ($first_column)
                                                                <a href="{{$url}}">{{ (!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '') }}</a>
                                                                {{ $first_column = false; }}
                                                            @else
                                                                {{ (!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '') }}
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @else
                                                @break;
                                            @endif
                                        @empty
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                {{__('No Available ') . $middle->plural_item}}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    @else
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        {{__('An error occurred retrieving the list of ') . $middle->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']}}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    {{-- Not list mode --}}
                    @else
                        <div class="card-wrapper p-3">
                            @if ($content_views['is_success'] == true)
                                @forelse($content_views['details'] as $content_view)
                                    @if ($middle->max_item >= $loop->iteration)
                                        @if (isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID']))
                                            @php
                                                $appName = $content_view['ICS_AppName'];
                                                $docId = $content_view['ICS_DocumentID'];
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $middle->data_source.'~'.array_values($content_view)[0];
                                                $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                            @endphp
                                        @else
                                            @php
                                                $appName = '';
                                                $docId = '';
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $middle->data_source.'~'.array_values($content_view)[0];
                                                $url = 'javascript:void(0)';
                                            @endphp
                                        @endif
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-file" aria-hidden="true"></i></div>
                                                    <div class="col ml-n2">
                                                        @if (env('CARD_FIELDS_STACK') >= 1)
                                                            <h6 class="text-sm mb-0">
                                                                <a href="{{$url}}">{{(!empty($content_view[$content_views['titles'][0]]) ? Utility::isDate($content_view[$content_views['titles'][0]]) : '')}}</a>
                                                            </h6>
                                                        @endif
                                                        @if (count($content_views['titles']) >= 3)
                                                            @if (env('CARD_FIELDS_STACK') >= 2)
                                                                <p class="card-text small text-muted mb-0">{{(!empty($content_view[$content_views['titles'][1]]) ? Utility::isDate($content_view[$content_views['titles'][1]]) : '')}}</p>
                                                            @endif
                                                            @if (env('CARD_FIELDS_STACK') >= 3)
                                                                <span
                                                                    class="card-text text-xs">{{(!empty($content_view[$content_views['titles'][2]]) ? Utility::isDate($content_view[$content_views['titles'][2]]) : '')}}</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if (array_key_exists('Status', $content_view) == true)
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4 {{(!in_array($content_view['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                                                @if (in_array($content_view['Status'],array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$content_view['Status'])}}"@endif
                                                                >
                                                                {{ $content_view['Status'] }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if (array_key_exists('Progress', $content_view) == true)
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            @php
                                                                $progressValue = $content_view['Progress'] == NULL ? "0" : $content_view['Progress'];

                                                                $progressColor = "";

                                                                if ($content_view['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($content_view['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($content_view['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $middleWidth = $middle->returnClass();

                                                                if ($middleWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            @endphp
                                                            <span class="completion mr-2"><small>{{ $progressValue }}%</small></span>
                                                            <div>
                                                                <div class="progress progress-xs" style="width: {{ $progressBarWidth }}">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $content_view['Progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $content_view['Progress'] }}%; background-color: {{ $progressColor }};"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @break;
                                    @endif
                                @empty
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        {{__('No Available ') . $middle->plural_item}}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            @else
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    {{__('An error occurred retrieving the list of ') . $middle->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="card-footer py-2 row footer-row">
                        @if (!empty($middle->eform_url))
                            <div class="col text-left">
                                <a href="{{route('eforms.view',[tenant('tenant_id'),$middle->id])}}"
                                   class="text-sm text-primary font-weight-bold">{{__('New..')}}</a>
                            </div>
                        @endif
                        <div class="col {{(!empty($middle->eform_url)) ? 'text-right' : 'text-center'}}">
                            <a href="{{ route('folder.index',[tenant('tenant_id')]) }}"
                            class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($middle->content_type == 'Notifications')
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{__('Notifications')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        @if (user()->getUnreadNotification()->count() > 0)
                            @foreach (user()->getUnreadNotification() as $notification)
                                @if ($middle->max_item >= $loop->iteration)
                                    <div class="list-group-item list-group-item-action" >
                                        {{-- @if ($notification->created_at > user()->notifications_read && $notification->created_at <= user()->last_login_at)
                                            <small class="float-right badge badge-sm badge-info">{{__('Unread')}}</small> --}}
                                        @if($notification->created_at > user()->last_login_at && $notification->created_at > user()->notifications_read)
                                            <small class="float-right badge badge-sm badge-success">{{__('New')}}</small>
                                        @endif
                                        <div class="d-flex">
                                            <div>
                                                <i class="fas {{ (!empty($notification->type)) ? $notification->type : 'fa-cogs' }} mr-3"></i>
                                            </div>
                                            <div>
                                                @if (env('CARD_FIELDS_STACK') >= 1)
                                                    <div class="text-sm lh-150">{{ mb_strimwidth($notification->text, 0, 100, "...") }}</div>
                                                @endif
                                                @if (env('CARD_FIELDS_STACK') >= 2)
                                                    <small
                                                        class="d-block text-muted">{{ Utility::getDateFormatted($notification->created_at,true) }}</small>
                                                @endif
                                                @if (!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type))

                                                    @if ($notification->link_type == 'calendar')
                                                        <a class="calendar_notif"
                                                        href="{!! \App\Models\UserNotification::getLink($notification->id) !!}"
                                                        data-title="{!! \App\Models\Calendar::getCalendarName($notification->link_url)  !!}">
                                                            <small
                                                                class="float-left badge badge-sm {{ $notification->link_color }} text-white"
                                                                data-type='{{$notification->link_type}}'
                                                            >
                                                                {{ $notification->link_title }}
                                                            </small>
                                                        </a>
                                                    @else
                                                        <a href="{!! \App\Models\UserNotification::getLink($notification->id) !!}"
                                                        data-title="{!! $notification->link_title !!}"
                                                        class="from_notification">
                                                            <small class="float-left badge badge-sm {{ $notification->link_color }} text-white" >{{ $notification->link_title }}</small>
                                                        </a>
                                                    @endif



                                                    <div class="clearfix"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @break;
                                @endif
                            @endforeach
                        @else
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="text-center">
                                    <div class="text-sm lh-150 font-weight-bold">{{__('No New Notifications')}}</div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('notification.index',tenant('tenant_id')) }}"
                        class="text-sm text-primary font-weight-bold">{{__('See all notifications')}}</a>
                    </div>
                </div>
            </div>
        @elseif($middle->content_type == 'Calendar')
            @php
                $calendar_id = uniqid().$middle->id;
            @endphp
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card widget-calendar">
                    <div class="card-header">
                        <div class="text-sm text-muted mb-1 layout-calendar-year"></div>
                        <a href="{{ route('calendar.index',tenant('tenant_id')) }}">
                            <div class="h5 mb-0 layout-calendar-day text-primary"></div>
                        </a>
                    </div>
                    <div data-toggle="{{$calendar_id}}-calendar"></div>
                </div>
            </div>
            @push('script')
                <script>
                    $('[data-toggle="{{$calendar_id}}-calendar"]').fullCalendar({
                        contentHeight: "auto",
                        displayEventTime: false,
                        theme: !1,
                        buttonIcons: {prev: " fas fa-angle-left", next: " fas fa-angle-right"},
                        header: {right: "next", center: "title, ", left: "prev"},
                        editable: !0,
                        events: {!! json_encode($arrData) !!},
                        eventClick: function (e, t) {
                            var title = e.title;
                            var url = e.url;

                            if (typeof url != 'undefined') {
                                $("#commonModal .modal-title").html(title);
                                $("#commonModal .modal-dialog").addClass('modal-md');
                                $("#commonModal .modal-dialog").addClass('ow-break-word');
                                $("#commonModal .modal-title").addClass('ow-anywhere');
                                $("#commonModal").modal('show');
                                $.get(url, {}, function (data) {
                                    $('#commonModal .modal-body').html(data);
                                });
                                return false;
                            }
                        }
                    });
                    var mYear = moment().format("YYYY"), mDay = moment().format("dddd, MMM D");
                    $(".layout-calendar-year").html(mYear), $(".layout-calendar-day").html(mDay);
                </script>
            @endpush
        @elseif($middle->content_type == 'System message')
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-body">
                        @if (user()->account_type == 4)
                            {!! Utility::getValByName('welcome_message_ext') !!}
                        @else
                            {!! Utility::getValByName('welcome_message_int') !!}
                        @endif
                    </div>
                </div>
            </div>
        @elseif($middle->content_type == 'KPI Card')
            @php
                $kpiData = $middle->getResult();
            @endphp
             <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{$kpiData['title']}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="kpi_card_title">{{ucfirst($kpiData['data'][0])}}</p>
                        <div class="text-center">
                            <h1 class="font-weight-700 kpi_card_value">{{$kpiData['data'][1]}}</h1>
                        </div>
                    </div>
                </div>
             </div>
        @elseif($middle->content_type == 'Pie Chart' || $middle->content_type == 'Line Chart' || $middle->content_type == 'Vertical bar Chart' || $middle->content_type == 'Horizontal bar Chart')
            @php
                $chartData ='';
                $chartData = $middle->getResult();
                $id = uniqid().$middle->id;
            @endphp
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ $middle->title }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($chartData['is_success'])
                            <div class="chartWrapper" id="chartwrap-{{$id}}" >
                                <div id="chartarea-{{$id}}">
                                    <canvas id="{{$id}}" ></canvas>
                                </div>
                            </div>
                        @else
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving').' '}} <i><b>{{$middle->title.'. '}}</b></i> {{__('Please contact your system administrator for assistance.')}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if($chartData['is_success'])
                    @push('script')
                    <script>
                        var ctx = document.getElementById('{{$id}}').getContext('2d');

                        var chartHeight = {!! json_encode($chartData['height']) !!};
                        var chartWidth = {!! json_encode($chartData['width']) !!};

                        var chartwrap = $("#chartwrap-{{$id}}");
                        var chartarea = $("#chartarea-{{$id}}");

                        var currWidth = parseInt(chartwrap.width());

                        if(chartWidth > 0){
                            chartarea.css('width', chartWidth + "px");
                        }

                        if(chartHeight > 0){
                            chartarea.css('height', chartHeight + "px");
                        }

                        var chart = new Chart(ctx, {
                            type: {!! json_encode($chartData['type']) !!},
                            data: {
                                labels: {!! json_encode($chartData['labels']) !!},
                                datasets: [{!! json_encode($chartData['data']) !!}],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                @if ($chartData['type'] != 'doughnut')
                                tooltips: {
                                    mode: 'label',
                                    callbacks: {
                                        label: function (tooltipItem, data) {
                                            // if (tooltipItem.value != '1' && tooltipItem.value != '0') {
                                            if (tooltipItem.value > 1) {
                                                return ' ' + Number(tooltipItem.value).toLocaleString() + " {{$chartData['plural']}}";
                                            } else {
                                                return ' ' + Number(tooltipItem.value).toLocaleString() + " {{$chartData['single']}}";
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(value, index, values) {
												return '       ' + value.toLocaleString();
											}
                                        }
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(value, index, values) {
												return '       ' + value.toLocaleString();
											}
                                        }
                                    }]
                                },
                                legend: {display: false}
                                @else
                                legend: {
                                    display: true,
                                    position: 'right',
                                    labels: {
                                        fontColor: '#333',
                                        usePointStyle: true,
                                    }
                                },
                                tooltips: {
                                    callbacks: {
                                        title: function (tooltipItem, data) {
                                            return data['labels'][tooltipItem[0]['index']];
                                        },
                                        label: function (tooltipItem, data) {
                                            if (data['datasets'][0]['data'][tooltipItem['index']] > 1) {
                                                return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " {{$chartData['plural']}}";
                                            } else {
                                                return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " {{$chartData['single']}}";
                                            }
                                        },
                                    },
                                }
                                @endif
                            },
                        });
                    </script>
                @endpush
                @endif
            </div>
        @elseif($middle->content_type == 'Custom HTML')
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ $middle->title }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <iframe id="dynamicHtmlMiddleFrame" src="{!! $middle->data_source !!}" frameborder="0" style="height:200px;width: 100%;" data-src="{!! $middle->data_source !!}"  data-title="{!! $middle->title !!}"  allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        @elseif($middle->content_type == 'Integration')
            @php
                $Integrations = $middle->getResult();
            @endphp
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $middle->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($Integrations['details']) }} {{ (count($Integrations['details']) == 0 || count($Integrations['details']) > 1) ? $middle->plural_item : $middle->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @if ($Integrations['is_success'] == true)
                            @forelse($Integrations['details'] as $key => $integration_val)
                                @if ($middle->max_item >= $loop->iteration)

                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="fas fa-file" aria-hidden="true"></i></div>
                                                <div class="col ml-n2">

                                                    @if (env('CARD_FIELDS_STACK') >= 1)
                                                        @if (isset($integration_val[$Integrations['titles'][0]]) && !empty($integration_val[$Integrations['titles'][0]]))
                                                            @if ($Integrations['details_type'] == 1)
                                                                @php
                                                                    $basic_details_keys = array_intersect(array_keys($integration_val), $Integrations['basic_details']);
                                                                    foreach($basic_details_keys as $k1 => $v1){
                                                                        $basic_details_array[$v1] = $integration_val[$v1];
                                                                    }
                                                                @endphp
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)" class="open-basic-details"
                                                                    data-details="{{json_encode($basic_details_array)}}"
                                                                    data-url="{{ route('integration.basic.detail',tenant('tenant_id')) }}"
                                                                    data-size="md"
                                                                    data-title="{{__('Basic Details')}}">{{Utility::isDate($integration_val[$Integrations['titles'][0]]) }}</a>
                                                                </h6>
                                                            @elseif($Integrations['details_type'] == 2)
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)" class="open_doc"
                                                                    data-id="get-integration-details{{$key}}">{{Utility::isDate($integration_val[$Integrations['titles'][0]]) }}</a>
                                                                </h6>
                                                                {!! Form::open(['method' => 'POST', 'route' => ['integration.detail',[tenant('tenant_id'), "rest" => $Integrations['id']]],'id'=>'get-integration-details'.$key]) !!}
                                                                {{ Form::hidden('url',\Crypt::encrypt($integration_val['url']), ['class' => 'form-control']) }}
                                                                {!! Form::close() !!}
                                                            @else
                                                                <h6 class="text-sm mb-0">{{ Utility::isDate($integration_val[$Integrations['titles'][0]]) }}</h6>
                                                            @endif
                                                        @endif
                                                    @endif
                                                    @if (count($Integrations['titles']) >= 3)
                                                        @if (env('CARD_FIELDS_STACK') >= 2)
                                                            @if (isset($integration_val[$Integrations['titles'][1]]) && !empty($integration_val[$Integrations['titles'][1]]))
                                                                <p class="card-text small text-muted mb-0">{{(!empty($integration_val[$Integrations['titles'][1]]) ? Utility::isDate($integration_val[$Integrations['titles'][1]]) : '')}}</p>
                                                            @endif

                                                        @endif
                                                        @if (env('CARD_FIELDS_STACK') >= 3)
                                                            @if (isset($integration_val[$Integrations['titles'][2]]) && !empty($integration_val[$Integrations['titles'][2]]))
                                                                <span
                                                                    class="card-text text-xs">{{ Utility::isDate($integration_val[$Integrations['titles'][2]]) }}</span>
                                                            @endif
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @break;
                                @endif
                            @empty
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    {{__('No Available ') . $middle->plural_item}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        @else
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving').' '.$middle->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer py-2 row">

                        <div class="col {{(!empty($middle->eform_url)) ? 'text-right' : 'text-center'}}">
                            <a href="{{ route('integration.list',[tenant('tenant_id'),$Integrations['name'],$Integrations['id']]) }}"
                            class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($middle->content_type == 'Court Case')
            @php
                $case_views = $middle->getResult();
            @endphp

            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $middle->title }}<span class="badge badge-success badge-xs"></span>
                                </h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($case_views['details']) }} {{ (count($case_views['details']) == 0 || count($case_views['details']) > 1) ? $middle->plural_item : $middle->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @if ($case_views['is_success'] == true)
                            @forelse($case_views['details'] as $case)
                                @if ($middle->max_item >= $loop->iteration)
                                    @php
                                        $url = route('courtcase.detail',[tenant('tenant_id'),$middle->data_source,$case['ActiveBatchID'] ?? ""]);
                                    @endphp
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i></div>
                                                <div class="col ml-n2">
                                                    @if (env('CARD_FIELDS_STACK') >= 1)
                                                        <h6 class="text-sm mb-0">
                                                            <a href="{{$url}}">{{(!empty($case[$case_views['titles'][2]]) ? Utility::isDate($case[$case_views['titles'][2]]) : '')}}</a>
                                                        </h6>
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 2)
                                                        @if (isset($case[$case_views['titles'][3]]) && !empty($case[$case_views['titles'][3]]))
                                                            <p class="card-text small text-muted mb-0">{{ Utility::isDate($case[$case_views['titles'][3]]) }}</p>
                                                        @endif
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 3)
                                                        @if (isset($case[$case_views['titles'][4]]) && !empty($case[$case_views['titles'][4]]))
                                                            <span
                                                                class="card-text text-xs">{{ Utility::isDate($case[$case_views['titles'][4]]) }}</span>
                                                        @endif
                                                    @endif
                                                </div>
                                                @if (in_array('Status',$case_views['titles']) == true)
                                                    <div class="col-12 text-right">
                                                        <span
                                                            class="badge badge-xs text-white {{(!in_array($case['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                                            @if (in_array($case['Status'],array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$case['Status'])}}"@endif>{{ $case['Status'] }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @break;
                                @endif
                            @empty
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    {{__('No Available ') . $middle->plural_item}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        @else
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving').' '.$middle->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('courtcase.list',[tenant('tenant_id'),$middle->data_source,$middle->id]) }}"
                        class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                    </div>
                </div>
            </div>
        @elseif($middle->content_type == 'Custom Page')
            @php
                $custom_page = $middle->getResult();
                $style = "";
                if($middle->max_item > 0) $style = "max-height: ".(100*$middle->max_item)."px; overflow: auto;"
            @endphp
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card">
                    @if (!is_null($custom_page))
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="h5 mb-0">{{ $custom_page->title }}<span
                                            class="badge badge-success badge-xs"></span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="{{ $style }}">
                            {!! $custom_page->detail !!}
                        </div>
                    @endif
                </div>
            </div>
        @elseif($middle->content_type == 'News Feed')
            @php
                $postList = $middle->getResult();
                $dateformat = Utility::getValByName('date_format');
            @endphp
            <div class="{{$middle->returnClass()}} col-auto">
                <div class="card overflow-auto h-580">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $middle->title }}</h5>
                                <span class="d-block text-sm font-italic">{{ count($middle->getResult()) }} {{ (count($middle->getResult()) == 0 || count($middle->getResult()) > 1) ? $middle->plural_item : $middle->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper overflow-auto h-580">
                        @foreach($postList as $key => $post)
                            <div class="card-body border-bottom">

                                @php
                                if ($post->image) {
                                    if($post->image_placement == "center"){
                                        $imageClass = "12";
                                        $contentClass = "12";
                                        $textAlign = 'text-right';
                                    }elseif($post->image_placement == "right"){
                                        $imageClass = "4 order-lg-2";
                                        $contentClass = "8 order-lg-1";
                                        $textAlign = '';
                                    }else{
                                        $imageClass = "4";
                                        $contentClass = "8";
                                        $textAlign = '';
                                    }
                                } else {
                                    $contentClass = "12";
                                    $textAlign = '';
                                }
                                @endphp
                                <div class="row">
                                    @if($post->image)
                                        <div class="col-{{$imageClass}}">
                                            <div class="">
                                                <div class=" overflow-hidden {{$post->image_placement == 'center' ? 'h-200' : 'max-h-200'}}">
                                                    <a href="{{ route('newsfeed.show',[tenant('tenant_id'),$post->id]) }}" class="d-block animate-this">
                                                        <img alt="Image placeholder" src="{{asset(Storage::url($post->image))}}" class="post_image">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-{{$contentClass}}">
                                        <div class="row">

                                            <div class="col-12 {{$textAlign}} {{$post->image_placement == 'center' ? 'mt-4' : ''}}">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div class="overflow-hidden">
                                                        <h5 class="h5 mb-0 overflow-hidden text-truncate"><a href="{{ route('newsfeed.show',[tenant('tenant_id'),$post->id]) }}" class="post_title">{!! $post->title !!}</a></h5>
                                                    </div>
                                                </div>
                                                <span class="post_subtitle">{{$post->user->name}} - {{Utility::getDateFormatted($post->created_at,false,$dateformat)}}</span>
                                            </div>

                                            <div class="shortened_txt col-12 card-text mt-2 mb-2 text-muted post_body {{$post->excerpt_length > 0 ? 'overflow-hidden' : 'overflow-auto'}}" id="shortened_txt_{{$post->id}}" >
                                                {!! $post->detail !!}
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 text-right {{$post->image_placement == 'right' ? 'order-lg-3' : ''}}">
                                        <a href="{{ route('newsfeed.show',[tenant('tenant_id'),$post->id]) }}">
                                            <span class="text-primary">{{__('Read more...')}}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('newsfeed.list',[tenant('tenant_id')]) }}">
                            <span class="text-primary">{{__('See all...')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
{{--End Middle Layout--}}

<div class="clearfix"></div>

{{--Bottom Layout--}}
<div class="row">
    @foreach ($layouts['bottom'] as $bottom)
        @if (str_contains($bottom->content_type, '[package_layout]'))
            @php
                $cartTemplate = '';
                $packageLayout = config('package-layout');
                if ($packageLayout) {
                    $contentTypeArr = explode('.', $bottom->content_type);
                    if (isset($packageLayout[$contentTypeArr[1]]) && !empty($packageLayout[$contentTypeArr[1]])) {
                        $templateName = $packageLayout[$contentTypeArr[1]][$contentTypeArr[2]]['template'];
                        $cartTemplate = $contentTypeArr[1] . '::' . $templateName;
                    }
                }
            @endphp
            @if ($cartTemplate)
                @include($cartTemplate, [
                'title' => $bottom->title,
                 'class' => $bottom->returnClass(),
                 'plural_item' => $bottom->plural_item,
                 'single_item' => $bottom->single_item,
                 'max_item' => $bottom->max_item,
                 'data_source' => $bottom->data_source,
                 ])
            @endif
        @endif
        @if ($bottom->content_type == 'Documents')
            <div class="{{$bottom->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $bottom->title }}<span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($bottom->getResult()) }} {{ (count($bottom->getResult()) == 0 || count($bottom->getResult()) > 1) ? $bottom->plural_item : $bottom->single_item }}</span>
                            </div>
                            <span
                                class="badge badge-xs badge-success">{{ Utility::newCount($bottom->getResult()) }}</span>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @forelse($bottom->getResult() as $doc_response)
                            @if ($bottom->max_item >= $loop->iteration)
                                @php
                                    $doc_icon = Utility::GetDocProp($doc_response,'Icon');
                                    $doc_icon = !empty($doc_icon) ? $doc_icon : 'fa fa-file-text-o';
                                @endphp
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="{{ $doc_icon }}" aria-hidden="true"></i>
                                            </div>
                                            <div class="col ml-n2">
                                                @if (env('CARD_FIELDS_STACK') >= 1)
                                                    <h6 class="text-sm mb-0">
                                                        <a href="{{ route('docs.view',[tenant('tenant_id'),$doc_response->DocID]) }}">{{ Utility::isDate(Utility::GetDocProp($doc_response,'Title')) }}</a>
                                                    </h6>
                                                @endif
                                                @if (env('CARD_FIELDS_STACK') >= 2)
                                                    <p class="card-text small text-muted mb-0">{{ Utility::isDate(Utility::GetDocProp($doc_response,'Subtitle')) }}</p>
                                                @endif
                                                @if (env('CARD_FIELDS_STACK') >= 3)
                                                    <span
                                                        class="card-text text-xs">{{ Utility::isDate(Utility::GetDocProp($doc_response,'Excerpt')) }}</span>
                                                @endif
                                            </div>
                                            <div class="col-12 text-right">
                                                <span
                                                    class="badge badge-xs {{ Utility::GetDocProp($doc_response,'badge-class') }}">{{ Utility::GetDocProp($doc_response,'Status') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @break;
                            @endif
                        @empty
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('No Available ') . $bottom->plural_item}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('docs.index',[tenant('tenant_id'),$bottom->data_source]) }}"
                           class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                    </div>
                </div>
            </div>
        @elseif($bottom->content_type == 'Child Workflows')
            <div class="{{$bottom->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $bottom->title }}<span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($bottom->getResult()) }} {{ (count($bottom->getResult()) == 0 || count($bottom->getResult()) > 1) ? $bottom->plural_item : $bottom->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @forelse($bottom->getResult() as $row)
                            @if ($bottom->max_item >= $loop->iteration)
                                @php
                                    $columnArray = $row->ColumnValues;
                                    $icon = Utility::GetTableRowColumnValue($columnArray,'Icon');
                                    $icon = !empty($icon) ? $icon : 'fa fa-file-text-o';
                                @endphp
                                @if (!empty(Utility::GetTableRowColumnValue($columnArray,'Title')))
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="{{ $icon }}" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">
                                                    @if (env('CARD_FIELDS_STACK') >= 1)
                                                        <h6 class="text-sm mb-0">
                                                            <a href="{{ route('batch.form.detail',[tenant('tenant_id'),$bottom->content_type,Utility::GetTableRowColumnValue($columnArray,'Title')]) }}">{{ Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Title')) }}</a>
                                                        </h6>
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 2)
                                                        <p class="card-text small text-muted mb-0">{{ Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Subtitle')) }}</p>
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 3)
                                                        <span
                                                            class="card-text text-xs">{{ Utility::isDate(Utility::GetTableRowColumnValue($columnArray,'Excerpt')) }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-12 text-right">
                                                    <span
                                                        class="badge badge-xs {{ Utility::GetTableRowColumnValue($columnArray,'badge-class') }}">{{ Utility::GetTableRowColumnValue($columnArray,'Status') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                @break;
                            @endif
                        @empty
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('No Available ') . $bottom->plural_item}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('batch.detail',[tenant('tenant_id'),$bottom->data_source]) }}"
                           class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                    </div>
                </div>
            </div>
        @elseif($bottom->content_type == 'Workflow view')
            @php
                $workflow_views = $bottom->getResult();
                $adv_config = json_decode($bottom->adv_config);
            @endphp
            <div class="{{$bottom->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $bottom->title }}<span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($workflow_views['details']) }} {{ (count($workflow_views['details']) == 0 || count($workflow_views['details']) > 1) ? $bottom->plural_item : $bottom->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- List mode --}}
                    @if (isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on")
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        @for ($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++)
                                            <th class="pointer text-dark">
                                                {{ (isset($workflow_views['titles'][$i]) ? Str::title($workflow_views['titles'][$i]) : '') }}
                                            </th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    @if ($workflow_views['is_success'] == true)
                                        @forelse($workflow_views['details'] as $workflow)
                                            @if ($bottom->max_item >= $loop->iteration)
                                                @php
                                                    if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                                    {
                                                        $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($bottom->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                    else
                                                    {
                                                        $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($bottom->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                                    }
                                                @endphp
                                                <tr>
                                                    @php
                                                        $first_column = true;
                                                    @endphp
                                                    @for ($i = 2; $i < ($adv_config->list_mode_settings[0]->max_column + 2); $i++)
                                                        <td>
                                                            @if ($first_column)
                                                                <a href="{{$url}}">{{ (!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '') }}</a>
                                                                {{ $first_column = false; }}
                                                            @else
                                                                {{ (!empty(Utility::isDate($workflow[$workflow_views['titles'][$i]])) ? Utility::isDate($workflow[$workflow_views['titles'][$i]]) : '') }}
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @else
                                                @break;
                                            @endif
                                        @empty
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                {{__('No Available ') . $bottom->plural_item}}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    @else
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        {{__('An error occurred retrieving the list of ') . $bottom->plural_item . '. ' . __('Please contact your system administrator and reference error: ')}}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    {{-- Not list mode --}}
                    @else
                        <div class="card-wrapper p-3">
                            @if ($workflow_views['is_success'] == true)
                                @forelse($workflow_views['details'] as $workflow)
                                    @if ($bottom->max_item >= $loop->iteration)
                                        @php
                                            if(isset($workflow['ICM_EFORM']) && $workflow['ICM_EFORM'] == 1)
                                            {
                                                $url = route('tasks.eform.detail',[tenant('tenant_id'),rawurlencode($bottom->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                            else
                                            {
                                                $url = route('tasks.detail',[tenant('tenant_id'),rawurlencode($bottom->data_source), Utility::base64url_encode(array_values($workflow)[2]),$workflow['ActiveBatchID'] ?? ""]);
                                            }
                                        @endphp
                                        <div class="card mb-2 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col ml-n2">
                                                        @if (env('CARD_FIELDS_STACK') >= 1)
                                                            <h6 class="text-sm mb-0">
                                                                <a href="{{$url}}">{{(!empty($workflow[$workflow_views['titles'][2]]) ? Utility::isDate($workflow[$workflow_views['titles'][2]]) : '')}}</a>
                                                            </h6>
                                                        @endif
                                                        @if (env('CARD_FIELDS_STACK') >= 2)
                                                            @if (isset($workflow[$workflow_views['titles'][3]]) && !empty($workflow[$workflow_views['titles'][3]]))
                                                                <p class="card-text small text-muted mb-0">{{ Utility::isDate($workflow[$workflow_views['titles'][3]]) }}</p>
                                                            @endif
                                                        @endif
                                                        @if (env('CARD_FIELDS_STACK') >= 3)
                                                            @if (isset($workflow[$workflow_views['titles'][4]]) && !empty($workflow[$workflow_views['titles'][4]]))
                                                                <span
                                                                    class="card-text text-xs">{{ Utility::isDate($workflow[$workflow_views['titles'][4]]) }}</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if (in_array('Status',$workflow_views['titles']) == true)
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4 {{(!in_array($workflow['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                                                @if (in_array($workflow['Status'],array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$workflow['Status'])}}"@endif>{{ $workflow['Status'] }}</span>
                                                        </div>
                                                    @endif
                                                    @if (in_array('Progress',$workflow_views['titles']) == true)
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            <span class="completion mr-2"><small>{{ $workflow['Progress'] }}%</small></span>
                                                            @php
                                                                $progressColor = "";

                                                                if ($workflow['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($workflow['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($workflow['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $bottomWidth = $bottom->returnClass();

                                                                if ($bottomWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            @endphp
                                                            <div>
                                                                <div class="progress progress-xs" style="width: {{ $progressBarWidth }}">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $workflow['Progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $workflow['Progress'] }}%; background-color: {{ $progressColor }};"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @break;
                                    @endif
                                @empty
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        {{__('No Available ') . $bottom->plural_item}}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            @else
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    {{__('An error occurred retrieving').' '.$bottom->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="card-footer py-2 row footer-row">
                        @if (!empty($bottom->eform_url))
                            <div class="col text-left">
                                <a href="{{route('eforms.view',[tenant('tenant_id'),$bottom->id])}}"
                                   class="text-sm text-primary font-weight-bold">{{__('New..')}}</a>
                            </div>
                        @endif
                        <div class="col {{(!empty($bottom->eform_url)) ? 'text-right' : 'text-center'}}">
                            <a href="{{ route('tasks.index',[tenant('tenant_id')]) }}"
                               class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($bottom->content_type == 'Content view')
            <div class="{{$bottom->returnClass()}} col-auto">
                @php
                    $content_views = $bottom->getResult();
                    $adv_config = json_decode($bottom->adv_config);
                @endphp
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $bottom->title }}<span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($content_views['details']) }} {{ (count($content_views['details']) == 0 || count($content_views['details']) > 1) ? $bottom->plural_item : $bottom->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- List mode --}}
                    @if (isset($adv_config->list_mode_settings) && $adv_config->list_mode_settings[0]->list_mode === "on")
                        <div class="card-wrapper p-1">
                            <table class="table table-sm table-responsive table-borderless table-list-mode">
                                <thead>
                                    <tr>
                                        @for ($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++)
                                            <th class="pointer text-dark">
                                                {{ (isset($content_views['titles'][$i]) ? Str::title($content_views['titles'][$i]) : '') }}
                                            </th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody class="list-mode-body">
                                    @if ($content_views['is_success'] == true)
                                        @forelse($content_views['details'] as $content_view)
                                            @if ($bottom->max_item >= $loop->iteration)
                                                @if (isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID']))
                                                    @php
                                                        $appName = $content_view['ICS_AppName'];
                                                        $docId = $content_view['ICS_DocumentID'];
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $bottom->data_source.'~'.array_values($content_view)[0];
                                                        $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                                    @endphp
                                                @else
                                                    @php
                                                        $appName = '';
                                                        $docId = '';
                                                        unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                        $newName = $bottom->data_source.'~'.array_values($content_view)[0];
                                                        $url = 'javascript:void(0)';
                                                    @endphp
                                                @endif
                                                <tr>
                                                    @php
                                                        $first_column = true;
                                                    @endphp
                                                    @for ($i = 0; $i < $adv_config->list_mode_settings[0]->max_column; $i++)
                                                        <td>
                                                            @if ($first_column)
                                                                <a href="{{$url}}">{{ (!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '') }}</a>
                                                                {{ $first_column = false; }}
                                                            @else
                                                                {{ (!empty($content_view[$content_views['titles'][$i]]) ? Utility::isDate($content_view[$content_views['titles'][$i]]) : '') }}
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @else
                                                @break;
                                            @endif
                                        @empty
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h6 class="text-sm mb-0 text-center">
                                                                {{__('No Available ') . $bottom->plural_item}}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    @else
                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-3">
                                                <div class="row align-items-center">
                                                    <div class="col ml-n2">
                                                        <h6 class="text-sm mb-0 text-center">
                                                        {{__('An error occurred retrieving the list of ') . $bottom->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']}}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    {{-- Not list mode --}}
                    @else
                        <div class="card-wrapper p-3">
                            @if ($content_views['is_success'] == true)
                                @forelse($content_views['details'] as $content_view)
                                    @if ($bottom->max_item >= $loop->iteration)
                                        @if (isset($content_view['ICS_AppName']) && isset($content_view['ICS_DocumentID']))
                                            @php
                                                $appName = $content_view['ICS_AppName'];
                                                $docId = $content_view['ICS_DocumentID'];
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $bottom->data_source.'~'.array_values($content_view)[0];
                                                $url = route('folder.detail',[tenant('tenant_id'),rawurlencode($newName),$appName,$docId]);
                                            @endphp
                                        @else
                                            @php
                                                $appName = '';
                                                $docId = '';
                                                unset($content_view['Ident'], $content_view['ICS_DocumentID'], $content_view['ICS_AppName']);
                                                $newName = $bottom->data_source.'~'.array_values($content_view)[0];
                                                $url = 'javascript:void(0)';
                                            @endphp
                                        @endif


                                        <div class="card mb-3 border shadow-none">
                                            <div class="px-3 py-2">
                                                <div class="row align-items-center compact-content">
                                                    <div class="col-auto"><i class="fas fa-file" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="col ml-n2">
                                                        @if (env('CARD_FIELDS_STACK') >= 1)
                                                            <h6 class="text-sm mb-0">
                                                                <a href="{{$url}}">{{(!empty($content_view[$content_views['titles'][0]]) ? Utility::isDate($content_view[$content_views['titles'][0]]) : '')}}</a>
                                                            </h6>
                                                        @endif
                                                        @if (count($content_views['titles']) >= 3)
                                                            @if (env('CARD_FIELDS_STACK') >= 2)
                                                                <p class="card-text small text-muted mb-0">{{(!empty($content_view[$content_views['titles'][1]]) ? Utility::isDate($content_view[$content_views['titles'][1]]) : '')}}</p>
                                                            @endif
                                                            @if (env('CARD_FIELDS_STACK') >= 3)
                                                                <span
                                                                    class="card-text text-xs">{{(!empty($content_view[$content_views['titles'][2]]) ? Utility::isDate($content_view[$content_views['titles'][2]]) : '')}}</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @if (array_key_exists('Status', $content_view) == true)
                                                        <div class="col-4">
                                                            <span
                                                                class="badge badge-xs text-white ml-4 {{(!in_array($content_view['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                                                @if (in_array($content_view['Status'],array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$content_view['Status'])}}"@endif
                                                                >
                                                                {{ $content_view['Status'] }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if (array_key_exists('Progress', $content_view) == true)
                                                        <div class="col-8 d-flex align-items-center justify-content-end compact-content">
                                                            @php
                                                                $progressValue = $content_view['Progress'] == NULL ? "0" : $content_view['Progress'];

                                                                $progressColor = "";

                                                                if ($content_view['Progress'] < 25) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_25');
                                                                } else if ($content_view['Progress'] < 50) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_50');
                                                                } else if ($content_view['Progress'] < 75) {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_75');
                                                                } else {
                                                                    $progressColor = env('PROGRESSBAR_COLOR_100');
                                                                }

                                                                $progressBarWidth = "";
                                                                $bottomWidth = $bottom->returnClass();

                                                                if ($bottomWidth === "col-md-4") {
                                                                    $progressBarWidth = "50px;";
                                                                } else {
                                                                    $progressBarWidth = "100px;";
                                                                }
                                                            @endphp
                                                            <span class="completion mr-2"><small>{{ $progressValue }}%</small></span>
                                                            <div>
                                                                <div class="progress progress-xs" style="width: {{ $progressBarWidth }}">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $content_view['Progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $content_view['Progress'] }}%; background-color: {{ $progressColor }};"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @break;
                                    @endif
                                @empty
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0 text-center">
                                                        {{__('No Available ') . $bottom->plural_item}}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            @else
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving the list of ') . $bottom->plural_item . '. ' . __('Please contact your system administrator and reference error: ') . $content_views['error_message']}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="card-footer py-2 row footer-row">
                        @if (!empty($bottom->eform_url))
                            <div class="col text-left">
                                <a href="{{route('eforms.view',[tenant('tenant_id'),$bottom->id])}}"
                                   class="text-sm text-primary font-weight-bold">{{__('New..')}}</a>
                            </div>
                        @endif
                        <div class="col {{(!empty($bottom->eform_url)) ? 'text-right' : 'text-center'}}">
                            <a href="{{ route('folder.index',[tenant('tenant_id')]) }}"
                               class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($bottom->content_type == 'Notifications')
            <div class="{{$bottom->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{__('Notifications')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        @if (user()->getUnreadNotification()->count() > 0)
                            @foreach (user()->getUnreadNotification() as $notification)
                                @if ($bottom->max_item >= $loop->iteration)
                                    <div class="list-group-item list-group-item-action ">
                                    {{-- @if ( $notification->created_at > user()->notifications_read && $notification->created_at <= user()->last_login_at)
                                    <small class="float-right badge badge-sm badge-info">{{__('Unread')}}</small> --}}
                                        @if($notification->created_at > user()->last_login_at && $notification->created_at > user()->notifications_read)
                                            <small class="float-right badge badge-sm badge-success">{{__('New')}}</small>
                                        @endif
                                        <div class="d-flex">
                                            <div>
                                                <i class="fas {{ (!empty($notification->type)) ? $notification->type : 'fa-cogs' }} mr-3"></i>
                                            </div>
                                            <div>
                                                @if (env('CARD_FIELDS_STACK') >= 1)
                                                     <div class="text-sm lh-150">{{ mb_strimwidth($notification->text, 0, 100, "...") }}</div>
                                                @endif
                                                @if (env('CARD_FIELDS_STACK') >= 2)
                                                    <small
                                                        class="d-block text-muted">{{ Utility::getDateFormatted($notification->created_at,true) }}</small>
                                                @endif
                                                @if (!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type))

                                                    @if ($notification->link_type == 'calendar')
                                                        <a class=" calendar_notif" href="{!! \App\Models\UserNotification::getLink($notification->id) !!}"
                                                        data-title="{!! \App\Models\Calendar::getCalendarName($notification->link_url)  !!}">
                                                            <small class="float-left badge badge-sm {{ $notification->link_color }} text-white"
                                                                data-type='{{$notification->link_type}}'>
                                                                {{ $notification->link_title }}
                                                            </small>
                                                        </a>
                                                    @else
                                                        <a href="{!! \App\Models\UserNotification::getLink($notification->id) !!}"
                                                        class="from_notification"
                                                        data-title="{!! $notification->link_title !!}"
                                                        >
                                                            <small class="float-left badge badge-sm  {{ $notification->link_color }} text-white" >
                                                                {{ $notification->link_title }}
                                                            </small>
                                                        </a>
                                                    @endif

                                                    <div class="clearfix"></div>

                                                @endif
                                             </div>
                                        </div>
                                    </a>
                                </div>
                                @else
                                    @break;
                                @endif
                            @endforeach
                        @else
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="text-center">
                                    <div class="text-sm lh-150 font-weight-bold">{{__('No New Notifications')}}</div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('notification.index',tenant('tenant_id')) }}"
                        class="text-sm text-primary font-weight-bold">{{__('See all notifications')}}</a>
                    </div>
                </div>
            </div>
        @elseif($bottom->content_type == 'Calendar')
            <div class="{{$bottom->returnClass()}} col-auto">
                @php
                    $calendar_id = uniqid().$bottom->id;
                @endphp
                <div class="card widget-calendar">
                    <div class="card-header">
                        <div class="text-sm text-muted mb-1 layout-calendar-year"></div>
                        <a href="{{ route('calendar.index',tenant('tenant_id')) }}">
                            <div class="h5 mb-0 layout-calendar-day text-primary"></div>
                        </a>
                    </div>
                    <div data-toggle="{{$calendar_id}}-calendar"></div>
                </div>
                @push('script')
                    <script>
                        $('[data-toggle="{{$calendar_id}}-calendar"]').fullCalendar({
                            contentHeight: "auto",
                            displayEventTime: false,
                            theme: !1,
                            buttonIcons: {prev: " fas fa-angle-left", next: " fas fa-angle-right"},
                            header: {right: "next", center: "title, ", left: "prev"},
                            editable: !0,
                            events: {!! json_encode($arrData) !!},
                            eventClick: function (e, t) {
                                var title = e.title;
                                var url = e.url;

                                if (typeof url != 'undefined') {
                                    $("#commonModal .modal-title").html(title);
                                    $("#commonModal .modal-dialog").addClass('modal-md');
                                    $("#commonModal .modal-dialog").addClass('ow-break-word');
                                    $("#commonModal .modal-title").addClass('ow-anywhere');
                                    $("#commonModal").modal('show');
                                    $.get(url, {}, function (data) {
                                        $('#commonModal .modal-body').html(data);
                                    });
                                    return false;
                                }
                            }
                        });
                        var mYear = moment().format("YYYY"), mDay = moment().format("dddd, MMM D");
                        $(".layout-calendar-year").html(mYear), $(".layout-calendar-day").html(mDay);
                    </script>
                @endpush
            </div>
        @elseif($bottom->content_type == 'System message')
            <div class="{{$bottom->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-body">
                        @if (user()->account_type == 4)
                            {!! Utility::getValByName('welcome_message_ext') !!}
                        @else
                            {!! Utility::getValByName('welcome_message_int') !!}
                        @endif
                    </div>
                </div>
            </div>
        @elseif($bottom->content_type == 'KPI Card')
            @php
                $bottomKpiData = $bottom->getResult();
            @endphp
            <div class="{{$bottom->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{$bottomKpiData['title']}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="kpi_card_title">{{ucfirst($bottomKpiData['data'][0])}}</p>
                        <div class="text-center">
                            <h1 class="font-weight-700 kpi_card_value">{{$bottomKpiData['data'][1]}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($bottom->content_type == 'Pie Chart' || $bottom->content_type == 'Line Chart' || $bottom->content_type == 'Vertical bar Chart' || $bottom->content_type == 'Horizontal bar Chart')
            <div class="{{$bottom->returnClass()}} col-auto">
                @php
                    $fullChartData = $bottom->getResult();
                    $id = uniqid().$bottom->id;
                @endphp
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ $bottom->title }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($fullChartData['is_success'])
                            <div class="chartWrapper" id="chartwrap-{{$id}}" >
                                <div id="chartarea-{{$id}}">
                                    <canvas id="{{$id}}" ></canvas>
                                </div>
                            </div>
                        @else
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving').' '.$top->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if($fullChartData['is_success'])
                    @push('script')
                        <script>
                            var ctx = document.getElementById('{{$id}}').getContext('2d');

                            var chartHeight = {!! json_encode($fullChartData['height']) !!};
                            var chartWidth = {!! json_encode($fullChartData['width']) !!};

                            var chartwrap = $("#chartwrap-{{$id}}");
                            var chartarea = $("#chartarea-{{$id}}");

                            var currWidth = parseInt(chartwrap.width());

                            if(chartWidth > 0){
                                chartarea.css('width', chartWidth + "px");
                            }

                            if(chartHeight > 0){
                                chartarea.css('height', chartHeight + "px");
                            }

                            var fullChart = new Chart(ctx, {
                                type: {!! json_encode($fullChartData['type']) !!},
                                data: {
                                    labels: {!! json_encode($fullChartData['labels']) !!},
                                    datasets: [{!! json_encode($fullChartData['data']) !!}],
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    @if ($fullChartData['type'] != 'doughnut')
                                    tooltips: {
                                        mode: 'label',
                                        callbacks: {
                                            label: function (tooltipItem, data) {
                                                // if (tooltipItem.value != '1' && tooltipItem.value != '0') {
                                                if (tooltipItem.value > 1) {
                                                    return ' ' + Number(tooltipItem.value).toLocaleString() + " {{$fullChartData['plural']}}";
                                                } else {
                                                    return ' ' + Number(tooltipItem.value).toLocaleString() + " {{$fullChartData['single']}}";
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true,
												userCallback: function(value, index, values) {
													return '       ' + value.toLocaleString();
												}
                                            }
                                        }],
                                        xAxes: [{
                                            ticks: {
                                                beginAtZero: true,
												userCallback: function(value, index, values) {
													return '       ' + value.toLocaleString();
												}
                                            }
                                        }]
                                    },
                                    legend: {display: false}
                                    @else
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            fontColor: '#333',
                                            usePointStyle: true,
                                        }
                                    },
                                    tooltips: {
                                        callbacks: {
                                            title: function (tooltipItem, data) {
                                                return data['labels'][tooltipItem[0]['index']];
                                            },
                                            label: function (tooltipItem, data) {
                                                if (data['datasets'][0]['data'][tooltipItem['index']] > 1) {
                                                    return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " {{$fullChartData['plural']}}";
                                                } else {
                                                    return ' ' + data['datasets'][0]['data'][tooltipItem['index']] + " {{$fullChartData['single']}}";
                                                }
                                            },
                                        },
                                    }
                                    @endif
                                },
                            });
                        </script>
                    @endpush
                @endif
            </div>
        @elseif($bottom->content_type == 'Custom HTML')
            <div class="{{$bottom->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ $bottom->title }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <iframe id="dynamicHtmlBottomFrame" src="{!! $bottom->data_source !!}" frameborder="0" style="height:200px;width: 100%;" data-src="{!! $bottom->data_source !!}" data-title="{!! $bottom->title !!}" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        @elseif($bottom->content_type == 'Integration')
            <div class="{{$bottom->returnClass()}} col-auto">
                @php
                    $Integrations = $bottom->getResult();
                @endphp
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $bottom->title }}<span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($Integrations['details']) }} {{ (count($Integrations['details']) == 0 || count($Integrations['details']) > 1) ? $bottom->plural_item : $bottom->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @if ($Integrations['is_success'] == true)
                            @forelse($Integrations['details'] as $key => $integration_val)
                                @if ($bottom->max_item >= $loop->iteration)

                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="fas fa-file" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">

                                                    @if (env('CARD_FIELDS_STACK') >= 1)
                                                        @if (isset($integration_val[$Integrations['titles'][0]]) && !empty($integration_val[$Integrations['titles'][0]]))
                                                            @if ($Integrations['details_type'] == 1)
                                                                @php
                                                                    $basic_details_keys = array_intersect(array_keys($integration_val), $Integrations['basic_details']);
                                                                    foreach($basic_details_keys as $k1 => $v1){
                                                                        $basic_details_array[$v1] = $integration_val[$v1];
                                                                    }
                                                                @endphp
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)"
                                                                       class="open-basic-details"
                                                                       data-details="{{json_encode($basic_details_array)}}"
                                                                       data-url="{{ route('integration.basic.detail',tenant('tenant_id')) }}"
                                                                       data-size="md"
                                                                       data-title="{{__('Basic Details')}}">{{Utility::isDate($integration_val[$Integrations['titles'][0]]) }}</a>
                                                                </h6>
                                                            @elseif($Integrations['details_type'] == 2)
                                                                <h6 class="text-sm mb-0">
                                                                    <a href="javascript:void(0)" class="open_doc"
                                                                       data-id="get-integration-details{{$key}}">{{Utility::isDate($integration_val[$Integrations['titles'][0]]) }}</a>
                                                                </h6>
                                                                {!! Form::open(['method' => 'POST', 'route' => ['integration.detail',[tenant('tenant_id'), "rest" => $Integrations['id']]],'id'=>'get-integration-details'.$key]) !!}
                                                                {{ Form::hidden('url',\Crypt::encrypt($integration_val['url']), ['class' => 'form-control']) }}
                                                                {!! Form::close() !!}
                                                            @else
                                                                <h6 class="text-sm mb-0">{{ Utility::isDate($integration_val[$Integrations['titles'][0]]) }}</h6>
                                                            @endif
                                                        @endif
                                                    @endif
                                                    @if (count($Integrations['titles']) >= 3)
                                                        @if (env('CARD_FIELDS_STACK') >= 2)
                                                            @if (isset($integration_val[$Integrations['titles'][1]]) && !empty($integration_val[$Integrations['titles'][1]]))
                                                                <p class="card-text small text-muted mb-0">{{(!empty($integration_val[$Integrations['titles'][1]]) ? Utility::isDate($integration_val[$Integrations['titles'][1]]) : '')}}</p>
                                                            @endif

                                                        @endif
                                                        @if (env('CARD_FIELDS_STACK') >= 3)
                                                            @if (isset($integration_val[$Integrations['titles'][2]]) && !empty($integration_val[$Integrations['titles'][2]]))
                                                                <span
                                                                    class="card-text text-xs">{{ Utility::isDate($integration_val[$Integrations['titles'][2]]) }}</span>
                                                            @endif
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @break;
                                @endif
                            @empty
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    {{__('No Available ') . $bottom->plural_item}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        @else
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving').' '.$bottom->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer py-2 row">

                        <div class="col {{(!empty($bottom->eform_url)) ? 'text-right' : 'text-center'}}">
                            <a href="{{ route('integration.list',[tenant('tenant_id'),$Integrations['name'],$Integrations['id']]) }}"
                               class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($bottom->content_type == 'Court Case')
            @php
                $case_views = $bottom->getResult();
            @endphp
            <div class="{{$bottom->returnClass()}} col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="h5 mb-0">{{ $bottom->title }}<span
                                        class="badge badge-success badge-xs"></span></h5>
                                <span
                                    class="d-block text-sm font-italic">{{ count($case_views['details']) }} {{ (count($case_views['details']) == 0 || count($case_views['details']) > 1) ? $bottom->plural_item : $bottom->single_item }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        @if ($case_views['is_success'] == true)
                            @forelse($case_views['details'] as $case)
                                @if ($bottom->max_item >= $loop->iteration)
                                    @php
                                        $url = route('courtcase.detail',[tenant('tenant_id'),$bottom->data_source,$case['ActiveBatchID'] ?? ""]);
                                    @endphp
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><i class="fas fa-tasks" aria-hidden="true"></i>
                                                </div>
                                                <div class="col ml-n2">
                                                    @if (env('CARD_FIELDS_STACK') >= 1)
                                                        <h6 class="text-sm mb-0">
                                                            <a href="{{$url}}">{{(!empty($case[$case_views['titles'][2]]) ? Utility::isDate($case[$case_views['titles'][2]]) : '')}}</a>
                                                        </h6>
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 2)
                                                        @if (isset($case[$case_views['titles'][3]]) && !empty($case[$case_views['titles'][3]]))
                                                            <p class="card-text small text-muted mb-0">{{ Utility::isDate($case[$case_views['titles'][3]]) }}</p>
                                                        @endif
                                                    @endif
                                                    @if (env('CARD_FIELDS_STACK') >= 3)
                                                        @if (isset($case[$case_views['titles'][4]]) && !empty($case[$case_views['titles'][4]]))
                                                            <span
                                                                class="card-text text-xs">{{ Utility::isDate($case[$case_views['titles'][4]]) }}</span>
                                                        @endif
                                                    @endif
                                                </div>
                                                @if (in_array('Status',$case_views['titles']) == true)
                                                    <div class="col-12 text-right">
                                                        <span
                                                            class="badge badge-xs text-white {{(!in_array($case['Status'],array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                                            @if (in_array($case['Status'],array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$case['Status'])}}"@endif>{{ $case['Status'] }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @break;
                                @endif
                            @empty
                                <div class="card mb-3 border shadow-none">
                                    <div class="px-3 py-3">
                                        <div class="row align-items-center">
                                            <div class="col ml-n2">
                                                <h6 class="text-sm mb-0 text-center">
                                                    {{__('No Available ') . $bottom->plural_item}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        @else
                            <div class="card mb-3 border shadow-none">
                                <div class="px-3 py-3">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <h6 class="text-sm mb-0 text-center">
                                                {{__('An error occurred retrieving').' '.$bottom->plural_item.'. '.__('Please contact your system administrator for assistance.')}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer py-2 text-center">
                        <a href="{{ route('courtcase.list',[tenant('tenant_id'),$bottom->data_source,$bottom->id]) }}"
                           class="text-sm text-primary font-weight-bold">{{__('See all..')}}</a>
                    </div>
                </div>
            </div>
        @elseif($bottom->content_type == 'Custom Page')
            @php
                $custom_page = $bottom->getResult();
                $style = "";
                if($bottom->max_item > 0) $style = "max-height: ".(100*$bottom->max_item)."px; overflow: auto;"
            @endphp
            <div class="{{$bottom->returnClass()}} col-auto">
                <div class="card">
                    @if (!is_null($custom_page))
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="h5 mb-0">{{ $custom_page->title }}<span
                                                class="badge badge-success badge-xs"></span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="{{ $style }}">
                            {!! $custom_page->detail !!}
                        </div>
                    @endif
                </div>
            </div>
        @elseif($bottom->content_type == 'News Feed')
            @php
                $postList = $bottom->getResult();
                $dateformat = Utility::getValByName('date_format');
            @endphp

            <div class="{{$bottom->returnClass()}} col-auto">
                <div class="card overflow-auto h-580">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="h5 mb-0">{{ $bottom->title }}</h5>
                                    <span class="d-block text-sm font-italic">{{ count($bottom->getResult()) }} {{ (count($bottom->getResult()) == 0 || count($bottom->getResult()) > 1) ? $bottom->plural_item : $bottom->single_item }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-wrapper overflow-auto h-580">
                            @foreach($postList as $key => $post)
                                <div class="card-body border-bottom">
                                    @php
                                        if ($post->image) {
                                            if($post->image_placement == "center"){
                                                $imageClass = "12";
                                                $contentClass = "12";
                                                $textAlign = 'text-right';
                                            }elseif($post->image_placement == "right"){
                                                $imageClass = "4 order-lg-2";
                                                $contentClass = "8 order-lg-1";
                                                $textAlign = '';
                                            }else{
                                                $imageClass = "4";
                                                $contentClass = "8";
                                                $textAlign = '';
                                            }
                                        } else {
                                            $contentClass = "12";
                                            $textAlign = '';
                                        }
                                    @endphp
                                    <div class="row">
                                        @if($post->image)
                                            <div class="col-{{$imageClass}}">
                                                <div class="">
                                                    <div class=" overflow-hidden {{$post->image_placement == 'center' ? 'h-200' : 'max-h-200'}}">
                                                        <a href="{{ route('newsfeed.show',[tenant('tenant_id'),$post->id]) }}" class="d-block animate-this">
                                                            <img alt="Image placeholder" src="{{asset(Storage::url($post->image))}}" class="post_image">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-{{$contentClass}}">
                                            <div class="row">
                                                <div class="col-12 {{$textAlign}} {{$post->image_placement == 'center' ? 'mt-4' : ''}}">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <div class="overflow-hidden">
                                                            <h5 class="h5 mb-0 overflow-hidden text-truncate"><a href="{{ route('newsfeed.show',[tenant('tenant_id'),$post->id]) }}" class="post_title">{!! $post->title !!}</a></h5>
                                                        </div>
                                                    </div>
                                                    <span class="post_subtitle">{{$post->user->name}} - {{Utility::getDateFormatted($post->created_at,false,$dateformat)}}</span>
                                                </div>

                                                <div class="shortened_txt col-12 card-text mt-2 mb-2 text-muted post_body {{$post->excerpt_length > 0 ? 'overflow-hidden' : 'overflow-auto'}}" id="shortened_txt_{{$post->id}}" >
                                                    {!! $post->detail !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 text-right {{$post->image_placement == 'right' ? 'order-lg-3' : ''}}">
                                            <a href="{{ route('newsfeed.show',[tenant('tenant_id'),$post->id]) }}">
                                                <span class="text-primary">{{__('Read more...')}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="card-footer py-2 text-center">
                            <a href="{{ route('newsfeed.list',[tenant('tenant_id')]) }}">
                                <span class="text-primary">{{__('See all...')}}</span>
                            </a>
                        </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
{{--End Bottom Layout--}}

@push('script')
    <script src="{{asset('assets/libs/truncate-fit-container-height/lc_text_shortener.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

        //console.log("usr", @json($usrData));

        //custom HTML for top
        if(document.getElementById('dynamicHtmlTopFrame')) {
            PassFormInfo('dynamicHtmlTopFrame');
        };

        //custom HTML for middle
        if(document.getElementById('dynamicHtmlMiddleFrame')){
            PassFormInfo('dynamicHtmlMiddleFrame');
        };

         //custom HTML for bottom
        if(document.getElementById('dynamicHtmlBottomFrame')){
            PassFormInfo('dynamicHtmlBottomFrame');
        };

        function PassFormInfo(id) {
            // The format of this message is required. Do not modify.
            let frame = document.getElementById(id);
            let title = $('#'+id).data('title');
            var message = {
                action: "[init-external-page]",
                info: {
                    userName: '{!! $usrData->Username !!}',
                    fullName: '{!! $usrData->FullName !!}',
                    emailAddress: '{!! $usrData->EmailAddress !!}',
                    tenantId: '{!! $usrData->TenantId !!}',
                    userId: '{!! $usrData->UserID !!}',
                    securityToken: '{!! $usrData->SecurityToken !!}',
                    title : title
                }
            };

            // Post the message to all Custom HTML iframes on the page
			var elms = document.querySelectorAll("[id='" + id + "']");
			for(var i = 0; i < elms.length; i++) {
                elms[i].contentWindow.postMessage(message, '*');
            }
        }


        $('.open_doc').on('click', function () {
            var form_id = $(this).data('id');
            $(`#${form_id}`).trigger("submit");
        });

        $(document).on('click', '.calendar_notif', function (e) {
            var url = $(this).attr('href');
            e.preventDefault();
            var title = $(this).attr('data-title');

            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-md');
                $("#commonModal").modal('show');
                $.get(url, {}, function (data) {
                    $('#commonModal .modal-body').html(data);
                });
                return false;
            }else{
                console.log("url is incorrect")
            }
        });

        @if(!empty($postList) && count($postList))
            $(document).ready(function(e) {
                @foreach($postList as $key => $post)
                    @if($post->excerpt_length > 0)
                        $(`#shortened_txt_{{$post->id}}`).lc_txt_shortener('...', {{$post->excerpt_length}}, '');
                        var text = $(`#shortened_txt_{{$post->id}}`).find('.lcts_end_txt').closest("p").text();
                        var replace = new RegExp('...' + '$');
                var str = text.replace(replace, '');
                        str = str.trimEnd();
                        $(`#shortened_txt_{{$post->id}}`).find('.lcts_end_txt').closest("p").html(str+'...');
                    @endif
                @endforeach
            });

        @endif
    </script>

@endpush
