<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearEmpleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('idempleado');
            $table->string('curp');
            $table->string('nombres')->require;
            $table->string('primerApellido')->require;
            $table->string('segundoApellido');
            $table->date('fechaNacimiento')->require;
            $table->string('nacionalidad')->require;
            $table->string('pais')->require;
            $table->string('estado')->require;
            $table->string('ciudad')->require;
            $table->string('colonia')->require;
            $table->string('calle')->requiere;
            $table->integer('numero')->requiere;
            $table->string('foto')->nullable();
            $table->string('correo')->require;
            $table->string('telefono')->require;
            $table->string('tipo')->require;
            $table->date('licenciaFechaExpiracion')->nullable();
            $table->date('licenciaFechaExpedicion')->nullable();
            $table->integer('numLicencia')->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
