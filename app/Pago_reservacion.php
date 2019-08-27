<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago_reservacion extends Model
{
    //
    protected $fillable = [
        'id', 'id_reserva','paypal_Datos', 'fecha','total','estatus'
    ];
}
