<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function manutencao()
    {
        return $this->hasMany(VeiculoManutencao::class);
    }
}
