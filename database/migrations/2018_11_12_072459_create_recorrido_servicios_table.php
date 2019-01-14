<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecorridoServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recorrido_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('servicio_tecnico_id');
            $table->foreign('servicio_tecnico_id')->references('id')->on('servicio_tecnicos');
            $table->unsignedInteger('recorrido_id');
            $table->foreign('recorrido_id')->references('id')->on('recorridos');
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
        Schema::dropIfExists('recorrido_servicios');
    }
}
