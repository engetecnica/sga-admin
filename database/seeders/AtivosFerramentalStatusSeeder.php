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
                'titulo' => 'Devolvido com defeito',
                'classe' => 'info'
            ], [
                'titulo' => 'Não devolvido',
                'classe' => 'danger'
            ], [
                'titulo' => 'Cancelado',
                'classe' => 'primary'
            ]
        );

        DB::table('ativos_ferramental_status')->insert($data);
    }
}
