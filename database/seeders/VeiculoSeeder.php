<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        foreach (range(1, 50) as $index) {
            DB::table('veiculos')->insert([
                'obra' => $faker->name(),
                'periodo_inicial'   => $faker->date(),
                'periodo_final'   => $faker->date(),
                'tipo' => $faker->randomElement(['carros', 'motos', 'caminhoes', 'maquinas']),
                'marca' => $faker->vehicleBrand,

                'modelo' => $faker->vehicleModel,
                'ano' => $faker->year($max = 'now'),
                'veiculo' => $faker->vehicle,
                'valor_fipe' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 1000, $max = 15000),
                'codigo_fipe' => $faker->randomNumber(6),
                'fipe_mes_referencia' => $faker->monthName($max = 'now'),
                'placa' => $faker->vehicleRegistration,

                'renavam' => $faker->randomNumber(6),

                // 'km' => $faker->randomNumber(6),
                'valor_funcionario' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
                'valor_adicional' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                'observacao' => $faker->text($maxNbChars = 200),
                'situacao' => $faker->randomElement(['ativo', 'inativo']),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
