<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlquilersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alquilers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_reservacion');//id de la reservacion antes creada
            
            $table->string('lugar_recogida');
            $table->date('fecha_recogida');
            $table->time('hora_recogida');

            $table->string('lugar_devolucion');
            $table->date('fecha_devolucion');
            $table->time('hora_devolucion');

            $table->integer('id_vehiculo');
            $table->integer('km_salida');
            $table->integer('km_regresa');

            $table->string('nombreConductor');
            $table->string('num_licencia');
            $table->string('expedicion_licencia');
            $table->string('expiracion_licencia');

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
        Schema::dropIfExists('alquilers');
    }
}
