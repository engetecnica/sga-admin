<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servicos')->insert([
            'name' => 'Troca de Óleo',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        DB::table('servicos')->insert([
            'name' => 'Substituição de peças',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        DB::table('servicos')->insert([
            'name' => 'Substituição de pneus',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        DB::table('servicos')->insert([
            'name' => 'Preventiva',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        DB::table('servicos')->insert([
            'name' => 'Elétrica',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
