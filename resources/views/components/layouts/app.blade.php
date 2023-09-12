@php($usrData = \Session::get('userInfo')) @endphp

@props([
    'title'        => 'ImageSource',
    'header'       => null,
    'actionButton' => null,
])

@if (!isset($header))
	@php
		$header = $title;
	@endphp
@endif

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title
            data-dash="{{ Utility::getSiteContent('header_text') ? Utility::getSiteContent('header_text') : config('app.name') }}"
            id="title_text">{{ $title }} &dash;
            {{ Utility::getSiteContent('header_text') ? Utility::getSiteContent('header_text') : config('app.name') }}
        </title>
        <link rel="icon" href="{{ asset(\Storage::url('logo/favicon.ico?v=2')) }}" type="image/png">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/libs/animate.css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/' . Utility::getSiteContent('default_theme') . '.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
        <link rel="stylesheet" href="{{asset('assets/css/jqueryscripttop.css')}}"  type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/daterangepicker/daterangepicker.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/jquery/dist/jquery-ui.min.css') }}"/>
        @stack('css')

        <style>
            .welcome-message {
                padding-left: 20px;
            }
        </style>

        @if (Utility::getSiteContent('banner_type') == 'image' && !empty(tenant()?->banner_path))
            <style>
                .application-offset .container-application:before {
                    background: url("{{ tenant()?->banner_path }}") !important;
                }
                @media (max-width: 767.98px) {
                    .application .sidenav.show:before {
                        background: url("{{ tenant()?->banner_path }}") !important;
                    }
                }

            </style>
        @endif
    </head>

    <body class="application application-offset">
        <div class="main-nav-container">
            <div class="nav-flex-container">
                <div class="sidenav-header align-items-center">
                    <a class="navbar-brand" href="{{ route('home',tenant('tenant_id')) }}">
                        <img src="{{ tenant()?->logo_path }}" class="navbar-brand-img" alt="...">
                    </a>
                    <div class="ml-auto">
                        <!-- Sidenav toggler -->
                        <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin"
                             data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <x-layouts.partials.navbar :header="$header" :actionButton="$actionButton" />
            </div>
        </div>
        <div class="container-fluid container-application">
            <div class="sidenav pb-2" id="sidenav-main">
                <x-layouts.partials.sidebar/>
            </div>
            <div class="main-content position-relative">
                <div class="page-content min-750 pt-6">
                    {{ $slot }}
                </div>
            </div>
        </div>

        {{-- Footer --}}
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
                                        <span class="h6 text-sm mb-0"><i class="fas fa-globe-asia"></i>
                                            {{ Str::upper(user()->lang) }}</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            @foreach (Utility::languages() as $lang)
                                                <a href="{{ route('lang.change', [tenant('tenant_id'), $lang]) }}"
                                                   class="dropdown-item
                                                   {{ basename(App::getLocale()) == $lang ? 'active' : '' }} "
                                                >
                                                    {{ Str::upper($lang) }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" target="_blank"
                                           href="{{ Utility::getValByName('footer_value_1') }}">{{ Utility::getValByName('footer_link_1') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" target="_blank"
                                           href="{{ Utility::getValByName('footer_value_2') }}">{{ Utility::getValByName('footer_link_2') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" target="_blank"
                                           href="{{ Utility::getValByName('footer_value_3') }}">{{ Utility::getValByName('footer_link_3') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Common Modal --}}
        <div class="modal fade" tabindex="-1" role="dialog" id="commonModal" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        {{-- End Common Modal --}}

        {{-- Common Modal2 --}}
        <div class="modal fade" tabindex="-1" role="dialog" id="commonModal2" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        {{-- End Common Modal --}}

        {{-- Common Modal3 --}}
        <div class="modal fade modal-color" tabindex="-1" role="dialog" id="commonModal3" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        {{-- End Common Modal --}}

        @if (\Session::get('first_time') == true)
            <div class="modal fade" tabindex="-1" role="dialog" id="freshModal">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <iframe src="{{ route('first.time', tenant('tenant_id')) }}"
                                            style="height: 512px;width: 100%"></iframe>
                                </div>
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-sm btn-secondary rounded-pill"
                                            data-dismiss="modal">{{ __('Close') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </body>

    <!-- Scripts -->

    <script src="{{ asset('assets/js/site.core.js') }}"></script>
    <script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/libs/moment/min/moment-timezone-with-data.min.js') }}"></script>
    <script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/progressbar.js/dist/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/libs/autosize/dist/autosize.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/dist/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/libs/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/site.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/letter.avatar.js') }}"></script>


    <script>
        var tableLangData = {
            "lengthMenu": "{{ __('Show') }} _MENU_ {{ __('entries') }}",
            "zeroRecords": "{{ __('No data found.') }}",
            "info": "{{ __('Showing page') }} _PAGE_ {{ __('of') }} _PAGES_",
            "infoEmpty": "{{ __('No page available') }}",
            "infoFiltered": "({{ __('filtered from') }} _MAX_ {{ __('total records') }})",
            "paginate": {
                "previous": "{{ __('Previous') }}",
                "next": "{{ __('Next') }}",
                "last": "{{ __('Last') }}"
            }
        };
        var tableDom = '<"float-left"B><"float-right"f>rt<<l><p>>';
    </script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function () {
            if ($('.dataTable').length > 0) {
                $(".dataTable").DataTable({
                    "aaSorting": [],
                    language: tableLangData,
                });

                var spanSorting = '<span class="arrow-hack sort">&nbsp;&nbsp;&nbsp;</span>';
                var spanAsc = '<span class="arrow-hack asc">&nbsp;&nbsp;&nbsp;</span>';
                var spanDesc = '<span class="arrow-hack desc">&nbsp;&nbsp;&nbsp;</span>';

                $(".dataTable").on('click', 'th', function() {
                    $(".dataTable thead th").each(function(i, th) {
                        $(th).find('.arrow-hack').remove();
                        var html = $(th).html(),
                            cls = $(th).attr('class');

                        if(cls.includes('sorting_asc')){
                            $(th).html(html+spanAsc);
                        }else if(cls.includes('sorting_desc')){
                            $(th).html(html+spanDesc);
                        }else if(cls.includes('sorting_disabled')){
                            $(th).html(html);
                        }else{
                            $(th).html(html+spanSorting);
                        }
                    });
                });

                $(".dataTable th").first().click().click();
            }

            @if (\Session::get('first_time') == true)
            $('#freshModal').modal('show');
            @endif
        });

        $(document).on('click', '.main_title', function () {
            $.ajax({
                type: 'POST',
                url: '{{ route('get.breadcrumb', tenant('tenant_id')) }}',
                data: {
                    title: $(this).attr('data-title')
                },
                cache: false,
                success: function(data, status, xhr) {
                    if (!xhr.responseJSON && xhr.responseText) {
                        location.reload();
                        return false;
                    }
                }
            });

            $('.main_title').removeClass('active');
            var url = $(this).attr('data-link');

            if (typeof annotationHelper !== 'undefined') {
                if (annotationHelper.isChanged()) {
                    annotationHelper.askSaveChange(
                        function() {
                            unlockRequestWithAction(url);
                        },
                        function() {
                            unlockRequestWithAction(url);
                        }
                    );
                } else {
                    unlockRequestWithAction(url);
                }
            } else {
                setTimeout(function () {
                    window.location.replace(url);
                }, 400);
            }
        });

        $(document).on('click', '.non_title', function () {
            var url = $(this).attr('data-link');
            if (typeof annotationHelper !== 'undefined') {
                if (annotationHelper.isChanged()) {
                    annotationHelper.askSaveChange(
                        function() {
                            unlockRequestWithAction(url);
                        },
                        function() {
                            unlockRequestWithAction(url);
                        }
                    );
                } else {
                    unlockRequestWithAction(url);
                }
            } else {
                setTimeout(function () {
                    window.location.replace(url);
                }, 400);
            }
        });

        $(document).on('click', '#bt-logout', function () {
            if (typeof annotationHelper !== 'undefined') {
                if (annotationHelper.isChanged()) {
                    annotationHelper.askSaveChange(
                        function() {
                            unlockRequestWithAction();
                        },
                        function() {
                            unlockRequestWithAction();
                        }
                    );
                } else {
                    unlockRequestWithAction();
                }
            } else {
                $('#logout-form').submit();
            }
        });

        $(document).on('click', '.from_notification', function (e) {
            var url = $(this).attr('href');
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route('get.breadcrumb', tenant('tenant_id')) }}',
                data: {
                    title: $(this).attr('data-title'),
                    notification: true
                },
                cache: false,
                success: function(data, status, xhr) {
                    if (!xhr.responseJSON) {
                        location.reload();
                        return false;
                    }
                }
            });

            setTimeout(function () {
                window.location.href = url;
            }, 400);
        });

        function unlockRequestWithAction(url) {
            const waitingUnlockRequest = async () => {
                await annotationHelper.unlockRequest();
                setTimeout(function () {
                    if (url) { // change url
                        window.location.replace(url);
                    } else {   // logout
                        $('#logout-form').submit();
                    }
                }, 2000);
            };
            waitingUnlockRequest();
        }
    </script>

    @stack('theme-script')
    @stack('script')

    {{ \Session::forget('first_time') }}

    @if (Session::has('success'))
        <script>
            show_toastr('{{ __('Success') }}', "{!! session('success') !!}", 'success');
        </script>
        {{ Session::forget('success') }}
    @endif
    @if (Session::has('error'))
        <script>
            show_toastr('{{ __('Error') }}', "{!! session('error') !!}", 'error');
        </script>
        {{ Session::forget('error') }}
    @endif
    <script>
        var chart_keyword = [
            "{{ __('Wed') }}",
            "{{ __('Tue') }}",
            "{{ __('Mon') }}",
            "{{ __('Sun') }}",
            "{{ __('Sat') }}",
            "{{ __('Fri') }}",
            "{{ __('Thu') }}",
        ];
    </script>

    <script type="text/javascript">
        var idleMax = {{ env('LOGOUT_TIME', 150) }};
        var idleTime = 0;

        var idleInterval = setInterval(() => {
            idleTime++;
            if (idleTime >= idleMax) {
                $("#logout-form").submit();
            }
        }, 60 * 1000);

        $("body").on('mousemove keypress', function (event) {
            idleTime = 0;
        });
    </script>

</html>
