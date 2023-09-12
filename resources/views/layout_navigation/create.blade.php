<div id='layout-navigation-loader' class="min-h-500 d-none">
    <img src="{{ asset('assets/img/loading.gif') }}" height="50px" width="50px" class="loading" alt="">
</div>
<div id="layout-navigation-content">
    <x-form :action="route('layout.navigation.store', tenant('tenant_id'))" id="frm_navigation_store">
        <div class="row">
            <x-input.text required name="title" container-class="col-8" id="layout_navigation_title" :maxlength="100" />
            <x-select name="user_group" container-class="col-4" required>
                @foreach ($userGroup as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-select>
        </div>

        <div class="col-12 pb-5">
            <x-input.radio
                id="customRadio11"
                name="navigation_layout"
                checked
                value="{!! \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_GRID !!}"
                label="Navigation Grid"
            />
            <x-input.radio
                id="customRadio12"
                name="navigation_layout"
                value="{!! \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_LIST !!}"
                label="Navigation List"
            />
        </div>

        <div class="col-12 pb-3">
            <x-input.radio id="customRadio5" name="fixed_layout" checked value="0" label="Dynamic Home Page Layout" />
            <x-input.radio id="customRadio6" name="fixed_layout" value="1" label="Fixed Home Page Layout" />
        </div>

        <div class="row">
            <x-input.text type="number"
                name="top_card_height"
                id="top_card_height"
                value="{{env('FIXED_MIN_TOP_CARD_HEIGHT')}}"
                label="{{ 'Top Card Height (px)' }}"
                container-class="col-4"
                min="{{env('FIXED_MIN_TOP_CARD_HEIGHT')}}"
                max="99999"
                disabled="true"
            />
            <x-input.text type="number"
                name="middle_card_height"
                id="middle_card_height"
                value="{{ env('FIXED_MIN_MIDDLE_CARD_HEIGHT') }}"
                label="{{ 'Middle Card Height (px)'}}"
                container-class="col-4"
                min="{{ env('FIXED_MIN_MIDDLE_CARD_HEIGHT') }}"
                max="99999"
                disabled="true"
            />
            <x-input.text type="number"
                name="bottom_card_height"
                id="bottom_card_height"
                value="{{ env('FIXED_MIN_BOTTOM_CARD_HEIGHT') }}"
                label="{{ 'Bottom Card Height (px)' }}"
                container-class="col-4"
                min="{{ env('FIXED_MIN_BOTTOM_CARD_HEIGHT') }}"
                max="99999"
                disabled="true"
            />
        </div>

        <div class="text-right pt-3">
            <x-button type="submit" class="layout_selector"  sm pill>{{ __('Add') }}</x-button>
            <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </x-form>
</div>
