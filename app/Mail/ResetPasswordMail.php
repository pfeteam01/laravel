<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ResetPasswordMail => c'est le mailable qui sert à récupérer le mot de passe
 * @package App\Mail
 */
class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $resetpass ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetpass)
    {
        $this->resetpass = $resetpass ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.resetpassword')
            ->from('NotreSite@Immobilier.dz','ImmobilierAlgerie')
            ->subject('Récupération de votre mot de passe')
            ->replyTo('NotreSite@Immobilier.dz');
    }
}
