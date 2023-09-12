<link rel="stylesheet" href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/libs/dropzone/custom.css')}}?{{time()}}" type="text/css" />
<x-form :action="route('newsfeed.store', tenant('tenant_id'))" id="upload-form" >
    <div class="row">
        <x-input.text required name="title" container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12"/>
        <x-input.textarea class="summernote-simple" name="detail" required
                          container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12"/>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
            {{ Form::label('file', __('Featured image'), ['class' => 'form-control-label']) }}
            <div class="dropzone">
                <div class="dz-message" data-dz-message="">
                    <span class="dz-default-message">{{__('Click to browse or drop files here to upload ')}}</span>
                    <div class="dz-preview dz-preview-h"></div>
                </div>
            </div>
        </div>
        <x-select required name="featured_image_placement" container-class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            @foreach (\App\Models\Newsfeeds::imagePlacementOption() as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </x-select>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group">
            {{ Form::label('file', __('Excerpt length (0 to show all text)'), ['class' => 'form-control-label']) }}
            <input type="number" default="250" value="250" name="excerpt_length" class="form-control" required>
        </div>
    </div>
    @if (in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms) || user()->account_type == \App\Models\User::INTERNAL_TENANT_ADMIN)
        <div class="row pt-3">
            <div class="col-12 ">
                <div class="custom-control custom-radio">
                    <input type="radio" id="post_all_tenants" value="post_all_tenants"
                        name="post_tenants_type"
                        class="custom-control-input" required checked>
                    <label class="custom-control-label"
                        for="post_all_tenants">{{__('Post to all tenants')}}</label>
                </div>
            </div>
            <div class="col-12">
                <div class="custom-control custom-radio">
                    <input type="radio" id="post_selected_tenants" value="post_selected_tenants"
                        name="post_tenants_type"
                        class="custom-control-input" required>
                    <label class="custom-control-label"
                        for="post_selected_tenants">{{__('Post to selected tenants')}}</label>
                </div>

                <div class="pl-5 py-2 max-h-200-overflow" id="tenant_news_div">

                </div>
            </div>
        </div>
        <input type="hidden" name="tenants" value="ALL">
    @endif

    <div class="row text-right">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pt-4">
            <x-button type="button" sm pill id="btn-create-newsfeed">{{ __('Save') }}</x-button>
            <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </div>
</x-form>
<script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('assets/libs/dropzone/common-file-upload.js')}}"></script>
<script type="text/javascript">
    var tenants = @json($tenants);;
    //console.log("tenants", tenants);
    $(document).on('change', 'input[name="post_tenants_type"]', function () {
        // const userGroup = $('#user_group').val();
        if ($(this).val() == "post_selected_tenants") {
            return populateTenantsNewsfeeds(tenants, []);
        }

        $('#tenant_news_div').empty().hide();
    });

    $(document).ready(function () {
        const tenant_post_setting = $('input[name="post_tenants_type"]:checked').val();
        if (tenant_post_setting == "post_selected_tenants") {
            populateTenantsNewsfeeds(tenants, []);
        }else{
            $('#tenant_news_div').empty().hide();
        }


    })

    $(document).on('click', '#btn-create-newsfeed', function(e) {
        // Make sure that the form isn't actually being sent.
        e.preventDefault();

        var selected_tenants = [];
        var tenant_post_setting = '';

        //get the form data in object form
        var form_data = $('#upload-form').serializeArray().reduce(function(a, x) { a[x.name] = x.value; return a; }, {});
        //console.log('form_data', form_data);

        //if selected tenants exist
        $('input[name="selected_tenants[]"]:checked').each(function() {
            selected_tenants.push(this.value);
        });
        //console.log('selected_tenants', selected_tenants)

        tenant_post_setting = $('input[name="post_tenants_type"]:checked').val();

        if(!form_data.title) {
            show_toastr("Error", "Title is required", "error");
        }else if (!form_data.detail){
            show_toastr("Error", "Detail is required", "error");
        }else if(tenant_post_setting == "post_selected_tenants"  && selected_tenants.length < 1){
            show_toastr("Error", "Please select tenants ", "error");
        }else{
            if(tenant_post_setting == "post_selected_tenants"){
                $('input[name="tenants"]').val(JSON.stringify(selected_tenants));
            }
            if (dropzone.files.length) {
                dropzone.processQueue(); // upload files and submit the form
            }else{
                $('#upload-form').submit();
            }
        }

    });

    dropzone.on("addedfiles", function(files) {

        for(var i = 0; i<files.length; i++){

            var file = files[i];

            var patternFileExtension = /\.([0-9a-z]+)(?:[\?#]|$)/i;

            var default_icon = @json(config('defaultIcon'));

            //Get the file Extension

            var fileExtension = (file.name).match(patternFileExtension);

            var default_icon_image = 'file.png';

            if(default_icon[fileExtension[0]] != null && default_icon[fileExtension[0]] != undefined && default_icon[fileExtension[0]] != ''){
                default_icon_image = default_icon[fileExtension[0]];
            }

            var icon_file = `{{asset(\Storage::url("icons/files"))}}/${default_icon_image}`;

            if(file.status == "error"){
                var errMessage = file.previewElement.childNodes[7].innerText;
                file.previewElement.parentNode.removeChild(file.previewElement);
                show_toastr("Error", errMessage, "error");
                return false;
            }else{
                $('.dz-message').find('.dz-default-message').addClass('d-none');
                file.previewElement.querySelector("img").src = icon_file;
                $(file.previewElement).find(".dz-remove").html('<i class="fas fa-trash-alt text-danger"></i>');
            }

        }
    });


    dropzone.on("removedfile", function (file) {
        $('.dz-message').find('.dz-default-message').removeClass('d-none');
    });

    dropzone.on('success', function(file, xhr, response){
        window.location.replace(xhr.redirect_route);
    });
</script>
