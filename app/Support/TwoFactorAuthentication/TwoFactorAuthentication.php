<?php

namespace App\Support\TwoFactorAuthentication;

use App\Models\TwoFactorAuthenticationCode;
use App\Models\User;

interface TwoFactorAuthentication
{
    /** Sends a message to the user with the 2FA code. */
    public function sendMessage(User $user, TwoFactorAuthenticationCode $code): void;
}