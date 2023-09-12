<?php

namespace App\Actions\Seed;

use App\Models\CustomPage;
use App\Models\Layout;
use App\Models\LayoutDefinition;
use App\Models\Navigation;
use App\Models\User;

class NewTenantSeeder
{
    public static function execute(User $tenantUser)
    {
        BaseImageSeeder::execute($tenantUser->tenant_id);
    }

}
