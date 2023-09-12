<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::where('email', 'team@devsquad.com')->first();
        Note::factory(5)->create(['created_by' => $adminUser->id]);
    }
}
