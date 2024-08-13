<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GlassMail extends Mailable
{
    use Queueable, SerializesModels;

   public $mailContent;
    public $mailTemplate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailContent, $mailTemplate)
    {
        $this->mailContent = $mailContent;
        $this->mailTemplate = $mailTemplate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->mailTemplate,$this->mailContent);
    }
}
