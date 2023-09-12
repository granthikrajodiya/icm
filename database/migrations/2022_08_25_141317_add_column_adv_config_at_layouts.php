<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAdvConfigAtLayouts extends Migration
{
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->text('adv_config')->nullable()->default("");
        });
    }

    public function down()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->dropColumn('adv_config');
        });
    }
};
