<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $primaryKey ='idempleado';
    protected $fillable = [
        'ine','rfc','nombres','primerApellido','segundoApellido','fechaNacimiento','nacionalidad','codigopostal', 'status','municipio','colonia','calle','numero','foto','telefono','tipo','genero','licenciaFechaExpedicion','licenciaFechaExpiracion','numLicencia'
    ];
}
