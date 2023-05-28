<?php

namespace App\Helpers;

use App\Models\CadastroEmpresa;
use App\Models\CadastroFornecedor;
use App\Models\CadastroFuncionario;
use App\Models\CadastroObra;
use App\Models\User;

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
}
