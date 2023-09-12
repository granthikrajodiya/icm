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
        Schema::create('ird_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id', 100);
            $table->string('request_number', 100);
            $table->string('requestor_type', 200);
            $table->date('open_date')->nullable();
            $table->date('original_due_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('closed_date')->nullable();
            $table->integer('total_response_days')->nullable();
            $table->integer('adjusted_due_date_days')->nullable();
            $table->boolean('additional_info_requested')->nullable();
            $table->string('closed_category', 200)->nullable();
            $table->longText('closed_category_note')->nullable();
            $table->longText('applied_redaction_codes')->nullable();
            $table->boolean('delivery_electronic')->nullable();
            $table->boolean('delivery_physical')->nullable();
            $table->boolean('required_scanning')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ird_statistics');
    }
};
