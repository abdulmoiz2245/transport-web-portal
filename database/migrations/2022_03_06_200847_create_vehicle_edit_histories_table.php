<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('row_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('registration_type')->nullable();
            $table->string('own_vehicle')->nullable();
            $table->string('haired_sub_contractor_vehicle')->nullable();
            $table->string('register_vehicle')->nullable();
            $table->string('sub_contractor_id')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('registration_date')->nullable();
            $table->string('registration_expiry_date')->nullable();
            $table->string('registration_upload')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('colour')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_entry_type')->nullable();
            $table->string('conpany_id')->nullable();
            $table->integer('approx_value')->nullable();
            $table->string('vehicle_suspension')->nullable();
            $table->string('trailer_type')->nullable();
            $table->string('trailer_size')->nullable();
            $table->string('axle')->nullable();
            $table->string('vehicle_truck_type')->nullable();
            $table->string('vehicle_pickup_type')->nullable();
            $table->string('vehicle_car_type')->nullable();
            $table->string('car_description')->nullable();
            $table->string('max_ton_capacity')->nullable();
            $table->string('vehicle_insurance')->nullable();
            $table->string('insurance_exp_date')->nullable();
            $table->string('insurance_upload')->nullable();
            $table->string('other_insurance')->nullable();
            $table->string('other_insurance_exp_date')->nullable();
            $table->string('other_insurance_upload')->nullable();
            $table->string('tag')->nullable();
            $table->string('tag_expiry')->nullable();
            $table->string('tag_upload')->nullable();
            $table->string('tag_specify')->nullable();
            $table->string('sticker')->nullable();
            $table->string('sticker_validity')->nullable();
            $table->string('sticker_upload')->nullable();
            $table->string('pass')->nullable();
            $table->string('pass_validity')->nullable();
            $table->string('pass_upload')->nullable();
            $table->string('med_kit')->nullable();
            $table->string('med_kit_exp_date')->nullable();
            $table->string('fire_ext')->nullable();
            $table->string('fire_ext_exp_date')->nullable();
            $table->string('fire_ext_weight')->nullable();
            $table->string('registration_type')->nullable();
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
            $table->string('registration_type')->nullable();
            $table->string('lashing_belts')->nullable();
            $table->string('lashing_belts_quantity')->nullable();
            $table->string('lashing_belts_size')->nullable();
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
            $table->string('vehicle_front_photo')->nullable();
            $table->string('vehicle_back_photo')->nullable();
            $table->string('vehicle_left_photo')->nullable();
            $table->string('vehicle_right_photo')->nullable();
            $table->string('trailer_front_photo')->nullable();
            $table->string('trailer_back_photo')->nullable();
            $table->string('trailer_left_photo')->nullable();
            $table->string('trailer_right_photo')->nullable();
            $table->string('equipment_photos')->nullable();

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
        Schema::dropIfExists('vehicle_edit_histories');
    }
}
