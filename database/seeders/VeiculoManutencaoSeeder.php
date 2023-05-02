<?php

namespace Database\Seeders;

use App\Models\CadastroFornecedor;
use App\Models\Servico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Veiculo;
use Illuminate\Support\Facades\DB;

class VeiculoManutencaoSeeder extends Seeder
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
        $fornecedores = CadastroFornecedor::where('id', '>', 0)->get();
        $servicos = Servico::where('id', '>', 0)->get();

        foreach ($veiculos as $veiculo) {
            $fornecedor = $fornecedores->random();
            $servico = $servicos->random();
            DB::table('veiculo_manutencaos')->insert([
                'veiculo_id'       => $veiculo->id,
                'fornecedor_id' => $fornecedor->id,
                'servico_id' => $servico->id,
                
                'tipo' => $faker->randomElement(['corretiva', 'preventiva']),
                'quilometragem_atual' => $faker->randomNumber(6),
                'quilometragem_proxima' => $faker->randomNumber(6),
                'horimetro_atual' => $faker->time($format = 'H:i:s', $max = 'now'),
                'horimetro_proximo' => $faker->time($format = 'H:i:s', $max = 'now'),
                'data_de_execucao' => $faker->dateTime($max = 'now', $timezone = null),
                'data_de_vencimento' => $faker->dateTime($max = 'now', $timezone = null),
                'descricao' => $faker->text(),
                'valor_do_servico' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 50, $max = 300),

                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
