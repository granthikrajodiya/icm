<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLayoutDefinitionAtUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('layout_definition')->unsigned()->nullable()->default(null);
            $table->foreign('layout_definition')->references('id')->on('layout_definitions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['layout_definition']);
            $table->dropColumn('layout_definition');
        });
    }
}
