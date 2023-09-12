<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSecurityGroupsToLayoutDefinitionsTable extends Migration
{
    public function up()
    {
        Schema::table('layout_definitions', function (Blueprint $table) {
            $table->text('security_groups')->after('user_group')->nullable();
        });
    }

    public function down()
    {
        Schema::table('layout_definitions', function (Blueprint $table) {
            $table->dropColumn('security_groups');
        });
    }
}
