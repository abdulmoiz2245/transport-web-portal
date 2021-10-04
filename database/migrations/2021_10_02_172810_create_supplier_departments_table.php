<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_departments', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->string('account_name');
            $table->string('concerned_person_name');
            $table->string('concerned_person_designation');
            $table->string('tell');
            $table->string('mobile');
            $table->string('fax');
            $table->string('email');
            $table->string('delivery_order');
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
        Schema::dropIfExists('supplier_departments');
    }
}
