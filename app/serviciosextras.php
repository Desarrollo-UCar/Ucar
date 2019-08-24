<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class serviciosextras extends Model
{
    //
    protected $primaryKey ='idserviciosextra';
    protected $fillable = [
        'nombre','descripcion','disponibilidad','precio','foto',
        ];
}

