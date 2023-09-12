<div class="row">
    <div class="col-12 pb-3">
        <div class="row justify-content-between align-items-center">
            <div class="col-10">
                <h6 class="d-inline-block mb-0"><i class="fa fa-file"></i> {{$arrDocData['DocTypeName']}} </h6>
                - {{ $arrDocData['DocTitle'] }}
            </div>
            <div class="col text-right">
                <a href="#" id="closeDoc">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 text-center" id="contentdiv"></div>
    <div class="col-12 text-center" style="height:850px;">
        {{-- <iframe id="docframe_detail" src="" style="height:700px;width:100%;border: none;" allowfullscreen></iframe> --}}
        @if(!empty($docuViewareControlHtml))
        {!! $docuViewareControlHtml->{'HtmlContent'} !!}
        @endif
    </div>
</div>

<script src="{{ asset('assets/js/document-viewer.js') }}"></script>
<script>
    const docuViewareId = "{{ env('DOCUVIEWARE_ID') }}";
    const docId = "{{ $docId }}";
    var documentViewer = new DocumentViewer(docuViewareId);
    documentViewer.init();

    $(document).ready(function () {
        let docUrl = "{!! $frameUrl !!}";
        let csrfToken = "{!! csrf_token() !!}";
        let baseUrl = "{{ route('tasks.get-file', tenant('tenant_id')) }}";
        var type = 'application/pdf';

        fetch(baseUrl, {
            method: 'POST',
            body: JSON.stringify({
                url: docUrl,
            }),
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(function (response) {
            if (response.redirected) {
                window.location.href = response.url;
                return false;
            } else if (response.status === 200) {
                type = response.headers.get('Content-Type');
                return response.blob();
            } else {
                return document.querySelector('#contentdiv').innerHTML = "<p>{{__('There was a problem accessing the requested document. Please try again. If the problem continues, please contact your system administrator.')}}</p>";
            }
        }).then(function (myBlob) {
            var file = new Blob([myBlob], {type: type});
            // document.querySelector('#docframe_detail').src = URL.createObjectURL(file)
            documentViewer.viewDoc(file, docId);
        });
    });
</script>
