<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class XSS
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            \App::setLocale(user()->lang);

            if (
                !user()->hasUpdatePassword() && env('NEW_USERS_MUST_CHANGE_PASSWORD') == true && $request->route()->getName() !== 'change.password'
            ) {
                return redirect()->route('change.password', tenant('tenant_id'));
            }
        }

        if (\Request::route()->getName() == 'chat' && !Auth::check()) {
            return redirect()->back();
        }

        $input = $request->all();
        array_walk_recursive($input, function (&$input) {
            $input = strip_tags($input);
        });
        $request->merge($input);

        return $next($request);
    }
}
