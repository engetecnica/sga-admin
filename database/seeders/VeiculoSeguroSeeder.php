<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Veiculo;
use Illuminate\Support\Facades\DB;

class VeiculoSeguroSeeder extends Seeder
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
            DB::table('veiculo_seguros')->insert([
                'veiculo_id'       => $veiculo->id,

                'carencia_inicial' => $faker->date(),
                'carencia_final' =>  $faker->date(),
                'valor' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 100, $max = 500),
                
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
