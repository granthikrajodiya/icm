<?php

namespace App\Http\Middleware\API;

use Closure;
use Illuminate\Http\Request;

class VerifyApiId
{
    public function handle(Request $request, Closure $next)
    {
        if (env('ILINX_API_ID') !== $request->get('api_id')) {
            return response()->json([
                "is_success" => false,
                "message"    => __("Permission denied."),
                "data"       => "",
            ], 422);
        }

        return $next($request);
    }
}
