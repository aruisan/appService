<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonederoMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monedero_movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valor')->default(0);

            $table->unsignedInteger('monedero_id');
            $table->foreign('monedero_id')->references('id')->on('monederos');
            $table->unsignedInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('users');

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
        Schema::dropIfExists('monedero_movimientos');
    }
}
