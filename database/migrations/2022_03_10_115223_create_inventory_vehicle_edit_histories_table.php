<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryVehicleEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_vehicle_edit_histories', function (Blueprint $table) {
            $table->id();

            $table->string('purchase_id')->nullable();
            $table->string('row_id')->nullable();


            $table->string('vechicle_type')->nullable();
            $table->string('make')->nullable();

            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('chassis_no')->nullable();
            $table->string('vehicle_suspension')->nullable();
            
            $table->string('trailer_type')->nullable();
            $table->string('size')->nullable();
            $table->string('axle')->nullable();

            
            $table->string('delivery_date')->nullable();
            $table->string('supplier_name')->nullable();
            
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
        Schema::dropIfExists('inventory_vehicle_edit_histories');
    }
}
