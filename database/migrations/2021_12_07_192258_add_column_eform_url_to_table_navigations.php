<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEformUrlToTableNavigations extends Migration
{
    public function up()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->text('eform_url')->nullable();
        });
    }

    public function down()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->dropColumn('eform_url');
        });
    }
}
