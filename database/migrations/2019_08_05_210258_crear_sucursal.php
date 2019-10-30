<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearSucursal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
            $table->bigIncrements('idsucursal');
            $table->string('foto');
            $table->string('foto1');
            $table->string('foto2');
            $table->string('nombre')->require;
            $table->string('link')->nullable();
            $table->integer('codigopostal')->require;
            $table->string('estado')->require;
            $table->string('municipio')->require;
            $table->string('colonia')->require;
            $table->string('calle')->requiere;
            $table->string('numero')->requiere;
            $table->string('status')->requiere;
            $table->string('telefono')->require;

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
        Schema::dropIfExists('sucursales');
    }
}
