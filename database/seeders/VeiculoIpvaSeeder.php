<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Veiculo;
use Illuminate\Support\Facades\DB;

class VeiculoIpvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $veiculos = Veiculo::where('id', '>', 0)->get();

        foreach ($veiculos as $veiculo) {
            DB::table('veiculo_ipvas')->insert([
                'veiculo_id'       => $veiculo->id,

                'referencia_ano' => $faker->year($max = 'now'),
                'valor' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
                'data_de_vencimento' => $faker->dateTime($max = 'now', $timezone = null),
                'data_de_pagamento' => $faker->dateTime($max = 'now', $timezone = null),
                
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
