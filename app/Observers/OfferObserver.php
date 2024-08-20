<?php

namespace App\Observers;

use App\Models\Offer;
use App\Http\Controllers\Mail\MessageMailController;

class OfferObserver
{
    /**
     * Handle the Offer "created" event.
     */
    public function created(Offer $offer): void
    {
        MessageMailController::sendOfferMail($offer);
    }

    /**
     * Handle the Offer "updated" event.
     */
    public function updated(Offer $offer): void
    {
        MessageMailController::sendOfferMail($offer);
    }

}
