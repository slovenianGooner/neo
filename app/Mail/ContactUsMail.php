<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $email;
    public string $message;

    public function __construct(string $locale, string $name, string $email, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;

        app()->setLocale($locale);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: word('neo.contact_us_mail_subject')
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-us',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
