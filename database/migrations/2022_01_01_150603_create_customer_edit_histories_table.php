<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_edit_histories', function (Blueprint $table) {
            
            $table->id();
            $table->integer('row_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('name' )->nullable();
            $table->integer('trn')->nullable();
            $table->string('trn_copy')->nullable();
            $table->string('address' )->nullable();
            $table->string('city' )->nullable();
            $table->string('country' )->nullable();
            $table->string('tel_number' )->nullable();
            $table->string('fax' )->nullable();
            $table->string('mobile' )->nullable();
            $table->string('email' )->nullable();
            $table->string('contact_person' )->nullable();
            $table->string('des')->nullable();
            $table->string('web' )->nullable();
            $table->integer('credit_term' )->nullable();
            $table->string('remarks' )->nullable();
            $table->string('portal_login' )->nullable();
            $table->string('user' )->nullable();
            $table->string('pw' )->nullable();
            $table->string('business_license_copy' )->nullable();
            $table->date('business_license_expiary_date' )->nullable();
            $table->string('business_contract_copy' )->nullable();
            $table->date('business_contract_expiary_date' )->nullable();

            $table->string('status')->nullable();
            $table->string('action')->nullable();
            $table->string('status_message')->nullable();
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
        Schema::dropIfExists('customer_edit_histories');
    }
}
