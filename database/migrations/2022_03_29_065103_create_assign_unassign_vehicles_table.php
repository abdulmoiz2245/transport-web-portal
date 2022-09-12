<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignUnassignVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_unassign_vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('vehicle_id')->nullable();
            $table->string('trailer_id')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('vehicle_status')->nullable();
            $table->string('assign_date')->nullable();
            $table->string('unassign_date')->nullable();
            $table->string('handover_form')->nullable();
            $table->string('equipment_list_form')->nullable();
            $table->string('equipment_list_id')->nullable();

            $table->string('vehicle_interior_photo')->nullable();
            $table->string('vehicle_exterior_photo')->nullable();
            $table->string('trailer_left_photo')->nullable();
            $table->string('trailer_right_photo')->nullable();
            $table->string('trailer_front_photo')->nullable();
            $table->string('trailer_back_photo')->nullable();


            $table->string('status')->nullable();

            $table->string('action')->nullable();
            $table->string('status_message')->nullable();
            $table->string('row_status')->default('active');
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
        Schema::dropIfExists('assign_unassign_vehicles');
    }
}
