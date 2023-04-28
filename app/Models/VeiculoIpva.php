<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoIpva extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo_id',
        'referencia_ano',
        'valor',
        'data_de_vencimento',
        'data_de_pagamento',
    ];
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
