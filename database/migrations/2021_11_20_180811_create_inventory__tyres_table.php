<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTyresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory__tyres', function (Blueprint $table) {
            $table->id();
            $table->string('tyre_serial')->nullable();
            $table->string('brand')->nullable();
            $table->string('storage_location')->nullable();
            $table->string('status')->nullable();
            $table->string('complained')->nullable();
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
        Schema::dropIfExists('inventory__tyres');
    }
}
