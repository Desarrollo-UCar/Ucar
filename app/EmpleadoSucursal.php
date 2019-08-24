<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoSucursal extends Model
{
    //
    public $table='empleadosucursals';
    public $primaryKey ='empleado';
    //public $primaryKey ='sucursal';

    protected $fillable = [
        'sucursal','empleado','status'
    ];
}
