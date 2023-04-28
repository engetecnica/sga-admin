<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoDepreciacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo_id',
        'valor_atual',
        'referencia_mes',
        'referencia_ano'
    ];
    
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
