<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeHandoverSubmissionEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_handover_submission_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('row_id')->nullable();

            $table->integer('emp_id')->nullable();
            $table->string('name')->nullable();
            $table->string('doc_upload')->nullable();
            $table->string('type')->nullable();

            $table->string('status')->nullable();
            $table->string('action')->nullable();
            $table->string('row_status')->nullable();
            $table->string('status_message')->nullable();
            $table->string('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_handover_submission_edit_histories');
    }
}
