<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsOnLayoutDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('layout_definitions', function (Blueprint $table) {
            $table->integer('fixed_layout')->default(0);
            $table->integer('top_card_height')->nullable()->default(0);
            $table->integer('middle_card_height')->nullable()->default(0);
            $table->integer('bottom_card_height')->nullable()->default(0);
        });
    }


};
