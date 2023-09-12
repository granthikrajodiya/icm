<?php

namespace App\Actions\Mail;

use App\Models\MailSetting;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class RegisterMailSettings
{
    public function execute(): void
    {
        $mailSetting = MailSetting::first();

        if (! $mailSetting instanceof MailSetting) {
            return;
        }

        Config::set('mail', [
            'driver'     => $mailSetting->mail_driver,
            'host'       => $mailSetting->mail_host,
            'port'       => $mailSetting->mail_port,
            'username'   => $mailSetting->mail_username,
            'password'   => $mailSetting->mail_password,
            'encryption' => $mailSetting->mail_encryption,
            'from'       => [
                'address' => $mailSetting->mail_from_address,
                'name'    => $mailSetting->mail_from_name,
            ],
            'sendmail' => '/usr/sbin/sendmail -bs',
            'pretend'  => false,
        ]);

        App::register(MailServiceProvider::class);
    }
}