<div id='configuration-loader' class="min-h-500 d-none">
    <img src="{{ asset('assets/img/loading.gif') }}" height="50px" width="50px" class="loading" alt="">
</div>
<div id="configuration-content">
    <x-form :action="route('integrations.update', [tenant('tenant_id'), $restIntegration->id])" id="msform"
            autocomplete="off">
        <div class="msdiv">
            <div class="row">
                <x-input.text name="name" label="Integration Name" :value="$restIntegration?->name"/>

                <div class="col-12 form-group">
                    <h5 class="mb-1">{{ __('Authentication Configuration') }}</h5>
                </div>
            </div>
            <div class="row" id="load_auth_config"></div>
            <x-button type="button" sm pill name="next" class="next action-button" id="test_auth_config"
                      data-id="{{ $restIntegration?->id ?? 0 }}">
                {{ __('Next') }}
            </x-button>
        </div>
        <div class="msdiv">
            <div class="row">
                <div class="col-12 form-group">
                    <h5 class="mb-1">{{ __('Search/List Configuration') }}</h5>
                </div>
            </div>
            <div class="row" id="load_searchlist_config"></div>
            <x-button type="button" sm pill name="next" class="next action-button" id="test_searchlist_config">
                {{ __('Next') }}
            </x-button>
            <x-button type="button" sm secondary pill name="previous" class="previous action-button">
                {{ __('Previous') }}
            </x-button>
        </div>
        <div class="msdiv">
            <div class="row">
                <div class="col-12 form-group">
                    <h5 class="mb-1">{{ __('Configure result list') }}</h5>
                    <x-input.label for="display_configure_result_list">
                        {{ __('Select fields to be display') }}
                    </x-input.label>

                    <div class="row">
                        <div class="col-4">
                            <div class="pl-3 py-2" id="display_result_list"></div>
                        </div>
                        <div class="col-8">
                            <div class="table-responsive">
                                <table class="table result_table" id="display_result_table">
                                    <thead class="thead-light">
                                        <tr id="display_result_thead">
                                        </tr>
                                    </thead>
                                    <tbody id="display_result_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-button type="button" sm pill name="next" class="next action-button">
                {{ __('Next') }}
            </x-button>
            <x-button type="button" sm pill secondary name="previous" class="previous action-button">
                {{ __('Previous') }}
            </x-button>
        </div>
        <div class="msdiv">
            <div class="row">
                <div class="col-4 form-group">
                    <x-input.radio name="details_type" class="text-muted"
                                   label="Enable basic details" label-class="text-muted" checked value="1"
                                   data-id="details_div_0" :current="$restIntegration?->searchlist_details_type"/>
                </div>
                <div class="col-4 form-group">
                    <x-input.radio name="details_type" id="details_type_1"
                                   label="Open Document" value="2" data-id="details_div_1"
                                   :current="$restIntegration?->searchlist_details_type"/>
                </div>
                <div class="col-4 form-group">
                    <x-input.radio name="details_type" id="details_type_2"
                                   label="No Details" value="0" data-id="details_div_2"
                                   :current="$restIntegration?->searchlist_details_type"/>
                </div>
                <div class="details_div col-12 pl-3 py-2" id="details_div_0"></div>
                <div class="details_div col-12" id="details_div_1">
                    <div class="row" id="load_sub_config"></div>
                </div>
                <div class="details_div col-12" id="details_div_2"></div>
            </div>

            <x-button sm pill>{{ __('Update') }}</x-button>
            <x-button type="button" sm secondary pill name="previous" class="previous action-button">
                {{ __('Previous') }}
            </x-button>
            <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </x-form>
</div>

