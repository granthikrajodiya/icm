<link rel="stylesheet" href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/libs/dropzone/custom.css')}}?{{time()}}" type="text/css" />

@if(!empty($details->IndexFields))
<form id="upload-form" action="{{route('folder.document.upload',[tenant('tenant_id'),$repositoryName])}}" enctype="multipart/form-data">
    @csrf
<div class="row align-items-center">


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
            $Readonly = $indexVal->Readonly == true ? 'readonly' : '';

            $maxlength = '';
            if ($indexVal->MaxFieldLength > 0) {
                $maxlength = 'maxlength=' . $indexVal->MaxFieldLength;
            }
        @endphp
        @if (!$indexVal->Hidden && !$indexVal->IsRestricted)

            @if($indexVal->FieldType == 0)
                <div class="col-md-3 form-group">
                    {{ Form::label($input_name, $label, ['class' => 'form-control-label']) }}
                    <span class="text-danger h5">{{ $asterisk }}</span>
                    {{ Form::number($input_name, $indexVal->DefaultValue, ['class' => 'form-control ' . $Readonly, 'min' => 0, $required, $Readonly, $maxlength]) }}

                </div>
            @elseif($indexVal->FieldType == 1)
                <div class="col-md-3 form-group">
                    {{ Form::label($input_name, $label, ['class' => 'form-control-label']) }}
                    <span class="text-danger h5">{{ $asterisk }}</span>
                    {{ Form::number($input_name, $indexVal->DefaultValue, ['class' => 'form-control ' . $Readonly, 'min' => 0, 'step' => '0.01', $required, $Readonly, $maxlength]) }}

                </div>
            @elseif($indexVal->FieldType == 2)
                <div class="col-md-6 form-group">
                    {{ Form::label($input_name, $label, ['class' => 'form-control-label']) }}
                    <span class="text-danger h5">{{ $asterisk }}</span>
                    {{ Form::text($input_name, $indexVal->DefaultValue, ['class' => 'form-control ' . $Readonly, $required, $Readonly, $maxlength]) }}

                </div>
            @elseif($indexVal->FieldType == 3)
                <div class="col-md-4 form-group">
                    {{ Form::label($label, $label, ['class' => 'form-control-label']) }}
                    <span class="text-danger h5">{{ $asterisk }}</span>

                    @php
                        $date_default_val = '';
                        if ($indexVal->DefaultValue != '' && $indexVal->DefaultValue != null) {
                            $date_default_val = Utility::getDateFormatted($indexVal->DefaultValue,false,'Y-m-d');
                        }
                    @endphp
                    {{ Form::date($input_name, $date_default_val, ['class' => 'form-control ' . $Readonly, $required, $Readonly, $maxlength]) }}
                </div>
            @elseif($indexVal->FieldType == 5)
                <div class="col-md-3 form-group">
                    <div class="custom-control custom-checkbox mt-4">
                        <input type="checkbox" class="custom-control-input" name="{{$input_name}}" id="{{$input_name}}" value="true"{{isset($indexVal->DefaultValue) && $indexVal->DefaultValue == true ? 'checked' : ''}}>
                        <label class="custom-control-label form-control-label text-muted" for="{{$input_name}}">{{$label}}</label>
                    </div>
                </div>
            @elseif($indexVal->FieldType == 6)
                <div class="col-md-6 form-group">
                    {{ Form::label($label, $label, ['class' => 'form-control-label']) }}
                    <span class="text-danger h5">{{ $asterisk }}</span>
                    {{ Form::select($input_name, $indexVal->PickListFieldValues, $indexVal->DefaultValue, ['class' => 'form-control filter-select-' . $Readonly, $required, $Readonly == 'readonly' ? 'disabled' : '', $maxlength]) }}
                    @if ($Readonly == 'readonly')
                        {{ Form::hidden($input_name, $indexVal->DefaultValue, ['class' => 'form-control ' . $Readonly]) }}
                    @endif
                </div>
            @endif
        @endif
    @endforeach
    <div class="col-12">
        <div class="dropzone">
            <div class="dz-message" data-dz-message="">
                <span class="dz-default-message">{{__('Click to browse or drop files here to upload ')}}</span>
                <div class="dz-preview dz-preview-h"></div>
            </div>

        </div>
    </div>
</div>
<div class="row text-right">
    <div class="col-12 pt-4">
        <x-button type="submit" sm pill right>{{ __('Save') }}</x-button>
        <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
    </div>
</div>
</form>

    <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
    <script type="text/javascript">

        var dropzone = new Dropzone('#upload-form', { // The camelized version of the ID of the form element

        // The configuration we've talked about above
        autoProcessQueue: false,
        uploadMultiple: false,
        parallelUploads: 1,  // since we're using a global 'currentFile', we could have issues if parallelUploads > 1, so we'll make it = 1
        maxFilesize: 2048,   // max individual file size 1024 MB
        chunking: true,      // enable chunking
        forceChunking: true, // forces chunking when file.size < chunkSize
        parallelChunkUploads: true, // allows chunks to be uploaded in parallel (this is independent of the parallelUploads option)
        chunkSize: 2000000,  // chunk size 2,000,000 bytes (~2MB)
        retryChunks: true,   // retry chunks on failure
        retryChunksLimit: 3, // retry maximum of 3 times (default is 3)
        acceptedFiles: ".{{$filetype}}",
        addRemoveLinks: false,
        timeout: 120000,
        maxFiles: 1,
        previewsContainer: ".dz-preview",
        // The setting up of the dropzone
        init: function() {
            var myDropzone = this;
            }
        });

        $('#upload-form').on("submit", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            dropzone.processQueue();
        });


        dropzone.on("addedfiles", function(files) {
            $('.dz-message').find('.dz-default-message').addClass('d-none');
            $('.dz-image').find('img').attr('src',"{{asset('assets/libs/dropzone/file-upload.svg')}}");
        });
        dropzone.on("completemultiple", function(files) {
            $('.dz-image').find('img').attr('src',"{{asset('assets/libs/dropzone/file-upload.svg')}}");
        });

        dropzone.on('sending', function(file, xhr, formData){
            $('.dz-image').find('img').attr('src',"{{asset('assets/libs/dropzone/file-upload.svg')}}");
        });

        dropzone.on('success', function(file, xhr, formData){
        $('.dz-image').find('img').attr('src',"{{asset('assets/libs/dropzone/file-upload.svg')}}");
        });

        dropzone.on('success', function(file, xhr, response){
        if(xhr.is_success){
            $("#commonModal").modal("hide");
            loadDetailsPageView();
            show_toastr("Success", xhr.message, "success");
        }else{
            $("#commonModal").modal("hide");
            show_toastr("Error", xhr.message, "error");
        }
        });
    </script>
@endif
