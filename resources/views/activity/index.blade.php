<x-layouts.app
    title="{{__('Activities')}}"
    header="{{__('Activities')}}"
>
    <div class="row">
        <div class="col-12">
            @if (Utility::getValByName('show_activities') == '1')
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <h6 class="mb-0">{{__('Activities')}}</h6>
                            </div>
                            <div class="col text-right">
                                <div class="actions">
                                    <div class="dropdown">
                                        <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('activity.index',[tenant('tenant_id'),'date_desc']) }}" class="dropdown-item {{(request()->segment(2) == 'date_desc' || empty(request()->segment(2))) ? 'active':''}}"><i class="fas fa-sort-amount-down"></i> {{__('Newest')}}</a>
                                            <a href="{{ route('activity.index',[tenant('tenant_id'),'date_asc']) }}" class="dropdown-item {{(request()->segment(2) == 'date_asc') ? 'active' : ''}}"><i class="fas fa-sort-amount-up"></i> {{__('Oldest')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scrollbar-inner">
                        <div class="mh-690 min-h-690">
                            <div class="card-body">
                                <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                                    @foreach ($activities as $activity)
                                        <div class="timeline-block">
                                            @if ($activity->type == 'system')
                                                @if (strpos($activity->text, 'Login') === 0)
                                                    <span class="timeline-step timeline-step-sm bg-dark border-dark text-white"><i class="fas fa-sign-in-alt"></i></span>
                                                @elseif(strpos($activity->text, 'Logout') === 0)
                                                    <span class="timeline-step timeline-step-sm bg-dark border-dark text-white"><i class="fas fa-sign-out-alt"></i></span>
                                                @else
                                                    <span class="timeline-step timeline-step-sm bg-dark border-dark text-white"><i class="fas fa-cogs"></i></span>
                                                @endif
                                            @elseif($activity->type == 'shared-document')
                                                <span class="timeline-step timeline-step-sm bg-dark border-dark text-white"><i class="fas fa-folder-open"></i></span>
                                            @elseif($activity->type == 'shared-work-item')
                                                <span class="timeline-step timeline-step-sm bg-dark border-dark text-white"><i class="fas fa-box-open"></i></span>
                                            @elseif($activity->type == 'calendar')
                                                <span class="timeline-step timeline-step-sm bg-dark border-dark text-white"><i class="fas fa-calendar-times"></i></span>
                                            @else
                                                <span class="timeline-step timeline-step-sm bg-dark border-dark text-white"><i class="fas fa-user"></i></span>
                                            @endif
                                            <div class="timeline-content">
                                                <a href="#" class="d-block h6 text-sm mb-0">{{ $activity->text }}</a>
                                                <small><i class="fas fa-clock mr-1"></i>{{ Utility::getDateFormatted($activity->date_time,true) }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
