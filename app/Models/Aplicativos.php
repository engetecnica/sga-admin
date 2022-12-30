<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplicativos extends Model
{
    use HasFactory;
    

    protected $table = "aplicativos";

    public $timestamps = true;

    protected $fillable =   [
        'id', 
        'titulo',
        'link_download', 
        'downloads',
        'created_at', 
        'updated_at',
        'deleted_at' 
    ]; 

}
