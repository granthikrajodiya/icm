<div id='loader' class="min-h-500 d-none">
    <img src="{{asset('assets/img/loading.gif')}}" height="50px" width="50px" class="loading" alt="">
</div>
@php
$folderName = Crypt::decryptString($encodeFolderName);
@endphp

@if ($isSuccess == true)
    <div class="table-responsive">
        <table class="table align-items-center dataTable">
            <thead>
            <tr>
                @foreach($titles as $title)
                    <th class="pointer text-dark" id="{{ Str::replace(' ','_',$title) }}">{{ $title }}</th>
                @endforeach
                <th data-orderable="false"></th>
            </tr>
            </thead>
            <tbody id="tbl_record">
            @php
                $indexWithBoolean = [];
                $nonBoolean = [];

                // this will determine the boolean column
                foreach ($folderDetail as $list) {
                    foreach ($list as $index => $item) {
                        if ((is_bool($item) === true || $item == 0 || $item == 1) ){
                            $indexWithBoolean[$index] = $item;
                        }else if (isset($indexWithBoolean[$index])){
                            $nonBoolean[$index] = $index;
                        }else{
                            $nonBoolean[$index] = $index;
                        }
                    }
                }
                foreach ($nonBoolean as $index => $item) {
                    if (isset($indexWithBoolean[$index])){
                        unset($indexWithBoolean[$index]);
                    }
                }
            @endphp


                @foreach ($folderDetail as $list)
                    @if (isset($list['ICS_AppName']) && isset($list['ICS_DocumentID']))
                        <tr>
                            @php
                                $appName = $list['ICS_AppName'];
                                $docId = $list['ICS_DocumentID'];
                                $checkFileExt = (array_key_exists('ICS_FileExt', $list) ? $list['ICS_FileExt'] : NULL);
                                $extension = "";
                                if (isset($checkFileExt)) {
                                    $fileExt = str_replace(".", "", $list['ICS_FileExt']);
                                    $extension = getFileIconName(strtolower($fileExt));
                                }
                                unset($list['Ident'], $list['ICS_DocumentID'], $list['ICS_AppName'], $list['ICS_FileExt']);
                                $newName = $encodeFolderName.'~'.array_values($list)[0];
                                $url = route('folder.detail',[tenant('tenant_id'),$newName,$appName,$docId]);
                                $shareUrl = route('share.create',[tenant('tenant_id'),Crypt::encryptString($appName),$docId,'document']);
                            @endphp
                            @foreach ($list as $k => $v)
                                @if ($loop->first)
                                    <td scope="row">
                                        <div class="media align-items-center">
                                            <div>
                                                <a href="{{$url}}">
                                                    @if (isset($checkFileExt))
                                                        <i>
                                                            <img src="{{ asset('assets/img/icons/files/' . $extension) }}"
                                                                width="32"
                                                                height="32"
                                                                style="max-width: none !important;"
                                                            />
                                                        </i>
                                                    @else
                                                        <i class="fas fa-file fa-2x"></i>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="media-body ml-4">
                                                @if (isset($indexWithBoolean[$k]))
                                                    <a href="{{$url}}" class="name mb-0 h6 text-sm">{{ ($v)? 'Yes' : 'No' }}</a>
                                                @elseif (in_array(strtolower($k), $currColNames) == true)
                                                    <a href="{{$url}}" class="name mb-0 h6 text-sm" data-order="{{ Utility::isDateSortFormat($v) }}">
                                                        @if (is_numeric($v))
                                                            {{ $currSign . number_format($v, 2)}}
                                                        @else
                                                            {{ Utility::isDateSortFormat($v) }}
                                                        @endif
                                                    </a>
                                                @else
                                                    <a href="{{$url}}" class="name mb-0 h6 text-sm" data-order="{{ Utility::isDateSortFormat($v) }}">
                                                        {{ Utility::isDate($v) }}
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    </td>
                                @else
                                    @if (isset($indexWithBoolean[$k]))
                                        @if ($v)
                                            <td> Yes </td>
                                        @else
                                            <td> No </td>
                                        @endif
                                    @elseif (in_array(strtolower($k), $currColNames) == true)
                                        <td data-order="{{ Utility::isDateSortFormat($v) }}">
                                            @if (is_numeric($v))
                                                {{ $currSign . number_format($v, 2)}}
                                            @else
                                                {{ Utility::isDateSortFormat($v) }}
                                            @endif
                                        </td>
                                    @else
                                        <td data-order="{{ Utility::isDateSortFormat($v) }}">
                                            @if ($k == 'Status')
                                                <div class="col-12 text-center">
                                                    <span
                                                        class="badge badge-s text-white {{(!in_array($v,array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                                        @if (in_array($v,array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$v)}}"@endif>
                                                        {{ $v }}
                                                    </span>
                                                </div>
                                            @elseif ($k == "Progress")
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $progressValue = $v == NULL ? "0" : $v;
                                                        $progressColor = "";

                                                        if ($v < 25) {
                                                            $progressColor = env('PROGRESSBAR_COLOR_25');
                                                        } else if ($v < 50) {
                                                            $progressColor = env('PROGRESSBAR_COLOR_50');
                                                        } else if ($v < 75) {
                                                            $progressColor = env('PROGRESSBAR_COLOR_75');
                                                        } else {
                                                            $progressColor = env('PROGRESSBAR_COLOR_100');
                                                        }
                                                    @endphp
                                                    <span class="completion mr-2">{{ $progressValue }}%</span>

                                                    <div>
                                                        <div class="progress" style="width: 100px;">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $v }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $v }}%; background-color: {{ $progressColor }};"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                    {{ Utility::isDate($v) }}
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
                                        <a href="{{$url}}" class="dropdown-item">{{__('Open')}}</a>
                                        <a href="#" class="dropdown-item" data-url="{{$shareUrl}}"
                                           data-ajax-popup="true"
                                           data-title="{{__('Share Document')}}">{{__('Share')}}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @else
                        <tr>
                            @php
                                unset($list['Ident'], $list['ICS_DocumentID'], $list['ICS_AppName']);
                            @endphp
                            @foreach ($list as $k => $v)
                                @if ($loop->first)
                                    <td scope="row">
                                        <div class="media align-items-center">
                                            <div>
                                                <a class="text-primary"><i class="fas fa-file fa-2x"></i></a>
                                            </div>
                                            <div class="media-body ml-4">
                                                @if (isset($indexWithBoolean[$k]))
                                                    <a class="name mb-0 h6 text-sm">{{ ($v)? 'Yes' : 'No' }}</a>
                                                @elseif (in_array(strtolower($k), $currColNames) == true)
                                                    <a class="name mb-0 h6 text-sm" data-order="{{ Utility::isDateSortFormat($v) }}">
                                                        @if (is_numeric($v))
                                                            {{ $currSign . number_format($v, 2)}}
                                                        @else
                                                            {{ Utility::isDateSortFormat($v) }}
                                                        @endif
                                                    </a>
                                                @else
                                                    <a class="name mb-0 h6 text-sm" data-order="{{ Utility::isDateSortFormat($v) }}">
                                                        {{ Utility::isDate($v) }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                @else
                                    @if (isset($indexWithBoolean[$k]))
                                        @if ($v)
                                            <td> Yes </td>
                                        @else
                                            <td> No </td>
                                        @endif
                                    @elseif (in_array(strtolower($k), $currColNames) == true)
                                        <td data-order="{{ Utility::isDateSortFormat($v) }}">
                                            @if (is_numeric($v))
                                                {{ $currSign . number_format($v, 2)}}
                                            @else
                                                {{ Utility::isDateSortFormat($v) }}
                                            @endif

                                        </td>
                                    @else
                                        <td data-order="{{ Utility::isDateSortFormat($v) }}">
                                            {{ Utility::isDate($v) }}
                                        </td>
                                    @endif
                                @endif
                            @endforeach
                            <td></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <li class="media py-5">
        <div class="media-body">
            <h6 class="text-center">
			{{__('An error occurred retrieving').' '.$folderName . __(' contents. Please contact your system administrator and reference error: ') . $error_message}}
			</h6>
        </div>
    </li>
@endif
