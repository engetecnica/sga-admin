<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersVinculosSeeder extends Seeder
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
                'id_usuario' => 1,
                'id_obra' => null,
                'id_funcionario' => null,
                'id_nivel' => 1, // Master
                'acesso_atual' => now(),
                'ultimo_acesso' => now(),
                'status' => 'Ativo'
            ]
        );

        DB::table('usuarios_vinculos')->insert(
            $data
        );

        DB::table('usuarios_vinculos')->insert([
            'id_usuario' => '2',
            'id_nivel' => '2',
            'status'         => 'Ativo',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
