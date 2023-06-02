<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CadastroFuncionario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "funcionarios";
    protected $dates = ['deleted_at'];

    public function obra()
    {
        return $this->belongsTo(CadastroObra::class, 'id_obra', 'id');
    }

    public function funcao()
    {
        return $this->belongsTo(FuncaoFuncionario::class, 'id_funcao', 'id');
    }
}
