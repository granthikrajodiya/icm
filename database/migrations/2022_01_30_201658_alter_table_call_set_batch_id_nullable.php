<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCallSetBatchIdNullable extends Migration
{
    public function up()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->text('batch_id')->nullable()->change();
        });
    }
}
