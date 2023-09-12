<x-layouts.app title="{!! $newsfeed->title !!}">
    @push('css')
    <link rel="stylesheet" href="{{asset('assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.css')}}">
    @endpush
    @php
        $dateformat = Utility::getValByName('date_format');
    @endphp
    <div id="carouselExampleControls" class="carousel" data-interval="false">
        <div class="carousel-inner news">
            <div class="carousel-item active">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-10">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="h5 mb-0 post_title text-primary">{{__('News')}}
                                            <span class="h5 post_title"> - {!! $newsfeed->title !!}</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-right">
                                <a href="javascript:history.back()" class="back-page" >
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($newsfeed->image)
                            <div class="overflow-hidden">
                                <div class="animate-this max-h-350">
                                    <a href="{{asset(Storage::url($newsfeed->image))}}" data-fancybox data-caption="{!! $newsfeed->title !!}">
                                        <img src="{{asset(Storage::url($newsfeed->image))}}" class="post_image_detail">
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="row align-items-center mb-3 mt-3">
                            <div class="col text-right">
                                <span class="post_subtitle">{{$newsfeed->user->name}} - {{Utility::getDateFormatted($newsfeed->created_at,false,$dateformat)}}</span>
                            </div>
                        </div>
                        <div class="card-text mt-2 mb-2">{!! $newsfeed->detail !!}</div>
                    </div>
                    <div class="card-footer">
                        <div class="row actions d-flex justify-content-between px-4 align-self-center">
                            <div class="col action-item">
                                <a class="carousel-control-prev post-detail-prev" href="" role="button" data-slide="prev">
                                    <span class="text-primary">Previous</span>
                                </a>
                            </div>
                            <div class="col action-item text-center">
                                <a class="" href="{{ route('newsfeed.list', [tenant('tenant_id')]) }}">
                                    <span class="text-primary">{{__('See all...')}}</span>
                                </a>
                            </div>
                            <div class="col action-item">
                                    <a class="action-item carousel-control-next post-detail-next" href="" role="button" data-slide="next">
                                        <span class="text-primary">Next</span>
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    @push('script')
        <script src="{{asset('assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js')}}"></script>
        <script>

            $(document).ready(function(e) {
                sessionStorage.setItem("newsfeeds",'{{ Session::get('newsfeeds') }}');

                var news_feeds = sessionStorage.getItem("newsfeeds");

                //parse string to array
                news_feeds = news_feeds.replace(/'/g, '"');
                news_feeds = JSON.parse(news_feeds);

                //get the index of the current article
                var curr_id = {{$newsfeed->id}};
                var curr_index = news_feeds.indexOf(curr_id);

                if(curr_index != 0){
                    var url = '{{route('newsfeed.show',[tenant('tenant_id'), ':newsfeed_id'])}}';
                    url = url.replace(':newsfeed_id', news_feeds.at(curr_index-1));

                    $('.post-detail-prev').show();
                    $('.post-detail-prev').attr('href', url);
                }else{
                    $('.post-detail-prev').hide();
                }
                if(curr_index != news_feeds.length-1){
                    var url = '{{route('newsfeed.show',[tenant('tenant_id'), ':newsfeed_id'])}}';
                    url = url.replace(':newsfeed_id', news_feeds.at(curr_index+1));

                    $('.post-detail-next').show();
                    $('.post-detail-next').attr('href', url);
                }else{
                    $('.post-detail-next').hide();
                }

            });

            $('.carousel').carousel({
                interval: false,
            });
        </script>
    @endpush
</x-layouts.app>
