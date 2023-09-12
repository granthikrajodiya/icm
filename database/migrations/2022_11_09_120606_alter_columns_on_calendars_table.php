<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsOnCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->dropColumn('attendee_type');
            $table->dropColumn('attendee_id');
        });

        Schema::table('calendars', function (Blueprint $table) {
            $table->string('username')->nullable();
            $table->string('tenant_id')->nullable();
            $table->string('scope')->nullable();
            $table->integer('all_day')->nullable()->default(0);
            $table->string('timezone')->nullable();
        });
    }


};
