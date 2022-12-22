<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ModulosSeeder extends Seeder
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
                'id_modulo' => '0',
                'titulo' => 'Configurações',
                'posicao' => '1',
                'url_amigavel' => '#',
                'icone' => '',
                'tipo_de_acao' => 'view'
            ],
            [
                'id_modulo' => '1',
                'titulo' => 'Tipos de Usuário',
                'posicao' => '1',
                'url_amigavel' => 'configuracao/usuario_tipo',
                'icone' => '',
                'tipo_de_acao' => 'view'
            ],
            [
                'id_modulo' => '1',
                'titulo' => 'Usuários',
                'posicao' => '2',
                'url_amigavel' => 'configuracao/usuario',
                'icone' => '',
                'tipo_de_acao' => 'view'
            ],
            [
                'id_modulo' => '1',
                'titulo' => 'SGRC Configurações',
                'posicao' => '3',
                'url_amigavel' => 'configuracao/sistema',
                'icone' => '',
                'tipo_de_acao' => 'view'
            ]
        );

        DB::table('modulos')->insert(
           $data
        );        
    }
}
