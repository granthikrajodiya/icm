<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyCreatedByOnDiscussionsTable extends Migration
{
    public function up()
    {
        Schema::table('discussions', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->change()->index();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('discussions', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropIndex(['created_by']);
        });
    }
}
