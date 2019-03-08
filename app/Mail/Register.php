<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class Register : c'est le mailable qui sert à confirmer notre compte
 * @package App\Mail
 */
class Register extends Mailable
{
    use Queueable, SerializesModels;
    public $user ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.register')
            ->from('NotreSite@Immobilier.dz','ImmobilierAlgerie')
            ->subject('Bienvenue sur notre site')
            ->replyTo('NotreSite@Immobilier.dz');
    }
}
