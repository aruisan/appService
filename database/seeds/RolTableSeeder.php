<?php

use App\Rol;
use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'name' => 'Administrador',

        ]);              

        Rol::create([
            'name' => 'Cliente',

        ]);            

        Rol::create([
            'name' => 'Tecnico',

        ]);         
    }
}
