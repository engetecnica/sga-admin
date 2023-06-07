<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class AtivoExternoEstoque extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "ativos_externos_estoque";

    protected $fillable = [
        'id_ativo_externo',
        'id_obra',
        'patrimonio',
        'data_descarte',
        'valor',
        'calibracao',
        'status'
    ];

    static function getAtivosExternoEstoque()
    {
        $estoque = DB::table('ativos_externos_estoque')
        ->select(
            'obras.codigo_obra',
            'obras.razao_social',
            'ativos_externos.titulo as item',
            'ativos_externos_estoque.patrimonio',
            'ativos_externos_estoque.id_ativo_externo',
            'ativos_externos_estoque.id as id_ativo_externo_item'
        )
        ->join('ativos_externos', 'ativos_externos.id', '=', 'ativos_externos_estoque.id_ativo_externo')
        ->join('obras', 'obras.id', '=', 'ativos_externos_estoque.id_obra')
        ->where('ativos_externos_estoque.status', 4)
        ->get();

        return $estoque;
    }

    public function ativo_externo()
    {
        return $this->belongsTo(AtivoExterno::class, 'id_ativo_externo');
    }

    public function obra()
    {
        return $this->belongsTo(CadastroObra::class, 'id_obra');
    }

    public function situacao()
    {
        return $this->belongsTo(AtivoExernoStatus::class, 'status');
    }


}
