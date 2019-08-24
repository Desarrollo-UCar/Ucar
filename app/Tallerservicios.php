<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tallerservicios extends Model
{
    protected $primaryKey ='idserviciotaller';
    protected $fillable = [
        'nombreservicio','descripcion'
    ];
}
