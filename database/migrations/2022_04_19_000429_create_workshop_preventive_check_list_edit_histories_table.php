<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopPreventiveCheckListEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_preventive_check_list_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->string('row_id')->nullable();

            $table->string('vehicle_id')->nullable();
            $table->string('date')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('check_list_copy')->nullable();

            $table->string('status')->nullable();
            $table->string('action')->nullable();
            $table->string('row_status')->nullable()->default('active');
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
        Schema::dropIfExists('workshop_preventive_check_list_edit_histories');
    }
}
