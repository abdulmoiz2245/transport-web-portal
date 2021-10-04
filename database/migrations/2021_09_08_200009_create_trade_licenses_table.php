<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_licenses', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->string('member_ship_certificate' )->default('null');
            $table->string('sponsor_page')->default('null');
            $table->string('trade_name')->nullable();
            $table->string('license_number')->nullable();
            $table->string('trade_license_copy')->default('null');
            $table->date('expiary_date' );

            $table->string('manager_id_card')->default('null');
            $table->string('sponsor_id_card')->default('null');
            $table->string('partners_id_card')->default('null');

            $table->string('manager_visa' )->default('null');
            $table->string('sponsor_visa' )->default('null');
            $table->string('partners_visa' )->default('null');

            $table->string('manager_passport')->default('null');
            $table->string('sponsor_passport')->default('null');
            $table->string('partners_passport')->default('null');

            $table->string('status');
            $table->string('action')->nullable();
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
        Schema::dropIfExists('trade_licenses');
    }
}
