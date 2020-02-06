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
            $table->string('foto');
            $table->string('foto1');
            $table->string('foto2');
            $table->integer('codigo_postal')->require;
            $table->string('estado')->require;
            $table->string('Municipio')->require;
            $table->string('colonia')->require;
            $table->string('calle')->requiere;
            $table->string('numero')->requiere;
            $table->string('status');
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
