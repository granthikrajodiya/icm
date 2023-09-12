<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDetailsTypeToRestIntegrations extends Migration
{
    public function up()
    {
        Schema::table('rest_integrations', function (Blueprint $table) {
            $table->integer('details_type')->default(0)->comment('0 means no details, 1 means basic details, 2 open document');
        });
    }
    public function down()
    {
        Schema::table('rest_integrations', function (Blueprint $table) {
            $table->dropColumn('details_type');
        });
    }
}
