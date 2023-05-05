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
        'codigo_da_maquina',
        'marca_da_maquina',
        'placa',
        'renavam',
        'horimetro_inicial',
        'observacao',
        'situacao'
    ];

    public function quilometragens()
    {
        return $this->hasMany(VeiculoQuilometragem::class);
    }

    public function abastecimentos()
    {
        return $this->hasMany(VeiculoAbastecimento::class);
    }

    public function depreciacaos()
    {
        return $this->hasMany(VeiculoDepreciacao::class);
    }

    public function manutencaos()
    {
        return $this->hasMany(VeiculoManutencao::class);
    }

    public function seguros()
    {
        return $this->hasMany(VeiculoSeguro::class);
    }

    public function ipvas()
    {
        return $this->hasMany(VeiculoIpva::class);
    }

    public function obra()
    {
        return $this->belongsTo(CadastroObra::class);
    }
}
