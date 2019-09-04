<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicioextrasucursales extends Model
{
    //
    public $primaryKey ='sucursal';
    protected $fillable=[
        'sucursal','servicioextra','descripcion','cantidad'
    ];
}
