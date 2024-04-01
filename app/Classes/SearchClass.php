<?php

namespace App\Classes;

class SearchClass
{
    private $searchRequest;

    /**
     * Get $query from MainController
     * @param mixed $query
     */

    public function __construct($query)
    {
        $this->searchRequest = $query;

    }

    /**
     * 
     * @return mixed
     */
    public function getResult(): mixed
    {
        return $this->searchRequest;
    }
}
