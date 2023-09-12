<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ModulePermissionDef;

class ModulePermsDefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModulePermissionDef::create([
            'module_name'            => 'Calendar',
            'permission_key'         => ModulePermissionDef::ALL_TENANTS,
            'permission_level'       => 0,
            'permission_description' => "Manage events for all system users",
        ]);

        ModulePermissionDef::create([
            'module_name'            => 'Calendar',
            'permission_key'         => ModulePermissionDef::USER_TENANT,
            'permission_level'       => 1,
            'permission_description' => "Manage events for host users only",
        ]);

        ModulePermissionDef::create([
            'module_name'            => 'Calendar',
            'permission_key'         => ModulePermissionDef::PERSONAL,
            'permission_level'       => 2,
            'permission_description' => "Manage personal events only",
        ]);

        ModulePermissionDef::create([
            'module_name'            => 'Chat',
            'permission_key'         => ModulePermissionDef::ALL_TENANTS,
            'permission_level'       => 0,
            'permission_description' => "Can chat with any system user",
        ]);

        ModulePermissionDef::create([
            'module_name'            => 'Chat',
            'permission_key'         => ModulePermissionDef::HOST_CHAT_USERS,
            'permission_level'       => 1,
            'permission_description' => "Can chat only with enabled host users",
        ]);

        ModulePermissionDef::create([
            'module_name'            => 'Help & FAQ',
            'permission_key'         => ModulePermissionDef::ALL_CONTENT,
            'permission_level'       => 0,
            'permission_description' => "Manage all content",
        ]);

        ModulePermissionDef::create([
            'module_name'            => 'Custom Pages',
            'permission_key'         => ModulePermissionDef::ALL_CONTENT,
            'permission_level'       => 0,
            'permission_description' => "Manage all content",
        ]);
    }
}
