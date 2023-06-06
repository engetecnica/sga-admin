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
                'titulo' => 'Super',
                'permissoes' => '{"1":{"5":{"view":"on","add":"on","edit":"on","delete":"on"},"2":{"view":"on","add":"on","edit":"on","delete":"on"},"3":{"view":"on","add":"on","edit":"on","delete":"on"}}}'

            ],
            [
                'titulo' => 'Administrador',
                'permissoes' => '{"6":{"7":{"view":"on","add":"on","edit":"on","delete":"on"},"8":{"view":"on","add":"on","edit":"on","delete":"on"},"9":{"view":"on","add":"on","edit":"on","delete":"on"},"10":{"view":"on","add":"on","edit":"on","delete":"on"}},"11":{"16":{"view":"on","add":"on","edit":"on","delete":"on"},"12":{"view":"on","add":"on","edit":"on","delete":"on"},"13":{"view":"on","add":"on","edit":"on","delete":"on"},"14":{"view":"on","add":"on","edit":"on","delete":"on"}},"17":{"18":{"view":"on","add":"on","edit":"on","delete":"on"},"19":{"view":"on","add":"on","edit":"on","delete":"on"}},"1":{"15":{"other":"on"},"4":{"other":"on"},"5":{"view":"on","add":"on","edit":"on","delete":"on"},"2":{"view":"on","add":"on","edit":"on","delete":"on"},"3":{"view":"on","add":"on","edit":"on","delete":"on"}},"20":{"21":{"other":"on"},"22":{"other":"on"}},"23":{"24":{"view":"on","add":"on","edit":"on","delete":"on"},"25":{"other":"on"}}}'
            ],
            [
                'titulo' => 'Almoxarifado',
                'permissoes' => '{}'
            ],
            [
                'titulo' => 'Engenheiro',
                'permissoes' => '{}'
            ]
        );

        DB::table('usuarios_niveis')->insert(
            $data
        );
    }
}
