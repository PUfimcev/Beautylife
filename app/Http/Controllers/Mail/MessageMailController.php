<?php

namespace App\Http\Controllers\Mail;

use App\Models\Message;
use Illuminate\View\View;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\MessagesMailing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class MessageMailController extends Controller
{

    /**
     * Send the message.
     *
     * @return \Illuminate\Http\RedirectResponse
     */


    public function sendMessageMail(Message $message, Request $request): RedirectResponse
    {

        $subscribes = Subscription::all();

        if($subscribes->count() !== 0) {

            foreach($subscribes as $subscribe)
            {
                Mail::to($subscribe->email)->queue(new MessagesMailing($subscribe, $message));
            };

            return to_route('admin.messages.index')->with('status', 'The emails are sent successfully!');
        } else {
            return to_route('admin.messages.index')->with('status', 'There are no emails to send a message!');
        }

    }
}

