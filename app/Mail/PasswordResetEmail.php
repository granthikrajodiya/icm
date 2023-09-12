<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetEmail)
    {
        $this->resetEmail = $resetEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('email.from.address'), config('email.from.name'))
            ->markdown('email.password_reset_email')
            ->subject(__('Password reset'))
            ->with([
                'link' => $this->resetEmail['link'],
            ]);
    }
}
