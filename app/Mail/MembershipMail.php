<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MembershipMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $membership;
    /**
     * Create a new message instance.
     */
    public function __construct($membership){
        $this->membership = $membership;
      

    }

    public function build()
    {
        return $this->markdown('mail.membership')
              ->with('membership', $this->membership);
    }
}
