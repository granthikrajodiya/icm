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
        Schema::table('ird_solicitation_emails', function (Blueprint $table) {
            $table->string('upload_id', 100)->after('batch_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ird_solicitation_emails', function (Blueprint $table) {
            $table->dropColumn('upload_id');
        });
    }
};
