<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclePassTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_pass_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();

            $table->string('status')->nullable();
            $table->string('action')->nullable();
            $table->string('row_status')->nullable();
            $table->string('status_message')->nullable();
            $table->string('user_id')->nullable();
            
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
        Schema::dropIfExists('vehicle_pass_types');
    }
}
