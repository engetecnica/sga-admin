<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveisSeeder extends Seeder
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
                'titulo' => 'Master',
                'permissoes' => '{}'

            ],
            [
                'titulo' => 'Administrador',
                'permissoes' => '{}'
            ],
            [
                'titulo' => 'Revendedor',
                'permissoes' => '{}'
            ],
            [
                'titulo' => 'Cliente',
                'permissoes' => '{}'
            ]
        );

        DB::table('usuarios_niveis')->insert(
            $data
         ); 
    }
}
