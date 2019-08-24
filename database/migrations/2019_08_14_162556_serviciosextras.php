<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Serviciosextras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviciosextras', function (Blueprint $table) {
            $table->bigIncrements('idserviciosextra');            
            $table->string('nombre')->require;
            $table->string('descripcion')->nullable();
            $table->string('disponibilidad')->require;
            $table->integer('precio')->require;
            $table->string('foto')->nullable();
           // $table->bigInteger('sucursal')->unsigned();
            //$table->foreign('sucursal')->references('idsucursal')->on('sucursals');

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
        Schema::dropIfExists('serviciosextras');
    }
}
