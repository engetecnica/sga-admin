<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CadastroEmpresa extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = "empresas";
    protected $dates = ['deleted_at'];

    public function obras()
    {
        return $this->hasMany(CadastroObra::class, 'id_empresa', 'id');
    }
}
