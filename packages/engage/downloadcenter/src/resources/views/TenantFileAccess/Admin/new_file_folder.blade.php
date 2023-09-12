<link rel="stylesheet" href="{{asset('assets/libs/dropzone/custom.css')}}" type="text/css" />
@if($product->type == "folder")
    <x-form :action="route('newFile.store', tenant('tenant_id'))" enctype='multipart/form-data'>
        <div class="row">
            <x-input.text name="release_name" container-class="col-sm-12 col-md-12 col-lg-12" value="{{$product->product_version}}" disabled/>
            <x-input.text name="product_name" container-class="col-sm-12 col-md-12 col-lg-12" value="{{$product->product_name}}" disabled/>

            @if(!empty($product->subfolder))
                <x-input.text name="folder_name" container-class="col-sm-12 col-md-12 col-lg-12" value="{{$product->subfolder}}" disabled/>
                <input type="hidden" name="subfolder" class="col-sm-12 col-md-12 col-lg-12" value="{{$product->subfolder}}"/>

            @endif
            <input type="hidden" name="product_id" class="col-sm-12 col-md-12 col-lg-12" value="{{$product->id}}"/>
            <input type="hidden" name="type" class="col-sm-12 col-md-12 col-lg-12" value="{{$product->type}}"/>
            <input type="hidden" name="tenant" class="col-sm-12 col-md-12 col-lg-12" />
            <x-input.text required name="folder_name" container-class="col-sm-12 col-md-12 col-lg-12"/>
        </div>
        <div class="row">
            <div class="col-12 pt-4">
                <x-button sm pill right>{{ __('Save') }}</x-button>
                <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
            </div>
        </div>
    </x-form>
@else
    <div class="row">
        <x-input.text name="release_name" container-class="col-sm-12 col-md-12 col-lg-12" value="{{$product->product_version}}" disabled/>
        <x-input.text name="product_name" container-class="col-sm-12 col-md-12 col-lg-12" value="{{$product->product_name}}" disabled/>

        @if(!empty($product->subfolder))
            <x-input.text name="folder_name" container-class="col-sm-12 col-md-12 col-lg-12" value="{{$product->subfolder}}" disabled/>
        @endif
        <input type="hidden" name="product_id" class="col-sm-12 col-md-12 col-lg-12" value="{{$product->id}}"/>
        <input type="hidden" name="type" class="col-sm-12 col-md-12 col-lg-12" value="{{$product->type}}"/>

        <div class="col-sm-12 col-md-12 col-lg-12" id="uploaderHolder">
            <form action="{{ route('newFile.store', tenant('tenant_id')) }}" class="dropzone" id="datanodeupload">
                @csrf
                <div class="dz-message" data-dz-message><span>{{__('Click to browse or drop files here to upload ')}}</span></div>

                <input type="file" name="file"  style="display: none;">
                @if(!empty($product->subfolder))
                    <input type="hidden" name="subfolder" class="col-sm-12 col-md-12 col-lg-12" value="{{$product->subfolder}}"/>
                @endif

                <input type="hidden" name="product_id" class="col-sm-12 col-md-12 col-lg-12" value="{{$product->id}}"/>
                <input type="hidden" name="type" class="col-sm-12 col-md-12 col-lg-12" value="{{$product->type}}"/>
                <input type="hidden" name="tenant" class="col-sm-12 col-md-12 col-lg-12" />
            </form>
        </div>
    </div>
    <script src="{{asset('assets/libs/dropzone/file_upload.js') }}?{{time()}}" defer></script>
    <script type="text/javascript">
        $('.dz-image').find('img').attr('src',"{{asset('assets/libs/dropzone/file-upload.svg')}}");
        dropzone.on('sending', function(file, xhr, formData){
        $('.dz-image').find('img').attr('src',"{{asset('assets/libs/dropzone/file-upload.svg')}}");
        });
        dropzone.on('success', function(file, xhr, formData){
        $('.dz-image').find('img').attr('src',"{{asset('assets/libs/dropzone/file-upload.svg')}}");
        });
    </script>
@endif

<script type="text/javascript">
    $( document ).ready(function() {
        $('input[name=tenant]').val($('#tenant').val());
    });
</script>

