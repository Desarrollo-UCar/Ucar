<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $enviar;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($enviar)
    {
        $this->enviar = $enviar;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.correo_reserva');
    }
    }

