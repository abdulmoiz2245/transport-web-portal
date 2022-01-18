<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('row_id')->nullable();
            $table->string('name')->nullable();
            $table->string('designation' )->nullable();
            $table->string('photo')->nullable();

            $table->string('nationality')->nullable();
            $table->string('national_id_number')->nullable();
            $table->string('national_id_exp')->nullable();
            $table->string('national_id_copy')->nullable();

            $table->string('passport_number')->nullable();
            $table->string('passport_exp')->nullable();
            $table->string('passport_copy')->nullable();

            $table->string('company_id')->nullable();

            $table->string('visa_number')->nullable();
            $table->string('visa_uuid')->nullable();
            $table->string('visa_exp')->nullable();
            $table->string('visa_copy')->nullable();

            $table->string('noc_exp')->nullable();
            $table->string('noc_copy')->nullable();

            $table->string('work_permit_exp')->nullable();
            $table->string('work_permit_copy')->nullable();

            $table->string('labor_contract_exp')->nullable();
            $table->string('labor_contract_copy')->nullable();

             $table->string('emirates_id')->nullable();
            $table->string('emirates_exp')->nullable();
            $table->string('emirates_copy')->nullable();

            $table->string('health_insurance_policy_number')->nullable();
            $table->string('health_insurance_policy_exp')->nullable();
            $table->string('health_insurance_policy_copy')->nullable();

            $table->string('designation_per_labour_contract')->nullable();
            $table->string('designation_actual')->nullable();
            $table->string('basic_salary_per_labour_contract')->nullable();
            $table->string('basic_salary_actual')->nullable();

            $table->string('salary_card_id')->nullable();

            $table->string('jabel_ali_pass_number')->nullable();
            $table->string('jabel_ali_pass')->nullable();
            $table->string('jabel_ali_pass_exp')->nullable();
            $table->string('jabel_ali_pass_copy')->nullable();

            $table->string('emal_pass_number')->nullable();
            $table->string('emal_pass')->nullable();
            $table->string('emal_pass_exp')->nullable();
            $table->string('emal_pass_copy')->nullable();

            $table->string('kp_mina_number')->nullable();
            $table->string('kp_mina')->nullable();
            $table->string('kp_mina_exp')->nullable();
            $table->string('kp_mina_copy')->nullable();

            $table->string('driving_license_number')->nullable();
            $table->string('driving_license')->nullable();
            $table->string('driving_license_exp')->nullable();
            $table->string('driving_license_copy')->nullable();

            $table->string('employee_doj')->nullable();

            $table->string('employee_current_status')->nullable();
            $table->string('employee_current_action')->nullable();
            $table->string('employee_current_status_reason')->nullable();

            $table->string('deposit')->nullable();
            $table->string('deposit_amount')->nullable();
            $table->string('deposit_way')->nullable();
            $table->string('deposit_upload')->nullable();

            $table->string('incentives')->nullable();
            $table->string('incentives_upload')->nullable();


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
        Schema::dropIfExists('employee_edit_histories');
    }
}
