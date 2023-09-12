<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrdDeliveryJobsTable extends Migration
{
    public function up()
    {
        Schema::create('ird_delivery_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_id', 100)->nullable();
            $table->string('request_number', 100)->nullable();
            $table->string('ics_appname', 100)->nullable();
            $table->string('ics_documentid', 100)->nullable();
            $table->integer('created_by')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ird_delivery_jobs');
    }
}
