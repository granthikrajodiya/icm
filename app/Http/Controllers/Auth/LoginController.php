<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Utility;
use App\Providers\RouteServiceProvider;
use App\Services\Authentication\AuthenticationService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * @SupressWarnings(PHPMD)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('handle-saml-response')->only('login', 'logout');
    }

    public function showLoginForm(AuthenticationService $authentication)
    {
        if ($authentication->usesExternalAuthentication()) {
            return \Redirect::to(
                $authentication->withTenantService()->getLoginUrl()
            );
        }

        return view('auth.login');
    }

    public function login(Request $request, AuthenticationService $authentication)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::query()
            ->where('username', '=', $request->get('username'))
            ->where('tenant_id', '=', tenant('tenant_id'))
            ->first();

        if (empty($user)) {
            Utility::makeLogin($request->all());
            $user = User::query()
                ->where('username', '=', $request->get('username'))
                ->where('tenant_id', '=', tenant('tenant_id'))
                ->first();

            if (empty($user)) {
                return redirect()->route('login', tenant('tenant_id'))
                    ->withErrors([
                        'username' => __('These credentials do not match in our records.'),
                    ]);
            }
        }

        $tenant = Tenant::where('tenant_id', $user->tenant_id)->first();

        if ($tenant->account_status != Tenant::TENANT_ACTIVE) {
            return redirect()->route('login', tenant('tenant_id'))
                ->withErrors(['username' => __($tenant->message)]);
        }

        if ($user->account_type != User::INTERNAL_TENANT_ADMIN && $user->account_status != 'active') {
            return redirect()->route('login', tenant('tenant_id'))
                ->withErrors(['username' => __($user->account_status_message)]);
        }

        //If using ILINX security, add tenant_id to username for all external tenants ad to host tenat if configured
        $username = $request->get('username');
        if (tenant('authentication_service') == Tenant::AUTH_SERVICE_ILINX) {
            if (tenant('tenant_id') !== 'host' || (tenant('tenant_id') == 'host' && config('ilinx.include_tenant_id') == true)) {
                $username = tenant('tenant_id') . ':' . $username;
            }
        }

        $res = $authentication->withTenantService()->login($username, $request->get('password'));




        if ($res->Success) {
            if (Auth::loginUsingId($user->id)) {
                if (empty($user->last_login_at)) {
                    Session::put('first_time', 'true');
                }

                Session::put('last_login_at', $user->last_login_at);
                $user->update(['last_login_at' => Carbon::now()->toDateTimeString()]);

                $currDateTime = Carbon::now()->toDateTimeString();
                $user->activities()->create([
                    'type'      => 'system',
                    'date_time' => $currDateTime,
                    'text'      => 'Login successfully at ' . Utility::getDateFormatted($currDateTime, true),
                ]);

                if (Session::has('url.intended')) {
                    return redirect()->intended();
                } else {
                    return redirect()->route('home', $user->tenant_id);
                }
            }
        } else {
            return redirect()->route('login', tenant('tenant_id'))->withErrors(
                ['username' => __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.')]
            );
        }
    }

    public function makeLogout(Request $request)
    {
        $message = $request?->message;

        return view('auth.logout', compact('message'));
    }

    public function logout(Request $request, AuthenticationService $authentication)
    {
        if (empty(Session::get('userInfo')) && empty(auth()->user)) {
            return redirect()->route('login', tenant('tenant_id'));
        }

        $usrData = Session::get('userInfo');

        user()->update(['notifications_read' => Carbon::now()->toDateTimeString()]);
        $currDateTime = Carbon::now()->toDateTimeString();
        user()->activities()->create([
            'type'      => 'system',
            'date_time' => $currDateTime,
            'text'      => 'Logout successfully at ' . Utility::getDateFormatted($currDateTime, true),
        ]);
        $this->guard()->logout();

        $request->session()->invalidate();

        $this->loggedOut($request);

        return $authentication->withTenantService()->logout($usrData);
    }
}
