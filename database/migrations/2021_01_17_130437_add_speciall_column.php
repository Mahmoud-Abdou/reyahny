<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpeciallColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->integer('special')->default(0)->after('recommend');
        });
    }

    public function down()
    {
        Schema::table('vendors', function (Blueprint $table) {
            //
        });
    }
}
