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
@yield('content')

<script src="{{ asset('assets/js/purpose.core.js') }}"></script>
<script src="{{ asset('assets/js/purpose.js') }}"></script>
</body>
</html>
