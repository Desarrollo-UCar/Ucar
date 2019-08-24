<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $primaryKey ='idempleado';
    protected $fillable = [
        'curp','nombres','primerApellido','segundoApellido','fechaNacimiento','nacionalidad','pais', 'estado','ciudad','colonia','calle','numero','foto','telefono','tipo','licenciaFechaExpedicion','licenciaFechaExpiracion','numLicencia'
    ];
}
