<?php

namespace App\Actions;

use Illuminate\Support\Facades\Session;

class GetCacheBatchDocsData
{
    public static function execute(): array|bool
    {
        $batchObjCacheTime = Session::get('batchObjCacheTime');

        if (!empty($batchObjCacheTime)) {
            if (time() - $batchObjCacheTime < env('ILINX_CACHE_TIMEOUT')) {
                $cachedBatchObj = Session::get('batchObj');

                if (!empty($cachedBatchObj)) {
                    return $cachedBatchObj;
                }
            }
        }

        return false;
    }
}
