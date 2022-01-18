<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRateCardEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_rate_card_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('row_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->integer('vechicle_type')->nullable();
            $table->string('rate')->nullable();
            $table->float('rate_price')->nullable();
            $table->string('driver_comission')->nullable(); // friday * 1.5
            $table->string('other_carges')->nullable();
            $table->string('other_des')->nullable();
            $table->string('detention')->nullable();
            $table->string('time')->nullable();
            $table->string('charges')->nullable();
            $table->string('detention_days')->nullable();
            $table->string('detention_hours')->nullable();
             $table->string('detention_charges_days')->nullable();
            $table->string('detention_charges_hours')->nullable();
            $table->string('trip')->nullable();
            $table->string('ap_km')->nullable();
            $table->string('ap_diesel')->nullable();
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
        Schema::dropIfExists('customer_rate_card_edit_histories');
    }
}
