<div id='loader' class="min-h-500">
    <img src="{{ asset('assets/img/loading.gif') }}" height="50px" width="50px" class="loading" alt="">
</div>
<div id="data-content" style="display: none">
    <x-form :action="route('navigation.store', tenant('tenant_id'))" id="form_navigation">
        <div class="row">
            <x-input.text required name="title" :maxlength="100"/>
            <x-select required name="content_type" container-class="col-6">
                @foreach (\App\Models\Layout::getNavigationContentType() as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-select>
            <x-select name="data_source" container-class="col-6 source_div">
                <option value="data_source[]">data_source[]</option>
            </x-select>
            <x-input.text required name="custom_url" label="Data Source" container-class="col-6 d-none url_div"/>
            <x-input.text name="eform_url" label="ILINX eForm URL to create new items"
                          container-class="d-none eform_div"></x-input.text>

            <div class="col-12 pb-4 d-none url_div" >
                <x-input.checkbox id="open_new_window" name="open_new_window" label="Open in new window" value="1"/>
            </div>
            <div class="col-6 pb-4">
                <x-input.checkbox id="show_nav_menu" name="show_nav_menu" label="Show Navigation Icon" value="1"/>
            </div>
            <div class="col-6 pb-4">
                <x-input.checkbox id="show_top_menu" class="form-group" name="show_top_menu"
                                  label="Show Top Menu" value="1"/>
            </div>

            <div class="col-12 pt-4">
                <span data-icon="fab fa-accusoft"
                      data-cols="6"
                      data-align="center"
                      data-search="true"
                      data-search-text="{{ __('Search...') }}"
                      data-iconset="fontawesome5"
                      role="iconpicker" name="icon"></span>
            </div>
        </div>

        <div class="text-right pt-3">
            <x-button type="button" sm pill id="submit_navigation">{{ __('Add') }}</x-button>
            <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </x-form>
</div>
