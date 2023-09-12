<x-layouts.app
    title="{{ $batchName.' '.__('Form') }}"
>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-10">
                            <h6 class="d-inline-block mb-0">
                                <i class="fa fa-file-invoice"></i>
                                <span id="menu_title">{{ __('Form') }}</span>
                                @if (\Session::get('navigation_title') != $batchName)
                                    : {{ $batchName . __(' Form') }}
                                @endif
                            </h6> - {{ $title }}
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('batch.detail',[tenant('tenant_id'),$batchName]) }}">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <iframe id="formFrame" src="" style="height:720px;width: 100%;" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            var url = '{!! $url !!}';
            $('#formFrame').attr('src', '{{ config('ilinx.flex_init_url') }}');
            document.getElementById("formFrame").addEventListener('load', function () {
                PassFormInfo();
            });

            function PassFormInfo() {
                formUrl = '{!! $url !!}';
                var tenant_id = '{!! tenant('tenant_id') !!}';
				formUrl = formUrl + '&tenant_id=' + tenant_id;
                let frame = document.getElementById('formFrame');
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


