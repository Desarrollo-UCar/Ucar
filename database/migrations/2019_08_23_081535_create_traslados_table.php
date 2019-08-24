<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrasladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traslados', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->string('lugar_salida');
            $table->date('fecha_salida');
            $table->time('hora_salida');
            $table->string('lugar_llegada');
            $table->date('fecha_llegada_estimada');//estimacion de fecha segun tiempo estimado
            $table->time('hora_llegada_estimada');//estimacion de hora segun tiempo estimado
           
            $table->integer('metros_recorridos');//dado en metros
            $table->integer('tiempo_estimado'); //dado en segundos
            $table->integer('id_vehiculo');

            $table->decimal('precio_litro_gasolina');
            $table->integer('litros_gasolina');
            $table->decimal('monto_gasolina');
            $table->decimal('monto_casetas');

            $table->integer('num_choferes');
            $table->decimal('sueldo_chofer');
            $table->decimal('total');

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
        Schema::dropIfExists('traslados');
    }
}
