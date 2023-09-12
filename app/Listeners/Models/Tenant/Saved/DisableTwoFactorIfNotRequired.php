<?php

namespace App\Listeners\Models\Tenant\Saved;

use App\Events\Models\Tenant\Saved as TenantSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class DisableTwoFactorIfNotRequired
{
    public function handle(TenantSaved $event): void
    {
        if ((bool) $event->tenant->require_two_factor_authentication === true) {
            return;
        }

        Session::remove('two_factor');
    }
}
