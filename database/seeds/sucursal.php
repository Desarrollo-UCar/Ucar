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
            'pais' => 'MEXICO',
            'estado' => 'OAXACA',
            'ciudad' => 'POCHUTLA',
            'colonia' => 'COL. MARINERO, SANTA MARÍA COLOTEPEC POCHUTLA, OAXACA',
            'calle' => 'CONOCIDO',
            'numero' => '0',
            'telefono' => '(954) 582-3224',
            'created_at' => $date
        ]);

        DB::table('sucursals')-> insert([
            'nombre' => 'U-CAR ISTMO',
            'pais' => 'MEXICO',
            'estado' => 'OAXACA',
            'ciudad' => 'EL ESPINAL OAXACA',
            'colonia' => ' CENTRO, EL ESPINAL OAXACA, OAXACA',
            'calle' => 'GADALUPE VICTORIA ESQUINA DE LOS MAESTROS',
            'numero' => '0',
            'telefono' => '(954) 149-0304',
            'created_at' => $date
        ]);

        DB::table('sucursals')-> insert([
            'nombre' => 'U-CAR AEROPUERTO IXTEPEC',
            'pais' => 'MEXICO',
            'estado' => 'OAXACA',
            'ciudad' => 'IXTEPEC JUCHITAN',
            'colonia' => 'CENTRO, AEROPUERTO IXTEPEC JUCHITAN, OAXACA',
            'calle' => 'INTERIOR DEL AEROPUERTO',
            'numero' => '0',
            'telefono' => '(954) 149-0304',
            'created_at' => $date
        ]);
    }
}

