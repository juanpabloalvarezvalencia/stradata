<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    protected $table = 'datos';
    
    protected $fillable = [
        'departamento',
        'localidad',
        'municipio',
        'nombre',
        'años_activo',
        'tipo_persona',
        'tipo_cargo',
    ]; 

}
