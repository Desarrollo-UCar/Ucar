<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicioextrasucursales extends Model
{
    //
    protected $fillable=[
        'sucursal','servicioextra','descripcion','cantidad'
    ];
}
