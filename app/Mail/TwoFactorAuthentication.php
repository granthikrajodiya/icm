<?php

namespace App\Mail;

use App\Models\TwoFactorAuthenticationCode;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwoFactorAuthentication extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public TwoFactorAuthenticationCode $twoFactor,
    )
    {
    }

    public function build(): self
    {
        return $this->subject('Your Two-Factor Authentication Code')
            ->to($this->user->email)
            ->markdown('email.two-factor-authentication', [
                'user' => $this->user,
                'code' => $this->twoFactor->code,
            ]);
    }
}
