<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerramentalRetiradaAutenticacao extends Model
{
    use HasFactory;

    protected $table = "ativos_ferramental_retirada_autenticacao";
    protected $primaryKey = "id_retirada";
}