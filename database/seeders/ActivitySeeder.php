<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        User::all()->random(3)->each(function (User $user) {
            Activity::factory(10)->create(['user_id' => $user->id]);
        });
    }
}
