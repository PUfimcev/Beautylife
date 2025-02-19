<?php

namespace App\Classes;

use App\Models\Offer;
use Illuminate\Support\Facades\App;

class GetOffers{

    private $offers;

    public function __construct(int $numberOffers = 0, string $arch = null)
    {

        $offersQuery = Offer::query();

        if($numberOffers > 0){
            $offersQuery->take($numberOffers);
            $offers = $offersQuery->orderBy('updated_at','desc')->get();
        } else {

            if($arch == 'archive'){
                $offersQuery->onlyTrashed();
            }

            $offers = $offersQuery->orderBy('updated_at','desc')->paginate(6);
        }

        $this->offers = $offers;

    }

    public function getOffers()
    {
        return $this->offers;
    }


    // process code to swap slug/slug_en route in page offer depending on locale (en or ru) & by toggling lang link and get appropriate related data

    public static function getLocaleOffer()
    {
        $arr = explode('/', url()->previous());

        if(!in_array('offers', $arr)) return;

        $urlOfferKey = array_search('offers', $arr);
        $urlPreviuosLastKey = array_key_last($arr);

        if($urlOfferKey == $urlPreviuosLastKey) return;

        $route = $arr[$urlPreviuosLastKey];


        if(App::getLocale() == 'ru'){
            // $getOffer = Offer::withTrashed()->where('slug', $route )->first();
            $getOffer = Offer::withTrashed()->getOffer($route)->first();

        } elseif (App::getLocale() == 'en'){
            // $getOffer = Offer::withTrashed()->where('slug_en', $route )->first();
            $getOffer = Offer::withTrashed()->getOffer($route)->first();
        }

        return $getOffer;

    }
}
