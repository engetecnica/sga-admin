<?php

namespace App\Helpers;

use App\Models\CadastroObra;

class Tarefa
{
    public static function countObras()
    {
        return CadastroObra::where('nome_fantasia', null)->orderByDesc('id')->count();
    }

    public static function obras()
    {
        return CadastroObra::where('nome_fantasia', null)->orderByDesc('id')->limit(10)->get();
    }
}
