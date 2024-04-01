<?php

namespace App\Classes;

class RemoveSessionClass 
{

    public function __construct()
    {
        // $this->removeSessionPrevUrl();
    }

    /**
     * Remove session
     * @return void
     */

    public function removeSessionPrevUrl() :void
    {
        if(session()->has('prevUrl')){
            session()->forget('prevUrl');
        }
    }

}