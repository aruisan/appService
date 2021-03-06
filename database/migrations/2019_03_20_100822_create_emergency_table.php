<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('type_emergency');
            $table->integer('category_emergency');
            $table->double('lat');
            $table->double('lng');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('especialista_id')->nullable();;
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('especialista_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergency');
    }
}
