<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestIntegrationsTable extends Migration
{
    public function up()
    {
        Schema::create('rest_integrations', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0)->comment('0 for authentication integration, others are child configuration such as search/list configuration and opening document configuration');
            $table->string('name');
            $table->text('rest_endpoint_url');
            $table->string('http_method');
            $table->integer('http_authentication')->default(0)->comment('0 means on and 1 means off');
            $table->text('http_username')->nullable();
            $table->text('http_password')->nullable();
            $table->integer('custom_http_headers')->default(1)->comment('0 means on and 1 means off');
            $table->text('http_headers')->nullable();
            $table->integer('data_format')->default(0)->comment('0 means Send Key-Value Pairs and 1 means Send Raw Data');
            $table->text('data_parameter')->nullable();
            $table->text('result_list')->nullable();
            $table->integer('integration_type')->default(0)->comment('0 means authentication integration, 1 search/list configuration, 2 means opening document configuration');
            $table->text('basic_details')->nullable();
            $table->integer('created_by')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rest_integrations');
    }
}
