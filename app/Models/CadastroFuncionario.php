<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroFuncionario extends Model
{
    use HasFactory;

    protected $table = "funcionarios";
    protected $dates = ['deleted_at'];


    
}
