<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleEquipmentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_equipment_lists', function (Blueprint $table) {
            $table->id();
            $table->string('assign_unassign_vehicle_id')->nullable();
            $table->string('med_kit')->nullable();
            $table->string('med_kit_exp_date')->nullable();
            $table->string('fire_ext')->nullable();
            $table->string('fire_ext_exp_date')->nullable();
            $table->string('fire_ext_weight')->nullable();
            $table->string('jack')->nullable();
            $table->string('spare_wheel')->nullable();
            $table->string('spare_wheel_quantity')->nullable();
            $table->string('spare_wheel_size')->nullable();
            $table->string('safety_triangle')->nullable();
            $table->string('extra_emergency_light')->nullable();
            $table->string('safety_shoes')->nullable();
            $table->string('safety_helmet')->nullable();
            $table->string('safety_gloves')->nullable();
            $table->string('safety_jacket')->nullable();
            $table->string('safety_ear_plug')->nullable();
            $table->string('lashing_belts')->nullable();
            $table->string('lashing_belt_short_quantity')->nullable();
            $table->string('lashing_belt_long_quantity')->nullable();

            $table->string('lashing_chain')->nullable();
            $table->string('lashing_chain_quantity')->nullable();
            $table->string('side_grill')->nullable();
            $table->string('side_grill_quantity')->nullable();
            $table->string('side_grill_height')->nullable();
            $table->string('lashing_angle')->nullable();
            $table->string('lashing_angle_quantity')->nullable();
            $table->string('lashing_angle_size')->nullable();
            $table->string('container_lock')->nullable();
            $table->string('rope_seal')->nullable();
            $table->string('tail_lift')->nullable();
            $table->string('trolly')->nullable();
            $table->string('tarpaulin')->nullable();
            $table->string('tarpaulin_size')->nullable();
            $table->string('tarpaulin_type')->nullable();
            $table->string('assign_date')->nullable();
            $table->string('unassign_date')->nullable();
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
        Schema::dropIfExists('vehicle_equipment_lists');
    }
}
