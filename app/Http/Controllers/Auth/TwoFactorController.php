<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\TwoFactorRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function index(): View
    {
        if (Session::has('two-factor')) {
            abort(Response::HTTP_NOT_FOUND);
        }
        
        return view('auth.two-factor');
    }

    public function authenticate(TwoFactorRequest $request): RedirectResponse
    {
        Session::put('two_factor', true);

        /** @var User */
        $authenticatedUser = Auth::user();

        $authenticatedUser->twoFactorAuthenticationCode()->delete();

        return redirect()->route('home', tenant('tenant_id'));
    }
}
