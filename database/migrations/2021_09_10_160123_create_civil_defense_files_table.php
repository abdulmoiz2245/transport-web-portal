<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCivilDefenseFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civil_defense_files', function (Blueprint $table) {
            $table->id();
            $table->string('document');
            $table->string('type');
            $table->string('status');
            $table->string('status_message')->nullable();
            $table->string('action')->nullable();

            $table->string('user_id')->default('0');
            $table->date('expiary_date');
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
        Schema::dropIfExists('civil_defense_files');
    }
}
