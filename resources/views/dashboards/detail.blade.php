<x-layouts.app title="{{ $dashboardData->Name }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-10">
                            <h6 class="d-inline-block mb-0"><i class="fa fa-chart-bar"></i>
                                <span id="menu_title">{{ __('Dashboard') }}</span>
                            </h6> : {{ $dashboardData->Name }}
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
                            <iframe id="dashboardFrame" src="" style="height:{{ $dashboardData->height }}px;width: 100%;"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            const flexUrl = '{{ config('ilinx.flex_url') }}'
            $('#dashboardFrame').attr('src', flexUrl + "/init-embedded-dashboard");
            document.getElementById("dashboardFrame").addEventListener('load', function() {
                PassFormInfo();
            });

            function PassFormInfo() {
                viewUrl = '{!! $dashboardData->ViewUrl !!}';
				var tenant_id = '{!! tenant('tenant_id') !!}';
				viewUrl = viewUrl + '&tenant_id=' + tenant_id;
                let frame = document.getElementById('dashboardFrame');
                // The format of this message is required. Do not modify.
                var message = {
                    action: "[init-embedded-dashboard]",
                    info: {
                        username: '{!! $usrData->Username !!}',
                        securityToken: '{!! $usrData->SecurityToken !!}',
                        dashboardUrl: viewUrl
                    }
                };
                // console.log('PassFormInfo: postMessage: ' + JSON.stringify(message, null, 4));
                frame.contentWindow.postMessage(message, '*');
            }
        </script>
    @endpush
</x-layouts.app>
