<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtivoExterno extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "ativos_externos";
    protected $dates = ['deleted_at'];

    public function estoque()
    {
        return $this->hasMany(AtivoExternoEstoque::class, 'id_ativo_externo', 'id')->where('status', 4);
    }


}
