<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_temps', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->datetime('fecha_hora_reserva');
            $table->integer('lugar_recogida');
            $table->date('fecha_recogida');
            $table->time('hora_recogida');
            $table->integer('lugar_devolucion');
            $table->date('fecha_devolucion');
            $table->time('hora_devolucion');
            $table->string('codigo_descuento')->nullable();
            $table->string('tipo_vehiculo');
            $table->integer('id_vehiculo');
            $table->integer('id_cliente');//se agrego
            $table->string('servicios_extra');// agregar campo a la tabla reservacion
            $table->decimal('total');
            $table->string('estatus');
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
        Schema::dropIfExists('reserva_temps');
    }
}
