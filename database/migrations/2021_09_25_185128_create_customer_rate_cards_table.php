<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_rate_card', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('from');
            $table->string('to');
            $table->integer('vechicle_type');
            $table->string('rate');
            $table->string('driver_comission'); // friday * 1.5
            $table->string('other_carges');
            $table->string('other_des');
            $table->string('detention');
            $table->string('time');
            $table->string('charges');
            $table->string('trip');
            $table->string('ap_km');
            $table->string('ap_diesel');
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
        Schema::dropIfExists('customer_rate_card');
    }
}
