<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Veiculo extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'veiculos';

    protected $dates = ['deleted_at'];

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
        'placa',
        'renavam',
        'horimetro_inicial',
        'quilometragem_inicial',
        'observacao',
        'situacao'
    ];

    public function quilometragens()
    {
        return $this->hasMany(VeiculoQuilometragem::class, 'veiculo_id');
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
