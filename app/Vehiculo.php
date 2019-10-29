<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    //
    protected $primaryKey ='idvehiculo';
    protected $fillable = [
        'vin','matricula','marca','modelo','anio','precio', 'costo','pasajeros','color','cilindros','estatus','kilometraje','tipo','descripcion','foto','foto_atras','foto_derecha','foto_izquierda','puertas'
    ];
}
