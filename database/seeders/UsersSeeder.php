<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
    }
}
