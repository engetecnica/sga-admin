<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroUsuariosVinculo extends Model
{
    use HasFactory;
    protected $table = "usuarios_vinculos";
    protected $primaryKey = "id_usuario";

    public function vinculo()
    {
        return $this->hasMany(CadastroFuncionario::class, 'id_funcao');
    }
}
