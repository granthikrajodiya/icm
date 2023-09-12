<?php

namespace App\Actions\Seed;

use App\Models\Tenant;
use Illuminate\Support\Facades\File;

class BaseImageSeeder
{
    public static function execute($tenantId = 'host')
    {
        $publicPath  = public_path("/assets/img/base_img/");
        $storagePath = storage_path('/app/public/logo/' . $tenantId . '/');

        $storageLogo    = $storagePath . "logo.png";
        $storageBanner  = $storagePath . "banner.png";

        File::exists($storageLogo)    ?? File::delete($storageLogo);
        File::exists($storageBanner)  ?? File::delete($storageBanner);

        File::makeDirectory($storagePath, 0755, true, true);

        File::copy($publicPath . "logo.png", $storageLogo);
        File::copy($publicPath . "banner.png", $storageBanner);

        Tenant::where('tenant_id', $tenantId)->update(['logo' => "logo/" . $tenantId . "/logo.png"]);
        Tenant::where('tenant_id', $tenantId)->update(['banner' => "logo/" . $tenantId . "/banner.png"]);
    }
}
