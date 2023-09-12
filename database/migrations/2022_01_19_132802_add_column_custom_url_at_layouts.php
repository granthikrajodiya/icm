<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCustomUrlAtLayouts extends Migration
{
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->string('custom_url')->nullable()->default(null);
        });
    }
    public function down()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->dropColumn('custom_url');
        });
    }
}
