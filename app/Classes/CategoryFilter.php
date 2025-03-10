<?php

namespace App\Classes;

use App\Models\Property;
use Illuminate\Database\Query\Builder;
use App\Classes\MainAbstractProductFilter;
use App\Models\{Brand, Agerange, Category, Consumer, SkinType, Product};

class CategoryFilter extends MainAbstractProductFilter
{

    /**
    * @param mixed $queryTopNew
    * @return void
    */
    public function selectGoods($queryTopNew)
    {
        if(!$queryTopNew) return;

        if($queryTopNew == 'bestsellers') {
            $this->productBuilder->where('top', 1);
        }

        if($queryTopNew == 'new-arrivals')  {
            $this->productBuilder->where('new', 1);
        }

        if($queryTopNew == 'all-goods')  {
            $this->productBuilder;
        }

        if($queryTopNew == 'sale-price')  {
            $this->productBuilder->where('reduced_price', '>', 0)->where('amount', '>', 0);
        }

    }

    /**
    * @param mixed $querySubcategories
    * @return void
    */
    public function subcategorySelect($querySubcategories)
    {
        $this->productBuilder->whereIn('id', function (Builder $query) use ($querySubcategories) {
            $query->select('product_id')
                ->from('properties')
                ->whereColumn('properties.product_id', 'products.id')->whereIn('properties.subcategory_id', $querySubcategories);
            });
    }

    /**
    * @param mixed $queryBrands
    * @return void
    */
    public function brandSelect($queryBrands)
    {
        $this->productBuilder->whereIn('id', function (Builder $query) use ($queryBrands) {
            $query->select('product_id')
                ->from('properties')
                ->whereColumn('properties.product_id', 'products.id')->whereIn('properties.brand_id', $queryBrands);
            });
    }


    /**
    * @param string $queryPriceFrom
    * @return void
    */
    public function priceFrom($queryPriceFrom)
    {
        // dd($queryPriceFrom == null);
        if(!isset($queryPriceFrom)) {
            $this->productBuilder;
        } else {

            $this->productBuilder->where('amount', '>', '0')->where(function($query) use ($queryPriceFrom){
                $query->where(function($query) use ($queryPriceFrom){
                    $query->where('price', '>=', $queryPriceFrom)->where('reduced_price', '=','0');
                })->orWhere(function($query) use ($queryPriceFrom){
                    $query->where('reduced_price', '>=', $queryPriceFrom)->where('reduced_price', '>','0');
                });
            });
        }

    }

    /**
    * @param string $queryPriceTo
    * @return void
    */
    public function priceTo($queryPriceTo)
    {
        // dd(isset($queryPriceTo));
        if(!isset($queryPriceTo)) {
            $this->productBuilder;
        } else {

            $this->productBuilder->where('amount', '>', '0')->where(function($query) use ($queryPriceTo){
                $query->where(function($query) use ($queryPriceTo){
                    $query->where('price', '<=', $queryPriceTo)->where('reduced_price', '=','0');
                })->orWhere(function($query) use ($queryPriceTo){
                    $query->where('reduced_price', '<=', $queryPriceTo)->where('reduced_price', '>','0');
                });
            });
        };

    }

    /**
    * @param mixed $querySkintype
    * @return void
    */
    public function skintypeSelect($querySkintype)
    {
        $this->productBuilder->whereIn('id', function (Builder $query) use ($querySkintype) {
            $query->select('product_id')
                ->from('properties')
                ->whereColumn('properties.product_id', 'products.id')->whereIn('properties.skin_type_id', $querySkintype);
            });
    }

    /**
    * @param mixed $queryAgerange
    * @return void
    */
    public function agerangeSelect($queryAgerange)
    {
        $this->productBuilder->whereIn('id', function (Builder $query) use ($queryAgerange) {
            $query->select('product_id')
                ->from('properties')
                ->whereColumn('properties.product_id', 'products.id')->whereIn('properties.agerange_id', $queryAgerange);
            });
    }

    /**
    * @param mixed $queryConsumer
    * @return void
    */
    public function consumerSelect($queryConsumer)
    {
        $this->productBuilder->whereIn('id', function (Builder $query) use ($queryConsumer) {
            $query->select('product_id')
                ->from('properties')
                ->whereColumn('properties.product_id', 'products.id')->whereIn('properties.consumer_id', $queryConsumer);
            });
    }

    /**
    * @param mixed $queryCatalog
    * @return void
    */
    public function getCatalogProducts($queryCatalog)
    {
        if(!$queryCatalog) return;

        $this->productBuilder->where(function (Builder $query) {
            $query->select('category_id')
                ->from('properties')
                ->whereColumn('properties.product_id', 'products.id');
        }, $queryCatalog
        );

    }

    /**
     * getBrandData
     *
     * @return collection
     */
    protected static function getBrandData()
    {
        return Brand::all()->sortBy('brand_name');
    }

    /**
     * getSkintypesData
     *
     * @return collection
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
     * @return collection
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
     * @return collection
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
     * @return collection
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
     * @return array
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
