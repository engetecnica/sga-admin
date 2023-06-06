<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BasicSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ServicoSeeder::class,
            ModulosSeeder::class,
            NiveisSeeder::class,
            UsersSeeder::class,
            UsersVinculosSeeder::class,
            AtivosExternosStatusSeeder::class,
            AtivosFerramentalRequisicaoStatusSeeder::class,
            AtivosFerramentalStatusSeeder::class,
            ConfigSeeder::class,
            MarcaMaquinaSeeder::class,
            ModeloMaquinaSeeder::class,
        ]);
    }
}
