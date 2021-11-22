<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventorySparePartsEnteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_spare_parts_enteries', function (Blueprint $table) {
            $table->id();
            $table->string('part_description_id')->nullable();
            $table->string('person')->nullable();
            $table->string('vechicle')->nullable();
            $table->string('date')->nullable();
            $table->string('quantity')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('forman_name')->nullable();
            $table->string('requisition')->nullable();

            $table->string('action')->nullable();
            $table->string('status_message')->nullable();
            $table->string('row_status')->default('active');
            $table->string('user_id')->default('0');
            // $table->timestamps();

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
        Schema::dropIfExists('inventory_spare_parts_enteries');
    }
}
