<iframe id="addDoc" src="" style="height: 450px;width: 450px;" allowfullscreen></iframe>

<script>
    var url = '{!! $addDocUrl !!}';
    $('#addDoc').attr('src', '{{config('ilinx.flex_init_url')}}');
    document.getElementById("addDoc").addEventListener('load', function () {
        PassFormInfo();
    });

    function PassFormInfo() {
        formUrl = '{!! $addDocUrl !!}';
        var tenant_id = '{!! tenant('tenant_id') !!}';
		formUrl = formUrl + '&tenant_id=' + tenant_id;
        let frame = document.getElementById('addDoc');
        var message = {
            action: "[init-embedded-eform]",
            info: {
                username: '{!! $usrData->Username !!}',
                securityToken: '{!! $usrData->SecurityToken !!}',
                eformUrl: formUrl
            }
        };
        frame.contentWindow.postMessage(message, '*');
    }
</script>
