<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServicioExtraSucursales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicioextrasucursales', function (Blueprint $table) {
            $table->bigInteger('sucursal')->unsigned();
            $table->foreign('sucursal')->references('idsucursal')->on('sucursals');
            $table->bigInteger('serviciosextra')->unsigned();
            $table->foreign('serviciosextra')->references('idserviciosextra')->on('serviciosextras');  
            $table->string('descripcion')->nullable();
            $table->integer('cantidad')->nullable(); 
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
        Schema::dropIfExists('servicioextrasucursales');
    }
}
