<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypesTimetables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_tables', function (Blueprint $table) {
            $table->string("sat_st")->nullable()->change();
            $table->string("sat_end")->nullable()->change();
            $table->string("sun_st")->nullable()->change();
            $table->string("sun_end")->nullable()->change();
            $table->string("mon_st")->nullable()->change();
            $table->string("mon_end")->nullable()->change();
            $table->string("tues_st")->nullable()->change();
            $table->string("tues_end")->nullable()->change();
            $table->string("wed_st")->nullable()->change();
            $table->string("wed_end")->nullable()->change();
            $table->string("thur_st")->nullable()->change();
            $table->string("thur_end")->nullable()->change();
            $table->string("fri_st")->nullable()->change();
            $table->string("fri_end")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('time_tables', function (Blueprint $table) {
            //
        });
    }
}
