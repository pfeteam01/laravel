<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlerteMail extends Mailable
{
    use Queueable, SerializesModels;
    public $alerte ;
    public $sesBiens ;
    public $sesActions ;
    public $sesChambres ;
    public $id ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($alerte,$sesBiens,$sesActions,$sesChambres,$id)
    {
        $this->alerte = $alerte ;
        $this->sesBiens = $sesBiens ;
        $this->sesActions = $sesActions ;
        $this->sesChambres = $sesChambres ;
        $this->id = $id ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.alerte_notify')
            ->from('NotreSite@Immobilier.dz','ImmobilierAlgerie')
            ->subject('Un annonçateur vient de déposes une annonce qui a l\'air de correspendre à vos critères d\'une de vos alertes.')
            ->replyTo('NotreSite@Immobilier.dz');
    }
}
