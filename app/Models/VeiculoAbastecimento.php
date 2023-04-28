<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoAbastecimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo_id',
        'combustivel',
        'quilometragem',
        'valor_do_litro',
        'quantidade',
        'valor_total',
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
