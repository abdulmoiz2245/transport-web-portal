<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints_edit_histories', function (Blueprint $table) {
            $table->id();

            $table->string('row_id')->nullable();
            $table->string('emp_id')->nullable();

            $table->string('complaint')->nullable();
            $table->string('admin_remarks')->nullable();
            $table->string('hr_remarks')->nullable();

            $table->string('upload')->nullable();
            $table->string('type')->nullable();
            
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
        Schema::dropIfExists('complaints_edit_histories');
    }
}
