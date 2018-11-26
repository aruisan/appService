<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_tecnicos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('longitud');
            $table->char('latitud');

            $table->unsignedInteger('tecnico_id');
            $table->foreign('tecnico_id')->references('id')->on('users');
            $table->unsignedInteger('servicio_cliente_id');
            $table->foreign('servicio_cliente_id')->references('id')->on('servicio_clientes');
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
        Schema::dropIfExists('servicio_tecnicos');
    }
}
