<x-form :action="route('calendar.store', tenant('tenant_id'))" class="new-event--form" enctype="multipart/form-data">
    <div class="row">
        <x-input.text required name="name" label="Event Name" class="new-event--title" maxlength="255"/>
        <x-input.textarea class="summernote-simple" name="description"
                          container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12"/>

        <x-select name="timezone" label="Timezone" id="timezone_create" container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
            @foreach ($timezones as $timezone)
                <option value="{{ $timezone }}">
                    {{ $timezone }}
                </option>
            @endforeach
        </x-select>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="all_day"
                    id="all_day"
                    class="custom-control-input"
                    value="0">
                <label class="custom-control-label form-control-label"
                    for="all_day">
                    All day event
                </label>
            </div>
        </div>

        <x-input.text required type="time" name="start_time" id="create_start_time" class="new-event--title"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6 time_selector" :value="$startTime"/>
        <x-input.text required type="time" name="end_time" id="create_end_time" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6 time_selector"
                      :value="$endTime"/>
        <x-input.text required type="date" name="start_date" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required type="date" name="end_date" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>

        {{-- The account type is already been set at calendar permission level backend --}}
        {{-- @if (user()->account_type == 1) --}}
            <div class="col-12 pb-3">
                @if (in_array('CALENDAR_ALL_TENANTS',$userPerms))
                    <x-input.radio id="customRadio1" name="scope_type" checked value="user" label="Personal event" />
                    <x-input.radio id="customRadio2" name="scope_type" checked value="tenant" label="All '{{ tenant()->company_name }}' users" />
                    <x-input.radio id="customRadio3" name="scope_type" checked value="system" label="All system users" />
                @elseif (in_array('CALENDAR_USER_TENANT',$userPerms))
                    <x-input.radio id="customRadio1" name="scope_type" checked value="user" label="Personal event"/>
                    <x-input.radio id="customRadio2" name="scope_type" checked value="tenant" label="All '{{ tenant()->company_name }}' users" />
                @elseif (in_array('CALENDAR_PERSONAL',$userPerms))
                    <input type="hidden" name="scope_type" value="user">
                @endif
            </div>
        {{-- @endif --}}

            <x-input.toggle-group
                container-class="form-group col-12 mb-0"
                name="color"
                label="Event Color"
                class="btn-group-colors event-tag"
                label-class="d-block mb-3"
            withoutLineBreak>
            <x-input.toggle id="colorRadio1" labeless name="color" value="bg-info" info :current="true"/>
            <x-input.toggle id="colorRadio2" labeless name="color" value="bg-warning" warning/>
            <x-input.toggle id="colorRadio3" labeless name="color" value="bg-danger" danger/>
            <x-input.toggle id="colorRadio4" labeless name="color" value="bg-success" success/>
            {{-- <x-input.toggle id="colorRadio5" labeless name="color" value="bg-default" secondary/> --}}
            <x-input.toggle id="colorRadio6" labeless name="color" value="bg-primary" primary/>
        </x-input.toggle-group>
    </div>

    <div class="row">
        <div class="col-12 pt-4">
            <x-button sm pill right class="new-event--add">{{ __('Create event') }}</x-button>
            <x-button type="button" sm link right data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </div>
</x-form>
