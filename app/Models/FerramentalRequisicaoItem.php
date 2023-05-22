<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FerramentalRequisicaoItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'ativos_ferramental_requisicao_item';

    protected $fillable = [
        'id_ativo_externo',
        'id_requisicao',
        'quantidade_solicitada',
        'status',
    ];

    public function ativo()
    {
        return $this->belongsTo(AtivoExterno::class, 'id_ativo_externo');
    }

    public function requisicao()
    {
        return $this->belongsTo(FerramentalRequisicao::class, 'id_requisicao');
    }
}
