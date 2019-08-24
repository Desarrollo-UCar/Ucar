<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Sucursales', function (Blueprint $table) {
            $table->increments('idSucursal');
            $table->string('pais')->require;
            $table->string('estado')->require;
            $table->string('ciudad')->require;
            $table->string('colonia')->require;
            $table->string('calle')->requiere;
            $table->integer('numero')->requiere;
            $table->string('telefono')->require;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Sucursales');
    }
}
