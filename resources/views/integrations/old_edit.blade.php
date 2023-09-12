<div id='configuration-loader' class="min-h-500 d-none">
    <img src="{{asset('assets/img/loading.gif')}}" height="50px" width="50px" class="loading" alt="">
</div>
<div id="configuration-content">
    {{ Form::model($restIntegration, array('route' => array('integrations.update', [tenant('tenant_id'),$restIntegration->id]), 'method' => 'POST', 'id'=>'msform','autocomplete'=>'off')) }}

    <div class="msdiv">
        <div class="row" id="load_configuration">

        </div>

        <input type="button" name="next" class="next action-button btn btn-sm btn-primary rounded-pill" value="{{__('Test')}}" id="test_configuration"/>
    </div>
    <div class="msdiv">
        <div class="row">
            <div class="col-12 form-group">
                <h5 class="mb-1">{{__('Configure result list')}}</h5>
                {{ Form::label('display_configure_result_list', __('Select fields to be display'),['class' => 'form-control-label']) }}
                <div class="pl-3 py-2" id="display_result_list">

                </div>
            </div>
        </div>

        <input type="button" name="next" class="next action-button btn btn-sm btn-primary rounded-pill" value="{{__('Next')}}" />
        <input type="button" name="previous" class="previous action-button btn btn-sm btn-secondary rounded-pill" value="{{__('Previous')}}" />
    </div>
    <div class="msdiv">
        <div class="row">
            <div class="col-4 form-group">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="details_type" id="details_type" value="0" data-id="details_div_0" checked="true">
                    <label class="custom-control-label form-control-label text-muted" for="details_type">{{__('Enable basic details')}}</label>
                </div>
            </div>
            <div class="col-4 form-group">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="details_type" id="details_type_1" value="1" data-id="details_div_1">
                    <label class="custom-control-label form-control-label text-muted" for="details_type_1">{{__('Open Document')}}</label>
                </div>
            </div>
            <div class="col-4 form-group">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="details_type" id="details_type_2" value="2" data-id="details_div_2">
                    <label class="custom-control-label form-control-label text-muted" for="details_type_2">{{__('No Details')}}</label>
                </div>
            </div>
            <div class="details_div col-12" id="details_div_0"></div>
            <div class="details_div col-12" id="details_div_1">
                <input type="hidden" name="open_document_id" value="{{$restIntegration->open_document_id}}">
                <div class="row" id="load_sub_configuration">

                </div>
            </div>
            <div class="details_div col-12" id="details_div_2"></div>
        </div>
        <input type="button" name="next" class="next action-button btn btn-sm btn-primary rounded-pill" value="{{__('Next')}}" />
        <input type="button" name="previous" class="previous action-button btn btn-sm btn-secondary rounded-pill" value="{{__('Previous')}}" />
    </div>
    <div class="msdiv">
        <input type="hidden" name="menu_action_id" value="{{$restIntegration->menu_action_id}}">
        <div class="row">
            <div class="col-12 form-group">
                <h5 class="mb-1">{{__('Configure Menu Action')}}</h5>
            </div>
        </div>
        <div class="row" id="load_menuaction_configuration">

        </div>
        {{ Form::submit(__('Update'), ['class' => 'action-button btn btn-sm btn-primary rounded-pill next']) }}
        <input type="button" name="previous" class="previous action-button btn btn-sm btn-secondary rounded-pill" value="{{__('Previous')}}" />
        <input type="button" class="btn btn-sm btn-secondary rounded-pill" data-dismiss="modal" value="{{__('Cancel')}}" />
    </div>
    {{ Form::close() }}
</div>
<script src="{{ asset('assets/js/form-step.js') }}"></script>
<script type="text/javascript">


    $(document).on('click', ' #test_configuration', function(e) {
        let myForm = document.getElementById('msform');

        let formData = new FormData(myForm);

        formData.append('_token','{{ csrf_token() }}');
        $.ajax({
            type: "POST",
            url: '{{ route('configure.test',tenant('tenant_id')) }}',
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
                    $("#display_result_list").html('');
                    var result_list = `<?php echo json_encode($restIntegration->result_list); ?>`;
                    $.each(response.data, function (k, v) {
                        var is_checked = result_list != "" && result_list.includes(v) ? 'checked' : '';
                        var group_data = `<div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="result_list[]" id="${v}" value="${v}" ${is_checked}>
                            <label class="custom-control-label form-control-label text-muted" for="${v}">${v}</label>
                          </div>`;
                        $("#display_result_list").append(group_data);
                    });

                    $("#details_div_0").show();
                    $("#details_div_0").html('');
                    $("#display_result_list").clone().appendTo("#details_div_0");
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

    $('.details_div').hide();

    $(document).on('change', ' input[name="details_type"]', function() {
        $('.details_div').hide();
        var show_div = $(this).data('id');
        $(`#${show_div}`).show();
        if(show_div == "details_div_1"){
            var IntegrationId = "{{$restIntegration->open_document_id}}";
            loadConfigurationView(IntegrationId,'second');
        }else if(show_div == "details_div_0"){
            $("#details_div_0").html('');
            $("#display_result_list").clone().appendTo("#details_div_0");
        }
    });
    var IntegrationId = "{{$restIntegration->menu_action_id}}";
    loadConfigurationView(IntegrationId,'third');
</script>



