<?php

use App\Models\Tenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAuthenticationServiceToTenants extends Migration
{
    public function up()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('authentication_service')->default(Tenant::AUTH_SERVICE_ILINX);
        });
    }
    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('authentication_service');
        });
    }
}
