<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_info', function (Blueprint $table) {

            $table->id();
            $table->integer('company_id');
            $table->string('name' );
            $table->integer('trn')->nullable();
            $table->string('trn_copy')->nullable();
            $table->string('address' );
            $table->string('city' );
            $table->string('country' );
            $table->string('tel_number' );
            $table->string('fax' );
            $table->string('mobile' );
            $table->string('email' );
            $table->string('contact_person' );
            $table->string('des')->nullable();
            $table->string('web' )->nullable();
            $table->integer('credit_term' );
            $table->string('remarks' )->nullable();
            $table->string('portal_login' )->nullable();
            $table->string('user' )->nullable();
            $table->string('pw' )->nullable();
            $table->string('business_license_copy' )->nullable();
            $table->date('business_license_expiary_date' )->nullable();
            $table->string('business_contract_copy' )->nullable();
            $table->string('business_contract_copy' )->nullable();
            $table->date('contract' )->nullable();

            $table->string('status');
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
        Schema::dropIfExists('customer_info');
    }
}
