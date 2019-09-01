<?php

use Illuminate\Database\Seeder;

class sucursal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        DB::table('sucursals')-> insert([
            'nombre' => 'U-CAR PUERTO ESCONDIDO',
            'codigopostal' => '68000',
            'estado' => 'OAXACA',
            'municipio' => 'POCHUTLA',
            'colonia' => 'COL. MARINERO, SANTA MARÍA COLOTEPEC POCHUTLA, OAXACA',
            'calle' => 'CONOCIDO',
            'numero' => '0',
            'telefono' => '(954) 582-3224',
            'status'=> 'ACTIVO',
            'created_at' => $date
        ]);
            
        DB::table('sucursals')-> insert([
            'nombre' => 'U-CAR ISTMO',
            'codigopostal' => '68000',
            'estado' => 'OAXACA',
            'municipio' => 'EL ESPINAL OAXACA',
            'colonia' => ' CENTRO, EL ESPINAL OAXACA, OAXACA',
            'calle' => 'GADALUPE VICTORIA ESQUINA DE LOS MAESTROS',
            'numero' => '0',
            'telefono' => '(954) 149-0304',
            'status'=> 'ACTIVO',
            'created_at' => $date
        ]);

        DB::table('sucursals')-> insert([
            'nombre' => 'U-CAR AEROPUERTO IXTEPEC',
            'codigopostal' => '68000',
            'estado' => 'OAXACA',
            'municipio' => 'IXTEPEC JUCHITAN',
            'colonia' => 'CENTRO, AEROPUERTO IXTEPEC JUCHITAN, OAXACA',
            'calle' => 'INTERIOR DEL AEROPUERTO',
            'numero' => '0',
            'telefono' => '(954) 149-0304',
            'status'=> 'ACTIVO',
            'created_at' => $date
        ]);
    }
}

