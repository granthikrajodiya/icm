<x-layouts.app
    title="{{ $taskName.'-'.Utility::getValByName('task_menu') }}"
>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <div class="row justify-content-between align-items-center">
                    <div class="col">
                        <h6 class="d-inline-block mb-0"><i class="fas fa-tasks"></i> <a href="{{ route('tasks.index',tenant('tenant_id')) }}"><span id="menu_title">{{ Utility::getValByName('task_menu') }}</span></a> @if(\Session::get('navigation_title') != $taskName): {{ $taskName }}@endif</h6>
                    </div>
                    @if(!empty($view_id) && $eform_url != '')
                        <div class="col text-right">
                            <a href="{{ route('eforms.view',[tenant('tenant_id'),$view_id]) }}" class="btn btn-primary btn-xs rounded-pill">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body pt-0">
                @if($isSuccess == true)
                    <div class="table-responsive">
                        <table class="table align-items-center dataTable">
                            <thead>
                            <tr>
                                @foreach($titles as $title)
                                    <th class="pointer text-dark" id="{{ str_replace(' ','_',$title) }}">{{ $title }}</th>
                                @endforeach
                                <th data-orderable="false"></th>
                            </tr>
                            </thead>
                            <tbody id="tbl_record">
                            @foreach($taskDetail as $list)
                                <tr>
                                    @php
                                        if(isset($list['ICM_EFORM']) && $list['ICM_EFORM'] == 1)
                                        {
                                            $url = route('tasks.eform.detail',[tenant('tenant_id'),$taskName, Utility::base64url_encode(array_values($list)[2]),$list['ActiveBatchID'] ?? ""]);
                                        }
                                        else
                                        {
                                            $url = route('courtcase.detail',[tenant('tenant_id'),$taskName,$list['ActiveBatchID'] ?? ""]);
                                        }
                                        $shareUrl = route('share.create',[tenant('tenant_id'),Crypt::encryptString(array_values($list)[2]),$list['ActiveBatchID'] ?? "",'batch']);
                                    @endphp
                                    @foreach($titles as $title)
                                        @if($loop->first)
                                            <td scope="row">
                                                <div class="media align-items-center">
                                                    <div>
                                                        <a href="{{$url}}"><i class="fas fa-tasks fa-2x"></i></a>
                                                    </div>
                                                    <div class="media-body ml-4">
                                                        <a href="{{$url}}" class="name mb-0 h6 text-sm">{{ Utility::isDate($list[$title]) }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                            <td>{{ Utility::isDate($list[$title]) }}</td>
                                        @endif
                                    @endforeach
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ $url }}" class="dropdown-item">{{ __('Open') }}</a>
                                                <a href="#" class="dropdown-item" data-url="{{ $shareUrl }}" data-ajax-popup="true" data-title="{{ __('Share work item') }}">
                                                    {{ __('Share') }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <li class="media py-4">
                        <div class="media-body">
                            <h6 class="text-center">
                                {{ __('An error occurred retrieving').' '.$taskName.'. '.__('Please contact your system administrator for assistance.') }}
                            </h6>
                        </div>
                    </li>
                @endif
            </div>
        </div>
    </div>
</div>
</x-layouts.app>
