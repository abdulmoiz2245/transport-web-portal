<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentDisputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_disputes', function (Blueprint $table) {
            $table->id();
            $table->string('assign_id')->nullable();
            $table->string('equipment_name')->nullable();
            $table->string('dispute_status')->nullable();
            $table->string('operation_remark')->nullable();
            $table->string('admin_remark')->nullable();
            $table->string('amount_deduction')->nullable();
            $table->string('dispute_date')->nullable();
            $table->string('dispute_resolved_date')->nullable();



            $table->string('status')->nullable();

            $table->string('action')->nullable();
            $table->string('status_message')->nullable();
            $table->string('row_status')->default('active');
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
        Schema::dropIfExists('equipment_disputes');
    }
}
