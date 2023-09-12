<?php

namespace App\Listeners\Models\Tenant\Saved;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Facades\Mail;
use App\Support\RandomStringGenerator;
use Illuminate\Queue\InteractsWithQueue;
use App\Actions\Mail\RegisterMailSettings;
use App\Events\Models\Tenant\Saved as TenantSaved;
use App\Models\TwoFactorAuthenticationCode;
use App\Support\TwoFactorAuthentication\TwoFactorAuthentication;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTwoFactorCodes
{
    public function __construct(
        private RegisterMailSettings $registerMailSettings,
        private RandomStringGenerator $generator,
        private TwoFactorAuthentication $twoFactorAuthentication,
    )
    {
    }

    public function handle(TenantSaved $event): void
    {
        $tenant = $event->tenant;

        if ($tenant->isClean('require_two_factor_authentication') && $event->forceDirty === false) {
            return;
        }

        $tenant->fresh();

        if ((bool) $tenant->require_two_factor_authentication === false) {
            return;
        }

        $this->registerMailSettings->execute();

        $tenant->users()->each(function (User $user): void {
            $user->twoFactorAuthenticationCode()->delete();

            /** @var TwoFactorAuthenticationCode */
            $twoFactor = $user->twoFactorAuthenticationCode()->create([
                'code' => $this->generator->generate(),
            ]);

            $this->twoFactorAuthentication->sendMessage($user, $twoFactor);
        });
    }
}
