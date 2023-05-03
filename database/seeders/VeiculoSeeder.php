<?php

namespace Database\Seeders;

use App\Models\CadastroObra;
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
        $obraIds = CadastroObra::pluck('id')->toArray(); // convertendo Collection em array
        shuffle($obraIds);
        foreach (range(1, 50) as $index) {
            DB::table('veiculos')->insert([
                'obra_id'           => $obraIds[array_rand($obraIds)],
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
                'codigo_da_maquina' => $faker->randomNumber(6),
                'placa' => $faker->vehicleRegistration,
                'renavam' => $faker->randomNumber(6),
                'observacao' => $faker->text($maxNbChars = 200),
                'situacao' => $faker->randomElement(['ativo', 'inativo']),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
