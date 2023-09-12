<?php

namespace Database\Seeders;

use App\Models\Calendar;
use App\Models\User;
use Illuminate\Database\Seeder;

class CalendarSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'team@devsquad.com')->first();

        Calendar::factory(10)->create(['created_by' => $user->id]);
    }
}
