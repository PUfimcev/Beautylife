<?php

namespace App\Classes;

use App\Models\Category;
use App\Classes\MainAbstractProductFilter;


class GetCatalogTopNewData extends MainAbstractProductFilter
{

    /**
    * @param mixed $query
    * @return ((int[]|unset)|(int|unset)|(string|unset)|\Illuminate\Database\Eloquent\Collection<int, \App\Models\Category>)[
    */

    public function getCatalogTopNewData($query)
    {

        $products = $this->getProducts($query)->orderBy('created_at', 'desc');

        return $products;
    }


    public function getProducts($query)
    {
        if($query == 'bestsellers') {
            $goods = $this->productBuilder->where('top', 1);
        }

        if($query == 'new-arrivals')  {
            $goods = $this->productBuilder->where('new', 1);
        }

        if($query == 'all-goods')  {
            $goods = $this->productBuilder;
        }

        if($query == 'sale-price')  {
            $goods = $this->productBuilder->where('reduced_price', '>', 0);
        }

        return $goods;

    }
}
