<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mantenimientos extends Model
{
    //
    public $primaryKey ='idmantenimiento';
    protected $fillable = [
        'fecha_ingresa','fecha_salida','costo_total','tipo','status'
    ];
}
