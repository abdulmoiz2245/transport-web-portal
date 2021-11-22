<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventorySparePartsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_spare_parts_histories', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->integer('user_id');
            $table->timestamp('date');
            $table->string('route_name');
            $table->integer('data_id');
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
        Schema::dropIfExists('inventory_spare_parts_histories');
    }
}
