<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailHelper extends Mailable
{
    use Queueable, SerializesModels;

    public $rekamMedic;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rekamMedic)
    {
        $this->rekamMedic = $rekamMedic;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Mail Helper',
            replyTo:[
                "mohammadtajutzamzami07@gmail.com"
            ],
            from:"telemedicine.dev12@gmail.com",

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
            view: "test.mail", with : ["rekamMedic" => $this->rekamMedic]
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
