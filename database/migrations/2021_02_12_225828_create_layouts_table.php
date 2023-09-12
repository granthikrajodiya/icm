<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutsTable extends Migration
{
    public function up()
    {
        Schema::create('layouts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('single_item');
            $table->string('plural_item');
            $table->string('position')->default('top')->nullable();
            $table->string('width', 5)->default(100);
            $table->integer('max_item')->default(0);
            $table->string('content_type');
            $table->string('data_source');
            $table->integer('order_no')->default(0);
            $table->integer('layout_definition_id')->default(0)->comment('0 = customer/client, 1 = internal admin, 2 = internal non-admin, 3 = public, 4 = external admin');
            $table->text('eform_url')->nullable();
            $table->integer('created_by')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('layouts');
    }
}
