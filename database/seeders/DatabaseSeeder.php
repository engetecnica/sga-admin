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
            FornecedorSeeder::class,
            ServicoSeeder::class,
            ModulosSeeder::class,
            NiveisSeeder::class,
            UsersSeeder::class,
            UsersVinculosSeeder::class,
            AtivosExternosStatusSeeder::class,
            AtivosFerramentalStatusSeeder::class,
            EmpresaSeeder::class,
            ObraSeeder::class,

            VeiculoSeeder::class,
            VeiculoAbastecimentoSeeder::class,
            VeiculoDepreciacaoSeeder::class,
            VeiculoIpvaSeeder::class,
            VeiculoManutencaoSeeder::class,
            VeiculoQuilometragemSeeder::class,
            VeiculoSeguroSeeder::class
        ]);
    }
}
