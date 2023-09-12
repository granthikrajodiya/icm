<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('lang', 10)->default('en');
            $table->integer('created_by')->default(0);
            $table->smallInteger('account_type')->default(0)->comment('0 = customer/client, 1 = internal admin, 2 = internal non-admin, 3 = public, 4 = external admin');
            $table->string('account_status')->default('inactive');
            $table->text('account_status_message')->nullable();
            $table->smallInteger('chat_user')->default(0);
            $table->dateTime('last_login_at')->nullable();
            $table->dateTime('password_change_at')->nullable();
            $table->string('phone', 20)->nullable();
            $table->dateTime('notifications_read')->nullable();
            $table->string('communication_channel', 10)->nullable();
            $table->string('texting_number', 50)->nullable();
            $table->string('tenant_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
