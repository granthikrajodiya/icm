<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $tenant = Tenant::where('tenant_id', 'host')->first();
        User::factory()->create([
            'username'       => 'teamdevsquad',
            'email'          => 'team@devsquad.com',
            'tenant_id'      => $tenant->tenant_id,
            'account_status' => 'active',
            'account_type'   => User::INTERNAL_TENANT_ADMIN
        ]);
        User::updateOrCreate([
            'name'           => 'Casey Adminner',
            'username'       => 'caseadmin',
            'email'          => 'case@admin.com',
            'password'       => '$2y$10$H0a4Kw9EyuRseopb2YfM6OBRTtG3o1J2Zl.63O9OoZbKi5XHUKbam',
            'tenant_id'      => $tenant->tenant_id,
            'account_status' => 'active',
            'account_type'   => User::INTERNAL_TENANT_ADMIN,
            'password_change_at' => '1973-10-14T19:19:00.000Z'
        ]);
        User::updateOrCreate([
            'name'           => 'VN regular user 1',
            'username'       => 'vnr1',
            'email'          => 'randyw@imagesourceinc.com', //'vnr1@aaa.com',
            'password'       => '$2y$10$H0a4Kw9EyuRseopb2YfM6OBRTtG3o1J2Zl.63O9OoZbKi5XHUKbam',
            'tenant_id'      => $tenant->tenant_id,
            'account_status' => 'active',
            'account_type'   => User::INTERNAL_TENANT_ADMIN,
            'password_change_at' => '1973-10-14T19:19:00.000Z'
        ]);
        User::updateOrCreate([
            'name'           => 'Casey Nonadminner',
            'username'       => 'casenonadmin',
            'email'          => 'case@casenonadmin.com',
            'password'       => '$2y$10$H0a4Kw9EyuRseopb2YfM6OBRTtG3o1J2Zl.63O9OoZbKi5XHUKbam',
            'tenant_id'      => $tenant->tenant_id,
            'account_status' => 'active',
            'account_type'   => User::INTERNAL_TENANT_USER,
            'password_change_at' => '1973-10-14T19:19:00.000Z'
        ]);
        User::updateOrCreate([
            'name'           => 'VN regular user 2',
            'username'       => 'vnr2',
            'email'          => 'vnr2@bbb.com',
            'password'       => '$2y$10$H0a4Kw9EyuRseopb2YfM6OBRTtG3o1J2Zl.63O9OoZbKi5XHUKbam',
            'tenant_id'      => $tenant->tenant_id,
            'account_status' => 'active',
            'account_type'   => User::INTERNAL_TENANT_USER,
            'password_change_at' => '1973-10-14T19:19:00.000Z'
        ]);

        Tenant::all()->each(function ($tenant) {
            $tenant->users()
                ->saveMany(
                    User::factory(5)->create(['tenant_id' => $tenant->tenant_id])
                );
        });
    }
}
