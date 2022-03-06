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
            $table->text('registration_type')->length(50)->nullable();
            $table->text('own_vehicle')->length(50)->nullable();
            $table->text('haired_sub_contractor_vehicle')->length(50)->nullable();
            $table->text('register_vehicle')->length(50)->nullable();
            $table->text('sub_contractor_id')->length(50)->nullable();
            $table->text('vehicle_number')->length(50)->nullable();
            $table->text('registration_date')->length(50)->nullable();
            $table->text('registration_expiry_date')->length(50)->nullable();
            $table->text('registration_upload')->length(50)->nullable();
            $table->text('make')->length(50)->nullable();
            $table->text('model')->length(50)->nullable();
            $table->text('colour')->length(50)->nullable();
            $table->text('engine_number')->length(50)->nullable();
            $table->text('chassis_number')->length(50)->nullable();
            $table->text('vehicle_type')->length(50)->nullable();
            $table->text('vehicle_entry_type')->length(50)->nullable();
            $table->text('conpany_id')->length(50)->nullable();
            $table->integer('approx_value')->length(50)->nullable();
            $table->text('vehicle_suspension')->length(50)->nullable();
            $table->text('trailer_type')->length(50)->nullable();
            $table->text('trailer_size')->length(50)->nullable();
            $table->text('axle')->length(50)->nullable();
            $table->text('vehicle_truck_type')->length(50)->nullable();
            $table->text('vehicle_pickup_type')->length(50)->nullable();
            $table->text('vehicle_car_type')->length(50)->nullable();
            $table->text('car_description')->length(50)->nullable();
            $table->text('max_ton_capacity')->length(50)->nullable();
            $table->text('vehicle_insurance')->length(50)->nullable();
            $table->text('insurance_exp_date')->length(50)->nullable();
            $table->text('insurance_upload')->length(50)->nullable();
            $table->text('other_insurance')->length(50)->nullable();
            $table->text('other_insurance_exp_date')->length(50)->nullable();
            $table->text('other_insurance_upload')->length(50)->nullable();
            $table->text('tag')->length(50)->nullable();
            $table->text('tag_expiry')->length(50)->nullable();
            $table->text('tag_upload')->length(50)->nullable();
            $table->text('tag_specify')->length(50)->nullable();
            $table->text('sticker')->length(50)->nullable();
            $table->text('sticker_validity')->length(50)->nullable();
            $table->text('sticker_upload')->length(50)->nullable();
            $table->text('pass')->length(50)->nullable();
            $table->text('pass_validity')->length(50)->nullable();
            $table->text('pass_upload')->length(50)->nullable();
            $table->text('med_kit')->length(50)->nullable();
            $table->text('med_kit_exp_date')->length(50)->nullable();
            $table->text('fire_ext')->length(50)->nullable();
            $table->text('fire_ext_exp_date')->length(50)->nullable();
            $table->text('fire_ext_weight')->length(50)->nullable();
            $table->text('jack')->length(50)->nullable();
            $table->text('spare_wheel')->length(50)->nullable();
            $table->text('spare_wheel_quantity')->length(50)->nullable();
            $table->text('spare_wheel_size')->length(50)->nullable();
            $table->text('safety_triangle')->length(50)->nullable();
            $table->text('extra_emergency_light')->length(50)->nullable();
            $table->text('safety_shoes')->length(50)->nullable();
            $table->text('safety_helmet')->length(50)->nullable();
            $table->text('safety_gloves')->length(50)->nullable();
            $table->text('safety_jacket')->length(50)->nullable();
            $table->text('safety_ear_plug')->length(50)->nullable();
            $table->text('lashing_belts')->length(50)->nullable();
            $table->text('lashing_belts_quantity')->length(50)->nullable();
            $table->text('lashing_belts_size')->length(50)->nullable();
            $table->text('lashing_chain')->length(50)->nullable();
            $table->text('lashing_chain_quantity')->length(50)->nullable();
            $table->text('side_grill')->length(50)->nullable();
            $table->text('side_grill_quantity')->length(50)->nullable();
            $table->text('side_grill_height')->length(50)->nullable();
            $table->text('lashing_angle')->length(50)->nullable();
            $table->text('lashing_angle_quantity')->length(50)->nullable();
            $table->text('lashing_angle_size')->length(50)->nullable();
            $table->text('container_lock')->length(50)->nullable();
            $table->text('rope_seal')->length(50)->nullable();
            $table->text('tail_lift')->length(50)->nullable();
            $table->text('trolly')->length(50)->nullable();
            $table->text('tarpaulin')->length(50)->nullable();
            $table->text('tarpaulin_size')->length(50)->nullable();
            $table->text('tarpaulin_type')->length(50)->nullable();
            $table->text('vehicle_front_photo')->length(50)->nullable();
            $table->text('vehicle_back_photo')->length(50)->nullable();
            $table->text('vehicle_left_photo')->length(50)->nullable();
            $table->text('vehicle_right_photo')->length(50)->nullable();
            $table->text('trailer_front_photo')->length(50)->nullable();
            $table->text('trailer_back_photo')->length(50)->nullable();
            $table->text('trailer_left_photo')->length(50)->nullable();
            $table->text('trailer_right_photo')->length(50)->nullable();
            $table->text('equipment_photos')->length(50)->nullable();

            $table->text('status')->length(50)->nullable();
            $table->text('action')->length(50)->nullable();
            $table->text('row_status')->length(50)->nullable();
            $table->text('status_message')->length(50)->nullable();
            $table->text('user_id')->length(50)->nullable();


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
