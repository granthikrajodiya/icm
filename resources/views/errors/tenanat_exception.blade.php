<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') &dash; {{ config('app.name') }}</title>
    <link rel="icon" href="{{ tenant()?->fav_icon_path }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/'.Utility::getValByName('default_theme').'.css') }}">
</head>
<body>
    <div class="min-vh-100 h-100vh py-5 d-flex align-items-center bg-gradient-danger">
        <div class="bg-absolute-cover vh-100 overflow-hidden d-none d-md-block">
            <figure class="w-100">
                <img alt="Image placeholder" src="{{ asset('assets/img/svg/backgrounds/bg-4.svg') }}" class="svg-inject">
            </figure>
        </div>
        <div class="container position-relative zindex-100">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <p class="lead text-xl text-white mb-5">
                        {{__("Tenant is not available in our record.")}}
                    </p>
                    <a href="{{ (\Auth::check()) ? route('home',!empty(tenant('tenant_id')) ? tenant('tenant_id') : '') : url('/home') }}" class="btn btn-white btn-icon rounded-pill hover-translate-y-n3">
                        <span class="btn-inner--icon"><i class="fas fa-home"></i></span>
                        <span class="btn-inner--text">{{__('Return home')}}</span>
                    </a>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <figure class="w-100">
                        <img alt="Image placeholder" src="{{ asset('assets/img/svg/illustrations/server-down.svg') }}" class="svg-inject opacity-8 img-fluid" style="height: 500px;">
                    </figure>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('assets/js/purpose.core.js') }}"></script>
<script src="{{ asset('assets/js/purpose.js') }}"></script>
</body>
</html>
