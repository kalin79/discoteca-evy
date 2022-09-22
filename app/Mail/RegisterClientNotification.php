<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterClientNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $registro_cliente;
    public $file;
    public function __construct($data,$file)
    {
        $this->registro_cliente = $data;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject = 'Registro Generado :' ;

        $email = $this->subject( $subject )->view('mail.registro-cliente', ['cliente'=>$this->registro_cliente] );
           // ->bcc('leslie@workaholics.pe');
        if($this->file){
            $email->attach($this->file);
        }
        return  $email;
    }
}
