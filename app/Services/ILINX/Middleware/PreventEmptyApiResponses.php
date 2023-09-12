<?php

namespace App\Services\ILINX\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PreventEmptyApiResponses
{
    public function __invoke($handler): Closure
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            return $handler($request, $options)->then(function (ResponseInterface $response) {
                $data = json_decode($response->getBody()->getContents());

                //adding route controller and function name on log
                if(empty($data)){ // sometimes , getBody() or getContents returns null , this is for double-checking conditions
                    $data = (object) ['logFile'=>request()->route()->getActionName()];
                }

                $data->logFile = request()->route()->getActionName();
                $data->routeName = request()->route()->getName();
                //$data->requestUrl = request()->url();
                //$data->serviceName = env('ILINX_REST_URL');

                $log  = json_encode($data);

                if (isset($data->Success) === false) {
                    Log::error('API Response: ' . $log);
                } else {
                    if ($data->Success === false || $data->Success === 'false') {
                        Log::error('API Response: ' . $log);
                    } else {
                        if (config('app.debug') === true) {
                            Log::info('API Response: ' . $log);
                        }
                    }
                }

                $response->getBody()->rewind();

                return $response;
            });
        };
    }
}
