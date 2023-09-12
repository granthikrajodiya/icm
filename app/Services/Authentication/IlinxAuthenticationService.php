<?php

namespace App\Services\Authentication;

use App\Facades\ILINX;
use App\Models\Utility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RuntimeException;

class IlinxAuthenticationService implements AuthenticationInterface
{
    public function login(string $username, string $password): object
    {
        $response = ILINX::auth()->login($username, $password);

        if ($response->Success != 'true') {
            Auth::logout();
        } else {
            $userInfo = (array) $response->Data;
            $userInfo['TenantId'] = tenant('tenant_id');
            Session::put('userInfo', (object) $userInfo);
        }

        return $response;
    }

    public function logout(object $userData): RedirectResponse
    {
        Utility::ilinxLogout($userData);

        return redirect()->route('login', tenant('tenant_id'));
    }

    public function handleLoginCallback(Request $request): RuntimeException
    {
        throw new RuntimeException('This service does not contain handleLoginCallback');
    }

    public function getLoginUrl(): RuntimeException
    {
        throw new RuntimeException('This service does not contain getLoginUrl');
    }
}
