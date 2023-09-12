    <div class="row align-items-center">
        <div class="col">
            <ul class="nav nav-tabs nav-bordered mb-3">
                <li class="nav-item">
                    <a href="#properties" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                        <span class="d-lg-block">{{ __('Properties')}}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#designer" data-toggle="tab" aria-expanded="true" class="nav-link">
                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                        <span class="d-lg-block">{{ __('Designer')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#presentation" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                        <span class="d-lg-block">{{ __('Presentation')}}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="tab-content">
                <div class="tab-pane active show" id="properties">

                    <x-form id="propertiesSaveFormData" :action="route('qapp.properties',[tenant('tenant_id'), $qapp->id])" enctype="multipart/form-data">
                        <div class="row">
                            <x-input.text required name="name" :value="$qapp->name" container-class="col-xs-12 col-sm-12 col-md-4 col-lg-4"/>
                            <x-input.text required name="description" :value="$qapp->description" container-class="col-xs-12 col-sm-12 col-md-8 col-lg-8"/>

                            <div class="col-md-12 my-3">
                                <div class="d-flex align-items-center col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <x-input.checkbox name="online" id="online" label="App is online" default="false" value="1" :checked="$qapp->online == 1 ? true : false"/>
                                </div>
                            </div>

                            <div class="col-md-12 my-3">
                                <p class="mb-2">{{ __('Quick App data options') }}</p>
                                <input type="checkbox" name="allow_upload" value="1" class="mr-2" {{ $qapp->allow_upload == 1 ? 'checked' : "" }}> {{ __('Allow users to upload data (Excel, CSV)') }} <br>
                                <input type="checkbox" name="allow_download" value="1" class="mr-2" {{ $qapp->allow_download == 1 ? 'checked' : "" }}> {{ __('Allow users to download data') }} <br>
                                <input type="checkbox" name="allow_print" value="1" class="mr-2" {{ $qapp->allow_print == 1 ? 'checked' : "" }}> {{ __('Allow users to print data') }}
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label for="">{{ __('Content Store repository for attachments') }}</label>
                                <select name="ics_appname" class="form-control" id="">
                                    @foreach ($repositories as $repositorie)
                                        <option value="{{ $repositorie->RepositoryID }}" {{ $qapp->ics_appname ==  $repositorie->RepositoryID ? 'selected' : "" }}>{{ $repositorie->RepositoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-right pt-3">
                            <x-button type="button" sm pill id="propertiesSaveForm">{{ __('Create') }}</x-button>
                            <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
                        </div>

                    </x-form>

                </div>

                <div class="tab-pane" id="designer">

                    <div id="designerForm">
                        <div id="build-wrap"></div>
                        <div class="text-right pt-3">
                            <x-button type="button" sm primary pill id="previewForm">{{ __('Preview') }}</x-button>
                            <x-button type="button" sm primary pill id="designerSaveForm">{{ __('Save') }}</x-button>
                        </div>
                    </div>

                    <div class="d-none" id="previewDesignerForm">
                        <div id="preview_form"></div>
                        <div class="text-right pt-3">
                            <x-button type="button" sm primary pill id="backToDesigner">{{ __('Back to designer') }}</x-button>
                        </div>
                    </div>


                </div>

                <div class="tab-pane" id="presentation">

                    <x-form id="presentationSaveFormData" :action="route('qapp.presentation',[tenant('tenant_id'), 1])" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-12">
                                <p>{{ __('How would you like to display your Quick App data?') }}</p>
                            </div>

                            <div class="ml-3">
                                <div class="col-md-12 mb-3">
                                    <p class="mb-2">{{ __('Home Page Cards') }}</p>
                                    <div>
                                        <input type="radio" name="card_mode" value="1" class="mr-3" {{ $qapp->card_mode == 1 ? 'checked' : "" }}> Simple list
                                    </div>
                                    <div>
                                        <input type="radio" name="card_mode" value="2" class="mr-3" {{ $qapp->card_mode == 2 ? 'checked' : "" }}> Advanced list
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <p class="mb-2">{{ __('Navigations') }}</p>
                                    <div>
                                        <input type="radio" name="navigation_mode" value="1" class="mr-3" {{ $qapp->navigation_mode == 1 ? 'checked' : "" }}> Advanced list
                                    </div>
                                    <div>
                                        <input type="radio" name="navigation_mode" value="2" class="mr-3" {{ $qapp->navigation_mode == 2 ? 'checked' : "" }}> Cards and grid
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="text-right pt-3">
                            <x-button type="button" sm pill id="presentationSaveForm">{{ __('Create') }}</x-button>
                            <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
                        </div>

                    </x-form>

                </div>
            </div>
        </div>
    </div>



<script>
    $( document ).ready(function() {
        const fbTemplate = document.getElementById('build-wrap');
        var formData = '{{ $qapp->form_json }}';
            if(formData){
                var formData = JSON.parse(formData.replace(/&quot;/g,'"'));
            }else{
                var formData = "";
            }
        var options = {
            disabledActionButtons: ['data','save','clear'],
            dataType: 'json',
            formData: formData
        };
        var formBuilder = $(fbTemplate).formBuilder(options);

        $("#previewForm").click(function(){
            var formData = formBuilder.actions.getData();
            formRenderOpts = {
                dataType: 'xml',
                formData: formData
            };
            var renderedForm = $('<div>');
            renderedForm.formRender(formRenderOpts);
            $('#preview_form').html(renderedForm.html());
            $('#designerForm').addClass('d-none');
            $('#previewDesignerForm').removeClass('d-none');
        });

        $("#backToDesigner").click(function(){
            $('#previewDesignerForm').addClass('d-none');
            $('#designerForm').removeClass('d-none');
        });

        $("#designerSaveForm").click(function(){
            var formData = formBuilder.actions.getData();
            var qappId = '{{ $qapp->id }}';
            $.ajax({
                type: "POST",
                url: '{{ route('qapp.designer', tenant('tenant_id')) }}',
                dataType: 'json',
                data: {
                    json: JSON.stringify(formData),
                    qappId: qappId,
                },
                success: function (data) {
                    show_toastr('Success', data.message, 'success');
                }
            });
        });

        $("#propertiesSaveForm").click(function(){
            var formData = $('#propertiesSaveFormData').serialize();
            $.ajax({
                type: "POST",
                url: '{{ route('qapp.properties', [tenant('tenant_id'), $qapp->id]) }}',
                dataType: 'json',
                data: formData,
                success: function (data) {
                    show_toastr('Success', data.message, 'success');
                }
            });
        });

        $("#presentationSaveForm").click(function(){
            var formData = $('#presentationSaveFormData').serialize();
            $.ajax({
                type: "POST",
                url: '{{ route('qapp.presentation', [tenant('tenant_id'), $qapp->id]) }}',
                dataType: 'json',
                data: formData,
                success: function (data) {
                    show_toastr('Success', data.message, 'success');
                }
            });
        });
    });
</script>




