<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([
            'name' => 'André Baill',
            'email'         => 'srandrebaill@gmail.com',
            'password'      => bcrypt('10203010'),
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        DB::table('users')->insert(['name' => 'André Baill',
            'email'         => 'admin@sga-e.eng.br',
            'password'      => bcrypt('123456789'),
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
