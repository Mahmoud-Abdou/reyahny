<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThreeColumnServiceVendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services_vendors', function (Blueprint $table) {
            $table->string('cost')->nullable()->after('service_id');
            $table->string('duration')->nullable()->after('service_id');
            $table->string('discount')->nullable()->after('service_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services_vendors', function (Blueprint $table) {
            //
        });
    }
}
