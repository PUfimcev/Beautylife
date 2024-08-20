<?php

namespace App\Http\Controllers\Mail;

use App\Models\Offer;
use App\Models\Message;
use Illuminate\View\View;
use App\Mail\OfferMailing;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\MessagesMailing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class MessageMailController extends Controller
{

    // protected $subscribers;

    protected static function getSubscribers()
    {
        $subscribes = Subscription::all();

        if($subscribes->count() !== 0) return  $subscribes;
    }


    /**
     * Send the message.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function sendMessageMail(Message $message, Request $request): RedirectResponse
    {
        $subscribers = self::getSubscribers();

        if($subscribers) {

            foreach($subscribers as $subscriber)
            {
                Mail::to($subscriber->email)->queue(new MessagesMailing($subscriber, $message));
            };

            return to_route('admin.messages.index')->with('status', 'The emails are sent successfully!');
        } else {
            return to_route('admin.messages.index')->with('status', 'There are no emails to send a message!');
        }

    }

    public static function sendOfferMail(Offer $offer)
    {
        $subscribers = self::getSubscribers();

        if($subscribers) {

            foreach($subscribers as $subscriber)
            {
                Mail::to($subscriber->email)->queue(new OfferMailing($subscriber, $offer));
            };

        } else {
            return;
        }

    }
}

