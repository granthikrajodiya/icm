<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ModulePermissionDef;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ModulePermissionDef::create([
            'module_name'            => 'News Feeds',
            'permission_key'         => ModulePermissionDef::ALL_CONTENT,
            'permission_level'       => 0,
            'permission_description' => 'Manage all posts',
        ]);
    }


};
