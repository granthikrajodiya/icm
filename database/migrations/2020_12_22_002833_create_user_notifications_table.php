<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('type')->nullable();
            $table->dateTime('date_time');
            $table->text('text')->nullable();
            $table->boolean('is_read')->default(0);
            $table->string('link_title')->nullable();
            $table->string('link_color', 50)->nullable();
            $table->string('link_url')->nullable();
            $table->string('link_type', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_notifications');
    }
}
