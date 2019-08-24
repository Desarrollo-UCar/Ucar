<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleTallersevicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalletallerservicios', function (Blueprint $table) {
            $table->bigIncrements('idetalletallerservicio');
            $table->bigInteger('mantenimiento')->unsigned();
            $table -> foreign('mantenimiento')->references('idmantenimiento')->on('mantenimientos');
            $table->bigInteger('tallerservicio')->unsigned();
            $table->foreign('tallerservicio')->references('idserviciotaller')->on('tallerservicios');
            $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('detalletallerservicios');
    }
}
