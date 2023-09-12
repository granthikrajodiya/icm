<?php

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

if (!function_exists('user')) {
    function user(): ?User
    {
        if (!auth()->check()) {
            return null;
        }

        return auth()->user();
    }
}

if (!function_exists('carbon')) {
    function carbon($time = null, $tz = null): Carbon
    {
        return new Carbon($time, $tz);
    }
}

if (!function_exists('milliseconds')) {
    function milliseconds(): float
    {
        return round(microtime(true) * 1000);
    }
}

if (!function_exists('routeIs')) {
    function routeIs(string | array $routes, string $activeClass = 'selected', string $inactiveClass = ''): string
    {
        return request()->routeIs($routes) ? $activeClass : $inactiveClass;
    }
}

if (!function_exists('endingSlash')) {
    function endingSlash(string $url)
    {
        if (!Str::endsWith(env("ILINX_ICS_REST_URL"), '/')) {
            $url = $url . '/';
        }

        return $url;
    }
}

if (!function_exists('randomColorPart')) {
    function randomColorPart(): string
    {
        return '#' . dechex(mt_rand(0, 0xFFFFFF));
    }
}

if (!function_exists('getFileIconName')) {
    function getFileIconName($fileType): string
    {
        // check the fileType if exist on defaultIcon.php config file
        $response = Arr::get(config('defaultIcon'), $fileType);

        if (!$response) {
            // If no matching fileType in extensions array, return default
            return 'default.png';
        }
        // return response from the array result
        return $response;
    }
}
