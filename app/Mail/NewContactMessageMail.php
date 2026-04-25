<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactMessageMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public readonly ContactMessage $message) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->message->email, $this->message->name)],
            subject: 'Novo contacto através do site NBTech',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-message',
        );
    }
}
