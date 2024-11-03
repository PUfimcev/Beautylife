<?php

namespace App\Classes;

use App\Models\Brand;
use App\Models\SkinType;

abstract class CategoryFilter
{
    // protected $query;
    // protected $request;

    public function __construct()
    {

        $this->getCatalogData();
    }



    protected static function getBrandData()
    {
        return Brand::all()->sortBy('brand_name');
    }

    protected static function getSkintypesData()
    {
        if(session('locale') == 'en'){
            $skintypes = SkinType::all()->sortBy('name_en');
        } else if(session('locale') == 'ru'){
            $skintypes = SkinType::all()->sortBy('name');
        } else {
            $skintypes = SkinType::all()->sortBy('name');
        }

        return $skintypes;
    }


    public static function getCatalogData()
    {

        $brands = self::getBrandData();

        $skintypes = self::getSkintypesData();

        $products = [1, 2, 3, 4, 5, 6];

        $count = count($products);

        return array(
            $brands,
            $skintypes,
            $count,
            $products,
        );

    }

}
