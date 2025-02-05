<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\App;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OfferMailing extends Mailable
{
    use Queueable, SerializesModels;


    protected $subscription;
    protected $offer;
    protected $bestsellers;
    protected $newArrivals;

    /**
     * Create a new message instance.
     */
    public function __construct($subscription = null, $offer = null, $bestsellers = null, $newArrivals = null)
    {

        if($subscription != null) $this->subscription = $subscription;
        if($offer != null) $this->offer = $offer;

        if($bestsellers != null) $this->bestsellers = $bestsellers;
        if($newArrivals != null) $this->newArrivals = $newArrivals;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if(App::getLocale() === 'en'){
            $messageSubject = $this->offer->title_en.': '.$this->offer->about_en;
        } else {
            $messageSubject = $this->offer->title.': '.$this->offer->about;
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
            view: 'emails.offer_mailing',
            with: [
                'mailbody' => $this->offer,
                'subscribe' => $this->subscription,
                'bestsellers' => $this->bestsellers,
                'newArrivals' => $this->newArrivals,
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
