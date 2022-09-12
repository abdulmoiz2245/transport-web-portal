<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePettyBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petty_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->nullable();
            // $table->string('po_id')->nullable();
            $table->string('account_id')->nullable();
            // $table->string('company')->nullable();
            $table->string('booking_date')->nullable();
            // $table->string('supplier')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('amount_remaning')->nullable();

            $table->string('reciving');
            $table->string('reciving_date');

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
        Schema::dropIfExists('petty_bookings');
    }
}
