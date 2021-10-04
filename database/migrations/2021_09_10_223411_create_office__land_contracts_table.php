<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeLandContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office__land_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('contract_number')->nullable();
            $table->string('plot_details')->nullable();
            $table->string('landloard_name')->nullable();
            $table->date('contract_expiary_date')->nullable();
            $table->string('lease_rent')->nullable();
            $table->string('ijari_number')->nullable();
            $table->string('ijari_certificate')->nullable();
            $table->string('status');
            $table->string('status_message')->nullable();
            $table->string('action')->nullable();

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
        Schema::dropIfExists('office__land_contracts');
    }
}
