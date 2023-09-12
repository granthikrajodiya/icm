@props([
    'title' => 'ImageSource'
])

<!doctype html>
<html lang="{{ Str::replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' *.googleapis.com *.gstatic.com; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' *.googleapis.com *.gstatic.com; font-src 'self' 'unsafe-inline' data: *.googleapis.com *.gstatic.com; img-src 'self' 'unsafe-inline' data:">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} &dash; {{ config('app.name', 'ILINXEngage') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="icon" href="{{ tenant()?->fav_icon_path }}" type="image/png">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/'.Utility::getSiteContent('default_theme').'.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/jqueryscripttop.css')}}"  type="text/css">
    @if (Utility::getSiteContent('banner_type') == 'image' && !empty(tenant()?->banner_path))
        <style>
            .application-offset .container-application:before {
                background: url('{{ tenant()?->banner_path }}') !important;
            }
        </style>
    @endif
</head>
<body class="application application-offset">
<div id="app">
    <div class="container-fluid container-application">
        <div class="main-content position-relative">
            <div class="page-content">
                <div class="py-5 d-flex align-items-center">
                    <div class="w-100">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="text-center pb-2 {{ !is_null(tenant('small_logo')) ? '': 'pt-5' }}">
                                    <img src="{{tenant()?->logo_path }}" class="auth-logo">
                                </div>
                                @if(!is_null(tenant('small_logo')))
                                <div class="text-center pb-2">
                                    <img src="{{ !is_null(tenant('small_logo')) ? asset(\Storage::url(tenant('small_logo'))) : '' }}" class="small_logo" />
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="min-vh-100 align-items-center pt-4">
                    <div class="w-100">
                        <div class="row justify-content-center">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/site.core.js')}}"></script>
<script src="{{asset('assets/js/site.js')}}"></script>
@stack('script')


</body>
</html>
