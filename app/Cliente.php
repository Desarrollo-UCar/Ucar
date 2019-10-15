<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $primaryKey ='idCliente';
    protected $fillable = ['idCliente', 'nombre', 'primerApellido','segundoApellido','foto','correo','telefono','calle','numero','colonia','ciudad','estado','pais'];
}
