<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class contactMe extends Mailable
{
    use Queueable, SerializesModels;
    
    public $fromuser ;
    public $fromname ;
    public $content ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fromuser , $fromname , $content)
    {
        $this->fromuser = $fromuser ;
        $this->fromname = $fromname;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromuser)
                    ->subject('Question For You From ' . $this->fromname)
                    ->markdown('emails.contactme');
    }
}
