<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    public function run()
    {
        Navigation::updateOrCreate([
            'order_no'             => 0,
            'title'                => 'Tasks',
            'content_type'         => 'All workflow views',
            'data_source'          => 'List all Workflow views',
            'show_top_menu'        => true,
            'show_nav_menu'        => true,
            'layout_definition_id' => 1,
            'icon'                 => 'fas fa-briefcase'
        ]);

        Navigation::updateOrCreate([
            'order_no'             => 0,
            'title'                => 'Calendar',
            'content_type'         => 'Calendar',
            'data_source'          => 'Standard Calendar',
            'show_top_menu'        => true,
            'show_nav_menu'        => true,
            'layout_definition_id' => 1,
            'icon'                 => 'fas fa-calendar-alt',
        ]);

        Navigation::updateOrCreate([
            'order_no'             => 0,
            'title'                => 'Forms',
            'content_type'         => 'Forms',
            'data_source'          => 'Available Forms',
            'show_top_menu'        => true,
            'show_nav_menu'        => true,
            'layout_definition_id' => 2,
            'icon'                 => 'fab fa-wpforms',
        ]);
    }
}
