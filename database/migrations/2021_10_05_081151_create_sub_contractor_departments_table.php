<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubContractorDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_contractor_departments', function (Blueprint $table) {
            $table->id();
            $table->integer('sub_contractor_id');
            $table->string('accountant_name');
            $table->string('concerned_person_name')->nullable();
            $table->string('concerned_person_designation')->nullable();
            $table->string('logistic_department');
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
        Schema::dropIfExists('sub_contractor_departments');
    }
}
