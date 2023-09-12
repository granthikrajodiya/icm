<x-layouts.app>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center" id="contentdiv"></div>
                        <div class="col-12 text-center">
                            <iframe id="folderframe" src="" style="height:700px;width:100%;border: none;"
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
                var url = "{!! $url !!}";
                var xhr = new XMLHttpRequest();
                xhr.open('{{ $method }}', url);
                xhr.onreadystatechange = handler;
                xhr.responseType = 'blob';
                var decoded = "{{ $parsed }}".replace(/&quot;/g, '"');

                var parse = JSON.parse(decoded);

                $.each(parse, function(k, v) {
                    xhr.setRequestHeader(k, v);
                });


                xhr.send();

                function handler() {
                    if (this.readyState === this.DONE) {
                        if (this.status === 200) {
                            // this.response is a Blob, because we set responseType above
                            var data_url = URL.createObjectURL(this.response);
                            document.querySelector('#folderframe').src = data_url;
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
                var url = "{!! $url !!}";
                var xhr = new XMLHttpRequest();
                url = url.replace("fileFormat=pdf", "");
                xhr.open("{{ $method }}", url);
                xhr.onreadystatechange = handler;
                xhr.responseType = 'blob';

                var decoded = "{{ $parsed }}".replace(/&quot;/g, '"');

                var parse = JSON.parse(decoded);

                $.each(parse, function(k, v) {
                    xhr.setRequestHeader(k, v);
                });

                xhr.send();

                function handler() {
                    if (this.readyState === this.DONE) {
                        if (this.status === 200) {
                            // this.response is a Blob, Because we set responseType above
                            var data_url = URL.createObjectURL(this.response);
                            document.querySelector('#folderframe').src = data_url;
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
