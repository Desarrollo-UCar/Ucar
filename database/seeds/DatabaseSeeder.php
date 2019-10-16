<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

       // $this->call(UsersTableSeeder::class);
<<<<<<< HEAD
        // $this->call(RoleTableSeeder::class);
        // $this->call(tallerservicios::class);
        // $this->call(sucursal::class);
        //  $this->call(Vehiculo::class);
         $this->call(vehiculosucursal::class);
         $this->call(servicios_extra::class);
        //  $this->call(cliente::class);
        //  $this->call(Alquiler::class);
        //  $this->call(Reservacion::class);
    //      $this->call(nacionalidades::class);
    //      $this->call(Empleado::class);
    // $this->call(pagos::class);
=======
        $this->call(RoleTableSeeder::class);
        $this->call(tallerservicios::class);
        $this->call(sucursal::class);
         $this->call(Vehiculo::class);
         $this->call(vehiculosucursal::class);
         $this->call(servicios_extra::class);
         $this->call(cliente::class);
         $this->call(Alquiler::class);
         $this->call(Reservacion::class);
         $this->call(nacionalidades::class);
         $this->call(Empleado::class);
    $this->call(pagos::class);
>>>>>>> a85946b74065c06ec71decd4325f4dfbeb940aba
    }
}
