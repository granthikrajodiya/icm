<div id='loader' class="min-h-500">
    <img src="{{ asset('assets/img/loading.gif') }}" height="50px" width="50px" class="loading" alt="">
</div>
<div id="data-content" style="display: none">
    <x-form :action="route('navigation.update', [tenant('tenant_id'), $navigation->id])" put id="form_navigation">
        <div class="row">
            <x-input.text required name="title" :value="$navigation->title" :maxlength="100" container-class="col-12"/>
            <x-select required name="content_type" container-class="col-6">
                @foreach (\App\Models\Layout::getNavigationContentType() as $value => $label)
                    <option value="{{ $value }}" @if ($navigation->content_type == $value) selected @endif>
                        {{ $label }}
                    </option>
                @endforeach
            </x-select>
            <x-select name="data_source" label="Data Source" container-class="col-6 source_div">
                <option value="data_source[]">data_source[]</option>
            </x-select>
            <x-input.text required name="custom_url" label="Data Source" container-class="col-6 d-none url_div"
                          value="{{ $navigation->data_source }}"/>
            <x-input.text name="eform_url" label="ILINX eForm URL to create new items"
                          container-class="{{ !in_array($navigation->content_type, ['Content view', 'Workflow view']) ? 'd-none' : '' }} eform_div"
                          value="{{ $navigation->eform_url }}"/>

            <div class="col-12 pb-4 d-none url_div" >
                <x-input.checkbox id="open_new_window" name="open_new_window" label="Open in new window" value="1"
                            :current="$navigation->adv_config" :checked="$navigation->adv_config == 1 ? true : false"/>
            </div>
            <div class="col-6">
                <x-input.checkbox id="show_nav_menu" name="show_nav_menu" label="Show Navigation Icon" value="1"
                                  :current="$navigation->show_nav_menu" :checked="$navigation->show_nav_menu == 1 ? true : false"/>
            </div>
            <div class="col-6">
                <x-input.checkbox id="show_top_menu" name="show_top_menu" label="Show Top Menu" value="1"
                                  :current="$navigation->show_top_menu" :checked="$navigation->show_top_menu == 1 ? true : false"/>
            </div>
            <div class="col-12 pt-4">
                <span data-icon="{{ $navigation->icon }}"
                      data-cols="6"
                      data-align="center"
                      data-search="true"
                      data-search-text="{{ __('Search...') }}"
                      data-iconset="fontawesome5"
                      role="iconpicker" name="icon"></span>
            </div>
        </div>
        <div class="text-right pt-3">
            <x-button type="button" sm pill id="submit_navigation">{{ __('Update') }}</x-button>
            <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </x-form>
</div>
