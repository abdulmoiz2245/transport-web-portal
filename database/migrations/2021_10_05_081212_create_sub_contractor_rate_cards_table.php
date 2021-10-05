<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubContractorRateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_contractor_rate_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('sub_contractor_id');
            $table->integer('customer_id');

            $table->string('from');
            $table->string('to');
            $table->string('vechicle_type');
            $table->string('rate');
            $table->string('rate_price');

            // $table->string('driver_comission'); // friday * 1.5
            $table->string('other_carges');
            $table->string('other_des');
            // $table->string('detention');
            // $table->string('time');
            // $table->string('charges');
            // $table->string('trip');
            $table->string('ap_km');
            // $table->string('ap_diesel');
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
        Schema::dropIfExists('sub_contractor_rate_cards');
    }
}
