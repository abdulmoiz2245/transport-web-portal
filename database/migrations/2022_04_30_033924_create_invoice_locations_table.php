<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_locations', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->nullable();
            $table->string('job_id')->nullable();
            $table->string('from_location')->nullable();
            $table->string('to_location')->nullable();
            $table->string('toll_charges')->nullable();
            $table->string('gate_charges')->nullable();
            $table->string('labour_charges')->nullable();
            $table->string('border_charges')->nullable();
            $table->string('other_charges')->nullable();
            $table->string('other_charges_description')->nullable();
            $table->string('deten_rate')->nullable();
            $table->string('detention_duration')->nullable();
            $table->string('detention_type')->nullable();
            $table->string('loading_date')->nullable();
            $table->string('offloading_date')->nullable();
            $table->string('booking_date')->nullable();
            $table->string('vehicle_id')->nullable();
            $table->string('trailer_id')->nullable();
            $table->string('job_price')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('discount')->nullable();

            $table->string('status')->nullable();
            $table->string('action')->nullable();
            $table->string('row_status')->nullable()->default('active');
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
        Schema::dropIfExists('invoice_locations');
    }
}
