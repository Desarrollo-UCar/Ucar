<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehiculosucursales extends Model
{
    //
    public $table='vehiculosucursales';
    public $primaryKey ='vehiculo';
    protected $fillable = [
        'sucursal','vehiculo','status'
    ];
}
