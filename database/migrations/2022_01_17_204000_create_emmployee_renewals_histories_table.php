<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmmployeeRenewalsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emmployee_renewals_histories', function (Blueprint $table) {
            $table->id();
            $table->string('action')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('route_name')->nullable();
            $table->integer('data_id')->nullable();
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
        Schema::dropIfExists('emmployee_renewals_histories');
    }
}
