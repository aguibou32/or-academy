<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    
    public $name;
    public $surname;
    public $course_apply;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $surname, $course_apply)
    {
        //
        $this->name = $name;
        $this->surname = $surname;
        $this->course_apply = $course_apply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.application_confirmation');
    }
}
