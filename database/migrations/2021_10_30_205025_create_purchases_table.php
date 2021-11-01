<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('date' )->nullable();
            $table->integer('trn')->nullable();
            $table->string('lpo_ref_num')->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('meterial_data_id')->nullable();
            $table->string('type')->nullable();
            $table->string('made_in')->nullable();

            $table->string('vechicle_num')->nullable();
            $table->string('stock_description')->nullable();
            $table->string('product_name')->nullable();
            $table->string('brand')->nullable();
            $table->string('size')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('terms')->nullable();
            $table->string('cerdit_days')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
