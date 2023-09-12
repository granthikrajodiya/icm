<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyCreatedByToCustomPagesTable extends Migration
{
    public function up()
    {
        DB::transaction(function () {
            Schema::table('custom_pages', function (Blueprint $table) {
                $table->unsignedBigInteger('created_by_backup')->nullable();
            });

            $rows = DB::table('custom_pages')->get(['id', 'created_by']);
            foreach ($rows as $row) {
                DB::table('custom_pages')
                    ->where('id', $row->id)
                    ->update(['created_by_backup' => $row->created_by]);
            }
            Schema::table('custom_pages', function (Blueprint $table) {
                $table->dropColumn('created_by');
                $table->renameColumn('created_by_backup', 'created_by');
                $table->index('created_by');
                $table->foreign('created_by')->references('id')->on('users');
            });
        });
    }

    public function down()
    {
        Schema::table('custom_pages', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropIndex(['created_by']);
        });
    }
}
