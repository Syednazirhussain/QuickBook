<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
	public $email;
	public $password;
	public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
	 
	public $details;
	 
    public function __construct($name,$email,$password,$subject)
    {
       
	    $this->name = $name;
	    $this->email = $email;
	    $this->password = $password;
		$this->subject = $subject;
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
        ->view('emails.passwdmail');
    }
}
