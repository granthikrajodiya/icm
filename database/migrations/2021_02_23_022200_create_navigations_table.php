<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationsTable extends Migration
{
    public function up()
    {
        Schema::create(
            'navigations',
            function (Blueprint $table) {
                $table->id();
                $table->integer('order_no')->default(0);
                $table->string('title');
                $table->string('content_type');
                $table->string('data_source');
                $table->boolean('show_top_menu')->default(1);
                $table->boolean('show_nav_menu')->default(1);
                $table->integer('layout_definition_id')->default(0);
                $table->string('icon');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('navigations');
    }
}
