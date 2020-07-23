<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $surname;
    public $email;
    public $username;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $surname, $email, $username)
    {
        //
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registration_email');
    }
}
