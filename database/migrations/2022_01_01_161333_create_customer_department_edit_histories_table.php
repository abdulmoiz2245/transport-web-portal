<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDepartmentEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_department_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('row_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('department_name')->nullable();
            $table->string('concerned_person_name')->nullable();
            $table->string('concerned_person_designation')->nullable();
            $table->string('tell')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('customer_department_edit_histories');
    }
}
