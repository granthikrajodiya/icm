<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    public function up()
    {
        Schema::create(
            'emails',
            function (Blueprint $table) {
                $table->id();
                $table->text('batch_id');
                $table->string('to');
                $table->string('subject');
                $table->text('description')->nullable();
                $table->integer('created_by');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
