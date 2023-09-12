<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserIdFieldOnActivitiesTable extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->bigInteger('user_id');
        });
    }
}
