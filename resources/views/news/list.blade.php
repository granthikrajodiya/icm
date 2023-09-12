

<x-layouts.app title="{!! $title !!}">
    <div class="row">
        @php
            $dateformat = Utility::getValByName('date_format');
        @endphp
        <div class="col-12">

            @foreach($newsfeeds as $key => $newsfeed)

                <div class="card overflow-hidden">

                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="overflow-hidden">
                                            <h5 class="h5 mb-0 text-muted overflow-hidden text-truncate post_title">
                                                <a href="{{ route('newsfeed.show',[tenant('tenant_id'), $newsfeed->id]) }}"
                                                    class="post_title " >
                                                    {!! $newsfeed->title !!}
                                                </a>
                                            </h5>
                                </div>
                            </div>
                        </div>

                    <div class="card-body">

                        @php
                            if ($newsfeed->image) {
                                    if($newsfeed->image_placement == "center"){
                                        $imageClass = "12";
                                        $contentClass = "12";
                                        $textAlign = 'text-right';
                                    }elseif($newsfeed->image_placement == "right"){
                                        $imageClass = "4 order-lg-2";
                                        $contentClass = "8 order-lg-1";
                                        $textAlign = '';
                                    }else{
                                        $imageClass = "4";
                                        $contentClass = "8";
                                        $textAlign = '';
                                    }
                                } else {
                                    $contentClass = "12";
                                    $textAlign = '';
                                }
                        @endphp
                        <div class="row">
                            @if ($newsfeed->image)
                            <div class="col-{{$imageClass}}">
                                    <div class="overflow-hidden {{$newsfeed->image_placement == 'center' ? 'h-200' : 'max-h-200'}}">
                                        <div class="animate-this">
                                            <a href="{{ route('newsfeed.show',[tenant('tenant_id'), $newsfeed->id]) }}">
                                                <img alt="Image placeholder" src="{{asset(Storage::url($newsfeed->image))}}" class="post_image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-{{$contentClass}}">
                                <div class="row">
                                    <div class="col-12 {{$textAlign}} mt-2 mb-2">
                                        <span class="post_subtitle">{{$newsfeed->user->name}} - {{Utility::getDateFormatted($newsfeed->created_at,false,$dateformat)}}</span>
                                    </div>
                                    <div class="shortened_txt col-12 card-text mt-2 mb-2 text-muted {{$newsfeed->excerpt_length > 0 ? 'overflow-hidden' : 'overflow-auto'}} max-h-350" id="shortened_txt_{{$newsfeed->id}}" >
                                        {!! $newsfeed->detail !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-right {{$newsfeed->image_placement == 'right' ? 'order-lg-3' : ''}}">
                                <a href="{{ route('newsfeed.show', [tenant('tenant_id'), $newsfeed->id]) }}" >
                                    <span class="text-primary">{{__('Read more...')}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if(!is_null($nextPage))
        <div class="row nextpage text-center mt-2">
            <div class="col-12">
                <a href="{{$nextPage}}" >{{__('Show more posts...')}}</a>
            </div>
        </div>
    @endif
    @push('script')
        <script src="{{asset('assets/libs/truncate-fit-container-height/lc_text_shortener.js')}}" type="text/javascript"></script>

        <script type="text/javascript">
            sessionStorage.setItem("newsfeeds",'{{ Session::get('newsfeeds') }}');


            $(document).ready(function(e) {
                @foreach($newsfeeds as $key => $newsfeed)
                    @if($newsfeed->excerpt_length > 0)
                        $(`#shortened_txt_{{$newsfeed->id}}`).lc_txt_shortener('...', {{$newsfeed->excerpt_length}}, '');
                        var text = $(`#shortened_txt_{{$newsfeed->id}}`).find('.lcts_end_txt').closest("p").text();
                        var replace = new RegExp('...' + '$');
                        var str = text.replace(replace, '');
                        str = str.trimEnd();
                        $(`#shortened_txt_{{$newsfeed->id}}`).find('.lcts_end_txt').closest("p").html(str+'...');
                    @endif
                @endforeach
            });

        </script>
    @endpush
</x-layouts.app>
