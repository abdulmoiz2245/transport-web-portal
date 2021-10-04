<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuncipalityDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muncipality_documents', function (Blueprint $table) {
            $table->id();
            $table->string('document');
            $table->string('type');
            $table->string('status');
            $table->string('status_message')->nullable();
            $table->string('user_id')->default('0');
            $table->string('action')->nullable();

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
        Schema::dropIfExists('muncipality_documents');
    }
}
