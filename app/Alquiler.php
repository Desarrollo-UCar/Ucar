<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    //
    protected $fillable = ['id', 'id_reservacion', 'lugar_recogida', 'fecha_recogida','hora_recogida','lugar_devolucion','fecha_devolucion','hora_devolucionj','id_vehiculo','km_salida','km_regresa','num_licencia','expedicion_licencia','expiracion_licencia','estatus'];

}
