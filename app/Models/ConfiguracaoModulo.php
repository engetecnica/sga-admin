<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class ConfiguracaoModulo extends Model
{
    use HasFactory;

    protected $table = "modulos";

    static function get_modulos()
    {

        $modulos = DB::table('modulos')->where('id_modulo', 0)->get();
        foreach($modulos as &$module){

            $module->submodulos = DB::table('modulos')
                                        ->where('id_modulo', $module->id)
                                        ->orderBy('posicao', 'ASC')
                                        ->get();
        }

        return $modulos;
    }

    
}
