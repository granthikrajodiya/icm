<?php

namespace App\Actions;

use Illuminate\Support\Facades\Session;

class GetCacheCaseBatchData
{
    public static function execute(): array|bool
    {
        $caseBatchCacheTime = Session::get('caseBatchCacheTime');

        if (!empty($caseBatchCacheTime)) {
            if (time() - $caseBatchCacheTime < env('ILINX_CACHE_TIMEOUT')) {
                $caseBatchObj = Session::get('caseBatchObj');

                if (!empty($caseBatchObj)) {
                    return $caseBatchObj;
                }
            }
        }

        return false;
    }
}
