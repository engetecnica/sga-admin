<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $veiculos = DB::table('veiculos')->pluck('id');
        $empresas = DB::table('empresas')->pluck('id');
        for ($i = 0; $i < 50; $i++) {
            DB::table('obras')->insert([
                'veiculo_id' => $veiculos->random(),
                'id_empresa' => $empresas->random(),

                'razao_social' => $faker->name,
                'cnpj'         => $faker->unique()->randomNumber(9),
                'codigo_obra'  => $faker->randomNumber(5),
                'cep' => $faker->postcode,
                'endereco' => $faker->address,
                'numero' => $faker->buildingNumber,
                'bairro' => $faker->address,
                'cidade' =>  $faker->city,
                'estado' => $faker->state,
                'email' => $faker->unique()->email,
                'celular' => $faker->phoneNumber,
                'status' => $faker->randomElement(['Ativo', 'Inativo']),

                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
