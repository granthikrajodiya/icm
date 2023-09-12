<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrdTimeTrackingsTable extends Migration
{
    public function up()
    {
        Schema::create(
            'ird_time_tracking',
            function (Blueprint $table) {
                $table->id();
                $table->integer('created_by')->default(0);
                $table->string('created_by_name', 100)->nullable();
                $table->string('request_number', 100)->nullable();
                $table->decimal('hours');
                $table->text('notes')->nullable();
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('ird_time_tracking');
    }
}
