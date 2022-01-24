<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("phone")->nullable();
            $table->string("image")->nullable();
            $table->string("city_id");
            $table->string("town_id");
            $table->text("about_us")->nullable();
            $table->text("gallery")->nullable();
            $table->string("num_seats")->nullable();
            $table->string("type_queue")->nullable();
            $table->integer("parent_vendor")->nullable();
            $table->string("burber_gender")->nullable();

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
        Schema::dropIfExists('client_details');
    }
}
