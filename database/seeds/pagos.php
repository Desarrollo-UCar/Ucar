<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class pagos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        for ($i=0; $i <300; $i++) {
            \DB::table('pago_reservacions')->insert(array(
                'id_reserva' => $faker->unique()->numberBetween(1,300),
                'paypal_Datos' => 'xxxx-xxx-xx',
                'mostrador_Datos' =>'<<<',
                'motivo' => 'saldo',
                'comentario' =>'bien',
                'fecha' =>  $faker->dateTimeBetween('-3 year', '+14 days'),
                'total' => $faker->numberBetween(1000,3000),
               'estatus' => 'pagado',
               'metodo' => 'efectivo',
            ));
        }
        //
    }
}
