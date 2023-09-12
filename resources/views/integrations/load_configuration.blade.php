@php 
    $request_type = !empty($request_type) ? $request_type : '';
    $data_parameter = isset($restIntegration->data_format) && $restIntegration->data_format == 0 && !empty($restIntegration->data_parameter) ? json_decode($restIntegration->data_parameter) : null;
@endphp

<div class="col-12 form-group">
    {{ Form::label('rest_endpoint_url', __('Rest Endpoint Url'),['class' => 'form-control-label']) }}
    {{ Form::text($request_type.'[rest_endpoint_url]', !empty($restIntegration->rest_endpoint_url) ? $restIntegration->rest_endpoint_url : '', ['class' => 'form-control']) }}
</div>
<div class="col-6 form-group">
    {{ Form::label('http_method', __('HTTP Method'),['class' => 'form-control-label']) }}
    {{ Form::select($request_type.'[http_method]', ['post' => __('HTTP Post'),'get' => __('HTTP Get')],!empty($restIntegration->http_method) ? $restIntegration->http_method : null, ['class' => 'form-control']) }}
</div>
<div class="col-12 form-group">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="{{$request_type}}[http_authentication]" id="{{$request_type}}http_authentication" {{isset($restIntegration->http_authentication) && $restIntegration->http_authentication == '0' ? 'checked' : ''}}>
        <label class="custom-control-label form-control-label text-muted" for="{{$request_type}}http_authentication">{{__('Use HTTP Authentication')}}</label>
    </div>
</div>
<div class="col-12 form-group">
    <div class="card hover-shadow-lg">
        <div class="card-body">
            <div class="row">
                <div class="col-6 form-group">
                    {{ Form::label('http_username', __('HTTP User Name'),['class' => 'form-control-label']) }}
                    {{ Form::text($request_type.'[http_username]', !empty($restIntegration->http_username) ? $restIntegration->http_username : '', ['class' => 'form-control', 'autocomplete' => 'false']) }}
                </div>
                <div class="col-6 form-group">
                    {{ Form::label('http_password', __('HTTP Password'),['class' => 'form-control-label']) }}
                    <input type="password" name="{{$request_type}}[http_password]" value="{{!empty($restIntegration->http_password) ? $restIntegration->http_password : ''}}" class="form-control" autocomplete="new-password">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12 form-group">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="{{$request_type}}[custom_http_headers]" id="{{$request_type}}custom_http_headers" {{isset($restIntegration->custom_http_headers) && $restIntegration->custom_http_headers == '0' ? 'checked' : ''}}>
        <label class="custom-control-label form-control-label text-muted" for="{{$request_type}}custom_http_headers">{{__('Use Custom HTTP Headers')}}</label>
    </div>
</div>
<div class="col-12 form-group">
    {{ Form::label('http_headers', __('HTTP Headers'),['class' => 'form-control-label']) }}
    {{ Form::textarea($request_type.'[http_headers]', !empty($restIntegration->http_headers) ? $restIntegration->http_headers : '', ['class' => 'form-control','rows' => 2]) }}
</div>
<div class="col-12 form-group">
    {{ Form::label('data_format', __('Data Format'),['class' => 'form-control-label']) }}
    <div class="row">
        <div class="col-4 form-group">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="{{$request_type}}[data_format]" value="0" id="{{$request_type}}key_value_pairs" {{(isset($restIntegration->data_format) && $restIntegration->data_format == '0') || !isset($restIntegration->data_format) ? 'checked' : ''}} >
                <label class="custom-control-label form-control-label text-muted" for="{{$request_type}}key_value_pairs">{{__('Send Key-Value Pairs')}}</label>
            </div>
        </div>
        <div class="col-4 form-group">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="{{$request_type}}[data_format]" id="{{$request_type}}raw_data" value="1" {{(isset($restIntegration->data_format) && $restIntegration->data_format == '1') ? 'checked' : ''}}>
                <label class="custom-control-label form-control-label text-muted" for="{{$request_type}}raw_data">{{__('Send Raw Data')}}</label>
            </div>
        </div>
    </div>
</div>
<div class="col-12 form-group {{$request_type}}_repeater" data-value='{!! $data_parameter !!}' id="{{$request_type}}-form-data-div">
    {{ Form::label('data_format', __('Parameters'),['class' => 'form-control-label']) }}
    <div class="row repeater-heading">
        <div class="col-5">
            {{ Form::label('parameter_name', __('Name'),['class' => 'form-control-label']) }}
        </div>
        <div class="col-5">
            {{ Form::label('parameter_value', __('Value'),['class' => 'form-control-label']) }}
        </div>
        <div class="col-2 form-group">
            <button type="button" class="btn btn-xs btn-primary btn-icon-only rounded-circle">
                <span class="btn-inner--icon" data-repeater-create=""><i class="fas fa-plus"></i></span>
            </button>
        </div>
    </div>
    <div class="items" data-repeater-list="{{$request_type}}[parameter]">
        <div class="row align-items-center" data-repeater-item>
            <div class="col-5 form-group">
                {{ Form::text('key', '', ['class' => 'form-control', 'data-name' => 'key', 'id' => 'key']) }}
            </div>
            <div class="col-5 form-group">
                {{ Form::text('value', '', ['class' => 'form-control', 'data-name' => 'value', 'id' => 'value']) }}
            </div>
            <div class="col-2 form-group repeater-remove-btn">
                <button type="button" class="btn btn-xs btn-danger btn-icon-only rounded-circle" data-repeater-delete>
                    <span class="btn-inner--icon"><i class="fas fa-minus"></i></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="col-12 form-group d-none" id="{{$request_type}}-raw-data-div">
    {{ Form::textarea($request_type.'[raw_data]', !empty($restIntegration->data_parameter) ? json_decode($restIntegration->data_parameter) : '', ['class' => 'form-control','rows' => 5]) }}
</div>
<script type="text/javascript">

    $(document).ready(function () {
        var dataParameter = $('input[name="{{$request_type}}[data_format]"]:checked');
        load_data_parameter(dataParameter);
    });

    $(document).on('change', 'input[name="{{$request_type}}[data_format]"]', function () {
        load_data_parameter($(this));
    })

    function load_data_parameter(element){
        if(element.attr('name') == "{{$request_type}}[data_format]"){
            if(element.attr('value') == "0"){
                $('#{{$request_type}}-form-data-div').removeClass('d-none');
                $('#{{$request_type}}-raw-data-div').addClass('d-none');
            }else{
                $('#{{$request_type}}-form-data-div').addClass('d-none');
                $('#{{$request_type}}-raw-data-div').removeClass('d-none');
            }
        }
    }

    var selector = "body";
    if ($(selector + " .{{$request_type}}_repeater").length) {
       
        var $repeater = $(selector + ' .{{$request_type}}_repeater').repeater({
            initEmpty: true,
            defaultValues: {
                'status': 1
            },
            isFirstItemUndeletable: true
        });
        var value = $(selector + " .{{$request_type}}_repeater").attr('data-value');

        if (typeof value != 'undefined' && value.length != 0) {
            value = JSON.parse(value);
            $repeater.setList(value);
        }
    }
    if('{{$request_type}}' == 'second'){
        $.each($('input[name="details_type"]'), function () {
            if($(this).val() == "{{isset($restIntegration->details_type) ? $restIntegration->details_type : 0}}"){
                
                $(this).attr('checked', 'checked');
                setDetailsType($(this));

                return true;
            }
        });
    }
    

       
</script>




