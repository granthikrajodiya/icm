<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class CheckTwoFactorAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        if (tenant('require_two_factor_authentication') && Session::has('two_factor') === false) {
            return redirect()->route('two-factor.index', tenant('tenant_id'));
        }

        return $next($request);
    }
}
