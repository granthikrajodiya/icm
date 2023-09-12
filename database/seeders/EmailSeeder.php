<?php

namespace Database\Seeders;

use App\Models\Email;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::where('email', 'team@devsquad.com')->first();
        Email::factory(3)->create(['created_by' => $adminUser->id]);
    }
}
