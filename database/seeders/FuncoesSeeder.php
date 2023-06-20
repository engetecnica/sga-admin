<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class FuncoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePaths = [
            database_path('seeders/cbos/CBO2002-a.json'),
            database_path('seeders/cbos/CBO2002-b.json'),
            database_path('seeders/cbos/CBO2002-c.json'),
            database_path('seeders/cbos/CBO2002-d.json'),
            database_path('seeders/cbos/CBO2002-e.json'),
            // Adicionar mais caminhos de arquivo, se houver
        ];

        foreach ($filePaths as $filePath) {
            $json = File::get($filePath);
            $data = json_decode($json, true);
            DB::table('funcao_funcionarios')->insert($data);
        }
    }
}
