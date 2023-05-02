<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        foreach (range(1, 50) as $index) {
            DB::table('fornecedores')->insert([
                'razao_social'      => $faker->name,
                'cnpj'          => $faker->unique()->randomNumber(9),
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
                'updated_at' => now(),
            ]);
        }
    }
}
