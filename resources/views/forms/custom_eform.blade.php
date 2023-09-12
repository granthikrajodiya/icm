<x-layouts.app title="{{ $view->title }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-10">
                            @if (\Session::has('from_notification'))
                                <h6 class="d-inline-block mb-0">
                                    <i class="fa fa-file-invoice"></i>
                                    <span>{!! \Session::get('from_notification') !!}</span>
                                </h6> : {{ $view->title }}
                            @else
                                <h6 class="d-inline-block mb-0">
                                    <i class="fa fa-file-invoice"></i>
                                    <span id="menu_title">{{ __('Form') }}</span>
                                </h6> : {{ $view->title }}
                            @endif
                        </div>
                        <div class="col text-right">
                            <a href="javascript:void(0)" class="back-page">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <iframe id="eform_frame" src="" style="height:900px;width: 100%;" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            var url = '{!! $view->eform_url !!}';
            $('#eform_frame').attr('src', '{{ config('ilinx.flex_init_url') }}');
            document.getElementById("eform_frame").addEventListener('load', function () {
                PassFormInfo();
            });

            function PassFormInfo() {
                formUrl = '{!! $view->eform_url !!}';
                var tenant_id = '{!! tenant('tenant_id') !!}';
				formUrl = formUrl + '&tenant_id=' + tenant_id;
                let frame = document.getElementById('eform_frame');
                // The format of this message is required. Do not modify.
                var message = {
                    action: "[init-embedded-eform]",
                    info: {
                        username: '{!! $usrData->Username !!}',
                        securityToken: '{!! $usrData->SecurityToken !!}',
                        eformUrl: formUrl
                    }
                };
                //console.log('PassFormInfo: postMessage: ' + JSON.stringify(message, null, 4));
                frame.contentWindow.postMessage(message, '*');
            }
        </script>
    @endpush
</x-layouts.app>
