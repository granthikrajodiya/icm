<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserIdFieldOnUserNotificationsTable extends Migration
{
    public function up()
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('user_notifications', function (Blueprint $table) {
            $table->bigInteger('user_id');
        });
    }
}
