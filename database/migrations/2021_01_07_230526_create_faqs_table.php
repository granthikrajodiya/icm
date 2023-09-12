<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    public function up()
    {
        Schema::create(
            'faqs',
            function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->longText('detail')->nullable();
                $table->integer('created_by');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('faqs');
    }
}
