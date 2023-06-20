<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Transferencia extends Model
{
    use HasFactory;

    //protected $connection = 'mysql2';

    static function getObrasSGA()
    {
        return DB::connection('mysql2')
            ->table('obra')
            ->select('*')
            ->get();
    }

    /** Get Empresas */
    static function getEmpresasSGA()
    {
        return DB::connection('mysql2')
            ->table('empresa')
            ->select('*')
            ->get();
    }

    /** Get Fornecedores */
    static function getFornecedoresSGA()
    {
        return DB::connection('mysql2')
            ->table('fornecedor')
            ->select('*')
            ->get();
    }

    /** Get Funcionários */
    static function getFuncionariosSGA()
    {
        return DB::connection('mysql2')
            ->table('funcionario')
            ->select('*')
            ->get();
    }

    /** Get Funcionários Funções */
    static function getFuncionariosFuncoesSGA()
    {
        return DB::connection('mysql2')
            ->table('funcionario_funcao')
            ->select('*')
            ->get();
    }

    /** Get Funcionários Funções */
    static function getAtivoConfiguracaoSGA()
    {
        return DB::connection('mysql2')
            ->table('ativo_configuracao')
            ->select('*')
            ->get();
    }
}
