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
        $marcas = [
            'Case',
            'CAT | Caterpillar',
            'Jhon Deere',
            'Massey Ferguson',
            'New Holland',
            'Valtra',
            'Bobcat',
            'JCB',
            'TKA',
            'Argus',
            'Outra'
        ];

        foreach ($marcas as $marca) {
            MarcaMaquina::create(['marca' => $marca]);
        }
    }
}
