<?php

use Illuminate\Database\Seeder;

class tallerservicios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

    $datos=[
        'CAMBIAR ACEITE',
        'ENGRASAR CHASIS',
        'CAMBIO FILTRO DE ACEITE',
        'CAMBIO FILTRO DE AIRE',
        'CAMBIAR LIQUIDO DE TRANSMISION',
        'PURGAR SISTEMA DE REFRIGERACION',
        'AGREGAR ANTICONGELANTE',
        'EQUILIBRAR RUEDAS',
        'ROTAR NEUMATICOS',
        'CAMBIAR RUEDAS',
        'INSPECCION FRENOS',
        'PONER MOTOR A PUNTO',
        'CAMBIO DE BATERIA',
        'CAMBIO DE RADIADOR',
        'ALINEACION Y BALANCEO',
        'LAVADO Y ENGRASADO',
        'RECARGA DE AIRE ACONDICIONADO',
        'CAMBIO DE BUJIAS',
        'LUBRICACION',
        'LAVADO DE MOTOR',
        'LAVADO DE INYECCIONES',
        'BORRADO DE CODIGOS',
        'INSPECCION DE LUCES',
        'INSPECCION DE SISTEMA ELECTRICO',
        'CAMBIO DE FILTRO DE GASOLINA',
        'REVISION DE NIVELES DE LIQUIDO',
        'CAMBIO DE ROTULOS',
        'CAMBIO DE AMORTIGUADORES',
        'CAMBIO DE BOMBAS DE AGUA',
        'CAMBIO DE CLUTCH',
        'LAVADO DE SISTEMA',
        'LIMPIEZA DEL CUERPO DE ACELERACION',
        'CAMBIO DE LLANTAS'
        ];
        for($i=0;$i<count($datos);$i++){
        DB::table('tallerservicios')-> insert([
            'nombreservicio' => $datos[$i],
            'descripcion' => null,
            'created_at'=>$date,
            'updated_at'=>$date
        ]);
        }
    }
}
