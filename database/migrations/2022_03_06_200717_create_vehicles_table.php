<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->string('registration_type',50)->nullable();
            $table->string('own_vehicle',50)->nullable();
            $table->string('haired_sub_contractor_vehicle',50)->nullable();
            $table->string('register_vehicle',50)->nullable();
            $table->string('sub_contractor_id',50)->nullable();
            $table->string('vehicle_number',50)->nullable();
            $table->string('registration_date',50)->nullable();
            $table->string('registration_expiry_date',50)->nullable();
            $table->string('registration_upload',50)->nullable();
            $table->string('make',50)->nullable();
            $table->string('model',50)->nullable();
            $table->string('colour',50)->nullable();
            $table->string('engine_number',50)->nullable();
            $table->string('chassis_number',50)->nullable();
            $table->string('vehicle_type',50)->nullable();
            $table->string('vehicle_entry_type',50)->nullable();
            $table->string('conpany_id',50)->nullable();
            $table->integer('approx_value',50)->nullable();
            $table->string('vehicle_suspension',50)->nullable();
            $table->string('trailer_type',50)->nullable();
            $table->string('trailer_size',50)->nullable();
            $table->string('axle',50)->nullable();
            $table->string('vehicle_truck_type',50)->nullable();
            $table->string('vehicle_pickup_type',50)->nullable();
            $table->string('vehicle_car_type',50)->nullable();
            $table->string('car_description',50)->nullable();
            $table->string('max_ton_capacity',50)->nullable();
            $table->string('vehicle_insurance',50)->nullable();
            $table->string('insurance_exp_date',50)->nullable();
            $table->string('insurance_upload',50)->nullable();
            $table->string('other_insurance',50)->nullable();
            $table->string('other_insurance_exp_date',50)->nullable();
            $table->string('other_insurance_upload',50)->nullable();
            $table->string('tag',50)->nullable();
            $table->string('tag_expiry',50)->nullable();
            $table->string('tag_upload',50)->nullable();
            $table->string('tag_specify',50)->nullable();
            $table->string('sticker',50)->nullable();
            $table->string('sticker_validity',50)->nullable();
            $table->string('sticker_upload',50)->nullable();
            $table->string('pass',50)->nullable();
            $table->string('pass_validity',50)->nullable();
            $table->string('pass_upload',50)->nullable();
            $table->string('med_kit',50)->nullable();
            $table->string('med_kit_exp_date',50)->nullable();
            $table->string('fire_ext',50)->nullable();
            $table->string('fire_ext_exp_date',50)->nullable();
            $table->string('fire_ext_weight',50)->nullable();
            $table->string('jack',50)->nullable();
            $table->string('spare_wheel',50)->nullable();
            $table->string('spare_wheel_quantity',50)->nullable();
            $table->string('spare_wheel_size',50)->nullable();
            $table->string('safety_triangle',50)->nullable();
            $table->string('extra_emergency_light',50)->nullable();
            $table->string('safety_shoes',50)->nullable();
            $table->string('safety_helmet',50)->nullable();
            $table->string('safety_gloves',50)->nullable();
            $table->string('safety_jacket',50)->nullable();
            $table->string('safety_ear_plug',50)->nullable();
            $table->string('lashing_belts',50)->nullable();
            $table->string('lashing_belts_quantity',50)->nullable();
            $table->string('lashing_belts_size',50)->nullable();
            $table->string('lashing_chain',50)->nullable();
            $table->string('lashing_chain_quantity',50)->nullable();
            $table->string('side_grill',50)->nullable();
            $table->string('side_grill_quantity',50)->nullable();
            $table->string('side_grill_height',50)->nullable();
            $table->string('lashing_angle',50)->nullable();
            $table->string('lashing_angle_quantity',50)->nullable();
            $table->string('lashing_angle_size',50)->nullable();
            $table->string('container_lock',50)->nullable();
            $table->string('rope_seal',50)->nullable();
            $table->string('tail_lift',50)->nullable();
            $table->string('trolly',50)->nullable();
            $table->string('tarpaulin',50)->nullable();
            $table->string('tarpaulin_size',50)->nullable();
            $table->string('tarpaulin_type',50)->nullable();
            $table->string('vehicle_front_photo',50)->nullable();
            $table->string('vehicle_back_photo',50)->nullable();
            $table->string('vehicle_left_photo',50)->nullable();
            $table->string('vehicle_right_photo',50)->nullable();
            $table->string('trailer_front_photo',50)->nullable();
            $table->string('trailer_back_photo',50)->nullable();
            $table->string('trailer_left_photo',50)->nullable();
            $table->string('trailer_right_photo',50)->nullable();
            $table->string('equipment_photos',50)->nullable();

            $table->string('status',50)->nullable();
            $table->string('action',50)->nullable();
            $table->string('row_status',50)->nullable();
            $table->string('status_message',50)->nullable();
            $table->string('user_id',50)->nullable();


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
        Schema::dropIfExists('vehicles');
    }
}
