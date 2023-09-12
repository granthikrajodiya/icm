<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOktaInformationTable extends Migration
{
    public function up()
    {
        Schema::create('okta_information', function (Blueprint $table) {
            $table->id();

            $table->string('destination_url');
            $table->string('issuer_url');
            $table->string('logout_url');
            $table->string('certificate_path');
            $table->string('key_path');

            $table->unsignedBigInteger('tenant_id');

            $table->foreign('tenant_id')->references('id')->on('tenants')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('okta_information');
    }
}
