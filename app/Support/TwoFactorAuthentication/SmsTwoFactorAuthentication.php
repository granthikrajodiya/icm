<?php

namespace App\Support\TwoFactorAuthentication;

use App\Http\Clients\Twilio\TwilioClientInterface;
use App\Models\User;
use App\Models\TwoFactorAuthenticationCode;

class SmsTwoFactorAuthentication implements TwoFactorAuthentication
{
    public function __construct(
        private TwilioClientInterface $twilio,
    )
    {
    }

    public function sendMessage(User $user, TwoFactorAuthenticationCode $code): void
    {
        $this->twilio->sendMessage(
            config('services.twilio.from_number'),
            $user->texting_number,
            sprintf('This is your Two-Factor Authentication code for ILINX Engage: %s', $code->code),
        );
    }
}