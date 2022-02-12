<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePettiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petties', function (Blueprint $table) {
            $table->id();
            $table->string('total_amount')->nullable();
            $table->string('recived_amount')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('company_id')->nullable();
            $table->string('description')->nullable();
            $table->string('circulating_cash')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('petties');
    }
}
