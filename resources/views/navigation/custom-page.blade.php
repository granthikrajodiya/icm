<x-layouts.app title="{!! $navigation->title !!}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <iframe id="customPageFrame" src="{!! $navigation->data_source !!}" frameborder="0" style="height:720px;width: 100%;" data-title="{!! $navigation->title !!}"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>

        document.getElementById("customPageFrame").addEventListener('load', function() {
            PassFormInfo();
        });

        function PassFormInfo() {
            let title = $('#customPageFrame').data('title');
            let frame = document.getElementById('customPageFrame');
            // The format of this message is required. Do not modify.
            var message = {
                action: "[init-embedded-eform]",
                info: {
                    userName: '{!! $usrData->Username !!}',
                    fullName: '{!! $usrData->FullName !!}',
                    emailAddress: '{!! $usrData->EmailAddress !!}',
                    tenantId: '{!! $usrData->TenantId !!}',
                    userId: '{!! $usrData->UserID !!}',
                    securityToken: '{!! $usrData->SecurityToken !!}',
                    title : title
                }
            };
            //console.log('PassFormInfo: postMessage: ' + JSON.stringify(message, null, 4));
            frame.contentWindow.postMessage(message, '*');
        }
    </script>
@endpush
</x-layouts.app>
