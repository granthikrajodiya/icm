<?php

namespace App\Services\ILINX;

use App\Services\ILINX\Core\Client;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DocumentViewer extends Client
{
    public static function getDocView()
    {
        $dataConfig = [
            'SessionId'                        => Str::uuid(),
            'Timeout'                          => env('VIEWER_TIMEOUT'),
            'ControlId'                        => env('DOCUVIEWARE_ID'),
            'AllowPrint'                       => false,
            'EnablePrintButton'                => false,
            'AllowUpload'                      => true,
            'EnableFileUploadButton'           => false,
            'CollapsedSnapIn'                  => false,
            'ShowAnnotationsSnapIn'            => false,
            'EnableRotateButtons'              => false,
            'EnableZoomButtons'                => true,
            'EnablePageViewButtons'            => false,
            'EnableMultipleThumbnailSelection' => false,
            'EnableMouseModeButtons'           => false,
            'EnableFormFieldsEdition'          => false,
            'EnableTwainAcquisitionButton'     => false,
            'Locale'                           => 'en',
        ];

        $url = env('VIEWER_CONTROL_URL');

        //Callback API up to 3 times to get $response->Data
        $retry = 0;
        $result = NULL;
        do {
            if ($retry > 0) {
                sleep(env('API_CALL_DELAY_TIME'));
            }

            try {
                $response = Http::post($url, $dataConfig);
                $retry++;
                $tmp = json_decode($response->body());
                if (isset($tmp->Data)) {
                    $result = $tmp->Data;
                }
            }
            catch (Exception $e) { }
        }
        while( $result == NULL and $retry <= 3);

        return $result;
    }
}
