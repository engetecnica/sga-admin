<?php

namespace Database\Seeders;

use App\Models\CadastroObra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $obras = DB::table('obras')->pluck('id');

        for ($i = 0; $i < 500; $i++) {
            DB::table('funcionarios')->insert([
                'matricula' => $faker->randomNumber(4),
                'id_obra' => $obras->random(),
                // 'id_funcao' => $faker->randomNumber(1),
                'nome' => $faker->name,
                'rg' => $faker->unique()->randomNumber(9),
                'cpf'         => $faker->unique()->randomNumber(9),
                'data_nascimento'  => $faker->date(),
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
