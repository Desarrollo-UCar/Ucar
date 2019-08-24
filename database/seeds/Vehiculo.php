<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class Vehiculo extends Seeder
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
        for ($i=0; $i <10; $i++) {
            \DB::table('vehiculos')->insert(array(
                'vin' => '00000000000000000',
               'matricula' => 'xxxxxxx',
                'marca' => $faker->randomElement(['Audi', 'Mercedez Benz', 'BMW', 'Honda', 'Chevrolet', 'Nissan']),
                'modelo' => $faker->randomElement(['March 2018', 'Aveo 2016', 'Durango 2013', 'Suburban 2008', 'Duster 2018', 'Hilux 2014','XV 2018','Dio 2019']),
                'transmicion' => $faker->randomElement(['automática','standar']),
                'puertas' => $faker->randomElement(['4','2']),
                'rendimiento' => $faker->randomElement(['14', '11', '6', '8', '10', '4']),
                'estatus' => 'disponible',
                'anio' => $faker->year,
               'precio' => $faker->numberBetween(1100,1600), 
                'costo' => $faker->numberBetween(400000,800000), 
                'pasajeros' => $faker->numberBetween(3,5),
                'maletero' => $faker->randomElement(['4 Maletas Grandes','2 Maletas Grandes', '3 Maletas Grandes']),
                'color' => $faker->randomElement(['Rojo', 'Blanco', 'Negro', 'Plata']),
                'cilindros' => '4',
                'kilometraje' => '4000',
                'tipo' => $faker->randomElement(['compacto', 'camioneta', 'suburban', 'motoneta']),
                'descripcion' =>'Aire acondicionado, bolsas de aire',
                'foto' => 'img/flota/Chevrolet-Aveo-2018.jpg'
            ));
        }
    }
}
