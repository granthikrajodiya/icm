<div id='loader' class="min-h-500">
    <img src="{{ asset('assets/img/loading.gif') }}" height="50px" width="50px" class="loading" alt="">
</div>
<div id="data-content" style="display: none">
    <x-form :action="route('layout.store', tenant('tenant_id'))" id="form_layout">
        <div class="row">
            <x-select
                x-on:change="onChangeSelect($event.target.value)"
                required
                name="content_type"
                id="content_type"
                container-class="col-6"
            >
                @foreach (\App\Models\Layout::gethomePageCardContentType() as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-select>
            <div class="col-6">
                <div class="form-group source_div">
                    <x-select name="data_source" :wrap="false">
                        <option value="data_source[]">data_source[]</option>
                    </x-select>
                </div>
                <div class="form-group d-none url_div">
                    <x-input.text name="custom_url" label="Data Source" :wrap="false"/>
                </div>
            </div>
            <x-input.text
                required
                name="title"
                label="Card Title"
                :maxlength="100"
            />
            <div class="col-12 color-select-table form-group d-none">
                <label for="color_map" class="form-control-label">
                    Color Map
                </label>
                <table class="table form_control" name="color_map" id="color_map">
                    <thead class="thead-light ">
                    <tr>
                        <th class="">{{__('Color')}}</th>
                        <th class="">{{__('Data value')}}</th>

                        <th class="text-right">
                            <div class="actions">
                                <a class="action-item pointer add-color-pointer"
                                    data-url="{{route('layout.navigation.colorSelect',tenant('tenant_id'))}}" data-ajax-popup3="true"
                                    data-size="md" data-title="{{__('Add Color Value')}}">
                                    <i class="fas fa-plus"></i>
                                    <span class="d-sm-inline-block">{{__('Add')}}</span>
                                </a>
                            </div>

                        </th>
                    </tr>
                    </thead>
                    <tbody id="color-table-body">
                    </tbody>
                </table>

            </div>

            <div class="chart-dimensions d-none row px-2" >
                <x-input.text
                    type="number"
                    name="chart_height"
                    label="Chart Height(px)"
                    default='0'
                    container-class="col-6"
                />
                <x-input.text
                    type="number"
                    name="chart_width"
                    default='0'
                    label="Chart Width(px)"
                    container-class="col-6"
                />
            </div>

            <div x-show="!hidePartialInputs" class="row px-2">
                <x-input.text
                    required
                    name="single_item"
                    label="Single Item"
                    container-class="col-6"
                    :maxlength="100"
                />
                <x-input.text
                    required
                    name="plural_item"
                    label="Plural item"
                    container-class="col-6"
                    :maxlength="100"
                />
            </div>
            <x-select required name="position" container-class="col-4">
                @foreach (\App\Models\Layout::$position as $value => $label)
                    <option
                        value="{{ $value }}"
                        @if($label === \App\Models\Layout::$position['middle'])
                            selected
                        @endif
                    >
                        {{ $label }}
                    </option>
                @endforeach
            </x-select>
            <x-select required name="width" container-class="col-4">
                @foreach (\App\Models\Layout::$width as $value => $label)
                    <option
                        value="{{ $value }}"
                        @if($value === \App\Models\Layout::$width['100%'])
                            selected
                        @endif
                    >
                        {{ $label }}
                    </option>
                @endforeach
            </x-select>
            <div x-show="!hideMaxItems"class="col-4">
                <x-input.text
                    type="number"
                    required
                    name="max_item"
                    label="Max items"
                    max="5"
                    min="1"
                    value="5"
                />
            </div>
            <x-input.text
                x-show="!hidePartialInputs"
                name="eform_url"
                label="ILINX eForm URL to create new items"
                container-class="d-none eform_div"
                :maxlength="100"
            />
            <input type="hidden" name="adv_config" id="adv_config" value="">
            <div class="col-6 mt-3 mb-5 custom-control custom-switch" id="list_mode_toggle">
                <input
                    type="checkbox"
                    class="custom-control-input"
                    id="list_mode"
                    name="list_mode"
                >
                <label class="custom-control-label" for="list_mode">List Mode</label>
            </div>
            <div x-show="!hideMaxItems" class="col-6" id="max_column_input">
                <x-input.text
                    type="number"
                    required
                    name="max_column"
                    id="max_column"
                    label="Max column"
                    max="5"
                    min="1"
                    value="3"
                />
            </div>
        </div>
        <div class="pt-3">
            <x-button sm pill right id="submit_layout">{{ __('Create Card') }}</x-button>
            <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </x-form>
</div>

<script>
    // check the initial value of checkbox if false, set the max column field to display none
    $(document).ready( () => {
        let list_mode = $('#list_mode').is(':checked');

        if (!list_mode) {
            $("#max_column_input").css("display", "none");
        }
    })

    $('#list_mode').change(function() {
        // this will contain a reference to the checkbox
        if (this.checked) {
            // the checkbox is now checked
            $("#max_column_input").css("display", "block");
        } else {
            // the checkbox is now no longer checked
            $("#max_column_input").css("display", "none");
            $("#max_column").val(0);
        }
    });

    $('#single_item').on('focusout', () => {
        const word = $('#single_item').val();
        $.ajax({
            url: '{{ route('pluralize') }}',
            type: 'GET',
            data: {
                word,
            },
            dataType: 'json',
            async: false,

            success: function(data, status, xhr) {
                if (!xhr.responseJSON) {
                    location.reload();
                    return false;
                }
                $('#plural_item').val(data.plural_item);
            }
        });
    });
</script>
