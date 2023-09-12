<?php

namespace Database\Seeders;

use App\Models\LayoutDefinition;
use Illuminate\Database\Seeder;

class LayoutDefinitionSeeder extends Seeder
{
    public function run()
    {
        LayoutDefinition::updateOrCreate([
            'title'      => 'Engage',
            'user_group' => 1,
        ]);
    }
}
