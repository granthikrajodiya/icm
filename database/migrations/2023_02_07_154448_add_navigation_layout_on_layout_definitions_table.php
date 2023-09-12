<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\LayoutDefinition;

class AddNavigationLayoutOnLayoutDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('layout_definitions', function (Blueprint $table) {
            $table->string('navigation_layout')->default(LayoutDefinition::NAVIGATION_LAYOUT_GRID);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('layout_definitions', function (Blueprint $table) {
            $table->dropColumn('navigation_layout');
        });
    }
};
