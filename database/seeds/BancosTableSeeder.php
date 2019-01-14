<?php

use App\Banco;
use Illuminate\Database\Seeder;

class BancosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banco::create([
            'name' => 'BANCO AGRARIO',

        ]);           
        Banco::create([
            'name' => 'BANCO AV VILLAS',

        ]);           
        Banco::create([
            'name' => 'BANCO BBVA COLOMBIA S.A.',

        ]);           
        Banco::create([
            'name' => 'BANCO CAJA SOCIAL',

        ]);           
        Banco::create([
            'name' => 'BANCO COLPATRIA',

        ]);           
        Banco::create([
            'name' => 'BANCO COOPERATIVO COOPCENTRAL',

        ]);           
        Banco::create([
            'name' => 'BANCO DAVIVIENDA',

        ]);           
        Banco::create([
            'name' => 'BANCO DE BOGOTA',

        ]);           
        Banco::create([
            'name' => 'BANCO DE OCCIDENTE',

        ]);           
        Banco::create([
            'name' => 'BANCO FALABELLA',

        ]);           
        Banco::create([
            'name' => 'BANCO GNB SUDAMERIS',

        ]);           
        Banco::create([
            'name' => 'BANCO PICHINCHA S.A.',

        ]);           
        Banco::create([
            'name' => 'BANCO POPULAR',

        ]);           
        Banco::create([
            'name' => 'BANCO PROCREDIT',

        ]);               
        Banco::create([
            'name' => 'BANCO SANTANDER COLOMBIA ',

        ]);               
        Banco::create([
            'name' => 'BANCOLOMBIA',

        ]);            
        Banco::create([
            'name' => 'BANCOOMEVA S.A.',

        ]);              
        Banco::create([
            'name' => 'CITIBANK',

        ]);           

    }
}
