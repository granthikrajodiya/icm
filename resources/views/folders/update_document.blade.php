@if(!empty($details->IndexFields))
    @if($permission == true)
        <form action="{{route('folder.document.update',[tenant('tenant_id'),$repositoryName,$docId])}}" enctype="multipart/form-data" method="POST" id="update-document">
        @csrf
    @endif
        <div class="row align-items-center">
            @php
                if(!empty($indexvalues) && count($indexvalues)>0){
                    $column = array_column($indexvalues, 'IndexName');
                }
            @endphp
            <input type="hidden" name="indexvalues" value="{!!json_encode($indexvalues)!!}">
            @foreach ($details->IndexFields as $key => $val)
                @php
                    $indexVal = $val->Value;
                    if ($indexVal->FieldType == 3) {
                        $indexVal->SearchOperator = 5;
                    }

                    $input_name = 'input['.$indexVal->FieldName.']';
                    $label = $indexVal->FieldName;
                    $required = $indexVal->Required == true ? 'required' : '';
                    $asterisk = $indexVal->Required == true ? '*' : '';
                    $Readonly = $indexVal->Readonly == true || $permission == false ? 'readonly' : '';

                    $maxlength = '';
                    if ($indexVal->MaxFieldLength > 0) {
                        $maxlength = 'maxlength=' . $indexVal->MaxFieldLength;
                    }

                    if(!empty($column)){
                        $found_key = array_search($indexVal->FieldName, $column);
                        $input_value = $indexvalues[$found_key]->IndexValue;
                    }else{
                        $input_value = '';
                    }
                @endphp
                @if (!$indexVal->Hidden && !$indexVal->IsRestricted)

                    @if($indexVal->FieldType == 0)
                        <div class="col-md-12 form-group">
                            {{ Form::label($input_name, $label, ['class' => 'form-control-label']) }}
                            <span class="text-danger h5">{{ $asterisk }}</span>
                            {{ Form::number($input_name, $input_value, ['class' => 'form-control ' . $Readonly, 'min' => 0, $required, $Readonly, $maxlength]) }}
                        </div>
                    @elseif($indexVal->FieldType == 1)
                        <div class="col-md-12 form-group">
                            {{ Form::label($input_name, $label, ['class' => 'form-control-label']) }}
                            <span class="text-danger h5">{{ $asterisk }}</span>
                            {{ Form::number($input_name, $input_value, ['class' => 'form-control ' . $Readonly, 'min' => 0, 'step' => '0.01', $required, $Readonly, $maxlength]) }}

                        </div>
                    @elseif($indexVal->FieldType == 2)
                        <div class="col-md-12 form-group">
                            {{ Form::label($input_name, $label, ['class' => 'form-control-label']) }}
                            <span class="text-danger h5">{{ $asterisk }}</span>
                            {{ Form::text($input_name, $input_value, ['class' => 'form-control ' . $Readonly, $required, $Readonly, $maxlength]) }}

                        </div>
                    @elseif($indexVal->FieldType == 3)
                        <div class="col-md-12 form-group">
                            {{ Form::label($label, $label, ['class' => 'form-control-label']) }}
                            <span class="text-danger h5">{{ $asterisk }}</span>

                            @php
                                $date_default_val = '';
                                if ($input_value != '' && $input_value != null) {
                                    $date_default_val = Utility::getDateFormatted($input_value,false,'Y-m-d');
                                }
                            @endphp
                            {{ Form::date($input_name, $date_default_val, ['class' => 'form-control ' . $Readonly, $required, $Readonly, $maxlength]) }}
                        </div>
                    @elseif($indexVal->FieldType == 5)
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="hidden" class="checbox-field-value" name="{{ $input_name }}" id="{{ $input_name }}" value="{{ isset($input_value) && strtolower('' . $input_value) == 'true' ? 'true' : 'false' }}">
                                <input type="checkbox" class="custom-control-input checbox-field" name="{{ $input_name }}_tmp" id="{{ $input_name }}_tmp" value="true" {{ isset($input_value) && strtolower('' . $input_value) == 'true' ? 'checked' : '' }}>
                                <label class="custom-control-label form-control-label text-muted" for="{{ $input_name }}_tmp">{{$label}}</label>
                            </div>
                        </div>
                    @elseif($indexVal->FieldType == 6)
                        <div class="col-md-12 form-group">
                            {{ Form::label($label, $label, ['class' => 'form-control-label']) }}
                            <span class="text-danger h5">{{ $asterisk }}</span>
                            <select class="form-control filter-select-{{ $Readonly }}" name="{{ $input_name }}" {{ $required }} {{ $Readonly == 'readonly' ? 'disabled' : '' }} {{ $maxlength }}>
                                @foreach($indexVal->PickListFieldValues as $indexValue)
                                    <option value='{{ $indexValue }}' {{ $indexValue == $input_value ? 'selected' : '' }}> {{ $indexValue }}</option>
                                @endforeach
                            </select>
                            @if ($Readonly == 'readonly')
                                {{ Form::hidden($input_name, $input_value, ['class' => 'form-control ' . $Readonly]) }}
                            @endif
                        </div>
                    @endif
                @endif
            @endforeach
        </div>

        <div class="row text-right">
            <div class="col-12 pt-4">
                @if($permission == true)<x-button type="submit" sm pill right>{{ __('Update') }}</x-button>@endif
                <x-button type="button" sm secondary pill right id="collapsebutton">{{ __('Cancel') }}</x-button>
            </div>
        </div>
    @if($permission == true)
        </form>
        <script type="text/javascript">
            $('#update-document').on('submit',function(e){
                e.preventDefault();
                var url = $(this).attr('action');
                var data = new FormData(this);
                postAjax(url, data, true, function (response) {
                    if(response.Success){
                        show_toastr('Success', response.Message, 'success');
                        getDocProperties();
                    }else{
                        show_toastr('Error', response.ErrorMessage, 'error');
                    }

                });
            });

            $('.checbox-field').change(function() {
                const field = $(this).parent().find('.checbox-field-value')[0];
                if (field) {
                    if(this.checked) {
                        $(field).val('true');
                    } else {
                        $(field).val('false');
                    }
                }
            });
        </script>
    @endif
@else
    <div class="row align-items-center text-center">
        <div class="col-12">
            {{__('Details not found.')}}
            <x-button type="button" sm secondary pill right id="collapsebutton">{{ __('Close') }}</x-button>
        </div>
    </div>
@endif




