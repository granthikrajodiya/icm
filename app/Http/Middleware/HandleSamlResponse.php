<?php

namespace App\Http\Middleware;

use App\Services\Authentication\AuthenticationService;
use Closure;
use Illuminate\Http\Request;

class HandleSamlResponse
{
    public function handle(Request $request, Closure $next)
    {
        $authentication = new AuthenticationService;

        if ($authentication->usesExternalAuthentication() && $request->has("SAMLResponse")) {
            return $authentication->withTenantService()->handleLoginCallback($request);
        }

        return $next($request);
    }
}
