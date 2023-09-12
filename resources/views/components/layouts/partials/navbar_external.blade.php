@props([
    'title'        => 'ImageSource',
    'header',
    'actionButton',
])
<nav
    class="navbar navbar-main navbar-expand-lg navbar-dark {{(Utility::getSiteContent('banner_type') == 'color') ? 'bg-primary' : ''}} navbar-border"
    id="navbar-main">
    <div class="container-fluid">
        <!-- Navbar nav -->
        <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
            <ul class="navbar-nav ml-lg-auto align-items-center d-none d-lg-flex">
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
                            @if (user()->account_type == 1 && Utility::getValByName('show_activities') == 'on')

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
                            @if (user()->account_type == 1 || user()->account_type == 4)
                                <a href="#" data-link="{{ route('settings',tenant('tenant_id')) }}" class="dropdown-item non_title">
                                    <i class="fas fa-cogs"></i>
                                    <span>{{__('Settings')}}</span>
                                </a>
                            @endif
                            @if(env('ILINX_DOWNLOAD_PST_INSTALL_FILE'))
                                <a href="{{ route('ird.download_pst',tenant('tenant_id')) }}" class="custom-nav-link">
                                    <i class="fas fa-edit pt-1"></i>
                                    <span>{{ __('Download the PST Utility') }}</span>
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a href="#" id="bt-logout"
                                class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                        </div>
                    </li>
            </ul>
                <form id="logout-form" action="{{ route('logout',tenant('tenant_id')) }}" method="POST" style="display: none;">
                    @csrf
                </form>
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
