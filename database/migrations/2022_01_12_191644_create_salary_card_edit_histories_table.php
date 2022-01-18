<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryCardEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_card_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('row_id')->nullable();
            $table->integer('emp_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('type')->nullable();
            $table->string('comission')->nullable();
            
            $table->string('status')->nullable();
            $table->string('action')->nullable();
            $table->string('row_status')->nullable();
            $table->string('status_message')->nullable();
            $table->string('user_id')->nullable();

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
        Schema::dropIfExists('salary_card_edit_histories');
    }
}
