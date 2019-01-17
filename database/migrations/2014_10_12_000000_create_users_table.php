<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name');
            $table->string('nickname')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->unsignedInteger('rol_id')->nullable();
            $table->string('avatar')->default('default');
            $table->string('phone_number')->nullable();
            $table->string('country_code')->nullable();
            $table->string('authy_id')->nullable();
            $table->boolean('verified')->default(false);
            $table->enum('activo', [1,0])->default(0);
            $table->rememberToken();
            $table->timestamps();


            $table->foreign('rol_id')->references('id')->on('roles');

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
