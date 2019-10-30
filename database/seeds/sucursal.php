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
            'foto' => 'foto',
            'foto1' => 'fotoo',
            'foto2' => 'fotooo',
            'nombre' => 'U CAR PUERTO ESCONDIDO',
            'codigopostal' => '68000',
            'estado' => 'OAXACA',
            'municipio' => 'POCHUTLA',
            'colonia' => 'COL. MARINERO, SANTA MARÍA COLOTEPEC POCHUTLA, OAXACA',
            'calle' => 'CONOCIDO',
            'numero' => '0',
            'telefono' => '(954) 582-3224',
            'status'=> 'ACTIVO',
            'link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22621.964087749308!2d-95.10877327070585!3d16.555703272105468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c00181d48959e7%3A0xb705ca0184f7dd6f!2s70110%20Ixtepec%2C%20Oax.!5e0!3m2!1ses!2smx!4v1572459043932!5m2!1ses!2smx',
            'created_at' => $date
        ]);
            
        DB::table('sucursals')-> insert([
            'foto' => 'foto',
            'foto1' => 'fotoo',
            'foto2' => 'fotooo',
            'nombre' => 'U CAR ISTMO',
            'codigopostal' => '68000',
            'estado' => 'OAXACA',
            'municipio' => 'EL ESPINAL OAXACA',
            'colonia' => ' CENTRO, EL ESPINAL OAXACA, OAXACA',
            'calle' => 'GADALUPE VICTORIA ESQUINA DE LOS MAESTROS',
            'numero' => '0',
            'telefono' => '(954) 149-0304',
            'status'=> 'ACTIVO',
            'link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22621.964087749308!2d-95.10877327070585!3d16.555703272105468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c00181d48959e7%3A0xb705ca0184f7dd6f!2s70110%20Ixtepec%2C%20Oax.!5e0!3m2!1ses!2smx!4v1572459043932!5m2!1ses!2smx',
            'created_at' => $date
        ]);

        DB::table('sucursals')-> insert([
            'foto' => 'foto',
            'foto1' => 'fotoo',
            'foto2' => 'fotooo',
            'nombre' => 'U CAR AEROPUERTO IXTEPEC',
            'codigopostal' => '68000',
            'estado' => 'OAXACA',
            'municipio' => 'IXTEPEC JUCHITAN',
            'colonia' => 'CENTRO, AEROPUERTO IXTEPEC JUCHITAN, OAXACA',
            'calle' => 'INTERIOR DEL AEROPUERTO',
            'numero' => '0',
            'telefono' => '(954) 149-0304',
            'status'=> 'ACTIVO',
            'link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22621.964087749308!2d-95.10877327070585!3d16.555703272105468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c00181d48959e7%3A0xb705ca0184f7dd6f!2s70110%20Ixtepec%2C%20Oax.!5e0!3m2!1ses!2smx!4v1572459043932!5m2!1ses!2smx',
            'created_at' => $date
        ]);
    }
}

