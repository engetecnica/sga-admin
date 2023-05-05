<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VeiculoQuilometragem extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
