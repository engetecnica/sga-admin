<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoQuilometragem extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo_id',
        'quilometragem_atual',
        'quilometragem_nova',
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}
