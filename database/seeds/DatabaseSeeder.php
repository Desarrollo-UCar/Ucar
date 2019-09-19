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

<<<<<<< HEAD
       // $this->call(UsersTableSeeder::class);
       // $this->call(RoleTableSeeder::class);
        $this->call(tallerservicios::class);
        $this->call(sucursal::class);
         $this->call(Vehiculo::class);
         $this->call(vehiculosucursal::class);
         $this->call(servicios_extra::class);
         $this->call(cliente::class);
         $this->call(Alquiler::class);
         $this->call(Reservacion::class);
         $this->call(nacionalidades::class);
=======
        //$this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(tallerservicios::class);
        $this->call(sucursal::class);
        $this->call(Vehiculo::class);
        $this->call(vehiculosucursal::class);
        $this->call(servicios_extra::class);
        //$this->call(cliente::class);
        //$this->call(Alquiler::class);
        //$this->call(Reservacion::class);
        $this->call(nacionalidades::class);
>>>>>>> ec850472166f33319f4da05476fb974d730c7023
         $this->call(Empleado::class);
    }
}
