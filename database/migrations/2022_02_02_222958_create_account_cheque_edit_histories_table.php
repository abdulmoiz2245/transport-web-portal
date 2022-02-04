<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountChequeEditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_cheque_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->string('row_id')->nullable();

            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('cheque_amount')->nullable();
            $table->string('date')->nullable();
            $table->string('upload')->nullable();
            $table->string('reciving')->nullable();
            $table->string('reciving_date')->nullable();

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
        Schema::dropIfExists('account_cheque_edit_histories');
    }
}
