<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('descripcion');
            $table->char('longitud');
            $table->char('latitud');
            $table->enum('metodo_pago', [0,1,2])->default(0);
            $table->enum('estado', [0,1,2,3])->default(1);
            //0 cancelar, 1 solo la creo, 2 un tecnico acepto, 3 finalizo

            $table->unsignedInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('users');
            $table->unsignedInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks');

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
        Schema::dropIfExists('servicio_clientes');
    }
}
