<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class servicios_extra extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //
       $faker = Faker::create();
       for ($i=0; $i <1; $i++) {
           \DB::table('serviciosextras')->insert(array(
               'nombre' => 'SILLA PARA BEBÉ',
              'descripcion' => 'Para bebes con menos de un año de edad y con peso inferioir a 9kg.(20lbs).',
               'disponibilidad' => 'disponible',
               'precio' => '180',
               'foto' => 'img/servicios_extra/BABY.PNG'
           ));
           \DB::table('serviciosextras')->insert(array(
            'nombre' => 'GPS',
           'descripcion' => 'Herramienta de gran importancia a la hora de salir de aventuras.',
            'disponibilidad' => 'disponible',
            'precio' => '200',
            'foto' => 'img/servicios_extra/GPS.PNG'
        ));
        \DB::table('serviciosextras')->insert(array(
            'nombre' => 'CONDUCTOR',
           'descripcion' => 'Contamos con el personal mejor capacitado, para llevarte a donde gustes de manera rápida y segura',
            'disponibilidad' => 'disponible',
            'precio' => '800',
            'foto' => 'img/servicios_extra/CONDUCTOR.PNG'
        ));
       }
    }
}
