<?php

namespace App\Actions;

use Illuminate\Support\Facades\Session;

class GetCacheBatchObjData
{
    public static function execute(): array|bool
    {
        $batchDocsObjCacheTime = Session::get('batchDocsObjCacheTime');

        if (!empty($batchDocsObjCacheTime)) {
            if (time() - $batchDocsObjCacheTime < env('ILINX_CACHE_TIMEOUT')) {
                $cachedBatchDocsObj = Session::get('batchDocObj');

                if (!empty($cachedBatchDocsObj)) {
                    return $cachedBatchDocsObj;
                }
            }
        }

        return false;
    }
}
