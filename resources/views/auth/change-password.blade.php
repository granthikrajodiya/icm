@php
    $usrData = \Session::get('userInfo');
@endphp
    <!doctype html>
<html lang="{{ Str::replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title
        data-dash="{{(Utility::getValByName('header_text')) ? Utility::getValByName('header_text') : config('app.name') }}">{{__('Change Password')}} &dash; {{(Utility::getValByName('header_text')) ? Utility::getValByName('header_text') : config('app.name') }}</title>
    <link rel="icon" href="{{ asset(\Storage::url('logo/favicon.ico?v=2')) }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/'.Utility::getValByName('default_theme').'.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/jqueryscripttop.css')}}"  type="text/css">
    @if (Utility::getValByName('banner_type') == 'image' && !empty(tenant()?->banner_path))
        <style>
            .application-offset .container-application:before {
                background: url('{{ tenant()?->banner_path }}') !important;
            }

            @media (max-width: 767.98px) {
                .application .sidenav.show:before {
                    background: url('{{ tenant()?->banner_path }}') !important;
                }
            }
        </style>
    @endif
</head>
<body class="application application-offset">
    <div class="container-fluid container-application">
        <div class="main-content position-relative">
            <nav
                class="navbar navbar-main navbar-expand-lg navbar-dark {{(Utility::getValByName('banner_type') == 'color') ? 'bg-primary' : ''}} navbar-border"
                id="navbar-main">
                <div class="container-fluid">
                    <!-- User's navbar -->
                    <div class="navbar-user d-lg-none ml-auto">
                        <ul class="navbar-nav flex-row align-items-center">
                            <li class="nav-item dropdown dropdown-animate">
                                <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                              <span class="avatar avatar-sm rounded-circle">
                                <img class="avatar avatar-sm rounded-circle" {{ user()->img_avatar }} >
                              </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                                    <h6 class="dropdown-header px-0">{{__('Hi,')}} {{ user()->name }}</h6>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout',tenant('tenant_id')) }}" class="dropdown-item"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>{{ __('Logout') }}</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
                        <ul class="navbar-nav ml-lg-auto align-items-center d-none d-lg-flex">
                            <li class="nav-item dropdown dropdown-animate">
                                <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <div class="media media-pill align-items-center">
                                    <span class="avatar rounded-circle">
                                      <img class="avatar rounded-circle" {{ user()->img_avatar }}>
                                    </span>
                                        <div class="ml-2 d-none d-lg-block">
                                            <span class="mb-0 text-sm font-weight-bold">{{ user()->name }}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                                    <h6 class="dropdown-header px-0">{{__('Hi,')}} {{ user()->name }}</h6>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout',tenant('tenant_id')) }}" class="dropdown-item"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>{{ __('Logout') }}</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout',tenant('tenant_id')) }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>

            <div class="page-content min-750 pt-6">
                <div class="page-title">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3 mb-md-0">
                            <div class="text-center">
                                <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">{{ Utility::getSalutation().' '.user()->name.'!' }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-lg-6 col-xl-6">
                        <div class="card shadow zindex-100 mb-0">
                            <div class="card-body px-md-5 py-5">
                                <div class="mb-5">
                                    <h6 class="h4">{{__('Change Password')}}</h6>
                                </div>
                                <span class="clearfix"></span>
                                <x-form :action="route('update.password', tenant('tenant_id'))">
                                    <div class="form-group mb-4">
                                        <label class="form-control-label">{{__('Current Password')}}</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input id="current_password" type="password"
                                                   class="form-control @error('current_password') is-invalid @enderror"
                                                   name="current_password" required>
                                            <div class="input-group-append">
                                            <span class="input-group-text">
                                              <a href="#" data-toggle="password-text" data-target="#current_password">
                                                <i class="fas fa-eye"></i>
                                              </a>
                                            </span>
                                            </div>
                                            @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="form-control-label">{{__('New Password')}}</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required>
                                            <div class="input-group-append">
                                            <span class="input-group-text">
                                              <a href="#" data-toggle="password-text" data-target="#password">
                                                <i class="fas fa-eye"></i>
                                              </a>
                                            </span>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">{{__('Confirm password')}}</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required>
                                        </div>
                                    </div>
                                    @error('extra_error')
                                    <div class="form-group">
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    </div>
                                    @enderror
                                    <div class="mt-4">
                                        <x-button sm pill class="btn-icon">
                                            <span class="btn-inner--text">{{__('Change password')}}</span>
                                            <span class="btn-inner--icon">
                                                <i class="fas fa-long-arrow-alt-right"></i>
                                            </span>
                                        </x-button>
                                    </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Footer--}}
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer pt-5 pb-4 footer-light" id="footer-main">
                    <div class="row text-center text-sm-left align-items-sm-center">
                        <div class="col-sm-6">
                            <p class="text-sm mb-0">{{ Utility::getValByName('footer_text') }}</p>
                        </div>
                        <div class="col-sm-6 mb-md-0">
                            <ul class="nav justify-content-center justify-content-md-end">
                                <li class="nav-item dropdown border-right">
                                    <a class="nav-link" href="#" role="button" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <span class="h6 text-sm mb-0"><i class="fas fa-globe-asia"></i> {{ Str::upper(user()->lang) }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        @foreach (Utility::languages() as $lang)
                                            <a href="{{route('lang.change',[tenant('tenant_id'),$lang])}}"
                                               class="dropdown-item {{ (basename(App::getLocale()) == $lang) ? 'active' : '' }} ">{{ Str::upper($lang) }}</a>
                                        @endforeach
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" target="_blank"
                                       href="{{ Utility::getValByName('footer_value_1') }}">{{ Utility::getValByName('footer_link_1') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" target="_blank"
                                       href="{{ Utility::getValByName('footer_value_2') }}">{{ Utility::getValByName('footer_link_2') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" target="_blank"
                                       href="{{ Utility::getValByName('footer_value_3') }}">{{ Utility::getValByName('footer_link_3') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Scripts -->
<script src="{{ asset('assets/js/site.core.js') }}"></script>
<script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/libs/moment/min/moment-timezone-with-data.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<script src="{{ asset('assets/js/site.js') }}"></script>
<script src="{{ asset('assets/js/letter.avatar.js') }}"></script>

@if (Session::has('success'))
    <script>
        show_toastr('{{__('Success')}}', "{!! session('success') !!}", 'success');
    </script>
    {{ Session::forget('success') }}
@endif
@if (Session::has('error'))
    <script>
        show_toastr('{{__('Error')}}', "{!! session('error') !!}", 'error');
    </script>
    {{ Session::forget('error') }}
@endif

<script type="text/javascript" language="javascript">
    var idleMax = {{ env('LOGOUT_TIME') }};
    var idleTime = 0;

    var idleInterval = setInterval("timerIncrement()", 60000);  // 1 minute interval
    $("body").mousemove(function (event) {
        idleTime = 0;
    });
    $("body").keypress(function () {
        idleTime = 0;
    });

    // count minutes
    function timerIncrement() {
        idleTime = idleTime + 1;
        if (idleTime > idleMax) {
            $("#logout-form").submit();
        }
    }
</script>
</html>
