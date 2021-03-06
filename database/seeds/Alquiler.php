<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Alquiler extends Seeder
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
        for ($i=0; $i <300; $i++) {
            $lugar = $faker->randomElement(['Puerto','Tehua','Ixtepec']);
            $hora = $faker->time(8,20);
            \DB::table('alquilers')->insert(array(
                'id_reservacion' => $faker->unique()->numberBetween(1,300),
                
                'lugar_recogida' => $lugar,
                'fecha_recogida' =>  $faker->dateTimeBetween('-1 year', '+14 days'),
               'hora_recogida' => $hora,
               'lugar_devolucion' => $lugar,
               'fecha_devolucion' =>  $faker->dateTimeBetween('-1 year', '+18 days'),
               'hora_devolucion' => $faker->dateTimeBetween('-8 hour','+8 hour'),
               'id_vehiculo' => $faker->numberBetween(1,10),
                'km_salida' => $faker->numberBetween(10000, 10100),
                'km_regresa' => $faker->numberBetween(10150, 10200),
               'nombreConductor' => $faker->firstName,
                'num_licencia' => 'xxxx-xx-xx',
               'expedicion_licencia' => $faker->date, 
                'expiracion_licencia' => $faker->date, 
                'estatus' => 'espera',
            ));
        }
    }
}
