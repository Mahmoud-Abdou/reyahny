<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vendor_id');
            $table->string("sat_st");
            $table->string("sat_end");
            $table->string("sun_st");
            $table->string("sun_end");
            $table->string("mon_st");
            $table->string("mon_end");
            $table->string("tues_st");
            $table->string("tues_end");
            $table->string("wed_st");
            $table->string("wed_end");
            $table->string("thur_st");
            $table->string("thur_end");
            $table->string("fri_st");
            $table->string("fri_end");
         
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
        Schema::dropIfExists('time_tables');
    }
}
