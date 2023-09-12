<?php

namespace App\Policies;

use App\Models\Tenant;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Session;

class UserPolicy
{
    use HandlesAuthorization;

    public function userUpdatePassword(): bool
    {
        $userSession = Session::get('userInfo');

        return $userSession?->UserType == "BuiltIn" && (tenant('authentication_service') !== Tenant::AUTH_SERVICE_OKTA || tenant('authentication_service') !== Tenant::AUTH_SERVICE_AAD);
    }
}
