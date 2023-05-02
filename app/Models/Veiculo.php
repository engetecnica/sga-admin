<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'obra_id',
        'periodo_inicial',
        'periodo_final',
        'tipo',
        'marca',
        'modelo',
        'ano',
        'veiculo',
        'valor_fipe',
        'codigo_fipe',
        'fipe_mes_referencia',
        'placa',
        'renavam',
        'horimetro_inicial',
        'observacao',
        'situacao'
    ];

    public function quilometragem()
    {
        return $this->hasOne(VeiculoQuilometragem::class);
    }

    public function abastecimento()
    {
        return $this->hasOne(VeiculoAbastecimento::class);
    }

    public function depreciacao()
    {
        return $this->hasOne(VeiculoDepreciacao::class);
    }

    public function manutencao()
    {
        return $this->hasOne(VeiculoManutencao::class);
    }

    public function seguro()
    {
        return $this->hasOne(VeiculoSeguro::class);
    }

    public function ipva()
    {
        return $this->hasOne(VeiculoIpva::class);
    }

    public function obra()
    {
        return $this->belongsTo(CadastroObra::class);
    }
}
