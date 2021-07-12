<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //  
    protected $user;
    public function __construct($user)

    {
          $this->user= $user;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('sample email')->view('contents.sendmail.sendmail')->with("user",$this->user);
    }
}
