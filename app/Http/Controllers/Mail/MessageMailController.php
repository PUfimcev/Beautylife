<?php

namespace App\Http\Controllers\Mail;

use App\Models\Offer;
use App\Models\Message;
use App\Models\Product;
use Illuminate\View\View;
use App\Mail\OfferMailing;
use App\Classes\GetProducts;
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

        $query1['getBestsellers'] = 2;

        $productQuery1 = Product::with(['productImages']);
        $bestsellers = (new GetProducts($productQuery1, $query1))->apply()->get();

        $query2['getNewArrivals'] = 2;
        $productQuery2 = Product::with(['productImages']);

        $newArrivals = (new GetProducts($productQuery2, $query2))->apply()->get();

        if($subscribers) {

            foreach($subscribers as $subscriber)
            {
                Mail::to($subscriber->email)->queue(new OfferMailing($subscriber, $offer, $bestsellers, $newArrivals));
            };

        } else {
            return;
        }

    }
}