<script type="text/javascript">
    let auth_result = "";

    $(document).on('click', '#test_auth_config,#test_searchlist_config', function (e) {

        let attr = $(this).attr('data-id');

        let myForm = document.getElementById('msform');

        let formData = new FormData(myForm);

        let Requesttype = 'second';
        if ($(this).attr('id') == 'test_auth_config') {
            Requesttype = 'first';
        }

        formData.append('_token', '{{ csrf_token() }}');
        formData.append('auth_result', JSON.stringify(auth_result));
        formData.append('Requesttype', Requesttype);

        $.ajax({
            type: "POST",
            url: '{{ route('configure.test', tenant('tenant_id')) }}',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {

            },
            success: function(response, status, xhr) {
                if (!xhr.responseJSON) {
                    location.reload();
                    return false;
                }
                if (!response.is_success) {
                    show_toastr('Error', response.message, 'error');
                } else {
                    show_toastr('Success', response.message, 'success');

                    if (Requesttype == 'first') {
                        auth_result = response.data;

                        let type = 'second';
                        let IntegrationId = 0;
                        if (typeof attr !== typeof undefined && attr !== false) {
                            IntegrationId = attr;
                        }
                        loadConfigurationView(IntegrationId, type);
                    } else {
                        $("#display_result_list").empty();
                        $("#details_div_0").empty().show();
                        let data = [];
                        let resp = response.data;
                        if (typeof resp == 'object') {
                            let iterator = Object.keys(resp);
                            $.each(iterator, function (k, v) {
                                if (typeof resp[v] == 'object' && resp[v] != '' && resp[
                                    v] != null) {
                                    data = resp[v];
                                }
                            });
                        }

                        $.each(data, function (k, v) {
                            if (k < 3) {
                                let html = `<tr>`;
                                let filled_result_list = `<?php echo json_encode(!empty($restIntegration->search_result_list) ? $restIntegration->search_result_list : ''); ?>`;
                                let filled_basic_details = `<?php echo json_encode(!empty($restIntegration->search_basic_details) ? $restIntegration->search_result_list : ''); ?>`;
                                $.each(v, function (k_val, v_val) {
                                    let td_class = k_val.replace(/\s+/g, '_').toLowerCase();
                                    if (k == 0) {
                                        let is_checked = filled_result_list != "" &&
                                        filled_result_list.includes(k_val) ?
                                            'checked' : '';
                                        let result_list = `<div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="result_list[]" id="${td_class}" value="${k_val}" ${is_checked}>
                                            <label class="custom-control-label form-control-label text-muted" for="${td_class}">${k_val}</label>
                                          </div>`;
                                        $("#display_result_list").append(
                                            result_list);
                                        $("#display_result_thead").append(
                                            `<th class="${td_class}">${k_val}</th>`
                                        );
                                        let is_checked_details =
                                            filled_basic_details != "" &&
                                            filled_basic_details.includes(k_val) ?
                                                'checked' : '';
                                        let basic_details = `<div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="basic_details[]" id="basic_details_${k_val}" value="${k_val}" ${is_checked_details}>
                                            <label class="custom-control-label form-control-label text-muted" for="basic_details_${k_val}">${k_val}</label>
                                          </div>`;
                                        $("#details_div_0").append(basic_details);
                                    }

                                    html += `<td class="${td_class}">${v_val}</td>`;
                                });

                                html += `</tr>`;

                                $("#display_result_tbody").append(html);
                            }
                        });
                        $("input[name='result_list[]']:not(:checked)").each(function () {
                            let column = "table ." + $(this).attr("id");
                            $(column).hide();
                        });

                        setDetailsType($('input[name="details_type"]:checked'));
                    }
                }
            },
            error: function (requestObject, error, errorThrown) {
                alert(errorThrown);
            },
            complete: function (response) {

            }
        });
        e.stopImmediatePropagation();
        return false;
    });

    function setDetailsType(element) {
        let show_div = element.data('id');
        $('.details_div').hide();
        $(`#${show_div}`).show();
        if (show_div == "details_div_1") {
            let IntegrationId = "{{ $restIntegration->open_document_id }}";
            loadConfigurationView(IntegrationId, 'third');
        }
    }

    $(document).on('change', ' input[name="details_type"]', function () {
        setDetailsType($(this));
    });

    $(document).on('click', 'input[name="result_list[]"]', function () {
        let column = "table ." + $(this).attr("id");
        $(column).toggle();
    });
</script>
