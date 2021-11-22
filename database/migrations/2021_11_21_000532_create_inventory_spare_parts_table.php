<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventorySparePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_spare_parts', function (Blueprint $table) {
            $table->id();

            $table->string('condition')->nullable();
            $table->string('for')->nullable();
            $table->string('brand_namme')->nullable();
            $table->string('part_description')->nullable();
            $table->string('quantity')->nullable();


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
        Schema::dropIfExists('inventory_spare_parts');
    }
}
