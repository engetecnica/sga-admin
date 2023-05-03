<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MarcaMaquina;

class MarcaMaquinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcas = ['TKA', 'BOBCAT', 'JCB', 'BMH', 'Munck', 'Perfuratriz'];

        foreach ($marcas as $marca) {
            MarcaMaquina::create(['marca' => $marca]);
        }
    }
}
