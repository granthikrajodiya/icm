<?php

namespace App\Support;

use Illuminate\Support\Facades\Session;

class IrdHelper
{
    public static function getIRDDocStatus($tab) {
        switch ($tab) {
            case "working":
                return env('IRD_STATUS_WORKING');

                break;
            case "approvals":
                return env('IRD_STATUS_APPROVALS');

                break;
            default:
                // The safe default is internal/exempt
                return env('IRD_STATUS_EXEMPT');
        }
    }

    public static function getIRDRawIndexes($requestNumber, $batchId, $fileName, $description, $status) {
        $usrData = Session::get('userInfo');

        $indexes = [
            ['IndexName' => 'RequestNumber', 'IndexValue' => $requestNumber],
            ['IndexName' => 'BatchID', 'IndexValue' => $batchId],
            ['IndexName' => 'FileName', 'IndexValue' => $fileName],
            ['IndexName' => 'Description', 'IndexValue' => $description],
            ['IndexName' => 'Source', 'IndexValue' => 'Uploaded by ' . $usrData->FullName],
            ['IndexName' => 'Status', 'IndexValue' => $status]
        ];

        return json_encode($indexes);
    }

    public static function getIRDUploadBody($indexInfos, $filename, $filemime, $fileContent) {
        $boundary = "---------------------" . md5(mt_rand() . microtime());
        $body   = [];

        foreach ($indexInfos as $key => $value) {
            $body[] = implode("\r\n", [
                $boundary,
                "Content-Disposition: form-data; name=\"" . $key . "\"",
                "",
                $value,
            ]);
        }

        $body[] = implode("\r\n", [
            $boundary,
            "Content-Disposition: form-data; name=\"" . $filename . "\"; filename=\"" . $filename . "\";",
            "Content-Type: " . $filemime,
            "",
            $fileContent,
        ]);

        $body[] = $boundary;

        return $body;
    }

    public static function getHashFile($fileContent) {
        $sha1 = sha1($fileContent);
        $hash = base64_encode(pack('H*',$sha1));
        return $hash;
    }

}