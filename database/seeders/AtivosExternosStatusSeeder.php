<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AtivosExternosStatusSeeder extends Seeder
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
                'titulo' => 'Liberado',
                'classe' => 'primary'
            ], [
                'titulo' => 'Em Trânsito',
                'classe' => 'warning'
            ],[
                'titulo' => 'Em Estoque',
                'classe' => 'success'
            ], [
                'titulo' => 'Recebido',
                'classe' => 'success'
            ], [
                'titulo' => 'Em Operação',
                'classe' => 'light'
            ], [
                'titulo' => 'Transferido',
                'classe' => 'info'
            ], [
                'titulo' => 'Devolvido',
                'classe' => 'danger'
            ], [
                'titulo' => 'Fora de Operação',
                'classe' => 'dark'
            ], [
                'titulo' => 'Em Manutenção',
                'classe' => 'danger'
            ], [
                'titulo' => 'Reservado',
                'classe' => 'secondary'
            ], [
                'titulo' => 'Recebido com defeito',
                'classe' => 'warning'
            ],
            [
                'titulo' => 'Sem Estoque',
                'classe' => 'light'
            ], [
                'titulo' => 'Com Defeito',
                'classe' => 'info'
            ],
            [
                'titulo' => 'Liberado Parcialmente',
                'classe' => 'danger'
            ], [
                'titulo' => 'Recebido Parcialmente',
                'classe' => 'danger'
            ], [
                'titulo' => 'Em Manutenção',
                'classe' => 'danger'
            ], [
                'titulo' => 'Aguardando Autorizacao',
                'classe' => 'secondary'
            ], [
                'titulo' => 'Recusado',
                'classe' => 'warning'
            ]
        );

        DB::table('ativos_externos_status')->insert($data);
    }
}
