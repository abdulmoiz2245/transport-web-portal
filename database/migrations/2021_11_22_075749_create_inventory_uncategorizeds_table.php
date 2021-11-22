<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryUncategorizedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_uncategorizeds', function (Blueprint $table) {
            $table->id();

            $table->date('date')->nullable();
            $table->string('product_name')->nullable();
            $table->string('made_in')->nullable();
            $table->string('brand')->nullable();
            $table->string('size')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->string('unit_price')->nullable();
            
            $table->string('po_number')->nullable();

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
        Schema::dropIfExists('inventory_uncategorizeds');
    }
}
