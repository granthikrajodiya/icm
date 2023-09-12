<?php

namespace App\Services\Authentication;

use App\Models\Tenant;

class AuthenticationService
{
    public function withTenantService(): AuthenticationInterface
    {
        return match (tenant('authentication_service')) {
            Tenant::AUTH_SERVICE_OKTA  => app()->make(SsoConfigurationAuthenticationService::class),
            Tenant::AUTH_SERVICE_AAD  => app()->make(SsoConfigurationAuthenticationService::class),
            Tenant::AUTH_SERVICE_ILINX => app()->make(IlinxAuthenticationService::class),
        };
    }

    public function usesExternalAuthentication(): bool
    {
        return tenant('authentication_service') !== Tenant::AUTH_SERVICE_ILINX;
    }
}
