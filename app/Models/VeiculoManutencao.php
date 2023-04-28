<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoManutencao extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo_id',
        'tipo',
        'quilometragem_atual',
        'quilometragem_proxima',
        'horimetro_atual',
        'horimetro_proximo',
        'data_de_execucao',
        'data_de_vencimento',
        'descricao',
        'valor_do_servico'
    ];
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
