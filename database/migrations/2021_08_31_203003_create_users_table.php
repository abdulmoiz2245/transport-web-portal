<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->integer('role_id')->unsigned();
            $table->integer('status');

            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            //$table->foreign('module_id')->references('id')->on('modules');
            // $table->foreign('role_id')->references('id')->on('roles')->unsigned()->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
