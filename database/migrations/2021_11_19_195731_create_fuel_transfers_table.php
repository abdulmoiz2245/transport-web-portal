<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_transfers', function (Blueprint $table) {
            $table->id();
            $table->string("non_mobile_reading")->nullable();
            $table->string("non_mobile_refill_amount")->nullable();
            $table->string("mobile_reading")->nullable();
            $table->string("mobile_refill_amount")->nullable();
            $table->string("inter_tank_transfer_amount")->nullable();
            $table->string("inter_tank_transfer_from")->nullable();
            $table->string("fuel_entery")->nullable();
            $table->date("date")->nullable();
            $table->string('status')->nullable();
            $table->string('action')->nullable();
            $table->string('status_message')->nullable();
            $table->string('user_id')->default('0');

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
        Schema::dropIfExists('fuel_transfers');
    }
}
