<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryToolsEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_tools_entries', function (Blueprint $table) {
            $table->id();

            $table->string('tools_description')->nullable();
            $table->string('assign_person_name')->nullable();
            $table->string('assign_person_designation')->nullable();

            $table->string('quantity')->nullable();
            $table->string('given_to')->nullable();
            $table->string('reciving')->nullable();
            $table->string('is_general')->nullable();

            $table->string('brand')->nullable();
            $table->string('unit')->nullable();

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
        Schema::dropIfExists('inventory_tools_entries');
    }
}
