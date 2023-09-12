<?php

namespace App\Actions\Seed;

use App\Models\Tenant;

class BaseTenantSeeder
{
    public static function execute()
    {
        $tenant = Tenant::where('tenant_id', 'host')->first();
        if (empty($tenant)) {
            Tenant::create([
                'tenant_id'       => 'host',
                'company_name'    => 'ImageSource, Inc.',
                'company_phone'   => '(360)943-9273',
                'address'         => '3003 Sunset Way SE',
                'city'            => 'Olympia',
                'state'           => 'WA',
                'zip'             => '98501',
                'account_status'  => '1',
                'message'         => 'Default initial host information',
                'primary_contact' => '1',
                'data'            => ['id' => 1],
                'logo'            => 'logo/host/logo.png',
                'banner_type'     => 'color',
                'banner'          => 'null',
                'header_text'     => 'ILINX Engage',
                'default_theme'   => 'ilinx',
                'date_format'     => 'm/d/Y',
                'show_activities' => '1',
                'day_start'       => '08:00'
            ]);
        }
    }
}
