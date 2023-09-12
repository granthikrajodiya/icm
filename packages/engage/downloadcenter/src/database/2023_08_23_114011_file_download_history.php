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
        Schema::create('file_download_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenant_id', 255)->nullable();
            $table->integer('product_id')->nullable();
            $table->string('filename', 1024)->nullable();
            $table->dateTime('download_date')->nullable();
            $table->integer('download_user_id')->nullable();
            $table->dateTime('download_date')->nullable();
            $table->dateTime('download_date')->nullable();
            $table->timestamps();
            $table->integer('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_download_history');
    }
};
