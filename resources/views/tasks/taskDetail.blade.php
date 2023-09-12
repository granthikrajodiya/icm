<div class="row">
    <div class="col-12 pb-3">
        <div class="row justify-content-between align-items-center">
            <div class="col-10">
                <h6 class="d-inline-block mb-0"><i class="fa fa-file-invoice"></i> {{$arrTaskData['batchName']}}
                </h6> - {{ $arrTaskData['title'] }}
            </div>
            <div class="col text-right">
                <a href="#" id="closeTask">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
        <div class="col-12 text-center">
            <iframe id="formFrame" src="" style="height:720px;width: 100%;" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script>
    var url = '{!! $url !!}';
    $('#formFrame').attr('src', '{{config('ilinx.flex_init_url')}}');
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

