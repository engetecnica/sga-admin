<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtivosFerramentalRequisicaoStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    /**
     *      - Pendente
     *      - Liberado
     *          - Liberado Parcialmente
     *      - Recusado (recusado pelo administrador)
     *      - Em Trânsito 
     *      - Recebido Parcialmente (recebido parcialmente na obra)
     *      - Finalizado (recebido corretamente)
     */
    public function run()
    {
        //
        $data = array(
            [
                'titulo' => 'Pendente',
                'classe' => 'danger'
            ], [
                'titulo' => 'Liberado',
                'classe' => 'primary'
            ], [
                'titulo' => 'Liberado Parcialmente',
                'classe' => 'warning'
            ], [
                'titulo' => 'Recusado',
                'classe' => 'danger'
            ],
            [
                'titulo' => 'Em Trânsito',
                'classe' => 'light'
            ], [
                'titulo' => 'Recebido Parcialmente',
                'classe' => 'info'
            ], [
                'titulo' => 'Finalizado',
                'classe' => 'success'
            ]
        );

        DB::table('ativos_ferramental_requisicao_status')->insert($data);
    }
}
