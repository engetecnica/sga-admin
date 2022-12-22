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
                'name' => 'Master',
                'email' => "admin@app.app",
                'password' => "",
                'user_level' => 1, // Administrador

            ]
        );

        DB::table('users')->insert(
            $data
         ); 
    }
}