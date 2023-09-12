<?php

namespace Database\Seeders;

use App\Models\RestIntegration;
use App\Models\User;
use Illuminate\Database\Seeder;

class RestIntegrationSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::where('email', 'team@devsquad.com')->first();
        RestIntegration::factory(5)->create(['created_by' => $adminUser->id]);
    }
}
