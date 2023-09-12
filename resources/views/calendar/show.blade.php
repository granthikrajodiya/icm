<div class="row">
    <div class="col-12">
        <b>{{__('Event Name')}}</b> :
        <span>{{ $calendar->name }}</span>
    </div>
    <div class="col-12 pt-3">
        <b>{{__('Event Description')}}</b> :
        <span>{!! (!empty($calendar->description)) ? $calendar->description : '-' !!}</span>
    </div>
    <div class="col-12 pt-3">
        <b>{{__('Timezone')}}</b> :
        <span>{!! (!empty($calendar->timezone)) ? $calendar->timezone : '-' !!}</span>
        <span id="timezone-offset"></span>
    </div>
    <div class="col-12 pt-3">
        <b>{{__('Scope')}}</b> :
        <span>{!! (!empty($calendar->scope)) ? $calendar->scope : '-' !!}</span>
    </div>
    <div class="col-6 pt-3">
        <b>{{__('Start Date')}}</b> :
        <span>{{ Utility::getDateFormatted($calendar->start_date) }}</span>
    </div>
    <div class="col-6 pt-3">
        <b>{{__('End Date')}}</b> :
        <span>{{ Utility::getDateFormatted($calendar->end_date) }}</span>
    </div>

    @if($calendar->all_day != 0)
        <div class="col-12 pt-3">
            <b>{{__('Event Duration')}}</b> :
            <span> All Day</span>
        </div>

    @else
        <div class="col-6 pt-3">
            <b>{{__('Start Time')}}</b> :
            <span>{{ (!empty($calendar->start_time)) ? date('h:i A', strtotime($calendar->start_time)) : '-' }}</span>
        </div>
        <div class="col-6 pt-3">
            <b>{{__('End Time')}}</b> :
            <span>{{ (!empty($calendar->end_time)) ? date('h:i A', strtotime($calendar->end_time)) : '' }}</span>
        </div>
    @endif

    @if (user()->id == $calendar->created_by || user()->account_type == 1)
        <div class="row justify-content-start pt-4">
            <div class="col-4 pl-3 pr-4">
                <x-button type="button" class="btn-xs" pill
                    data-url="{{ route('calendar.edit', [tenant('tenant_id'), $calendar->id]) }}"
                    data-ajax-popup="true" data-title="{{ __('Edit Event') }}"  data-size="lg"
                >
                    {{ __('Edit') }}
                </x-button>
            </div>
            <x-form class="col-4 ml-2" :action="route('calendar.destroy', [tenant('tenant_id'), $calendar->id])" delete id="calendarDestroy">
                <x-button class="btn-xs" pill form="calendarDestroy" danger>
                    {{ __('Delete') }}
                </x-button>
            </x-form>
          </div>
    @endif
</div>
