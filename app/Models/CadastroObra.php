<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CadastroObra extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "obras";
    protected $dates = ['deleted_at'];

}
