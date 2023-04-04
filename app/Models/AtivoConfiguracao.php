<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtivoConfiguracao extends Model
{
    use HasFactory;

    protected $table = "ativos_configuracoes";
    protected $dates = ['deleted_at'];

    static function get_ativo_configuracoes(){

        $configuracoes = new AtivoConfiguracao();
        $configuracoes = $configuracoes->where('id_relacionamento', 0)->get();
        if($configuracoes){
            foreach($configuracoes as $configs){
                $configuracoes->subcategorias = $configuracoes->where('id_relacionamento', $configs->id);
            }
        }

        return $configuracoes;
    }
}
