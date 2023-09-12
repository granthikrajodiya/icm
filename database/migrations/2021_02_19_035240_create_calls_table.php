<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    public function up()
    {
        Schema::create(
            'calls',
            function (Blueprint $table) {
                $table->id();
                $table->text('batch_id');
                $table->string('subject');
                $table->string('call_type', 30);
                $table->string('duration', 20);
                $table->integer('user_id');
                $table->text('description')->nullable();
                $table->date('call_date')->nullable();
                $table->integer('created_by');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('calls');
    }
}
