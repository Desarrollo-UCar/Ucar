<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $primaryKey ='idempleado';
    protected $fillable = [
        'ine','nombres','primerApellido','segundoApellido','fechaNacimiento','nacionalidad','codigopostal', 'estado','municipio','colonia','calle','numero','foto','telefono','tipo','licenciaFechaExpedicion','licenciaFechaExpiracion','numLicencia'
    ];
}
