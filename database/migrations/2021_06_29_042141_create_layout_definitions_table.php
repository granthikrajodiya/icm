<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutDefinitionsTable extends Migration
{
    public function up()
    {
        Schema::create('layout_definitions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('user_group')->default(1)->comment('1= Internal, 2= External, 3= Public');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('layout_definitions');
    }
}
