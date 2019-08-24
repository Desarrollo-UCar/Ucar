<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    //
    protected $primaryKey ='idvehiculo';
    protected $fillable = [
        'vin','matricula','marca','modelo','anio','precio', 'costo','pasajeros','color','cilindros','status','kilometraje','tipo','descripcion','foto'
    ];
}
