<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommandeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $annonce ;
    public $typeBien ;
    public $typeBienObj ;
    public $typeAction ;
    public $typeActionObj ;
    public $image00 ;
    public $username ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($annonce,$typeBien,$typeBienObj,$typeAction,$typeActionObj,$image00,$username)
    {
        $this->annonce = $annonce;
        $this->typeBien = $typeBien;
        $this->typeBienObj = $typeBienObj;
        $this->typeAction = $typeAction;
        $this->typeActionObj = $typeActionObj;
        $this->image00 = $image00;
        $this->username = $username ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.commander')
            ->from('NotreSite@Immobilier.dz','ImmobilierAlgerie')
            ->subject('Bienvenue sur notre site')
            ->replyTo('NotreSite@Immobilier.dz');
    }
}
