<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoSeguro extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo_id',
        'carencia_inicial',
        'carencia_final',
        'valor'
    ];
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
