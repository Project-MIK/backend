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
    public $name;

    public $email;

    public function __construct($rekamMedic , $name , $email)
    {
        $this->rekamMedic = $rekamMedic;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Rekam-Medic Notification',
            replyTo: [
                $this->email
            ],
            from: env("MAIL_USERNAME"),
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
            view: "test.mail-medical-record",
            with: ["rekamMedic" => $this->rekamMedic, "name" => $this->name]
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
