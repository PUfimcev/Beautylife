<?php

namespace App\Classes;

use App\Models\Category;


class GetCatalogTopNewData{

    // private $data = [];

    public function __construct($query)
    {

        $this->getCatalogTopNewData($query);
    }


    public static function getCatalogTopNewData($query)
    {
        if($query == 'bestsellers') {
            $goods = [1, 2, 3, 4, 5, 6];
            $count = count($goods);
            $title = 'Bestsellers';
            $tag = 'Top';
        }

        if($query == 'new-arrivals')  {
            $goods = [1, 2, 3, 4, 5, 6];
            $count = count($goods);
            $title = 'New arrival';
            $tag = 'New';
        }

        if($query == 'all-goods')  {
            $goods = [];
            $count = count($goods);
            $title = 'All goods';
        }

        if($query == 'sale-price')  {
            $goods = [1, 2, 3, 4];
            $count = count($goods);
            $title = 'Sale price';
        }

        if(session('locale') == 'en'){
            $categories = Category::all()->sortBy('name_en');
        } else if(session('locale') == 'ru'){
            $categories = Category::all()->sortBy('name');
        } else {
            $categories = Category::all()->sortBy('name');
        }

        return array(
            $goods,
            $count,
            $title,
            $categories,
        );

    }


//     public static function getCatalogTopNewData()
//     {
//         return $this->blogs;
//     }
}
