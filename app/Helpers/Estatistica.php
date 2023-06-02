<?php

namespace App\Helpers;

use App\Models\CadastroEmpresa;
use App\Models\CadastroFornecedor;
use App\Models\CadastroFuncionario;
use App\Models\CadastroObra;
use App\Models\User;

use Carbon\Carbon;

class Estatistica
{
    public static function users()
    {
        return User::count();
    }

    public static function empresas()
    {
        return CadastroEmpresa::where('status', 'Ativo')->count();
    }

    public static function fornecedores()
    {
        return CadastroFornecedor::where('status', 'Ativo')->count();
    }

    public static function funcionarios()
    {
        return CadastroFuncionario::where('status', 'Ativo')->count();
    }

    public static function obras()
    {
        return CadastroObra::where('status', 'Ativo')->count();
    }

    public static function aniversariantes()
    {
        $now = Carbon::now();

        return CadastroFuncionario::whereMonth('data_nascimento', $now->month)->get();
    }
}
