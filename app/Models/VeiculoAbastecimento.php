<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VeiculoAbastecimento extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'veiculo_id',
        'fornecedor_id',
        'combustivel',
        'quilometragem',
        'valor_do_litro',
        'quantidade',
        'valor_total',
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'veiculo_id', 'id');
    }

    public function fornecedor()
    {
        return $this->belongsTo(CadastroFornecedor::class, 'fornecedor_id', 'id');
    }
}
