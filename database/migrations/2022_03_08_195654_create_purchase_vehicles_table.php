<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_vehicles', function (Blueprint $table) {
            $table->id();
            $table->date('date' )->nullable();
            $table->integer('trn')->nullable();
            $table->string('lpo_ref_num')->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('meterial_data_id')->nullable();
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
            $table->string('is_vat')->nullable();
            $table->string('supplier_status')->nullable();
            $table->string('supplier_id')->nullable();
            
            $table->string('total_amount')->nullable();
            $table->string('po_number')->nullable();

            $table->string('delivery_proof_copy')->nullable();
            $table->string('delivery_notes')->nullable();

            $table->string('status_admin');
            $table->string('status_account');

            $table->string('action')->nullable();
            $table->string('row_status')->nullable();
            $table->string('status_message')->nullable();
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
        Schema::dropIfExists('purchase_vehicles');
    }
}
