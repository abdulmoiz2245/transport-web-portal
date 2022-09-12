<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->nullable();
            $table->string('sr_no')->nullable();
            $table->string('own_hire_vehicle')->nullable();
            $table->string('subcontractor_id')->nullable();
            $table->string('vehicle_id')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('trailer_id')->nullable();
            $table->string('driver_trip')->nullable();
            $table->string('ap_km')->nullable();
            $table->string('ap_diesel')->nullable();
            $table->string('booking_status')->nullable();
            $table->string('loading_date')->nullable();
            $table->string('offloading_date')->nullable();
            $table->string('order_date')->nullable();
            $table->string('booking_date')->nullable();
            $table->string('status_update')->nullable();
            $table->string('vehicle_break_status')->nullable();
            $table->string('vehicle_break_repaier_person_name')->nullable();
            $table->string('pod')->nullable();
            $table->string('shipment_number')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('toll_charges')->nullable();
            $table->string('gate_charges')->nullable();
            $table->string('labour_charges')->nullable();
            $table->string('border_charges')->nullable();
            $table->string('other_charges')->nullable();
            $table->string('other_charges_description')->nullable();

            $table->string('status')->nullable();

            $table->string('action')->nullable();
            $table->string('status_message')->nullable();
            $table->string('row_status')->default('active')->nullable();
            $table->string('user_id')->default('0')->nullable();

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
        Schema::dropIfExists('bookings');
    }
}
