<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfilclimas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'cve_perfil_clima',
        'descripcion',
        'pregunta_inicio',
        'pregunta_fin',
    ];    
}