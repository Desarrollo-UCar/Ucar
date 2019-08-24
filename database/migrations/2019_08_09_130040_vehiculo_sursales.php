<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VehiculoSursales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculosucursales', function (Blueprint $table) {
            $table->bigInteger('sucursal')->unsigned();
            $table->foreign('sucursal')->references('idsucursal')->on('sucursals');
            $table->bigInteger('vehiculo')->unsigned();
            $table->foreign('vehiculo')->references('idvehiculo')->on('vehiculos');  
            $table->string('status'); 
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
        Schema::dropIfExists('vehiculosucursales');
    }
}
