<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoReservacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_reservacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_reserva');
            $table->string('paypal_Datos')->nullable();
            $table->string('mostrador_Datos')->nullable();
            $table->string('motivo')->nullable();
            $table->string('comentario')->nullable();
            $table->string('metodo')->nullable();
            $table->datetime('fecha');
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
        Schema::dropIfExists('pago_reservacions');
    }
}
