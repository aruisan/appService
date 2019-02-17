<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStateToMonederoMovimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monedero_movimientos', function (Blueprint $table) {
            $table->enum('state', ['entry', 'exit'])->after('cliente_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monedero_movimientos', function (Blueprint $table) {
            $table->enum('state');
        });
    }
}
