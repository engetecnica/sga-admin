<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ModulosSeeder::class,
            NiveisSeeder::class,
            UsersSeeder::class,
            UsersVinculosSeeder::class,
            AtivosExternosStatusSeeder::class,
            AtivosFerramentalStatusSeeder::class,
            EmpresaSeeder::class,
            VeiculoSeeder::class,
            ObraSeeder::class,
            VeiculoAbastecimentoSeeder::class,
            VeiculoDepreciacaoSeeder::class,
            VeiculoIpvaSeeder::class,
            VeiculoManutencaoSeeder::class,
            VeiculoQuilometragemSeeder::class,
            VeiculoSeguroSeeder::class
        ]);
    }
}
