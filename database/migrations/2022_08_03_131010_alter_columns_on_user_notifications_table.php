<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsOnUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('date_time');
            $table->dropColumn('text');
            $table->dropColumn('is_read');
        });

        Schema::table('user_notifications', function (Blueprint $table) {
            $table->string('username')->nullable();
            $table->string('tenant_id')->nullable();
            $table->string('scope');
            $table->text('text');
        });
    }


}
