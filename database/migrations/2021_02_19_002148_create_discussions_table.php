<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionsTable extends Migration
{
    public function up()
    {
        Schema::create(
            'discussions',
            function (Blueprint $table) {
                $table->id();
                $table->text('batch_id');
                $table->text('comment');
                $table->integer('created_by');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('discussions');
    }
}
