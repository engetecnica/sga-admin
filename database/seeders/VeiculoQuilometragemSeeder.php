<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Veiculo;
use Illuminate\Support\Facades\DB;

class VeiculoQuilometragemSeeder extends Seeder
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
            DB::table('veiculo_quilometragems')->insert([
                'veiculo_id'       => $veiculo->id,

                'quilometragem_atual' => $faker->randomNumber(6),
                'quilometragem_nova' => $faker->randomNumber(6),

                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
