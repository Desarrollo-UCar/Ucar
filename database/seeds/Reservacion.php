<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Reservacion extends Seeder
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
            \DB::table('reservacions')->insert(array(
                'id_cliente' => $faker->numberBetween(1,540),
               'fecha_reservacion' => $faker->dateTime,
                'motivo_visita' => $faker->randomElement(['Turismo','Negocios','Vacaciones']),
                'comentarios' => 'por comentar',
                'total' => $faker->numberBetween(1000,20000)
               //'estatus' => 'pagada',
                //'calificacion' => $faker->numberBetween(1,5)
            ));
        }
    }
}
