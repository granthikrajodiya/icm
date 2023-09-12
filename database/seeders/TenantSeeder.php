<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    public function run()
    {
        Tenant::updateOrCreate(
            [
                'tenant_id' => 'host',
                'company_name' => 'ImageSource',
                'default_theme' => 'ilinx',
                'authentication_service' => 'ilinx',
                'company_phone' => '(132)530-6535',
                'account_status' => 1,
                'logo' => 'logo/host/logo.png',
                'banner' => 'logo/host/banner.png'
            ]
        );

        Tenant::updateOrCreate(
            [
                'tenant_id' => 'sso_okta',
                'company_name' => 'Okta',
                'authentication_service' => 'sso_okta',
                'company_phone' => '(132)530-6535',
                'account_status' => 0,
            ]
        );

        Tenant::updateOrCreate(
            [
                'tenant_id' => 'sso_aad',
                'company_name' => 'Microsoft Azure Active Directory (AA)',
                'authentication_service' => 'sso_aad',
                'company_phone' => '(132)530-6535',
                'account_status' => 0,
            ]
        );
    }
}
