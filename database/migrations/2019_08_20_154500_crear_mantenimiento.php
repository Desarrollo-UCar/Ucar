<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearMantenimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->bigIncrements('idmantenimiento');
            $table->date('fecha_ingresa');
            $table->date('fecha_salida')->nullable();
            $table->float('costo_total')->nullable();
            $table->string('tipo');
            $table->string('status');
            $table->bigInteger('vehiculo')->unsigned();
            $table->foreign('vehiculo')->references('idvehiculo')->on('vehiculos'); 
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
        Schema::dropIfExists('mantenimientos');
    }
}
