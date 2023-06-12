<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FerramentalRetirada extends Model
{
    use HasFactory;

    protected $table = "ativos_ferramental_retirada";
    protected $fillable = [
        "id_relacionamento",
        "id_obra",
        "id_usuario",
        "id_funcionario",
        "termo_responsabilidade_gerado",
        "data_devolucao_prevista",
        "data_devolucao",
        "devolucao_observacoes",
        "status",
        "observacoes",
    ];

    public function obra()
    {
        return $this->belongsTo(CadastroObra::class, 'id_obra', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function funcionario()
    {
        return $this->belongsTo(CadastroFuncionario::class, 'id_funcionario', 'id');
    }

    public function situacao()
    {
        return $this->belongsTo(FerramentalRetiradaStatus::class, 'status', 'id');
    }




    static function getRetirada()
    {
        return DB::table('ativos_ferramental_retirada')
            ->select(
                'ativos_ferramental_retirada.*',
                'users.name as solicitante',
                'funcionarios.nome as funcionario',
                'funcionarios.matricula as funcionario_matricula',
                'obras.codigo_obra',
            'obras.razao_social'
            )
            ->join("users", "users.id", "=", "ativos_ferramental_retirada.id_usuario")
            ->join("funcionarios", "funcionarios.id", "=", "ativos_ferramental_retirada.id_funcionario")
            ->join("obras", "obras.id", "=", "ativos_ferramental_retirada.id_obra")
            ->get();
    }

    /**
     * Retirada de Itens de Acordo com o int(id_retirada)
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
        }


        return $retirada;
    }




}
