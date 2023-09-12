<?php

namespace App\Support\TwoFactorAuthentication;

use App\Mail\TwoFactorAuthentication as TwoFactorAuthenticationMail;
use App\Models\User;
use App\Models\TwoFactorAuthenticationCode;
use Illuminate\Support\Facades\Mail;

class EmailTwoFactorAuthentication implements TwoFactorAuthentication
{
    public function sendMessage(User $user, TwoFactorAuthenticationCode $code): void
    {
        Mail::send(
            new TwoFactorAuthenticationMail($user, $code)
        );
    }
}