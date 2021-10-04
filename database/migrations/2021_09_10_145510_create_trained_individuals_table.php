<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainedIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trained_individuals', function (Blueprint $table) {
            $table->id();
            $table->string('pass_card')->nullable();
            $table->string('type');
            $table->string('card_number')->nullable();
            $table->string('employee_name')->nullable();
            $table->date('expiary_date')->nullable();
            $table->string('front_pic')->nullable();
            $table->string('back_pic')->nullable();
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
        Schema::dropIfExists('trained_individuals');
    }
}
