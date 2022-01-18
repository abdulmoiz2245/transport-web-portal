<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmmployeeTerminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emmployee_terminations', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->nullable();
            $table->string('remarks')->nullable();
            $table->string('upload')->nullable();
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
        Schema::dropIfExists('emmployee_terminations');
    }
}
