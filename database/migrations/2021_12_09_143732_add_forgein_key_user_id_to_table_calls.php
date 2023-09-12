<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForgeinKeyUserIdToTableCalls extends Migration
{
    public function up()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index()->change();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->bigInteger('user_id')->change();
        });
    }
}
