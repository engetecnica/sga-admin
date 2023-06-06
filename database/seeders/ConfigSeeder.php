<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'title'         => 'Sistema de Gestão de Estoque',
            'email'         => 'example@engeativos.com.br',
            'notifications' => 0,
            'alerts'         => 0,
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
