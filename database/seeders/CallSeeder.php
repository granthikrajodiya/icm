<?php

namespace Database\Seeders;

use App\Models\Call;
use App\Models\User;
use Illuminate\Database\Seeder;

class CallSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::where('email', 'team@devsquad.com')->first();

        User::where('email', '!=', 'team@devsquad.com')->take(5)->each(function (User $user) use ($adminUser) {
            Call::factory(3)->create(['user_id' => $user->id, 'created_by' => $adminUser->id]);
        });
    }
}
