<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = User::create([
           'name' => 'Admin',
           'email' => 'Admin@admin.com',
           'password' => bcrypt('123456'),
           'rol_id' => 1,
        ]);  
    }
}
