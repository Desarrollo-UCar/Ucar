<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrasladoTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('traslado_temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('fecha_hora_reserva');//fecha y hora de creacion de la reserva de un traslado
           
            $table->string('lugar_salida');
            $table->date('fecha_salida')->nullable();
            $table->time('hora_salida')->nullable();
            $table->string('lugar_llegada');
            $table->date('fecha_llegada_solicitada');//estimacion de fecha segun tiempo estimado
            $table->time('hora_llegada');
            $table->integer('n_pasajeros');
            
            $table->integer('id_cliente')->nullable();
            $table->string('nombres')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();

            $table->boolean('viaje_redondo')->nullable();
            $table->integer('dias_espera')->nullable();
            //datos que se anexaran a la hora que el administrador realice la cotizacion
            $table->integer('sucursal')->nullable();
            $table->date('fecha_salida_de_sucursal')->nullable();
            $table->time('hora_salida_de_sucursal')->nullable();
            $table->integer('km_sucursal_origen')->nullable();
            $table->float('gasolina')->nullable();
            $table->float('otros_gastos')->nullable();

            $table->integer('id_vehiculo')->nullable();

            $table->integer('n_choferes')->nullable();
            $table->float('sueldo_chofer')->nullable();
            $table->integer('descuento')->nullable();
            $table->boolean('estatus')->nullable();
            //los datos personales 
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
        Schema::dropIfExists('traslado_temps');
    }
}
