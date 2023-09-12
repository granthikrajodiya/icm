<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSsoConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sso_configurations', function (Blueprint $table) {
            $table->id();

            $table->string('sso_type');
            $table->string('login_url');
            $table->string('issuer_url');
            $table->string('logout_url');
            $table->string('certificate_path');
            $table->string('key_path');
            $table->boolean('autocreate_authenticated_users')->default(false);

            $table->unsignedBigInteger('tenant_id');

            $table->foreign('tenant_id')->references('id')->on('tenants')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sso_configurations');
    }
};
