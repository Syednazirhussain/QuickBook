<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
	public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
	 
	public $details;
	 
    public function __construct($name,$password)
    {
       
	    $this->name = $name;
	    $this->password = $password;
    }

/**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('email.testmail');
		return $this->subject($this->subject)
        ->view('emails.forgot');
    }
}
