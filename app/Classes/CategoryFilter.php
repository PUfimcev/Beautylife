<?php

namespace App\Classes;

use App\Classes\MainAbstractProductFilter;
use App\Models\{Brand, Agerange, Category, Consumer, SkinType, Product};

class CategoryFilter extends MainAbstractProductFilter
{

    public function getCatalogProducts($query)
    {
        if(empty($query)){

        }

        $products = $this->productBuilder->where('id',$query)->get()->map->properties->get()->map->product_id;

        dd($products);
        // $products = Product::find($productsID);
// join('properties', 'categories.id', '=', 'properties.category_id')

        return $productsID;
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
    public static function getCatalogOptionData()
    {

        $brands = self::getBrandData();

        $skintypes = self::getSkintypesData();

        $ageranges = self::getAgerangesData();

        $consumers = self::getConsumersData();

        return array(
            $brands,
            $skintypes,
            $ageranges,
            $consumers,
        );

    }

}
