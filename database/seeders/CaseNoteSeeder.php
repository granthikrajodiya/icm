<?php

namespace Database\Seeders;

use App\Models\CaseNote;
use App\Models\User;
use Illuminate\Database\Seeder;

class CaseNoteSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::where('email', 'team@devsquad.com')->first();

        CaseNote::factory(3)->create(['created_by' => $adminUser->id]);
    }
}
