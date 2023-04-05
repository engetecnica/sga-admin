<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class AtivoConfiguracao extends Model
{
    use HasFactory;

    protected $table = "ativos_configuracoes";
    protected $dates = ['deleted_at'];

    static function get_ativo_configuracoes(){

        // $configuracoes = new AtivoConfiguracao();
        // $configuracoes = $configuracoes->where('id_relacionamento', 0)->get();
        // if($configuracoes){
        //     foreach($configuracoes as &$configs){
        //         echo $configs->id;
        //         $configs->subcategorias = $configuracoes->where('id_relacionamento', $configs->id);
        //     }
        // }


        $configuracoes = new AtivoConfiguracao();
        $configuracoes = $configuracoes->where('id_relacionamento', 0)->get();
        foreach ($configuracoes as &$configs) {

            $configs->subcategorias = DB::table('ativos_configuracoes')
                ->where('id_relacionamento', $configs->id)
                ->orderBy('titulo', 'ASC')
                ->get();
        }

       
        return $configuracoes;
    }
}
