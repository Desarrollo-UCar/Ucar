<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearVehículo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('idvehiculo');            
            $table->string('vin');
            $table->string('matricula')->require;
            $table->string('marca')->require;
            $table->string('modelo')->require;
            $table->string('transmicion');//agregada
            $table->integer('puertas');//agregada
            $table->integer('rendimiento');//agrega
            $table->string('estatus');//agregada
            $table->integer('anio');
            $table->float('precio');
            $table->float('costo');
            $table->integer('pasajeros');
            $table->string('maletero');
            $table->string('color');
            $table->integer('cilindros');
            $table->float('kilometraje');
            $table->string('tipo');
            $table->string('descripcion')->nullable(); 
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('vehiculos');
    }
}
