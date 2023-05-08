<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerivication extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;

    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token , $email, $name)
    {
        $this->email = $email;
        //
        $this->token = $token;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Email Verivication',
            from: env("MAIL_USERNAME"),
            replyTo: [
                $this->email
            ],
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'test.mail-recovery',
            with:["token" => $this->token,"name" =>$this->name]
            
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
