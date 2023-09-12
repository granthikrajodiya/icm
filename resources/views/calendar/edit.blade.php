@php
use App\Models\Calendar;
@endphp

<x-form :action="route('calendar.update', [tenant('tenant_id'), $calendar->id])" put class="new-event--form">
    <div class="row">
        <x-input.text required name="name" label="Event name" class="new-event--title" :value="$calendar->name" maxlength="255"/>
        <x-input.textarea name="description" label="Event Description" class="new-event-title" class="summernote-simple">
            {{ $calendar->description }}
        </x-input.textarea>

        <x-select name="timezone" label="Timezone" container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
            @foreach ($timezones as $timezone)
                <option value="{{ $timezone }}" @if($calendar->timezone == $timezone) selected @endif>
                    {{ $timezone }}
                </option>
            @endforeach
        </x-select>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
            <div class="custom-control custom-switch">
                @if ( $calendar->all_day == 1)
                    <input type="checkbox" name="all_day"
                        id="all_day"
                        class="custom-control-input"
                        checked
                        value="{{ $calendar->all_day }}">
                    <label class="custom-control-label form-control-label"
                        for="all_day">
                        All day event
                    </label>
                @else
                    <input type="checkbox" name="all_day"
                        id="all_day"
                        class="custom-control-input"
                        value="{{ $calendar->all_day }}"
                    >
                    <label class="custom-control-label form-control-label"
                        for="all_day">
                        All day event
                    </label>
                @endif

            </div>
        </div>

        <x-input.text required type="time" name="start_time" :value="$calendar->startDateTime->format('H:i:s')"
            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6 time_selector {{ $calendar->all_day == 1 ? 'd-none' : '' }}" />
        <x-input.text required type="time" name="end_time" :value="$calendar->endDateTime->format('H:i:s')"
            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6 time_selector {{ $calendar->all_day == 1 ? 'd-none' : '' }}" />

        <x-input.text required type="date" name="start_date" :value="$calendar->startDateTime->format('Y-m-d')"
            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" />
        <x-input.text required type="date" name="end_date" :value="$calendar->endDateTime->format('Y-m-d')"
            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" />

        {{-- @if (user()->account_type == 1) --}}
            <div class="col-12 pb-3">
                @if (in_array('CALENDAR_ALL_TENANTS',$userPerms))
                    <x-input.radio
                        id="customRadio1"
                        name="scope_type"
                        value="user"
                        label="Personal event"
                        checked="{{ $calendar->scope == Calendar::SCOPE_TYPES[Calendar::USER] ? true : false }}"
                    />
                    <x-input.radio
                        id="customRadio2"
                        name="scope_type"
                        value="tenant"
                        label="All '{{ tenant()->company_name }}' users"
                        checked="{{ $calendar->scope == Calendar::SCOPE_TYPES[Calendar::TENANT] ? true : false }}"
                    />
                    <x-input.radio
                        id="customRadio3"
                        name="scope_type"
                        value="system"
                        label="All system users"
                        checked="{{ $calendar->scope == Calendar::SCOPE_TYPES[Calendar::SYSTEM] ? true : false }}"
                    />
                @elseif (in_array('CALENDAR_USER_TENANT',$userPerms))
                    <x-input.radio
                        id="customRadio1"
                        name="scope_type"
                        value="user"
                        label="Personal event"
                        checked="{{ $calendar->scope == Calendar::SCOPE_TYPES[Calendar::USER] ? true : false }}"
                    />
                    <x-input.radio
                        id="customRadio2"
                        name="scope_type"
                        value="tenant"
                        label="All '{{ tenant()->company_name }}' users"
                        checked="{{ $calendar->scope == Calendar::SCOPE_TYPES[Calendar::TENANT] ? true : false }}"
                    />
                @elseif (in_array('CALENDAR_PERSONAL',$userPerms))
                    <input type="hidden" name="scope_type" value="user">
                @endif
            </div>
        {{-- @endif --}}

        <div class="form-group col-12 mb-0">
            <x-input.toggle-group name="color" label="Event Color" class="btn-group-colors event-tag"
                label-class="d-block mb-3" withoutLineBreak>
                <x-input.toggle id="colorRadio1" name="color" labeless value="bg-info" info
                    :current="$calendar->color" />
                <x-input.toggle id="colorRadio2" name="color" labeless value="bg-warning" warning
                    :current="$calendar->color" />
                <x-input.toggle id="colorRadio3" name="color" labeless value="bg-danger" danger
                    :current="$calendar->color" />
                <x-input.toggle id="colorRadio4" name="color" labeless value="bg-success" success
                    :current="$calendar->color" />
                {{-- <x-input.toggle id="colorRadio5" name="color" labeless value="bg-default" secondary
                    :current="$calendar->color" /> --}}
                <x-input.toggle id="colorRadio6" name="color" labeless value="bg-primary" primary
                    :current="$calendar->color" />
            </x-input.toggle-group>
        </div>

    </div>

    <div class="row">
        <div class="col-12 pt-4">
            <x-button sm pill right class="new-event--add">{{ __('Update event') }}</x-button>
            <x-button type="button" sm link right data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </div>
</x-form>
