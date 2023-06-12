<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VeiculoManutencao extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'veiculo_id',
        'fornecedor_id',
        'servico_id',
        'tipo',
        'quilometragem_atual',
        'quilometragem_proxima',
        'horimetro_atual',
        'horimetro_proximo',
        'data_de_execucao',
        'data_de_vencimento',
        'descricao',
        'valor_do_servico',
        'situacao',
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(CadastroFornecedor::class);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
