<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtivosFerramentalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = array(
            [
                'titulo' => 'Pendente',
                'classe' => 'danger'
            ], [
                'titulo' => 'Entregue',
                'classe' => 'danger'
            ], [
                'titulo' => 'Devolvido',
                'classe' => 'warning'
            ], [
                'titulo' => 'Devolvido com Defeito',
                'classe' => 'info'
            ]
        );

        DB::table('ativos_externos_status')->insert($data);
    }
}
