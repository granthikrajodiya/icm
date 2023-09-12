<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckTenantId
{
    /**
     * Excluded url uris.
     *
     * @var array $except
     */
    protected $except = [
        '{tenant}',
        '{tenant}/login',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = $request->route()->uri;

        if (!in_array($uri, $this->except) || ($request->hasSession() && $request->session()->has('userInfo'))) {
            $usrData = $request->session()->get('userInfo');
            if ($usrData && isset($usrData->TenantId )) {
                if($usrData->TenantId !== tenant('tenant_id') || in_array($uri, $this->except)){
                    // if not the same tenantID but has an active tenant session
                    // redirect to tenant home if accessing within $this->except uri (e.g: /login but already login )
                    // tenant session is still active , redirect to its home
                    return redirect()->route('home', $usrData->TenantId);
                }
            }
        }

        return $next($request);
    }
}
