<?php

namespace App\Classes;

use App\Models\Brand;
use App\Models\Agerange;
use App\Models\Category;
use App\Models\Consumer;
use App\Models\SkinType;

abstract class CategoryFilter
{
    // protected $query;
    // protected $request;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        $this->getCatalogData();
    }


    /**
     * getBrandData
     *
     * @return void
     */
    protected static function getBrandData()
    {
        return Brand::all()->sortBy('brand_name');
    }

    /**
     * getSkintypesData
     *
     * @return void
     */
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


    /**
     * getAgerangesData
     *
     * @return void
     */
    protected static function getAgerangesData()
    {
        if(session('locale') == 'en'){
            $ageranges = Agerange::all()->sortBy('name_en');
        } else if(session('locale') == 'ru'){
            $ageranges = Agerange::all()->sortBy('name');
        } else {
            $ageranges = Agerange::all()->sortBy('name');
        }

        return $ageranges;
    }

    /**
     * getConsumersData
     *
     * @return void
     */
    protected static function getConsumersData()
    {
        if(session('locale') == 'en'){
            $consumers = Consumer::all()->sortBy('name_en');
        } else if(session('locale') == 'ru'){
            $consumers = Consumer::all()->sortBy('name');
        } else {
            $consumers = Consumer::all()->sortBy('name');
        }

        return $consumers;
    }

    /**
     * getCataloges
     *
     * @return void
     */
    public static function getCatalogs()
    {
        if(session('locale') == 'en'){
            $categories = Category::all()->sortBy('name_en');
        }

        $categories = Category::all()->sortBy('name');

        return $categories;
    }

    /**
     * getCatalogData
     *
     * @return void
     */
    public static function getCatalogData()
    {

        $brands = self::getBrandData();

        $skintypes = self::getSkintypesData();

        $ageranges = self::getAgerangesData();

        $consumers = self::getConsumersData();

        $productsAll = range(1, 25, 1);

        $products = array_slice($productsAll, 0, 12);

        $count = count($productsAll);

        return array(
            $brands,
            $skintypes,
            $ageranges,
            $consumers,
            $count,
            $products,
        );

    }

}
