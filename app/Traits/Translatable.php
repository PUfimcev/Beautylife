<?php

// For getting attributes depending on locale (en or ru)

namespace App\Traits;

use Illuminate\Support\Facades\App;


trait Translatable
{

        public function langField($inputFieldName)
        {

            if(App::getLocale() === 'en'){
                $outputFieldName = $inputFieldName .'_en';
            } else {

                $outputFieldName = $inputFieldName;
            }

            if(App::getLocale() === 'en' && (is_null($this->$outputFieldName) || empty($this->$outputFieldName))){
                return $this->$inputFieldName;
            }

            return $this->$outputFieldName;
        }

}
