@props([
    'title'        => 'ImageSource',
    'header',
    'actionButton',
])
<nav
    class="navbar navbar-main navbar-expand-lg navbar-dark {{(Utility::getSiteContent('banner_type') == 'color') ? 'bg-primary' : ''}} navbar-border"
    id="navbar-main">
    <div class="container-fluid">
        <!-- User's navbar -->
        <div class="navbar-user d-lg-none ml-auto">
            <ul class="navbar-nav flex-row align-items-center">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                       data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                {{-- @if (user()->account_type != 3) --}}
                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link nav-link-icon {{(user()->getUnreadNotification()->count() > 0) ? 'beep':''}}"
                           href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fas fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                            <div class="py-3 px-3">
                                <h5 class="heading h6 mb-0 float-left">{{__('Notifications')}}</h5>
                                <a href="#" data-link="{{ route('notification.mark.read',tenant('tenant_id')) }}"
                                   class="link link-sm link--style-3 float-right non_title">{{__('Mark All As Read')}}</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="list-group list-group-flush mh-430 overflow-auto">
                                @if (user()->getUnreadNotification()->count() > 0)
                                    @foreach (user()->getUnreadNotification() as $notification)
                                        <div class="list-group-item list-group-item-action">
                                            {{-- @if ($notification->created_at > user()->notifications_read  &&$notification->created_at <= user()->last_login_at) --}}
                                            {{-- <small
                                            class="float-right badge badge-sm badge-info">{{ __('Unread') }}</small> --}}
                                            @if( $notification->created_at > user()->last_login_at && $notification->created_at > user()->notifications_read )
                                                <small
                                                    class="float-right badge badge-sm badge-success">{{__('New')}}</small>
                                            @endif
                                            <div class="d-flex align-items-center" data-toggle="tooltip"
                                                 data-placement="right"
                                                 data-title="{{ Utility::getDateFormatted($notification->created_at,true) }}">
                                                <div>
                                                    <span class="avatar bg-dark text-white rounded-circle"><i
                                                            class="fas {{ (!empty($notification->type)) ? $notification->type : 'fa-cogs' }}"></i></span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">{{ mb_strimwidth($notification->text, 0, 100, "...") }}</div>
                                                    <p class="text-sm lh-140 mb-0">{{ Utility::getDateFormatted($notification->created_at,true) }}</p>
                                                    @if (!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type))

                                                    @if ($notification->link_type == 'calendar')
                                                        <a class="calendar_notif"
                                                        href="{!! \App\Models\UserNotification::getLink( $notification->id) !!}"
                                                        data-notification="{{ $notification->id }}"
                                                        data-title="{!! \App\Models\Calendar::getCalendarName($notification->link_url)  !!}">
                                                            <small
                                                                class="float-left badge badge-sm {{ $notification->link_color }} text-white"
                                                                data-type='{{$notification->link_type}}'
                                                            >
                                                                {{ $notification->link_title }}
                                                            </small>
                                                        </a>
                                                    @else
                                                        <a href="{!! \App\Models\UserNotification::getLink($notification->id) !!}"
                                                        data-title="{!! $notification->link_title !!}"
                                                        data-notification="{{ $notification->id }}"
                                                        class="from_notification on-click-notification">
                                                            <small class="float-left badge badge-sm {{ $notification->link_color }} text-white" >
                                                                {{ $notification->link_title }}
                                                            </small>
                                                        </a>
                                                    @endif

                                                        <div class="clearfix"></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                @else
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="text-center">
                                            <div
                                                class="text-sm lh-150 font-weight-bold">{{__('No New Notifications')}}</div>
                                        </div>
                                    </a>
                                @endif
                            </div>
                            <div class="py-3 text-center">
                                <a href="#" data-link="{{ route('notification.index',tenant('tenant_id'),) }}"
                                   class="link link-sm link--style-3 non_title">{{__('See all notifications')}}</a>
                            </div>
                        </div>
                    </li>
                    @php
                        $layoutDefinitionslist = \App\Models\LayoutDefinition::layoutDefinitions();
                    @endphp
                    @if (count($layoutDefinitionslist)>0)
                        <li class="nav-item dropdown dropdown-animate">
                            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i class="fas fa-th"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-md dropdown-menu-arrow p-0">
                                <div class="py-3 px-3">
                                    <h5 class="heading h6 mb-0 float-left">{{__('Layout')}}</h5>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="list-group list-group-flush">
                                    @foreach ($layoutDefinitionslist as $did => $dtitle)
                                        <a href="#" data-link="{{ route('update.layout.store',[tenant('tenant_id'),$did]) }}"
                                           class="list-group-item list-group-item-action non_title">
                                            <div class="flex-fill">
                                                <div class="h6 text-sm mb-0">{{$dtitle}}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="py-1 text-center"></div>
                            </div>
                        </li>
                    @endif

                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                      <span class="avatar avatar-sm rounded-circle">
                        <img class="avatar avatar-sm rounded-circle" {{ user()->img_avatar }} >
                      </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                            <h6 class="dropdown-header px-0">{{__('Hi,')}} {{ user()->name }}</h6>
                            <a href="#" data-link="{{ route('profile',tenant('tenant_id')) }}" class="dropdown-item non_title">
                                <i class="fas fa-user"></i>
                                <span>{{__('My profile')}}</span>
                            </a>

                            @if(user()->account_type == 1 && Utility::getValByName('show_activities') == '1')
                                <a href="#" data-link="{{ route('activity.index',tenant('tenant_id'),) }}" class="dropdown-item non_title">
                                    <i class="fas fa-list-ul"></i>
                                    <span>{{__('Activities')}}</span>
                                </a>
                            @elseif(Utility::getSiteContent('show_activities') == '1')
                                <a href="#" data-link="{{ route('activity.index',tenant('tenant_id'),) }}" class="dropdown-item non_title">
                                    <i class="fas fa-list-ul"></i>
                                    <span>{{__('Activities')}}</span>
                                </a>
                            @endif
                            @if (user()->account_type == 1 || user()->account_type == 4)
                                <a href="#" data-link="{{ route('settings',tenant('tenant_id')) }}" class="dropdown-item non_title">
                                    <i class="fas fa-user"></i>
                                    <span>{{__('Settings')}}</span>
                                </a>
                            @endif
                            @php
                                $packageExtraProfileNav = [];
                                $packageLayout = config('package-layout');
                                if ($packageLayout) {
                                    foreach ($packageLayout as $pk => $v) {
                                        if (isset($v['extra_profile_navigation']) && !empty($v['extra_profile_navigation']) && \Illuminate\Support\Facades\Route::has($v['extra_profile_navigation']['route'])) {
                                            $packageExtraProfileNav[$pk] = $v['extra_profile_navigation'];
                                        }
                                    }
                                }
                            @endphp
                            @if ($packageExtraProfileNav)
                                @foreach ($packageExtraProfileNav as $pk => $v)
                                    <a href="{{ route($v['route'], tenant('tenant_id')) }}" class="custom-nav-link">
                                        {!! $v['icon'] !!}
                                        <span>{{ $v['title'] }}</span>
                                    </a>
                                @endforeach
                            @endif
                            <div class="dropdown-divider"></div>
                            <a
                                class="dropdown-item"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            >
                                <i class="fas fa-sign-out-alt"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                        </div>
                    </li>
                {{-- @endif --}}
            </ul>
        </div>

        <!-- Navbar nav -->
        <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
            <ul class="navbar-nav align-items-lg-center">
                <li class="border-top opacity-2 my-2"></li>
                <li class="nav-item {{(Session::get('navigation_title') == 'home') ? 'active' : '' }}">
                    <a class="nav-link pl-lg-0 main_title" href="#" data-link="{{ route('home',tenant('tenant_id')) }}">{{__('Home')}}</a>
                </li>

                @foreach (\App\Models\Navigation::navigationResult('top') as $topbar)
                    <li class="nav-item">
                        @if($topbar['contentType'] == 'Custom HTML' && $topbar['advConfig']  == '1')
                            <a class="nav-link pl-lg-0 {{(Session::get('navigation_title') == $topbar['title']) ? 'active' : '' }} " target="_blank"
                            href="{{ $topbar['datasource'] }}" data-title="{{$topbar['title']}}">
                                {{ $topbar['title'] }}
                            </a>
                        @else
                            <a class="nav-link pl-lg-0 {{(Session::get('navigation_title') == $topbar['title']) ? 'active' : '' }} main_title"
                                href="#" data-link="{{ $topbar['link'] }}" data-title="{{$topbar['title']}}">
                                {{ $topbar['title'] }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
            <ul class="navbar-nav ml-lg-auto align-items-center d-none d-lg-flex">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                       data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                {{--Notification Menu--}}
                {{-- @if (user()->account_type != 3) --}}
                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link nav-link-icon {{(user()->getUnreadNotification()->count() > 0) ? 'beep':''}}"
                           href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fas fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                            <div class="py-3 px-3">
                                <h5 class="heading h6 mb-0 float-left">{{__('Notifications')}}</h5>
                                <a href="#" data-link="{{ route('notification.mark.read',tenant('tenant_id')) }}"
                                    class="link link-sm link--style-3 float-right non_title">{{__('Mark All As Read')}}</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="list-group list-group-flush mh-430 overflow-auto">
                                @if (user()->getUnreadNotification()->count() > 0)
                                    @foreach (user()->getUnreadNotification() as $notification)
                                    <div class="list-group-item list-group-item-action"  >

                                            {{-- @if ($notification->created_at > user()->notifications_read  &&$notification->created_at <= user()->last_login_at) --}}
                                                {{-- <small  class="float-right badge badge-sm badge-info">{{ __('Unread') }}</small> --}}
                                            @if( $notification->created_at > user()->last_login_at && $notification->created_at > user()->notifications_read )
                                                <small
                                                    class="float-right badge badge-sm badge-success">{{__('New')}}</small>
                                            @endif
                                            <div class="d-flex align-items-center" data-toggle="tooltip"
                                                data-placement="right"
                                                data-title="{{ Utility::getDateFormatted($notification->created_at,true) }}">
                                                <div>
                                                    <span class="avatar bg-dark text-white rounded-circle"><i
                                                            class="fas {{ (!empty($notification->type)) ? $notification->type : 'fa-cogs' }}"></i></span>
                                                </div>
                                                <div class="flex-fill ml-3">
                                                    <div class="h6 text-sm mb-0">{{ mb_strimwidth($notification->text, 0, 100, "...") }}</div>
                                                    <p class="text-sm lh-140 mb-0">{{ Utility::getDateFormatted($notification->created_at,true) }}</p>

                                                    @if (!empty($notification->link_title) && !empty($notification->link_color) && !empty($notification->link_url) && !empty($notification->link_type))

                                                    @if ($notification->link_type == 'calendar')
                                                        <a class=" calendar_notif non_title" href="#" data-link="{!! \App\Models\UserNotification::getLink($notification->id) !!}"
                                                            data-notification="{{ $notification->id }}"
                                                            data-title="{!! \App\Models\Calendar::getCalendarName($notification->link_url) !!}"
                                                            >
                                                            <small class="float-left badge badge-sm {{ $notification->link_color }} text-white"
                                                                data-type='{{$notification->link_type}}'>
                                                                {{ $notification->link_title }}
                                                            </small>
                                                        </a>
                                                    @else
                                                        <a href="#" data-link="{!! \App\Models\UserNotification::getLink($notification->id) !!}"
                                                            class="from_notification on-click-notification non_title"
                                                            data-title="{!! $notification->link_title !!}"
                                                            data-notification="{{ $notification->id }}"
                                                            >

                                                            <small class="float-left badge badge-sm  {{ $notification->link_color }} text-white" >
                                                                {{ $notification->link_title }}
                                                            </small>
                                                        </a>
                                                    @endif
                                                        <div class="clearfix"></div>
                                                    @endif
                                                </div>
                                            </div>

                                    </div >
                                    @endforeach
                                @else
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="text-center">
                                            <div
                                                class="text-sm lh-150 font-weight-bold">{{__('No New Notifications')}}</div>
                                        </div>
                                    </a>
                                @endif
                            </div>
                            <div class="py-3 text-center">
                                <a href="#" data-link="{{ route('notification.index',tenant('tenant_id'),) }}"
                                   class="link link-sm link--style-3 non_title">{{__('See all notifications')}}</a>
                            </div>
                        </div>
                    </li>
                    @php
                        $layoutDefinitionslist = \App\Models\LayoutDefinition::layoutDefinitions();
                    @endphp
                    @if (count($layoutDefinitionslist)>0)
                        <li class="nav-item dropdown dropdown-animate">
                            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i class="fas fa-th"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-md dropdown-menu-arrow p-0">
                                <div class="py-3 px-3">
                                    <h5 class="heading h6 mb-0 float-left">{{__('Layout')}}</h5>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="list-group list-group-flush">
                                    @foreach ($layoutDefinitionslist as $did => $dtitle)
                                        <a href="#" data-link="{{ route('update.layout.store',[tenant('tenant_id'),$did]) }}"
                                           class="list-group-item list-group-item-action non_title">
                                            <div class="flex-fill">
                                                <div
                                                    class="h6 text-sm mb-0 {{(user()->layout_definition == $did) ? 'text-primary' : '-'}}">{{$dtitle}}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="py-1 text-center"></div>
                            </div>
                        </li>
                    @endif
                    @php
                        $userPerms = \App\Models\ModulePermissionAssignment::userPermissions();
                    @endphp
                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="media media-pill align-items-center">
                            <span class="avatar rounded-circle">
                              <img class="avatar rounded-circle" {{ user()->img_avatar }}>
                            </span>
                                <div class="ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">{{ user()->name }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                            <h6 class="dropdown-header px-0">{{__('Hi,')}} {{ user()->name }}</h6>
                            <a href="#" data-link="{{ route('profile',tenant('tenant_id')) }}" class="dropdown-item non_title">
                                <i class="fas fa-user"></i>
                                <span>{{__('My profile')}}</span>
                            </a>
                            @if (user()->account_type == 1 && Utility::getValByName('show_activities') == '1')

                                <a href="#" data-link="{{ route('activity.index',tenant('tenant_id'),) }}"
                                   class="dropdown-item non_title">
                                    <i class="fas fa-list-ul"></i>
                                    <span>{{__('Activities')}}</span>
                                </a>
                            @elseif(Utility::getSiteContent('show_activities') == '1')

                                <a href="#" data-link="{{ route('activity.index',tenant('tenant_id'),) }}"
                                   class="dropdown-item non_title">
                                    <i class="fas fa-list-ul"></i>
                                    <span>{{__('Activities')}}</span>
                                </a>
                            @endif
                            @if (user()->account_type == 1 ||
                                    user()->account_type == 4 ||
                                    in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms) ||
                                    in_array('FAQ_ALL_CONTENT', $userPerms) ||
                                    in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms)
                                )
                                <a href="#" data-link="{{ route('settings',tenant('tenant_id')) }}" class="dropdown-item non_title">
                                    <i class="fas fa-cogs"></i>
                                    <span>{{__('Settings')}}</span>
                                </a>
                            @endif
                            @php
                                $packageExtraProfileNav = [];
                                $packageLayout = config('package-layout');
                                if ($packageLayout) {
                                    foreach ($packageLayout as $pk => $v) {
                                        if (isset($v['extra_profile_navigation']) && !empty($v['extra_profile_navigation']) && \Illuminate\Support\Facades\Route::has($v['extra_profile_navigation']['route'])) {
                                            $packageExtraProfileNav[$pk] = $v['extra_profile_navigation'];
                                        }
                                    }
                                }
                            @endphp
                            @if ($packageExtraProfileNav)
                                @foreach ($packageExtraProfileNav as $pk => $v)
                                    <a href="{{ route($v['route'], tenant('tenant_id')) }}" class="custom-nav-link">
                                        {!! $v['icon'] !!}
                                        <span>{{ $v['title'] }}</span>
                                    </a>
                                @endforeach
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item btn"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                        </div>
                    </li>
                {{-- @endif --}}
            </ul>
            {{-- @if (user()->account_type != 3) --}}
                <form id="logout-form" action="{{ route('logout',tenant('tenant_id')) }}" method="POST" style="display: none;">
                    @csrf
                </form>
            {{-- @endif --}}
        </div>
    </div>
    @if(!empty($header))
        <div style="z-index: 2; /*position: absolute;*/" class="welcome-message">
            <div class="row justify-content-between align-items-center">
                <div class="row col-md-12 overflow-hidden">
                    <div class="col-md-2 overflow-hidden">
                        @if(!is_null(tenant('small_logo')))
                            <a class="" href="{{ route('home',tenant('tenant_id')) }}">
                                <img src="{{ !is_null(tenant('small_logo')) ? asset(\Storage::url(tenant('small_logo'))) : '' }}" class="small_logo" />
                            </a>
                        @endif
                    </div>
                    <div class="@if(!is_null(tenant('small_logo'))) col-md-10 @else col-md-12 @endif">
                        <h5 class="h4 font-weight-400 mb-0 text-white" id="header_title">
                            {{ $header }}
                        </h5>
                    </div>
                </div>
                @if($actionButton)
                    <div class="col-xs-12 col-sm-12 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
                        {{ $actionButton }}
                    </div>
                @endif
            </div>
        </div>
    @endif
</nav>
@push('script')
<script>
    $('.on-click-notification').click(async function (event) {
        event.preventDefault();
        const notificationId = event.currentTarget.dataset.notification;
        const destinationUrl = event.currentTarget.href
        await storeNotificationRead(notificationId)
        window.location.href = destinationUrl;
    });

    $(document).on('click', '.calendar_notif', function (e) {
            var url = $(this).attr('href');
            e.preventDefault();
            var title = $(this).attr('data-title');

            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-md');
                $("#commonModal").modal('show');
                $.get(url, {}, function (data) {
                    $('#commonModal .modal-body').html(data);
                });
                return false;
            }else{
                console.log("url is incorrect")
            }
        });

    async function storeNotificationRead(notificationId){
        const routeUrl = "{{ route('notification.mark.user.read', tenant('tenant_id')) }}"+"/"+notificationId
        return $.ajax({
            url: routeUrl,
            method: "POST"
        });
    }
</script>
@endpush
