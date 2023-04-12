<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerramentalRetiradaItem extends Model
{
    use HasFactory;
    protected $table = 'ativos_ferramental_retirada_item';
    protected $primaryKey = 'id_retirada';
}