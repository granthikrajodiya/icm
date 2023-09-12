<div class="row align-items-center">
    <div class="col">
        <div class="actions-search" id="history-search">
            <div class="input-group input-group-merge input-group-flush">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input type="text" class="form-control form-control-flush" id="history_keyword"
                       placeholder="{{ __('Type keyword..') }}">
                <div class="input-group-append">
                    <a href="#" class="input-group-text bg-transparent" data-action="search-close"
                       data-target="#history-search">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs nav-bordered mb-3">
            <x-tabs.menu id="user_notes" active>
                <span class="d-none d-lg-block">{{ __('User notes') }}</span>
            </x-tabs.menu>
            <x-tabs.menu id="workflow" active>
                <span class="d-none d-lg-block">{{ __('Workflow') }}</span>
            </x-tabs.menu>
            <li class="nav-item ml-auto my-auto">
                <div class="actions">
                    <a href="#" class="action-item" data-action="search-open" data-target="#history-search"><i
                            class="fas fa-search"></i></a>
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="tab-content">
            <div class="tab-pane active show" id="user_notes">
                <div class="table-responsive mh-500 min-h-430">
                    <table class="table historyTable" data-searching="false" data-info="false" data-paging="false">
                        <thead>
                            <tr>
                                <th class="font-weight-700">{{__('Date')}}</th>
                                <th class="font-weight-700">{{__('User')}}</th>
                                <th class="font-weight-700">{{__('Event')}}</th>
                            </tr>
                        </thead>
                        <tbody id="user_notes_records">
                            @if ($user_notes->count())
                                @foreach ($user_notes as $note)
                                    <tr id="{{ $note->id }}">
                                        <td>{{ Utility::getDateFormatted($note->created_at) }}</td>
                                        <td>{{ $note->createdBy->name }}</td>
                                        <td>{!! $note->notes !!}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-10">
                        <x-input.text name="user_note" labeless :wrap="false" class="text-sm"
                                      placeholder="{{ __('Enter Note') }}"/>
                    </div>
                    <div class="col-2">
                        <x-button sm pill class="mt-1" data-from="{{ $batchId }}" id="add_user_note">
                            {{ __('Add') }}
                        </x-button>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="workflow">
                @empty($error_msg)
                    <div class="table-responsive mh-500 min-h-430">
                        <table class="table historyTable" data-searching="false" data-info="false" data-paging="false">
                            <thead>
                                <tr>
                                    <th class="font-weight-700">{{ __('Date') }}</th>
                                    <th class="font-weight-700">{{ __('User') }}</th>
                                    <th class="font-weight-700">{{ __('Event') }}</th>
                                </tr>
                            </thead>
                            <tbody id="workflow_records">
                                @if (count($historyBatch))
                                    @foreach ($historyBatch as $note)
                                        <tr>
                                            <td>{{ $note->CreateDate }}</td>
                                            <td>{{ $note->UserName }}</td>
                                            <td>{!! $note->Message !!}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @else
                    <h5 class="text-center h5">{!! $error_msg !!}</h5>
                @endempty
            </div>
        </div>
    </div>
</div>
