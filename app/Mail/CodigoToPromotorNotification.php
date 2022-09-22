<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodigoToPromotorNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $promotor;
    public $evento;
    public $file;
    public $evento_promotor;
    public function __construct($data_promotor,$data_evento,$evento_promotor,$file=null)
    {
        $this->promotor = $data_promotor;
        $this->evento = $data_evento;
        $this->file = $file;
        $this->evento_promotor= $evento_promotor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject = 'Lista de Codigos Armoni - '.$this->evento->nombre." - " .$this->evento_promotor->zona->nombre ;

        $email = $this->subject( $subject )->view('mail.codigos-evento-promotor', ['promotor'=>$this->promotor,'evento'=>$this->evento,'evento_promotor_id'=>$this->evento_promotor->id] );
        // ->bcc('leslie@workaholics.pe');
        if($this->file){
            $email->attach($this->file);
        }
        return  $email;
    }
}
