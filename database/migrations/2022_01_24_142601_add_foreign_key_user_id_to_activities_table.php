<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyUserIdToActivitiesTable extends Migration
{
    public function up()
    {
        DB::transaction(function () {
            Schema::table('activities', function (Blueprint $table) {
                $table->unsignedBigInteger('created_by_backup')->nullable();
            });

            $rows = DB::table('user_notifications')->get(['id', 'user_id']);

            foreach ($rows as $row) {
                DB::table('activities')
                    ->where('id', $row->id)
                    ->update(['created_by_backup' => $row->user_id]);
            }
            Schema::table('activities', function (Blueprint $table) {
                $table->dropColumn('user_id');
                $table->renameColumn('created_by_backup', 'user_id');
                $table->index('user_id');
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            });
        });
    }

    public function down()
    {
    //     Schema::table('activities', function (Blueprint $table) {
    //         $table->dropForeign(['user_id']);
    //         $table->dropIndex(['user_id']);
    //     });
    }
}
