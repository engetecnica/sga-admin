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
        $data = array(
            [
                'name' => 'André Baill',
                'email' => "srandrebaill@gmail.com",
                'password' => bcrypt('10203010')
            ]
        );

        DB::table('users')->insert(
            $data
        );

        DB::table('users')->insert([
            'name' => 'Christian André Steffens',
            'email'         => 'admin@sga-e.eng.br',
            'password'      => Hash::make('123456789'),
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
