<?php

namespace App\Classes;

use App\Models\Review;

class GetReviews{

    private $reviews;

    public function __construct($numberReviews = 2)
    {

        $reviewsQuery = Review::edited();

        if($numberReviews > 0){

            $reviewsQuery->take($numberReviews);
        }

        $reviews = $reviewsQuery->orderBy('updated_at','desc')->get();
        $this->reviews = $reviews;
    }


    public function getReviews()
    {
        return $this->reviews;
    }
}
