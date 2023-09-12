<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create(
            'notes',
            function (Blueprint $table) {
                $table->id();
                $table->text('batch_id');
                $table->text('notes')->nullable();
                $table->integer('created_by');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
