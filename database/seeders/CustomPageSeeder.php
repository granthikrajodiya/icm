<?php

namespace Database\Seeders;

use App\Models\CustomPage;
use Illuminate\Database\Seeder;

class CustomPageSeeder extends Seeder
{
    public function run()
    {
        CustomPage::factory(5)->create();
    }
}
