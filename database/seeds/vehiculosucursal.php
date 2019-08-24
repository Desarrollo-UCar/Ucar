<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
class vehiculosucursal extends Seeder
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
        $faker = Faker::create();
        for ($i=0; $i <10; $i++) {
        DB::table('vehiculosucursales')-> insert([
            'sucursal' => $faker->numberBetween(1,3),
            'vehiculo' => $i+1,
            'status' => 'ACTIVO',            
            'created_at' => $date
        ]);
        }
    }
}
