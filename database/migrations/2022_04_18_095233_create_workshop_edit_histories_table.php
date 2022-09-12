<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('row_id')->nullable();

            $table->string('job_number')->nullable();
            $table->string('date')->nullable();
            $table->string('vehicle_id')->nullable();
            $table->string('driver_id')->nullable();

            $table->string('mechanic_id')->nullable();
            $table->string('electrician_id')->nullable();

            $table->string('denter_id')->nullable();
            $table->string('painter_id')->nullable();
            $table->string('whelder_id')->nullable();
            $table->string('helper_id')->nullable();


            $table->string('job_description')->nullable();
            $table->string('other_job_description')->nullable();
            $table->string('job_card_document')->nullable();
            $table->string('issue_status')->nullable();
            $table->string('findings')->nullable();

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
        Schema::dropIfExists('workshop_edit_histories');
    }
}
