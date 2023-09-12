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
        Schema::create('qapp_definitions', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->string('name',255)->nullable();
            $table->longText('description')->nullable();
            $table->integer('online')->default(0);
            $table->integer('allow_upload')->default(0);
            $table->integer('allow_download')->default(0);
            $table->integer('allow_print')->default(0);
            $table->longText('form_json')->nullable();
            $table->longText('ics_appname')->nullable();
            $table->integer('card_mode')->default(0);
            $table->integer('navigation_mode')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qapp_definitions');
    }
};
