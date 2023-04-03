<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = array(
            [
                'name' => 'Super Administrador',
                'email' => "master@sga-e.eng.br",
                'password' => bcrypt('123456789'),
                'user_level' => 1
            ]
        );

        DB::table('users')->insert(
            $data
         ); 
    }
}