<div id='loader' class="min-h-500 d-none">
    <img src="{{ asset('assets/img/loading.gif') }}" height="50px" width="50px" class="loading" alt="">
</div>

@if ($isSuccess == true)
    <div class="table-responsive">
        <table class="table align-items-center dataTable">
            <thead>
                <tr>
                    @foreach ($titles as $title)
                        <th class="pointer text-dark" id="{{ Str::replace(' ', '_', $title) }}">{{ $title }}</th>
                    @endforeach
                    <th data-orderable="false"></th>
                </tr>
            </thead>
            <tbody id="tbl_record">
                @php
                    $taskName = Crypt::decryptString($encodeTaskName);
                    $indexWithBoolean = [];
                    $nonBoolean = [];

                    // this will determine the boolean column
                    foreach ($taskDetail as $list) {
                        foreach ($list as $index => $item) {
                            if (is_bool($list[$title]) === true || $item == 0 || $item == 1) {
                                $indexWithBoolean[$index] = $item;
                            } elseif (isset($indexWithBoolean[$index])) {
                                $nonBoolean[$index] = $index;
                            } else {
                                $nonBoolean[$index] = $index;
                            }
                        }
                    }
                    foreach ($nonBoolean as $index => $item) {
                        if (isset($indexWithBoolean[$index])) {
                            unset($indexWithBoolean[$index]);
                        }
                    }
                @endphp

                @foreach ($taskDetail as $list)
                    <tr>
                        @php
                            if (isset($list['ICM_EFORM']) && $list['ICM_EFORM'] == 1) {
                                $url = route('tasks.eform.detail', [tenant('tenant_id'), $encodeTaskName, Utility::base64url_encode(array_values($list)[2]), $list['ActiveBatchID']]);
                            } else {
                                $url = route('tasks.detail', [tenant('tenant_id'), $encodeTaskName, Utility::base64url_encode(array_values($list)[2]), $list['ActiveBatchID']]);
                            }
                            $shareUrl = route('share.create', [tenant('tenant_id'), Crypt::encryptString(array_values($list)[2]), $list['ActiveBatchID'], 'batch']);
                        @endphp
                        @foreach ($titles as $k => $title)
                            @if ($loop->first)
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div>
                                            <a href="{{ $url }}"><i class="fas fa-tasks fa-2x"></i></a>
                                        </div>
                                        <div class="media-body ml-4">
                                            @if (isset($indexWithBoolean[$title]))
                                                <a href="{{ $url }}"
                                                    class="name mb-0 h6 text-sm">{{ $list[$title] ? 'Yes' : 'No' }}</a>
                                            @elseif (in_array(strtolower($title), $currColNames) == true)
                                                <a href="{{ $url }}" class="name mb-0 h6 text-sm"
                                                    data-order="{{ Utility::isDateSortFormat($list[$title]) }}">
                                                    @if (is_numeric($list[$title]))
                                                        {{ $currSign . number_format($list[$title], 2) }}
                                                    @else
                                                        {{ Utility::isDateSortFormat($list[$title]) }}
                                                    @endif

                                                </a>
                                            @else
                                                <a href="{{ $url }}" class="name mb-0 h6 text-sm"
                                                    data-order="{{ Utility::isDateSortFormat($list[$title]) }}">
                                                    {{ Utility::isDate($list[$title]) }}
                                                </a>
                                            @endif
                                            {{-- <a href="{{ $url }}"
                                                class="name mb-0 h6 text-sm">{{ Utility::isDate($list[$title]) }}</a> --}}
                                        </div>
                                    </div>
                                </td>
                            @else
                                @if (isset($indexWithBoolean[$title]))
                                    @if ($list[$title])
                                        <td> Yes </td>
                                    @else
                                        <td> No </td>
                                    @endif
                                @elseif (in_array(strtolower($title), $currColNames) == true)
                                    <td data-order="{{ Utility::isDateSortFormat($list[$title]) }}">
                                        @if (is_numeric($list[$title]))
                                            {{ $currSign . number_format($list[$title], 2) }}
                                        @else
                                            {{ Utility::isDateSortFormat($list[$title]) }}
                                        @endif
                                    </td>
                                @else
                                    <td data-order="{{ Utility::isDateSortFormat($list[$title]) }}">
                                        @if ($title == 'Status')
                                            <div class="col-12 text-center">
                                                <span
                                                    class="badge badge-s text-white {{ !in_array($list[$title], array_keys(config('statuscolor'))) ? 'badge-primary' : '' }}"
                                                    @if (in_array($list[$title], array_keys(config('statuscolor')))) style="background-color: {{ config('statuscolor.' . $list[$title]) }}" @endif>{{ $list[$title] }}</span>
                                            </div>
                                        @elseif ($title == 'Progress')
                                            <div class="d-flex align-items-center">
                                                <span class="completion mr-2">{{ $list[$title] }}%</span>
                                                @php
                                                    $progressColor = '';

                                                    if ($list[$title] < 25) {
                                                        $progressColor = env('PROGRESSBAR_COLOR_25');
                                                    } elseif ($list[$title] < 50) {
                                                        $progressColor = env('PROGRESSBAR_COLOR_50');
                                                    } elseif ($list[$title] < 75) {
                                                        $progressColor = env('PROGRESSBAR_COLOR_75');
                                                    } else {
                                                        $progressColor = env('PROGRESSBAR_COLOR_100');
                                                    }
                                                @endphp
                                                <div>
                                                    <div class="progress" style="width: 100px;">
                                                        <div class="progress-bar" role="progressbar"
                                                            aria-valuenow="{{ $list[$title] }}" aria-valuemin="0"
                                                            aria-valuemax="100"
                                                            style="width: {{ $list[$title] }}%; background-color: {{ $progressColor }};">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {{ Utility::isDate($list[$title]) }}
                                        @endif
                                    </td>
                                @endif
                            @endif
                        @endforeach

                        <td class="text-right">
                            <div class="dropdown">
                                <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ $url }}" class="dropdown-item">{{ __('Open') }}</a>
                                    <a href="#" class="dropdown-item" data-url="{{ $shareUrl }}"
                                        data-ajax-popup="true"
                                        data-title="{{ __('Share work item') }}">{{ __('Share') }}</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <li class="media py-5">
        <div class="media-body">
            <h6 class="text-center">
                {{ __('An error occurred retrieving') . ' ' . $taskName . '. ' . __('Please contact your system administrator for assistance.') }}
            </h6>
        </div>
    </li>
@endif
