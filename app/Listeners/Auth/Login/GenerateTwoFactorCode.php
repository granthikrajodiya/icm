<?php

namespace App\Listeners\Auth\Login;

use App\Actions\Mail\RegisterMailSettings;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use App\Support\RandomStringGenerator;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\TwoFactorAuthenticationCode;
use App\Support\TwoFactorAuthentication\TwoFactorAuthentication;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class GenerateTwoFactorCode
{
    public function __construct(
        private RegisterMailSettings $registerMailSettings,
        private RandomStringGenerator $generator,
        private TwoFactorAuthentication $twoFactorAuthentication,
    )
    {
    }

    public function handle(Login $event): void
    {
        if ((bool) tenant('require_two_factor_authentication') === false) {
            return;
        }

        $this->registerMailSettings->execute();

        /** @var User */
        $authenticatedUser = $event->user;

        /** @var TwoFactorAuthenticationCode */
        $twoFactor = $authenticatedUser->twoFactorAuthenticationCode()->create([
            'code' => $this->generator->generate(),
        ]);

        $this->twoFactorAuthentication->sendMessage($authenticatedUser, $twoFactor);
    }
}
