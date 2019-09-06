<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Enviar extends Mailable{
    use Queueable, SerializesModels;
    public $reservacion;
    public $serv_extra;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservacion,$serv_extra){
        $this->reservacion = $reservacion;
        $this->serv_extra = $serv_extra;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('mails.correo_reserva',compact('reservacion','serv_extra'));
    }
}
