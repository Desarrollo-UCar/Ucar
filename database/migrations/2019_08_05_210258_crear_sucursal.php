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
            $table->engine = 'InnoDB';
            $table->bigIncrements('idsucursal');
            $table->string('nombre')->require;
            $table->string('pais')->require;
            $table->string('estado')->require;
            $table->string('ciudad')->require;
            $table->string('colonia')->require;
            $table->string('calle')->requiere;
            $table->integer('numero')->requiere;
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
