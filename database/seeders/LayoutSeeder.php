<?php

namespace Database\Seeders;

use App\Models\Layout;
use App\Models\User;
use Illuminate\Database\Seeder;

class LayoutSeeder extends Seeder
{
    public function run()
    {
        Layout::updateOrCreate([
            'title'                => 'Calendar',
            'single_item'          => 'Calendar',
            'plural_item'          => 'Calendars',
            'max_item'             => 10,
            'content_type'         => 'Calendar',
            'data_source'          => 'Standard Calendar',
            'order_no'             => 0,
            'layout_definition_id' => 1,
            'created_by'           => 1
        ]);
    }
}
