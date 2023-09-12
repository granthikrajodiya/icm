<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Database\Seeder;

class UserNotificationSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::where('id', '1')->first();
        UserNotification::factory(5)->create(['username' => $adminUser->username, 'tenant_id' => $adminUser->tenant_id]);
    }
}