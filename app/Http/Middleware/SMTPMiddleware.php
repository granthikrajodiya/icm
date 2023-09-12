<?php

namespace App\Http\Middleware;

use App\Actions\Mail\RegisterMailSettings;
use App\Models\MailSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Mail\MailServiceProvider;

class SMTPMiddleware
{
    public function __construct(
        private RegisterMailSettings $registerMailSettings,
    )
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $this->registerMailSettings->execute();

        return $next($request);
    }
}
