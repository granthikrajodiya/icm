<?php

namespace App\Providers;

use App\Support\TwoFactorAuthentication\EmailTwoFactorAuthentication;
use App\Support\TwoFactorAuthentication\TwoFactorAuthentication;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class TwoFactorAuthenticationProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(TwoFactorAuthentication::class, function (Application $app): TwoFactorAuthentication {
            return new EmailTwoFactorAuthentication;
        });
    }

    public function provides()
    {
        return [TwoFactorAuthentication::class];
    }
}
