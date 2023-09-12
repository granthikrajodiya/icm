<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAdvConfigAtNavigations extends Migration
{
    public function up()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->string('adv_config')->nullable()->default('0');
        });
    }

    public function down()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->dropColumn('adv_config');
        });
    }
};
