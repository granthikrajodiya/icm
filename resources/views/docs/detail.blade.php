<x-layouts.app title="{{ $arrDocData['DocTypeName'] }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-10">
                            <h6 class="d-inline-block mb-0"><i class="fa fa-file"></i> <span
                                    id="menu_title">{{ __('Documents') }}</span> @if (\Session::get('navigation_title') != $arrDocData['DocTypeName']): {{ $arrDocData['DocTypeName'] }}@endif</h6> -
                            {{ $arrDocData['DocTitle'] }}
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('docs.index', [tenant('tenant_id'), $arrDocData['DocTypeName']]) }}">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center" id="contentdiv"></div>
                        <div class="col-12 text-center">
                            <iframe id="docframe" src="" style="height:700px;width:100%;border: none;"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                var url = "{!! $frameUrl !!}";
                var xhr = new XMLHttpRequest();
                xhr.open('GET', url);
                xhr.onreadystatechange = handler;
                xhr.responseType = 'blob';
                xhr.setRequestHeader('UserName', "{{ $usrData->Username }}");
                xhr.setRequestHeader('SecurityToken', "{{ $usrData->SecurityToken }}");
                xhr.send();

                function handler() {
                    if (this.readyState === this.DONE) {
                        if (this.status === 200) {
                            // this.response is a Blob, because we set responseType above
                            var data_url = URL.createObjectURL(this.response);
                            document.querySelector('#docframe').src = data_url;
                        } else if (this.status == 404) {
                            downloaddoc();
                        } else {
                            document.querySelector('#contentdiv').innerHTML =
                                "<p>{{ __('There was a problem accessing the requested document. Please try again. If the problem continues, please contact your system administrator.') }}</p>";
                        }
                    }
                }
            });

            function downloaddoc() {
                var url = "{!! $frameUrl !!}";
                var xhr = new XMLHttpRequest();
                url = url.replace("fileFormat=pdf", "");
                xhr.open('GET', url);
                xhr.onreadystatechange = handler;
                xhr.responseType = 'blob';
                xhr.setRequestHeader('UserName', "{{ $usrData->Username }}");
                xhr.setRequestHeader('SecurityToken', "{{ $usrData->SecurityToken }}");
                xhr.send();

                function handler() {
                    if (this.readyState === this.DONE) {
                        if (this.status === 200) {
                            // this.response is a Blob, Because we set responseType above
                            var data_url = URL.createObjectURL(this.response);
                            document.querySelector('#docframe').src = data_url;
                        } else {
                            document.querySelector('#contentdiv').innerHTML =
                                "<p>{{ __('There was a problem accessing the requested document. Please try again. If the problem continues, please contact your system administrator.') }}</p>";
                        }
                    }
                }
            }
        </script>
    @endpush
</x-layouts.app>
