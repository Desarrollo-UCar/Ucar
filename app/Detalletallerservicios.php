<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalletallerservicios extends Model
{
    //
    //public $primaryKey ='mantenimiento';
    protected $fillable = [
        'mantenimiento','tallerservicio','descripcion'
    ];
}
