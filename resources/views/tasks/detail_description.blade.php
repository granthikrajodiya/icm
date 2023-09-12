@php
$taskName = Crypt::decryptString($encodeTaskName);
@endphp
<x-layouts.app title="{{ $taskName . ' - ' . $response->Data->BatchProfileName . ' - ' . $response->Data->BatchName }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-10 overflow-hidden text-truncate">
                            <h6 class="d-inline-block mb-0"><i class="fa fa-tasks"></i> <a
                                    href="{{ route('tasks.view', [tenant('tenant_id'), $encodeTaskName]) }}">{{ $taskName }}</a>
                            </h6> - <span class="text-muted">{{ $response->Data->BatchProfileName }}</span> - <span
                                class="text-muted">{{ $response->Data->BatchName }}</span>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('tasks.view', [tenant('tenant_id'), $encodeTaskName]) }}" >
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="card py-2 text-sm">
                                <div class="row">
                                    <div class="col-11">
                                        <ul class="nav nav-pills p-1">
                                            @foreach ($arrHeader as $headKey => $headVal)
                                                @if ($loop->iteration <= 5)
                                                    <li class="nav-item px-3">
                                                        <span class="font-weight-700">{{ $headKey }}</span><br>
                                                        <span>{{ !empty($headVal) ? $headVal : '-' }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-1 text-center">
                                        <div class="dropdown mt-2">
                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-toggle="modal"
                                                    data-target="#nonsystemkeyword">{{ __('Details') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            @if (array_key_exists("Status",$arrHeader) && $arrHeader['Status'] != NULL)
                                <span
                                    class="badge badge-md text-white text-center {{(!in_array($arrHeader["Status"],array_keys(config('statuscolor')))) ? 'badge-primary' : '' }}"
                                    @if (in_array($arrHeader["Status"],array_keys(config('statuscolor')))) style="background-color: {{config('statuscolor.'.$arrHeader["Status"])}}"@endif>
                                    {{ $arrHeader["Status"] }}
                                </span>
                            @endif
                            @if (array_key_exists("Progress",$arrHeader))
                                <span>
                                    <div class="d-flex align-items-center">
                                        <span class="completion mr-2">{{ $arrHeader['Progress'] }}%</span>
                                        @php
                                            $progressColor = "";

                                            if ($arrHeader['Progress'] < 25) {
                                                $progressColor = env('PROGRESSBAR_COLOR_25');
                                            } else if ($arrHeader['Progress'] < 50) {
                                                $progressColor = env('PROGRESSBAR_COLOR_50');
                                            } else if ($arrHeader['Progress'] < 75) {
                                                $progressColor = env('PROGRESSBAR_COLOR_75');
                                            } else {
                                                $progressColor = env('PROGRESSBAR_COLOR_100');
                                            }
                                        @endphp
                                        <div>
                                            <div class="progress" style="width: 100px;">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $arrHeader['Progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $arrHeader['Progress'] }}%; background-color: {{ $progressColor }};"></div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <ul class="nav nav-tabs nav-overflow" role="tablist" id="task-detail-tabs">
                            <li class="nav-item">
                                <a href="#document" id="document-tab" class="nav-link active" data-toggle="tab"
                                    role="tab" aria-selected="true">{{ __('Documents') }}</a>
                            </li>
                            @if (env('BATCH_SUBTASKS_SHOW') == true)
                                <li class="nav-item">
                                    <a href="#subtask" id="subtask-tab" class="nav-link" data-toggle="tab"
                                        role="tab">{{ __('Subtask') }}</a>
                                </li>
                            @endif
                            @if (env('BATCH_DISCUSSION_SHOW') == true)
                                <li class="nav-item">
                                    <a href="#discussion" id="discussion-tab" class="nav-link" data-toggle="tab"
                                        role="tab">{{ __('Discussion') }}</a>
                                </li>
                            @endif
                            @if (env('BATCH_NOTES_SHOW') == true)
                                <li class="nav-item">
                                    <a href="#notes" id="notes-tab" class="nav-link" data-toggle="tab"
                                        role="tab">{{ __('Notes') }}</a>
                                </li>
                            @endif
                            @if (env('BATCH_CALLS_SHOW') == true)
                                <li class="nav-item">
                                    <a href="#calls" id="calls-tab" class="nav-link" data-toggle="tab"
                                        role="tab">{{ __('Calls') }}</a>
                                </li>
                            @endif
                            @if (env('BATCH_EMAILS_SHOW') == true)
                                <li class="nav-item">
                                    <a href="#emails" id="emails-tab" class="nav-link" data-toggle="tab"
                                        role="tab">{{ __('Emails') }}</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content pt-3 min-h-430">
                            {{-- Documents --}}
                            <div class="tab-pane fade active show" id="document" role="tabpanel"
                                aria-labelledby="document-tab">
                                <div style="display: none" id="docDetail"></div>
                                <div id="doc_response">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3 col-lg-3">
                                            <select name="docType" id="docType" class="form-control text-sm">
                                                @foreach ($otherData['docList'] as $docName)
                                                    <option value="{!! $docName !!}">{!! $docName !!}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-12 col-md-9 col-lg-9">
                                            <div class="actions-search" id="actions-search">
                                                <div class="input-group input-group-merge input-group-flush">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-transparent"><i
                                                                class="fas fa-search"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control form-control-flush"
                                                        id="doc_search" placeholder="{{ __('Type keyword..') }}">
                                                    <div class="input-group-append">
                                                        <a href="#" class="input-group-text bg-transparent"
                                                            data-action="search-close" data-target="#actions-search"><i
                                                                class="fas fa-times"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col text-right">
                                                <div class="actions">
                                                    <a href="#" class="action-item mr-3" data-action="search-open"
                                                        data-target="#actions-search"><i class="fas fa-search"></i></a>
                                                    <div class="dropdown mr-3">
                                                        <a href="#" class="action-item" role="button"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fas fa-filter"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            x-placement="bottom-end"
                                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(22px, 25px, 0px);">
                                                            <a class="dropdown-item doc-order active"
                                                                data-value="newest" href="#">
                                                                <i
                                                                    class="fas fa-sort-amount-down"></i>{{ __('Newest') }}
                                                            </a>
                                                            <a class="dropdown-item doc-order" data-value="asc"
                                                                href="#">
                                                                <i
                                                                    class="fas fa-sort-alpha-down"></i>{{ __('From A-Z') }}
                                                            </a>
                                                            <a class="dropdown-item doc-order" data-value="desc"
                                                                href="#">
                                                                <i
                                                                    class="fas fa-sort-alpha-up"></i>{{ __('From Z-A') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <a href="#" class="action-item" role="button"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="#" class="dropdown-item" id="doc-view"
                                                                data-value="grid">{{ __('Grid View') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-2">
                                            <span class="d-block text-sm font-italic" id="total_docs"></span>
                                        </div>
                                    </div>
                                    <div class="pt-3 loader" id="doc-loader">
                                        <img src="{{ asset('assets/img/loading.gif') }}" height="50px" width="50px"
                                            class="loading" alt="Loading..">
                                    </div>
                                    <div class="row pt-3" id="docResponse" style="display: none"></div>
                                </div>
                            </div>
                            {{-- Subtask --}}
                            @if (env('BATCH_SUBTASKS_SHOW') == true)
                                <div class="tab-pane fade" id="subtask" role="tabpanel" aria-labelledby="subtask-tab">
                                    <div style="display: none" id="taskDetail"></div>
                                    <div id="task_response">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <select name="subTaskType" id="subTaskType"
                                                    class="form-control text-sm">
                                                    @foreach ($otherData['subTaskList'] as $subTask)
                                                        <option value="{!! $subTask !!}">{!! $subTask !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <div class="actions-search" id="task-search">
                                                    <div class="input-group input-group-merge input-group-flush">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-transparent"><i
                                                                    class="fas fa-search"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control form-control-flush"
                                                            id="subtask_search"
                                                            placeholder="{{ __('Type keyword..') }}">
                                                        <div class="input-group-append">
                                                            <a href="#" class="input-group-text bg-transparent"
                                                                data-action="search-close" data-target="#task-search"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col text-right">
                                                    <div class="actions">
                                                        <a href="#" class="action-item mr-3" data-action="search-open"
                                                            data-target="#task-search"><i
                                                                class="fas fa-search"></i></a>
                                                        <div class="dropdown mr-3">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-filter"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                x-placement="bottom-end"
                                                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(22px, 25px, 0px);">
                                                                <a class="dropdown-item subtask-order active"
                                                                    data-value="newest" href="#">
                                                                    <i
                                                                        class="fas fa-sort-amount-down"></i>{{ __('Newest') }}
                                                                </a>
                                                                <a class="dropdown-item subtask-order" data-value="asc"
                                                                    href="#">
                                                                    <i
                                                                        class="fas fa-sort-alpha-down"></i>{{ __('From A-Z') }}
                                                                </a>
                                                                <a class="dropdown-item subtask-order"
                                                                    data-value="desc" href="#">
                                                                    <i
                                                                        class="fas fa-sort-alpha-up"></i>{{ __('From Z-A') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item" id="subtask-view"
                                                                    data-value="grid">{{ __('Grid View') }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-2">
                                                <span class="d-block text-sm font-italic" id="total_subtask"></span>
                                            </div>
                                        </div>
                                        <div class="pt-3 loader" id="subtask-loader">
                                            <img src="{{ asset('assets/img/loading.gif') }}" height="50px" width="50px"
                                                class="loading" alt="Loading..">
                                        </div>
                                        <div class="row pt-3" id="subtaskResponse" style="display: none"></div>
                                    </div>
                                </div>
                            @endif
                            {{-- Discussion --}}
                            @if (env('BATCH_DISCUSSION_SHOW') == true)
                                <div class="tab-pane fade" id="discussion" role="tabpanel"
                                    aria-labelledby="discussion-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-right mb-2">
                                                <a href="#" class="btn btn-xs btn-primary btn-icon rounded-pill add"
                                                    data-url="{{ route('discussion.create', [ 'tenant' => tenant('tenant_id'), 'batchId' => $response->Data->BatchID]) }}"
                                                    data-ajax-popup="true" data-size="md"
                                                    data-title="{{ __('Add Discussion') }}">
                                                    <span class="btn-inner--text"><i class="fas fa-plus"></i>
                                                        {{ __('Add New') }}</span>
                                                </a>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    @forelse($otherData['discussion'] as $discussion)
                                                        <ul class="list-unstyled list-unstyled-border">
                                                            <li class="media">
                                                                <img alt="{{ $discussion->createdBy->name }}"
                                                                    class="mr-3 rounded-circle" width="50" height="50"
                                                                    {{ $discussion->createdBy->img_avatar }}>
                                                                <div class="media-body">
                                                                    <div class="mt-0 mb-1 font-weight-bold text-sm">
                                                                        {{ $discussion->createdBy->name }}
                                                                        {{-- <small>{{ $discussion->createdBy->createdByRole() }}</small> --}}
                                                                        <small
                                                                            class="float-right">{{ $discussion->created_at->diffForHumans() }}</small>
                                                                    </div>
                                                                    <div class="text-xs">
                                                                        {{ $discussion->comment }}</div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    @empty
                                                        <ul class="list-unstyled list-unstyled-border">
                                                            <li class="media">
                                                                <div class="media-body">
                                                                    <h6 class="text-center">
                                                                        {{ __('No data found.') }}</h6>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Notes --}}
                            @if (env('BATCH_NOTES_SHOW') == true)
                                <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <textarea class="notes_textarea form-control"
                                                rows="6">{{ !empty($otherData['notes']) ? $otherData['notes']->notes : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Calls --}}
                            @if (env('BATCH_CALLS_SHOW') == true)
                                <div class="tab-pane fade" id="calls" role="tabpanel" aria-labelledby="calls-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-right mb-2">
                                                <a href="#" class="btn btn-xs btn-primary btn-icon rounded-pill add"
                                                    data-url="
                                                        {{ route('calls.create', [ 'tenant' => tenant('tenant_id'), 'batchId' => $response->Data->BatchID]) }}
                                                        "
                                                    data-ajax-popup="true" data-size="lg"
                                                    data-title="{{ __('Add Call') }}">
                                                    <span class="btn-inner--text"><i class="fas fa-plus"></i>
                                                        {{ __('Add New') }}</span>
                                                </a>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table dataTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('Subject') }}</th>
                                                                    <th>{{ __('Call Date') }}</th>
                                                                    <th>{{ __('Duration') }}</th>
                                                                    <th>{{ __('Created By') }}</th>
                                                                    <th data-orderable="false"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($otherData['calls'] as $call)
                                                                    <tr>
                                                                        <td>{{ $call->subject }}</td>
                                                                        <td>{{ !empty($call->call_date) ? Utility::getDateFormatted($call->call_date) : '' }}
                                                                        </td>
                                                                        <td>{{ $call->duration }}</td>
                                                                        <td>{{ $call->createdBy->name }}</td>
                                                                        <td class="actions">
                                                                            <a href="#"
                                                                                data-url="{{ route('calls.edit', [tenant('tenant_id'), $call->id]) }}"
                                                                                data-size="lg" data-ajax-popup="true"
                                                                                data-title="{{ __('Edit Call') }}"
                                                                                class="action-item px-2"
                                                                                data-toggle="tooltip"
                                                                                data-original-title="{{ __('Edit') }}"><i
                                                                                    class="fas fa-edit"></i></a>
                                                                            <a href="#"
                                                                                class="action-item text-danger px-2"
                                                                                data-toggle="tooltip"
                                                                                data-original-title="{{ __('Delete') }}"
                                                                                data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                                                data-confirm-yes="document.getElementById('delete-call-form-{{ $call->id }}').submit();"><i
                                                                                    class="fas fa-trash-alt"></i></a>
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['calls.destroy', [tenant('tenant_id'), $call->id]], 'id' => 'delete-call-form-' . $call->id]) !!}
                                                                            {!! Form::close() !!}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Emails --}}
                            @if (env('BATCH_EMAILS_SHOW') == true)
                                <div class="tab-pane fade" id="emails" role="tabpanel" aria-labelledby="emails-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-right mb-2">
                                                <a href="#" class="btn btn-xs btn-primary btn-icon rounded-pill add"
                                                    data-url="{{ route('emails.create', [
                                                        'tenant' => tenant('tenant_id'),
                                                        'batchId' => $response->Data->BatchID
                                                    ]) }}"
                                                    data-ajax-popup="true" data-size="lg"
                                                    data-title="{{ __('Add Email') }}">
                                                    <span class="btn-inner--text"><i class="fas fa-plus"></i>
                                                        {{ __('Add New') }}</span>
                                                </a>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    @forelse($otherData['emails'] as $email)
                                                        <ul class="list-unstyled list-unstyled-border">
                                                            <li class="media">
                                                                <img alt="image" class="mr-3 rounded-circle" width="50"
                                                                    height="50"
                                                                    src="{{ asset('images/avatars/avatar.png') }}">
                                                                <div class="media-body">
                                                                    <div class="mt-0 mb-1 font-weight-bold text-sm">
                                                                        {{ $email->subject }}
                                                                        <small
                                                                            class="float-right">{{ $email->created_at->diffForHumans() }}</small>
                                                                    </div>
                                                                    <div class="text-xs">{{ $email->to }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    @empty
                                                        <ul class="list-unstyled list-unstyled-border">
                                                            <li class="media">
                                                                <div class="media-body">
                                                                    <h6 class="text-center">
                                                                        {{ __('No data found.') }}</h6>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="nonsystemkeyword" tabindex="-1" role="dialog"
        aria-labelledby="nonsystemkeywordLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Batch Detail') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mh-500" style="overflow-y: auto">
                        <table class="table">
                            <tbody>
                                @foreach ($arrNonSystemHeader as $nonKey => $nonVal)
                                    <tr>
                                        <td class="td-break" width="30%">{{ $nonKey }}</td>
                                        <td class="font-weight-700 td-break" width="70%">
                                            {{ !empty($nonVal) ? $nonVal : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/libs/summernote/summernote-bs4.css') }}">
    @endpush

    @push('theme-script')
        <script src="{{ asset('assets/libs/summernote/summernote-bs4.js') }}"></script>
    @endpush
    @push('script')
        <script>
            // For Sidebar Tabs
            $(document).ready(function() {
                var tab = 'document';
                @if ($tab = Session::get('task-tab-status'))
                    var tab = '{{ $tab }}';
                @endif
                setTimeout(function() {
                    $("#task-detail-tabs .nav-link[href='#" + tab + "']").trigger("click");
                }, 10);

                $('.notes_textarea').on('blur', function() {
                    $.ajax({
                        url: "{{ route('task.note.store', [tenant('tenant_id'), $response->Data->BatchID]) }}",
                        data: {
                            notes: $(this).val()
                        },
                        type: 'POST',
                        success: function(response, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (!response.is_success) {
                                show_toastr('Error', response.error, 'error');
                            }
                        },
                        error: function(response) {
                            response = response.responseJSON;
                            if (response.is_success) {
                                show_toastr('Error', response.error, 'error');
                            } else {
                                show_toastr('Error', response, 'error');
                            }
                        }
                    })
                })

                setTimeout(function() {
                    $('#docType').trigger('change');
                    $('#subTaskType').trigger('change');
                }, 500);
            });

            jQuery.extend(jQuery.fn.dataTableExt.oSort, {
                "date-uk-pre": function(a) {
                    var ukDatea = a.split('/');
                    return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
                },
                "date-uk-asc": function(a, b) {
                    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
                },
                "date-uk-desc": function(a, b) {
                    return ((a < b) ? 1 : ((a > b) ? -1 : 0));
                }
            });

            $(document).on('show.bs.modal', '#commonModal', function(e) {
                $('#batch_id').val('{{ $response->Data->BatchID }}');
            });

            // For Document
            $(document).on('change', '#docType', function() {
                var viewType = $('#doc-view').attr('data-value');
                viewType = (viewType == 'grid') ? 'list' : 'grid';

                var data = {
                    type: 'document',
                    docName: $(this).val(),
                    batchId: "{{ $response->Data->BatchID }}",
                    viewType: viewType,
                    orderBy: $('.doc-order.active').attr('data-value')
                };
                fetchData(data);
            });
            $(document).on('click', '#doc-view', function() {
                var data = {
                    type: 'document',
                    docName: $('#docType').val(),
                    batchId: "{{ $response->Data->BatchID }}",
                    viewType: $(this).attr('data-value'),
                    orderBy: $('.doc-order.active').attr('data-value')
                };
                fetchData(data);
            });
            $('#doc_search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                var viewType = $('#doc-view').attr('data-value');

                if (viewType == 'grid') {
                    $("#doc_tbl tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                } else {
                    $("#docResponse .grid_record").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                }
            });
            $('.doc-order').on('click', function() {
                var viewType = $('#doc-view').attr('data-value');
                viewType = (viewType == 'grid') ? 'list' : 'grid';

                var data = {
                    type: 'document',
                    docName: $('#docType').val(),
                    batchId: "{{ $response->Data->BatchID }}",
                    viewType: viewType,
                    orderBy: $(this).attr('data-value'),
                };

                fetchData(data);
            });
            $(document).on('click', '.doc_detail', function() {
                var data = {
                    docId: $(this).attr('data-docid'),
                    batchId: "{{ $response->Data->BatchID }}",
                    type: 'document',
                };
                fetchDetail(data);
            });
            $(document).on('click', '#closeDoc', function() {
                $('#docDetail').hide();
                $('#docResponse').show();
                $('#doc_response').show();
            });


            // For SubTask
            $(document).on('change', '#subTaskType', function() {
                var viewType = $('#subtask-view').attr('data-value');
                viewType = (viewType == 'grid') ? 'list' : 'grid';

                var data = {
                    type: 'subtask',
                    taskName: $(this).val(),
                    batchId: "{{ $response->Data->BatchID }}",
                    viewType: viewType,
                    orderBy: $('.subtask-order.active').attr('data-value')
                };
                fetchData(data);
            });
            $(document).on('click', '#subtask-view', function() {
                var data = {
                    type: 'subtask',
                    taskName: $('#subTaskType').val(),
                    batchId: "{{ $response->Data->BatchID }}",
                    viewType: $(this).attr('data-value'),
                    orderBy: $('.subtask-order.active').attr('data-value')
                };
                fetchData(data);
            });
            $('#subtask_search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                var viewType = $('#subtask-view').attr('data-value');
                if (viewType == 'grid') {
                    $("#task_tbl tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                } else {
                    $("#subtaskResponse .grid_record").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                }
            });
            $('.subtask-order').on('click', function() {
                var viewType = $('#subtask-view').attr('data-value');
                viewType = (viewType == 'grid') ? 'list' : 'grid';

                var data = {
                    type: 'subtask',
                    taskName: $('#subTaskType').val(),
                    batchId: "{{ $response->Data->BatchID }}",
                    viewType: viewType,
                    orderBy: $(this).attr('data-value'),
                };

                fetchData(data);
            });
            $(document).on('click', '.task_detail', function() {
                var data = {
                    batchName: $('#subTaskType').val(),
                    batchId: "{{ $response->Data->BatchID }}",
                    title: $(this).attr('data-title'),
                    link: $(this).attr('data-url'),
                    type: 'subtask',
                };
                fetchDetail(data);
            });
            $(document).on('click', '#closeTask', function() {
                $('#taskDetail').hide();
                $('#subtaskResponse').show();
                $('#task_response').show();
            });

            // Common function for fetch data
            function fetchData(data) {
                $.ajax({
                    url: "{{ route('task.fetchData', tenant('tenant_id')) }}",
                    method: 'POST',
                    data: data,
                    beforeSend: function() {
                        if (data.type == "document") {
                            $("#doc-loader").show();
                            $('#docResponse').hide();
                        } else if (data.type == 'subtask') {
                            $("#subtask-loader").show();
                            $('#subtaskResponse').hide();
                        }
                    },
                    success: function(response, status, xhr) {
                        if (!xhr.responseJSON) {
                            location.reload();
                            return false;
                        }
                        if (response.is_success == true) {
                            if (response.from == 'document') {


                                $('#total_docs').html(response.total_docs);
                                $('#docResponse').html(response.html);

                                // filter
                                if (data.viewType != '' && data.viewType != undefined) {
                                    if (data.viewType == 'grid') {
                                        $('#doc-view').attr('data-value', 'list');
                                        $('#doc-view').html('List View');
                                    } else {
                                        $('#doc-view').attr('data-value', 'grid');
                                        $('#doc-view').html('Grid View');
                                    }
                                }

                                if (data.orderBy != '' && data.orderBy != undefined) {
                                    $('.doc-order').removeClass('active');
                                    $('.doc-order').each(function(k, v) {
                                        if ($(this).attr('data-value') == data.orderBy) {
                                            $(this).addClass('active');
                                        }
                                    });
                                }
                            } else {
                                $('#total_subtask').html(response.total_subtask);
                                $('#subtaskResponse').html(response.html);

                                // filter
                                if (data.viewType != '' && data.viewType != undefined) {
                                    if (data.viewType == 'grid') {
                                        $('#subtask-view').attr('data-value', 'list');
                                        $('#subtask-view').html('List View');
                                    } else {
                                        $('#subtask-view').attr('data-value', 'grid');
                                        $('#subtask-view').html('Grid View');
                                    }
                                }

                                if (data.orderBy != '' && data.orderBy != undefined) {
                                    $('.subtask-order').removeClass('active');
                                    $('.subtask-order').each(function(k, v) {
                                        if ($(this).attr('data-value') == data.orderBy) {
                                            $(this).addClass('active');
                                        }
                                    });
                                }
                            }
                        } else {
                            $('#docResponse').html(
                                '<div class="col-12"><li class="media"><div class="media-body">' +
                                '                <h6 class="text-center">' + response.msg + '</h6>' +
                                '            </div></li></div>');
                        }
                    },
                    error: function(data) {
                        alert('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.');
                    },
                    complete: function() {
                        if (data.type == "document") {
                            $("#doc-loader").hide();
                            $('#docResponse').show();
                        } else if (data.type == 'subtask') {
                            $("#subtask-loader").hide();
                            $('#subtaskResponse').show();
                        }
                    }
                });
            }

            // Common function for fetch detail
            function fetchDetail(data) {
                $.ajax({
                    url: "{{ route('task.fetchDetail', tenant('tenant_id')) }}",
                    method: 'POST',
                    data: data,
                    beforeSend: function() {
                        if (data.type == "document") {
                            $("#doc-loader").show();
                            $('#docResponse').hide();
                        } else if (data.type == 'subtask') {
                            $("#subtask-loader").show();
                            $('#subtaskResponse').hide();
                        }
                    },
                    success: function(response, status, xhr) {
                        if (!xhr.responseJSON) {
                            location.reload();
                            return false;
                        }
                        if (response.is_success == true) {
                            if (response.from == 'document') {
                                $('#docDetail').html(response.html);
                                $('#doc_response').hide();
                                $('#docDetail').show();
                            } else if (response.from == 'subtask') {
                                $('#taskDetail').html(response.html);
                                $('#task_response').hide();
                                $('#taskDetail').show();
                            }
                        }
                    },
                    error: function(data) {
                        alert('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.');
                    },
                    complete: function() {
                        if (data.type == "document") {
                            $("#doc-loader").hide();
                            $('#doc_response').hide();
                            $('#docDetail').show();
                        } else if (data.type == 'subtask') {
                            $("#subtask-loader").hide();
                            $('#task_response').hide();
                            $('#taskDetail').show();
                        }
                    }
                });
            }
        </script>
    @endpush
</x-layouts.app>
