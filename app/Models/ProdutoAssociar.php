<?php

namespace App\Models;

use App\Http\Controllers\CadastroProdutoController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoAssociar extends Model
{
    use HasFactory;

    protected $table = "produtos_configuracoes";

}
