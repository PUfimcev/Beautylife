<?php

namespace App\Classes;

// use App\Models\Product;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use App\Classes\MainAbstractProductFilter;

class GetProducts extends MainAbstractProductFilter
{

    public function getNewArrivals(int $numberOffers = null)
    {
        if($numberOffers) {
            $newProducts =  $this->productBuilder->where('new', '1')->latest()->take($numberOffers)->get();
        } else {
            $newProducts =  $this->productBuilder->where('new', '1')->get();
        }

        return $newProducts;
    }


    public function getBestsellers(int $numberOffers = 0)
    {
        if($numberOffers) {
            $topProducts =  $this->productBuilder->where('top', '1')->latest()->take($numberOffers)->get();
        } else {
            $topProducts =  $this->productBuilder->where('top', '1')->get();
        }

        return $topProducts;
    }


    public function getResult($searchQuery)
    {
        if(!$searchQuery) return [];

        if(session('locale') == 'en'){
            $nameColumn = 'name_en';
            $slug = 'products.slug_en';
            $name = 'products.name_en';
            $about = 'product_descriptions.about_en';
        } elseif (session('locale') == 'ru'){
            $nameColumn = 'name';
            $slug = 'products.slug';
            $name = 'products.name';
            $about = 'product_descriptions.about';
        }

        $searchQuery = $this->productBuilder->join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')->select('products.id', $slug, $name, 'products.price', 'products.reduced_price', $about)->where($nameColumn , 'like',"%$searchQuery%")->get();


        return (isset($products) && !empty($products)) ? $searchQuery : [];
    }

}
