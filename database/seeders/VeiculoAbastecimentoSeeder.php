<?php

namespace Database\Seeders;

use App\Models\Veiculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeiculoAbastecimentoSeeder extends Seeder
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
            DB::table('veiculo_abastecimentos')->insert([
                'veiculo_id'       => $veiculo->id,
                'combustivel' => $faker->randomElement(['gasolina', 'diesel', 'etanol']),
                'quilometragem' => $faker->randomNumber(6),
                'valor_do_litro' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'quantidade' => $faker->randomDigitNotNull(),
                'valor_total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
