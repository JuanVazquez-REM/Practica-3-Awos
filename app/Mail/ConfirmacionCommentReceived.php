<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacionCommentReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $data_email_post;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Object $data_email_post)
    {
        $this->data_email_post = $data_email_post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('19170059@uttcampus.edu.mx')
                    ->subject('¡Usted a realizado un nuevo commentario!')
                    ->view('email.ConfirmComment');
    }
}
