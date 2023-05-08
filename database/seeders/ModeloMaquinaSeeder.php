<?php

namespace Database\Seeders;

use App\Models\ModeloMaquina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeloMaquinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelos = [
            'Escavadeira',
            'Retroescavadeira',
            'Pá Carregadeira',
            'Empilhadeira',
            'Rolo Compactador Liso',
            'Rolo Compactador Liso (Pé de Caneiro)',
            'Rolo Pnemático',
            'Mini Escavadeira',
            'Mini Carregadeira',
            'Munck',
            'Perfuratriz',
            'Trator Esteira',
            'Outro'
        ];

        foreach ($modelos as $modelo) {
            ModeloMaquina::create(['modelo' => $modelo]);
        }
    }
}
