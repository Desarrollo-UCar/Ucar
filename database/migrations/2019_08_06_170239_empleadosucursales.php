<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Empleadosucursales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleadosucursals', function (Blueprint $table) {
            $table->bigInteger('sucursal')->unsigned();
            $table->foreign('sucursal')->references('idsucursal')->on('sucursals');
            $table->bigInteger('empleado')->unsigned();
            $table->foreign('empleado')->references('idempleado')->on('empleados');  
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
        Schema::dropIfExists('empleadosucursales');
    }
}
