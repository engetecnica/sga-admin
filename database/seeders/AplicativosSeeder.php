<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AplicativosSeeder extends Seeder
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
                'titulo' => 'Blue TV BOX',
                'link_download' => '#'
            ],[
                'titulo' => 'Blue TV Celular',
                'link_download' => '#'
            ],[
                'titulo' => 'My Family Cinema TV BOX',
                'link_download' => '#'
            ],[
                'titulo' => 'My Family Cinema Celular',
                'link_download' => '#'
            ]
        );

        DB::table('aplicativos')->insert($data);
    }
}
