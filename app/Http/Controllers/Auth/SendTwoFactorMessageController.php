<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Support\RandomStringGenerator;
use App\Models\TwoFactorAuthenticationCode;
use App\Support\TwoFactorAuthentication\TwoFactorAuthentication;

class SendTwoFactorMessageController extends Controller
{
    public function __construct(
        private RandomStringGenerator $generator,
        private TwoFactorAuthentication $twoFactorAuthentication,
    )
    {
    }

    public function __invoke(): Response
    {
        /** @var User */
        $authenticatedUser = Auth::user();

        $authenticatedUser->twoFactorAuthenticationCode()->delete();

        /** @var TwoFactorAuthenticationCode */
        $twoFactor = $authenticatedUser->twoFactorAuthenticationCode()->create([
            'code' => $this->generator->generate(),
        ]);

        $this->twoFactorAuthentication->sendMessage($authenticatedUser, $twoFactor);

        return response()->noContent();
    }
}
