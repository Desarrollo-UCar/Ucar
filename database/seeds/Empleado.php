<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class Empleado extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        //
        \DB::table('empleados')->insert(array(
            'ine' => '00000000000000a',
            'nombres' => 'Adriana',
            'primerApellido' => 'Rodriguez',
            'segundoApellido' => 'Benitez',
            'fechaNacimiento' => '1990-08-23',
            'genero' => 'femenino',
            'Nacionalidad' => 'mexicana',
            'fechaNacimiento' => '1990-08-23',
            'codigopostal' => '68000',
            'estado' => 'Oaxaca',
            'municipio' => 'De juarez',
            'colonia' => 'Guadalupe Victoria',
            'calle' => 'Independencia',
            'numero' => '5',
            'foto'  => 'foto',
            'correo' => 'gerente@ucar.com',
            'telefono'=> '9514786952',
            'tipo' => 'gerente',
            'status' => 'activo'

        ));
    }
}
