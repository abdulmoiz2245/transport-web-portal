<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->string('company_id')->nullable();
            $table->string('date')->nullable();
            $table->string('trn')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('sub_total_amount')->nullable();
            $table->string('vat_amount')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('checked_by')->nullable();
            $table->string('remaning_amount')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('paid_by')->nullable();
            $table->string('invoice_status')->nullable()->default('0');

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
        Schema::dropIfExists('invoices');
    }
}
