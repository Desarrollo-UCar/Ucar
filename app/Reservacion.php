<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    //
        //
    protected $fillable = ['id', 'id_cliente', 'fecha_reservacion','motivo_visita','comentarios','total'];
}
