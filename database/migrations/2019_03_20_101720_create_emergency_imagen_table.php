<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergencyImagenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_imagen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->unsignedInteger('emergency_id');
            $table->timestamps();

            $table->foreign('emergency_id')->references('id')->on('emergency');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergency_imagen');
    }
}
