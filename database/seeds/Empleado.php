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
            'ine' => '000000000000001',
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

        \DB::table('users')->insert(array(
            'name' => 'Adriana',
            'email' => 'gerente@ucar.com',
            'password'=> Hash::make('12345678'),
        ));

        \DB::table('role_user')->insert(array(
            'role_id' => '3',
            'user_id' => '1',
            //'password'=> Hash::make('12345678'),
        ));

    }
}

