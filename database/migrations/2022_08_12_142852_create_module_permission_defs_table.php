<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_permission_defs', function (Blueprint $table) {
            $table->id();
            $table->string('module_name');
            $table->string('permission_key');
            $table->integer('permission_level');
            $table->string('permission_description');
            $table->timestamps();
        });


        // Call seeder
        Artisan::call('db:seed', [
            '--class' => 'ModulePermsDefSeeder',
            '--force' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_permission_defs');
    }
};
