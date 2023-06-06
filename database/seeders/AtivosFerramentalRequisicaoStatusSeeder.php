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
                'classe' => 'primary'
            ], [
                'titulo' => 'Liberado',
                'classe' => 'success'
            ], [
                'titulo' => 'Liberado Parcialmente',
                'classe' => 'warning'
            ], [
                'titulo' => 'Recusado',
                'classe' => 'danger'
            ], [
                'titulo' => 'Em Trânsito',
                'classe' => 'warning'
            ], [
                'titulo' => 'Recebido',
                'classe' => 'info'
            ], [
                'titulo' => 'Recebido com defeito',
                'classe' => 'success'
            ], [
                'titulo' => 'Finalizado',
                'classe' => 'success'
            ]
        );

        DB::table('ativos_ferramental_requisicao_status')->insert($data);
    }
}
