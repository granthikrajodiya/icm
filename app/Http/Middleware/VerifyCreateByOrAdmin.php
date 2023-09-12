<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyCreateByOrAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->account_type == User::INTERNAL_TENANT_ADMIN) {
            return $next($request);
        }

        $routeParams = $request->route()->parameters();

        foreach ($routeParams as $value) {
            if (isset($value->created_by)) {
                if ($value->created_by != $user->id) {
                    return redirect()->back()->with('error', __('Permission Denied.'));
                }
            }
        }

        return $next($request);
    }
}
