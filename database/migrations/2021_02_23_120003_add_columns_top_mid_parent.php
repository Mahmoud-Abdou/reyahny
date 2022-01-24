<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsTopMidParent extends Migration
{
    /**
     * Run the migra0tions.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multi_bookings', function (Blueprint $table) {
            $table->string('top_parent')->default('0')->after("package_id");
            $table->string('mid_parent')->default('0')->after("package_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multi_bookings', function (Blueprint $table) {
            //
        });
    }
}
