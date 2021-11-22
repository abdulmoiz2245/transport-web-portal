<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelTransferHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_transfer_histories', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->integer('user_id');
            $table->timestamp('date');
            $table->string('route_name');
            $table->integer('data_id');
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
        Schema::dropIfExists('fuel_transfer_histories');
    }
}
