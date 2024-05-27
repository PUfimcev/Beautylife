<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\App;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessagesMailing extends Mailable
{
    use Queueable, SerializesModels;

    protected $subscription;
    protected $message;
    /**
     * Create a new message instance.
     */
    public function __construct($subscription = null, $message = null)
    {

        if($subscription != null) $this->subscription = $subscription;
        if($message != null) $this->message = $message;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        if(App::getLocale() === 'en'){
            $messageSubject = $this->message->subject_en;
        } else {
            $messageSubject = $this->message->subject;
        }

        return new Envelope(
            subject: $messageSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.message_mailing',
            with: [
                'mailbody' => $this->message,
                'subscribe' => $this->subscription,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
