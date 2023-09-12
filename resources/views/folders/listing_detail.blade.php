@php
$folderName = Crypt::decryptString($encodeFolderName);
@endphp
<x-layouts.app title="{{ $listName . ' - ' . $folderName }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-10">
                            @if (\Session::has('from_notification'))
                                <h6 class="d-inline-block mb-0"><i class="fa fa-folder-open"></i>
                                    <a href="#">{!! ($isFromNotification) ? $folderName : \Session::get('from_notification') !!}</a>
                                </h6> - <span class="text-muted">{{ $listName }}</span>
                            @else
                                <h6 class="d-inline-block mb-0"><i class="fa fa-folder-open"></i>
                                    <a href="{{ route('folder.index', tenant('tenant_id')) }}">
                                        <span id="menu_title">{{ ($isFromNotification) ? $folderName : Utility::getValByName('folder_menu') }}</span>
                                    </a>
                                    @if (\Session::get('navigation_title') != $folderName) : <a href="{{ route('folder.filter', [tenant('tenant_id'), $encodeFolderName]) }}">{{ $folderName }}</a> @endif
                                </h6> - <span class="text-muted">{{ $listName }}</span>
                            @endif
                        </div>
                        <div class="col text-right">
                            {{-- <a href="javascript:history.back()"> --}}
                            <div class="actions">
                                <div class="dropdown mr-2">
                                    <a href="javascript:void(0)" class="action-item" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item" id="updateDoc">{{__('Properties')}}</a>
                                    </div>
                                </div>
                                @if (!empty($folderName))
                                    <a href="javascript:void(0)" class="folder-back-page"
                                        data-link="{{ route('folder.filter', [tenant('tenant_id'), $encodeFolderName]) }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    {!! Form::open(['method' => 'POST', 'route' => ['folder.filter', [tenant('tenant_id'), $encodeFolderName]], 'id' => 'folder-filter-form', 'onsubmit' => 'function(){return false;}']) !!}
                                    {{ Form::hidden('action', 'back-page', ['class' => 'form-control']) }}
                                    {{ Form::hidden('isFromNotification', $isFromNotification, ['class' => 'form-control']) }}
                                    {!! Form::close() !!}
                                @else
                                    <a href="javascript:void(0)" class="back-page">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-4">
                            <div class="loader min-h-250 d-none">
                                <img src="{{asset('assets/img/loading.gif')}}" height="50px" width="50px" class="loading" alt="">
                            </div>
                            <div id="contentdiv"></div>
                        </div>
                        <div class="col-12 text-right" id="iframediv" style="height:850px;">
                            {{-- <iframe id="folderframe" src="" style="height:700px;width:100%;border: none;" allowfullscreen></iframe> --}}
                            @if(!empty($docuViewareControlHtml))
                            {!! $docuViewareControlHtml->{'HtmlContent'} !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('theme-script')
        <script src="{{ asset('assets/js/document-viewer.js') }}"></script>
    @endpush
    @push('script')
        <script>
            const docuViewareId = "{{ env('DOCUVIEWARE_ID') }}";
            const docId = "{{ $docId }}";
            var documentViewer = new DocumentViewer(docuViewareId);
            documentViewer.init();

            $(document).ready(function() {
                const url = "{!! $frameUrl !!}";
                const CsrfToken = "{{ csrf_token() }}"
                const getDocRoute = "{{ route('folder.document.get', tenant('tenant_id')) }}";
                const newOpenDocProps = "{!! $newOpenDocProps !!}";
                var type = 'application/pdf'

                fetch(getDocRoute, {
                    method: 'POST',
                    body: JSON.stringify({url}),
                    headers: {
                        'X-CSRF-TOKEN': CsrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                }).then(function(response) {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else if (response.status === 200) {
                        type = response.headers.get('Content-Type');
                        return response.blob()
                    } else {
                        return response.text().then(text => {throw new Error(text)})
                    }
                }).then(function (myBlob){
                    let fileData = myBlob
                    var file = new Blob([fileData], {type: type});
                    // document.querySelector('#folderframe').src = URL.createObjectURL(file)
                    documentViewer.viewDoc(file, docId);

                    if(newOpenDocProps){
                        $('#iframediv').removeClass('col-12');
                        $('#iframediv').addClass('col-8');
                        getDocProperties();
                    }
                })
                .catch((error) => {
                    const errorMessage = JSON.parse(error.message).message
                    show_toastr('Error', errorMessage, 'error');
                });
            });

            function getDocProperties(){
                $('#contentdiv').html('');
                $('.loader').removeClass('d-none');
                getAjax("{{route('folder.repo.get', [tenant('tenant_id'), $repositoryName,$docId,'update'])}}",function(response){

                    $('.loader').addClass('d-none');
                    if(response.Success){
                        addOpenDocPropToSession();
                        $('#contentdiv').html(response.html);

                        $('#collapsebutton').on('click',function(){
                            $('#contentdiv').html('');
                            $('#iframediv').removeClass('col-8');
                            $('#iframediv').addClass('col-12');
                            console.log("Aw");
                            removeOpenDocPropToSession()
                        });
                    }else{
                        show_toastr('Error', response.ErrorMessage, 'error');
                    }
                });
            }
            $('#updateDoc').on('click',function(e){
                $('#iframediv').removeClass('col-12');
                $('#iframediv').addClass('col-8');
                getDocProperties();
            });

            function addOpenDocPropToSession(){
                // remove docid in session openDocsProperties
                let url = "{{ route('add.OpenDocPropToSession',[tenant('tenant_id'),$docId]) }}"
                let data = "{!! $docId !!}";
                postAjax(url, {docID: data}, true, function (response) {});
                console.log("open again")
            }

            function removeOpenDocPropToSession(){
                console.log('remove?')
                // remove docid in session openDocsProperties
                let url = "{{ route('remove.OpenDocPropToSession',[tenant('tenant_id'),$docId]) }}"
                let data = "{!! $docId !!}";
                postAjax(url, {docID: data}, true, function (response) {});
            }



        </script>
    @endpush
</x-layouts.app>
