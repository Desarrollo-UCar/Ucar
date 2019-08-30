<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    public $primaryKey ='idsucursal';
    protected $fillable = [
        'nombre','codigopostal','estado','municipio','colonia','calle','numero','telefono','status'
    ];
}
