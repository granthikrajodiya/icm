<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::where('email', 'team@devsquad.com')->first();
        Faq::factory(3)->create(['created_by' => $adminUser->id]);
    }
}
