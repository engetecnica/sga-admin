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
            ]
        );

        DB::table('ativos_externos_status')->insert($data);
    }
}
