<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyUserIdToChFavoritesTable extends Migration
{
    public function up()
    {
        Schema::table('ch_favorites', function (Blueprint $table) {
            DB::transaction(function () {
                Schema::table('ch_favorites', function (Blueprint $table) {
                    $table->unsignedBigInteger('created_by_backup')->nullable();
                });

                $rows = DB::table('ch_favorites')->get(['id', 'user_id']);

                foreach ($rows as $row) {
                    DB::table('ch_favorites')
                        ->where('id', $row->id)
                        ->update(['created_by_backup' => $row->user_id]);
                }
                Schema::table('ch_favorites', function (Blueprint $table) {
                    $table->dropColumn('user_id');
                    $table->renameColumn('created_by_backup', 'user_id');
                    $table->index('user_id');
                    $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                });
            });
        });
    }

    public function down()
    {
        Schema::table('ch_favorites', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id']);
        });
    }
}
