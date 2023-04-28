<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Veiculo;
use Illuminate\Support\Facades\DB;

class VeiculoDepreciacaoSeeder extends Seeder
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
            DB::table('veiculo_depreciacaos')->insert([
                'veiculo_id'       => $veiculo->id,
                'valor_atual' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),

                'referencia_mes' => $faker->monthName($max = 'now'),
                'referencia_ano' => $faker->year($max = 'now'),

                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
