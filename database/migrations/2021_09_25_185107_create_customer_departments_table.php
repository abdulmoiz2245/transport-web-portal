<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_department', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('department_name');
            $table->string('concerned_person_name');
            $table->string('concerned_person_designation');
            $table->string('tell');
            $table->string('mobile');
            $table->string('fax');
            $table->string('email');
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
        Schema::dropIfExists('customer_department');
    }
}
