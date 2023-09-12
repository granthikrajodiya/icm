<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ird_time_tracking', function (Blueprint $table) {
            $table->string('batch_id', 100)->after('request_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ird_time_tracking', function (Blueprint $table) {
            $table->dropColumn('batch_id');
        });
    }
};
