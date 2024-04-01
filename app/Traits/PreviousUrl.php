<?php

namespace App\Traits;

use Illuminate\Support\Facades\URL;

trait PreviousUrl
{

    public function __construct()
    {

    }

    /**
     * Transmit URL to login form to add it into attribute href of remove button
     */

    public function getPreviousUrl()
    {

        $previousUrl = URL::previous();
        if(!isset($previousUrl)) return;

        if(!session()->has('prevUrl')){

           if(($previousUrl == route('index').'/' || $previousUrl == route('about') || $previousUrl == route('offers') || $previousUrl == route('catalog') || $previousUrl == route('brands') || $previousUrl == route('conditions') || $previousUrl == route('blogs'))){
               session(['prevUrl' => $previousUrl]);
           } else {
               session(['prevUrl' => route('index').'/']);
           }
        }
    }

}
