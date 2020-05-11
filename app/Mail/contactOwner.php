<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class contactOwner extends Mailable
{
    use Queueable, SerializesModels;
    
    public $fromuser ;
    public $fromname ;
    public $content ;
    public $propid ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fromuser ,$fromname, $content , $propid)
    {
        $this->fromuser = $fromuser ;
        $this->fromname = $fromname;
        $this->content = $content;
        $this->propid = $propid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromuser)
                ->subject('About Property number ' . $this->propid)
                ->markdown('emails.contact');
    }
}
