<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingToTenantsTable extends Migration
{
    public function up()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('logo')->after('primary_contact')->nullable();
            $table->string('banner_type')->after('logo')->nullable();
            $table->string('banner')->after('banner_type')->nullable();
            $table->string('header_text')->after('banner')->nullable();
            $table->string('default_theme')->after('header_text')->nullable();
            $table->string('date_format')->after('default_theme')->nullable();
            $table->string('day_start')->after('date_format')->nullable();
            $table->integer('show_activities')->after('day_start')->default(1);
        });
    }

    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('logo');
            $table->dropColumn('banner_type');
            $table->dropColumn('banner');
            $table->dropColumn('header_text');
            $table->dropColumn('default_theme');
            $table->dropColumn('date_format');
            $table->dropColumn('day_start');
            $table->dropColumn('show_activities');
        });
    }
}
