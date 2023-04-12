<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FerramentalRetirada extends Model
{
    use HasFactory;
    protected $table = "ativos_ferramental_retirada";

    static function getRetirada()
    {
        return DB::table('ativos_ferramental_retirada')
            ->select(
                'ativos_ferramental_retirada.*',
                'users.name as solicitante',
                'funcionarios.nome as funcionario',
                'funcionarios.matricula as funcionario_matricula',
                'obras.codigo_obra',
                'obras.razao_social',
                'ativos_ferramental_retirada_autenticacao.termo_responsabilidade'
            )
            ->join("users", "users.id", "=", "ativos_ferramental_retirada.id_usuario")
            ->join("funcionarios", "funcionarios.id", "=", "ativos_ferramental_retirada.id_funcionario")
            ->join("obras", "obras.id", "=", "ativos_ferramental_retirada.id_obra")
            ->join("ativos_ferramental_retirada_autenticacao", "ativos_ferramental_retirada_autenticacao.id_retirada", "=", "ativos_ferramental_retirada.id")
            // ->groupBy('ativos_ferramental_retirada_autenticacao.id_retirada')
            ->get();
    }

    /** 
     * Retirada de Itens de Acordo com o int(id_requisicao)
     */
    static function getRetiradaItems(int $id)
    {
        $retirada = DB::table('ativos_ferramental_retirada')
            ->select(
                'ativos_ferramental_retirada.*',
                'users.name',
                'funcionarios.nome as funcionario',
                'funcionarios.matricula as funcionario_matricula',
                'obras.codigo_obra',
                'obras.razao_social'
            )
            ->join("users", "users.id", "=", "ativos_ferramental_retirada.id_usuario")
            ->join("funcionarios", "funcionarios.id", "=", "ativos_ferramental_retirada.id_funcionario")
            ->join("obras", "obras.id", "=", "ativos_ferramental_retirada.id_obra")
            ->where('ativos_ferramental_retirada.id', $id)
            ->first();


        if ($retirada) {

            /** Faz a busca dos itens de acordo com a retirada */
            $retirada->itens = DB::table('ativos_ferramental_retirada_item')

                ->select(
                    'ativos_ferramental_retirada_item.*',
                    'ativos_externos_estoque.patrimonio as item_codigo_patrimonio',
                    'ativos_externos.titulo as item_nome'
                )

                ->join("ativos_externos_estoque", "ativos_externos_estoque.id", "=", "ativos_ferramental_retirada_item.id_ativo_externo")
                ->join("ativos_externos", "ativos_externos.id", "=", "ativos_externos_estoque.id_ativo_externo")
                ->where('ativos_ferramental_retirada_item.id_retirada', $id)
                ->get();

            /** Verifica se tem anexo */
            $retirada->anexo = DB::table('anexos')
                ->where('id_item', $id)
                ->where('id_modulo', '18') // Retirada
                ->get()
                ->first();

            /** Verifica se o termo já foi assinado digitalmente */
            $retirada->autenticado = DB::table('ativos_ferramental_retirada_autenticacao')->where('id_retirada', $id)->get()->first();
        }
        

        return $retirada;
    }
}