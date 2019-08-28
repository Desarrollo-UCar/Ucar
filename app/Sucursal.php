<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    public $primaryKey ='idsucursal';
    protected $fillable = [
        'nombre','pais', 'estado','ciudad','colonia','calle','numero','telefono'
    ];
}
