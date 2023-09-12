<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $user      = User::where('email', 'team@devsquad.com')->first();
        $createdBy = $user->id;

        foreach (Setting::VALUES as $value) {
            $value['created_by'] = $createdBy;
            Setting::create($value);
        }
    }
}
